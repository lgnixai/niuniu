<template>
    <el-dialog v-model="showDialog" :title="elDialogTitle" width="900px" :destroy-on-close="true">
        <el-form :model="formData" label-width="100px" ref="formRef" :rules="formRules" class="page-form" autocomplete="off" v-loading="loading">

          <el-form-item :label="t('expressNoPlaceholder')" prop="express_no">
            <el-select v-model="formData.express_no" :placeholder="t('expressNoPlaceholder')" class="input-width" filterable>

              <el-option v-for="item in brandList" :key="item.express_no" :label="item.company_name" :value="item.express_no">

              </el-option>
            </el-select>
          </el-form-item>
          <el-form-item :label="t('deliveryPlaceholder')" prop="express_no">
            <el-select v-model="formData.delivery" :placeholder="t('expressNoPlaceholder')" class="input-width" filterable>

              <el-option v-for="item in channelList" :key="item.code" :label="item.name" :value="item.code">

              </el-option>
            </el-select>
          </el-form-item>
          <el-form-item  label="上传价格" prop="deliveryPlaceholder">
            <input type="file" @change="handleFileUpload" accept=".csv" />
            <VisualGrid ref="visualGrid" :options="gridConfig" />
          </el-form-item>

        </el-form>

        <template #footer>
            <span class="dialog-footer">
                <el-button @click="showDialog = false">{{ t('cancel') }}</el-button>
                <el-button type="primary" :loading="loading" @click="confirm(formRef)">{{ t('confirm') }}</el-button>
            </span>
        </template>
    </el-dialog>
</template>

<script lang="ts" setup>
import { ref, reactive, computed, watch } from 'vue'
import { t } from '@/lang'
import { ElMessage, FormInstance } from 'element-plus'
import { getBrandAll, getCannelAll, importLinePrice } from '@/addon/fengchao/api/site'
import { useRoute, useRouter } from 'vue-router'
import { GridOptions, InputEditor, RowData } from '@visualjs/grid'
import VisualGrid from '@/addon/fengchao/views/components/VisualGrid.vue'
import Papa from 'papaparse'
const route = useRoute()
const showDialog = ref(false)
const loading = ref(true)

const end = new Date()

end.setTime(end.getTime() + 3600 * 1000 * 2 * 360)
/**
 * 表单数据
 */
const initialFormData = {
    site_id: 0,
    express_no: '',
    delivery: '',
    line_price: []
}
const formData: Record<string, any> = reactive({ ...initialFormData })
formData.site_id = ref(route.query.site_id)
const formRef = ref<FormInstance>()

const brandList = ref([])
const getBrandsList = async () => {
    brandList.value = await (await getBrandAll()).data

    console.log(brandList)
}
getBrandsList()

const channelList = ref([])

const getChannelList = async () => {
    channelList.value = await (await getCannelAll()).data
    loading.value = false
    console.log(brandList)
}
getChannelList()

const setFormData = async (row: any = null) => {
    loading.value = true
    Object.assign(formData, initialFormData)
    if (row) {
        // const data = await (await getSiteInfo(row.site_id)).data
        // siteType.value = data
        // Object.keys(formData).forEach((key: string) => {
        //     if (data[key] != undefined) formData[key] = data[key]
        // })
        formData.site_id = row.site_id
    }
    loading.value = false
}

// 表单验证规则
const formRules = computed(() => {
    return {
        express_no: [
            { required: true, message: t('expressNoPlaceholder'), trigger: 'blur' }
        ],
        delivery: [
            { required: true, message: t('deliveryPlaceholder'), trigger: 'blur' }
        ]
    }
})

const emit = defineEmits(['complete'])

// 弹窗头部
const elDialogTitle = computed(() => {
    if (loading.value) return ''
    return '导入价格'
})

const rows: RowData[] = []
for (let i = 0; i < 1; i++) {
    const data: RowData = {
        id: String(i),
        senderProvince: '',
        receiveProvince: '',
        firstWeight: '',
        continuousWeight: '',
        remark: ''
    }
    rows.push(data)
}
const gridConfig = reactive<GridOptions>({
    columns: [
        { field: 'id', headerName: 'id', resizable: true, width: 100 },
        { field: 'senderProvince', headerName: '发件省', resizable: true, width: 100 },
        { field: 'receiveProvince', headerName: '收件省', resizable: true, width: 100 },
        { field: 'firstWeight', headerName: '首重', resizable: true, width: 100 },
        { field: 'continuousWeight', headerName: '续重', resizable: true, width: 100 },
        { field: 'remark', headerName: '备注', resizable: true, width: 100 }
    ],
    defaultColumnOption: {
        width: 60,
        cellEditor: InputEditor
    },
    rows,
    fillable: 'xy'

})

const visualGrid = ref<InstanceType<typeof VisualGrid> | null>(null)
watch(() => visualGrid.value, () => {
    visualGrid.value.gridInstance.on('beforePaste', (str) => {
        const len = str.split('\n')
        // alert(len.length)
        addRow(len.length)
    })
})
// 添加一行数据
const addRow = (len) => {
    // visualGrid.value.gridInstance.g()
    // visualGrid.value.gridInstance.setRows = []
    const rows: RowData[] = []

    if (visualGrid.value?.gridInstance) {
        for (let i = 0; i < len; i++) {
            rows.push(

                {
                    id: String(i),
                    senderProvince: '',
                    receiveProvince: '',
                    firstWeight: '',
                    continuousWeight: '',
                    remark: ''
                }

            )
        }
        console.log()
    } else {
        console.error('Grid instance not available!')
    }

    visualGrid.value.gridInstance.store('row').dispatch('setRows', rows)
}
/**
 * 确认
 * @param formEl
 */
const confirm = async (formEl: FormInstance | undefined) => {
    if (loading.value || !formEl) return

    await formEl.validate(async (valid) => {
        if (valid) {
            loading.value = true

            if (visualGrid.value?.gridInstance) {
                const rows = visualGrid.value.gridInstance.getState().row.rows
                if (rows.length <= 1) {
                    ElMessage('请导入数据')
                    loading.value = false
                    return
                }
                Object.assign(formData, {

                    line_price: rows
                })
                loading.value = true
                importLinePrice(formData).then(res => {
                    loading.value = false
                    emit('complete')
                }).catch(() => {
                    loading.value = false
                })
            } else {

            }
        }
    })
}
// 文件上传处理函数
const handleFileUpload = (event: Event) => {
    const target = event.target as HTMLInputElement
    const file = target.files?.[0] // 获取上传的文件
    if (file) {
    // 使用 PapaParse 解析 CSV 文件
        Papa.parse(file, {
            header: false, // 如果第一行是表头，设置为 true
            skipEmptyLines: true, // 跳过空行
            complete: (result) => {
                if (result.errors.length > 0) {
                    console.error('解析错误:', result.errors)
                    return
                }
                const data = result.data as Record<string, string>[] // 解析后的数据

                // visualGrid.value.gridInstance.clearRows()
                let rowId = 0
                const rows1: RowData[] = []

                if (data.length > 0) {
                    // eslint-disable-next-line array-callback-return
                    data.map((row) => {
                        const r = {
                            id: String(rowId++),
                            senderProvince: row[0],
                            receiveProvince: row[1],
                            firstWeight: row[2],
                            continuousWeight: row[3]

                        }

                        rows1.push(r)
                    })

                    visualGrid.value.gridInstance.store('row').dispatch('setRows', rows1)
                }
            },
            error: (error) => {
                console.error('文件解析失败:', error)
            }
        })
    }
}
// 禁止点击input输入框时浏览器显示默认的账号信息
window.onload = function () {
    const inputs = document.getElementsByTagName('input')
    for (let i = 0; i < inputs.length; i++) {
        inputs[i].setAttribute('autocomplete', 'off')
    }
}

defineExpose({
    showDialog,
    setFormData,
    loading
})
</script>

<style  >
.visual-grid-container {
  width: 100%;
  height: 350px;
  width: 95%;
  /* max-width: 1200px; */
  height: 380px;
}

</style>
