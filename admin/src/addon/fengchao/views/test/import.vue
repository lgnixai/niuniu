<template>
  <div  >

    <el-form :model="formData" label-width="100px" ref="formRef" :rules="formRules" class="page-form" autocomplete="off" v-loading="loading">
      <el-form-item :label="t('expressNoPlaceholder')" prop="expressNoPlaceholder">

        <el-select class="input-width" :placeholder="t('expressNoPlaceholder')" v-model="formData.express_no"   clearable>
          <el-option :label="item.company_name" :value="item.express_no" v-for="item in brandList" :key="item.express_no" />
        </el-select>

      </el-form-item>
      <el-form-item :label="t('deliveryPlaceholder')" prop="deliveryPlaceholder">

        <el-select class="input-width" :placeholder="t('deliveryPlaceholder')" v-model="formData.delivery"   clearable>
          <el-option :label="item.name" :value="item.code" v-for="item in channelList" :key="item.code" />
        </el-select>
      </el-form-item>
    </el-form>
    <el-button type="primary" :loading="loading" @click="confirm(formRef)">保存入数据库</el-button>

<!--    <el-form :model="formData" label-width="100px" ref="formRef" :rules="formRules" class="page-form" autocomplete="off" v-loading="loading">-->

<!--  -->
    <el-form-item  label="上传价格" prop="deliveryPlaceholder">
      <input type="file" @change="handleFileUpload" accept=".csv" />

    </el-form-item>

      <VisualGrid ref="visualGrid" :options="gridConfig" />

    </el-form>
  </div>
</template>

<script lang="ts" setup>
import Papa from 'papaparse'
import { adjustBalance, importLinePrice, getBrandAll, getCannelAll } from '@/addon/fengchao/api/site'
import { useRoute, useRouter } from 'vue-router'

import { computed, reactive, ref, watch } from 'vue'
import VisualGrid from '@/addon/fengchao/views/components/VisualGrid.vue'
import { GridOptions, Grid, InputEditor, RowData } from '@visualjs/grid'
import { ElMessage, type FormInstance } from 'element-plus'
import { t } from '@/lang'
import { forEach } from 'lodash-es'
import { getRegisterChannelType } from '@/app/api/member'
import { img } from '@/utils/common'
const loading = ref(true)
const route = useRoute()
const router = useRouter()
const initialFormData = {
    loading: true,
    express_no: '',
    delivery: '',
    line_price: [],
    site_id: 0
}
/**
 * 表单数据
 */

const formData: Record<string, any> = reactive({ ...initialFormData })

formData.site_id = ref(route.query.site_id)

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
const insertRow = (row:any) => {
    console.log(row)
    if (visualGrid.value?.gridInstance) {
        visualGrid.value.gridInstance.appendRows(

            [row]

        )
    } else {
        console.error('Grid instance not available!')
    }
}
const formRules = computed(() => {
    return {
        express_no: [
            { required: true, message: t('siteNamePlaceholder'), trigger: 'blur' }
        ],
        group_id: [
            { required: true, message: t('groupIdPlaceholder'), trigger: 'blur' }
        ]

    }
})
const formRef = ref<FormInstance>()
const emit = defineEmits(['complete'])
/**
 * 确认
 * @param formEl
 */
const confirm = async (formEl: FormInstance | undefined) => {
    if (loading.value || !formEl) return

    await formEl.validate(async (valid) => {
        alert(valid)
        if (valid) {
            loading.value = true

            const data = formData

            if (visualGrid.value?.gridInstance) {
                const rows = visualGrid.value.gridInstance.getState().row.rows
                Object.assign(formData, {

                    line_price: rows
                })
                loading.value = true
                importLinePrice(formData).then(res => {
                    console.log(res)
                    loading.value = false
                    emit('complete')
                }).catch(() => {
                    loading.value = false
                })
                console.log('Grid instance:', visualGrid.value.gridInstance)
            } else {
                console.error('Grid instance not available!')
            }
        }
    })
}
// // 保存
// const importData = () => {
//     if (visualGrid.value?.gridInstance) {
//         const rows = visualGrid.value.gridInstance.getState().row.rows
//
//         Object.assign(formData, {
//
//             line_price: rows
//         })
//         loading.value = true
//         importLinePrice(formData).then(res => {
//             console.log(res)
//             loading.value = false
//         }).catch(() => {
//             loading.value = false
//         })
//         console.log('Grid instance:', visualGrid.value.gridInstance)
//     } else {
//         console.error('Grid instance not available!')
//     }
// }
const headers = ref<string[]>([]) // 表头
const tableData = ref<string[][]>([]) // 表格数据

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
                    data.map((row) => {
                        const r = {
                            id: String(rowId++),
                            senderProvince: row[0],
                            receiveProvince: row[1],
                            firstWeight: row[2],
                            continuousWeight: row[3]

                        }

                        rows1.push(r)
                        // insertRow(r)

                        //  console.log(r)
                        // visualGrid.value.gridInstance.appendRows([r])

                        // return r

                        // console.log(row)
                        // headers.value.map((header) => row[header] || '') // 确保值为空时显示空字符串
                    }
                    )

                    visualGrid.value.gridInstance.store('row').dispatch('setRows', rows1)
                }
            },
            error: (error) => {
                console.error('文件解析失败:', error)
            }
        })
    }
}
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
