<template>
  <div>
    <input type="file" @change="handleFileUpload" accept=".csv" />

    <VisualGrid ref="visualGrid" :options="gridConfig" />
    <el-button type="primary" @click="addRow(10)">添加十条记录</el-button>

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
    <el-button type="primary" @click="importData">保存入数据库</el-button>
  </div>
</template>

<script lang="ts" setup>
import Papa from 'papaparse'
import { adjustBalance, importLinePrice,getBrandAll, getCannelAll } from '@/addon/fengchao/api/site'
import { useRoute, useRouter } from 'vue-router'

import { reactive, ref, watch } from 'vue'
import VisualGrid from '../VisualGrid.vue'
import { GridOptions, Grid, InputEditor, RowData } from '@visualjs/grid'
import { ElMessage } from 'element-plus'
import { t } from '@/lang'
import { forEach } from 'lodash-es'

import { getRegisterChannelType } from '@/app/api/member'
const route = useRoute()
const router = useRouter()
const initialFormData = {
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
  fillable: 'xy',
  getColumnMenuItems: (params) => {
    const options = params.grid.getColumnOptions(params.column)

    const setColumnPinned = (pinned?: 'left' | 'right') => {
      params.grid.setColumnPinned(params.column, pinned)
    }

    const pinnedIcon = (pinned?: 'left' | 'right') => {
      if (pinned === options.pinned) {
        return 'vg-checkmark'
      }
    }

    return [
      {
        name: 'Pin Current Column',
        icon: 'vg-pin',
        disabled: options.readonly,
        subMenus: [
          {
            name: 'Pin Left',
            action: () => setColumnPinned('left'),
            icon: pinnedIcon('left')
          },
          {
            name: 'Pin Right',
            action: () => setColumnPinned('right'),
            icon: pinnedIcon('right')
          },
          {
            name: 'No Pin',
            action: () => setColumnPinned(),
            icon: pinnedIcon()
          }
        ]
      },
      {
        name: 'Flex',
        icon: options.flex ? 'vg-checkmark' : '',
        action: () => {
          params.grid.setColumnWidth(params.column, {
            flex: Number(!options.flex)
          })
        }
      },
      {
        name: 'Visible',
        icon: options.visible ? 'vg-checkmark' : '',
        action: () => {
          params.grid.setColumnVisible(params.column, false)
        }
      }
    ]
  },
  getContextMenuItems: (params) => {
    const options = params.grid.getColumnOptions(params.column)

    const setRowsPinned = (pinned?: 'top' | 'bottom') => {
      if (pinned == 'top') {
        params.grid.appendPinnedTopRows(params.grid.getSelectedRows())
      } else if (pinned == 'bottom') {
        params.grid.appendPinnedBottomRows(params.grid.getSelectedRows())
      } else {
        params.grid.takePinnedRows(params.grid.getSelectedRows())
      }
    }

    const pinnedTopRowIcon = () => {
      return params.grid.isPinnedTop(params.row) ? 'vg-checkmark' : ''
    }
    const pinnedBottomRowIcon = () => {
      return params.grid.isPinnedBottom(params.row) ? 'vg-checkmark' : ''
    }
    const noPinnedRowIcon = () => {
      return !params.grid.isPinnedRow(params.row) ? 'vg-checkmark' : ''
    }

    return [
      { name: 'Enlarge', icon: 'vg-enlarge-simplicit' },
      { separator: true },
      {
        name: 'Pin Current Row',
        icon: 'vg-pin',
        subMenus: [
          {
            name: 'Pin Top',
            action: () => setRowsPinned('top'),
            icon: pinnedTopRowIcon()
          },
          {
            name: 'Pin Bottom',
            action: () => setRowsPinned('bottom'),
            icon: pinnedBottomRowIcon()
          },
          {
            name: 'No Pin',
            action: () => setRowsPinned(),
            icon: noPinnedRowIcon()
          }
        ]
      },
      { separator: true },
      {
        name: 'Copy',
        icon: 'vg-copy',
        action: () => params.grid.copySelection()
      },
      {
        name: 'Paste',
        disabled: options.readonly,
        icon: 'vg-paste',
        action: () => params.grid.pasteFromClipboard()
      },
      { separator: true },
      {
        name: 'Delete',
        disabled: options.readonly,
        icon: 'vg-trash-bin',
        action: () => {
          params.grid.removeRows([params.row])
        }
      },
      { separator: true },
      { name: 'Download', icon: 'vg-download', disabled: true }
    ]
  }
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

// 保存
const importData = () => {
  if (visualGrid.value?.gridInstance) {
    const rows = visualGrid.value.gridInstance.getState().row.rows

    Object.assign(formData, {

      line_price: rows
    })
    importLinePrice(formData).then(res => {
      console.log(res)
    }).catch(() => {

    })
    console.log('Grid instance:', visualGrid.value.gridInstance)
  } else {
    console.error('Grid instance not available!')
  }
}
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
