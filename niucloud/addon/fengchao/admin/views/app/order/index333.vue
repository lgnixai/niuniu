<template>
  <div class="flex border-t border-b main-wrap border-color w-full" :class=" 'h-full'">
    <el-card class="box-card !border-none" shadow="never">

      <div class="flex justify-between items-center">
        <div class="detail-head !m-0">
          <span class="right">{{ pageName }}</span>
        </div>

      </div>

      <el-card class="box-card !border-none my-[10px] table-search-wrap" shadow="never">
        <el-form :inline="true" :model="orderTable.searchParam" ref="searchFormRef">
          <el-form-item :label="t('orderCode')" prop="order_code">
            <el-input v-model.trim="orderTable.searchParam.order_id" :placeholder="t('orderCodePlaceholder')"/>
          </el-form-item>
          <el-form-item :label="t('createTime')" prop="create_time">
            <el-date-picker v-model="orderTable.searchParam.create_time" type="datetimerange"
                            value-format="YYYY-MM-DD HH:mm:ss" :start-placeholder="t('startDate')"
                            :end-placeholder="t('endDate')" />
          </el-form-item>

          <el-form-item>
            <el-button type="primary" @click="loadOrderList()">{{ t('search') }}</el-button>
            <el-button @click="resetForm(searchFormRef)">{{ t('reset') }}</el-button>
            <!--            <el-button type="primary" @click="exportEvent">{{ t('export') }}</el-button>-->

          </el-form-item>
        </el-form>
      </el-card>
      <div class="attachment-list-wrap flex flex-col p-[15px] flex-1 overflow-hidden">

        <el-scrollbar height="500px"  >

          <VisualGrid ref="visualGrid" :options="gridConfig" />
        </el-scrollbar>
      </div>

      <order-detail ref="orderDetailDialog" @complete="loadOrderList()" />
    </el-card>
  </div>
</template>

<script lang="ts" setup>
import { reactive, ref, watch } from 'vue'
import { t } from '@/lang'
import { getOrderList } from '@/addon/fengchao/api/order'
import { img } from '@/utils/common'
import { ElMessageBox, FormInstance } from 'element-plus'
import { useRoute, useRouter } from 'vue-router'
import VisualGrid from '@/addon/fengchao/views/components/VisualGrid.vue'
import { GridOptions, Grid, InputEditor, RowData } from '@visualjs/grid'
import { getCBData } from '@/addon/fengchao/api/api'
import OrderDetail from '@/addon/fengchao/views/app/order/detail.vue'

import '@easytable/vue/libs/theme-default/index.css'
// 引入组件库
import { VeTable } from '@easytable/vue'

const route = useRoute()
const router = useRouter()
const pageName = route.meta.title
const rows: RowData[] = []
const orderTable = reactive({
    page: 1,
    limit: 10,
    total: 0,
    loading: true,
    data: [],
    searchParam: {
        order_id: '',
        create_time: ''
    }
})
const formatOrderCode = function (code) {
    if (code.length <= 6) {
        return code // 如果长度小于等于6，不做缩略
    }
    const start = code.slice(0, 3) // 取前三位
    const end = code.slice(-3) // 取后三位
    return `${start}...${end}` // 拼接缩略显示
}

const searchFormRef = ref<FormInstance>()
function sleep (ms) {
    return new Promise(resolve => setTimeout(resolve, ms))
}
/**
 * 获取物流公司列表
 */
const loadOrderList = async (page: number = 1) => {
    orderTable.loading = true
    orderTable.page = page

    getOrderList({
        page: orderTable.page,
        limit: orderTable.limit,
        ...orderTable.searchParam
    }).then(res => {
        orderTable.loading = false

        orderTable.data = res.data.data
        orderTable.total = res.data.total
        const data = res.data.data
        let rowId = 0

        if (data.length > 0) {
            data.map((row) => {
                const r = {
                    id: String(rowId++),
                    order_id: row.deliveryInfo.order_id,
                    client_order_code: row.deliveryInfo.client_order_code,
                    logistic_order_code: row.deliveryInfo.logistic_order_code,
                    send_province_name: row.deliveryInfo.order_info.Sender.ProvinceName,
                    send_name: row.deliveryInfo.order_info.Sender.Name,
                    receive_province_name: row.deliveryInfo.order_info.Receiver.ProvinceName,
                    receive_name: row.deliveryInfo.order_info.Receiver.Name,
                    shipper_code: row.deliveryInfo.order_info.ShipperCode
                }

                rows.push(r)
            })

            visualGrid.value.gridInstance.store('row').dispatch('setRows', rows)
        }
    }).catch(async () => {
        await sleep(3000)
        orderTable.loading = false
    })
}
loadOrderList()

const resetForm = (formEl: FormInstance | undefined) => {
    if (!formEl) return
    formEl.resetFields()
    loadOrderList()
}

// 订单详情
// const detailEvent = (data: any) => {
//     router.push('/fengchao/order/detail?order_id=' + data.id)
// }

const exportSureDialog = ref(null)
const flag = ref(false)
const handleClose = (val) => {
    flag.value = val
}
const exportEvent = (data: any) => {
    flag.value = true
}

const gridConfig = reactive<GridOptions>({
    columns: [

        { field: 'id', headerName: 'id', resizable: true, width: 10 },
        { field: 'client_order_code', headerName: '商户订单', resizable: true, width: 200 },
        { field: 'order_id', headerName: '平台订单号', resizable: true, width: 200 },
        { field: 'logistic_order_code', headerName: '运单号', resizable: true, width: 200 },
        { field: 'send_name', headerName: '发件人', resizable: true, width: 100 },
        { field: 'send_province_name', headerName: '发件省', resizable: true, width: 100 },
        { field: 'receive_name', headerName: '收件人', resizable: true, width: 100 },
        { field: 'receive_province_name', headerName: '收件省', resizable: true, width: 100 },
        { field: 'shipper_code', headerName: '物流渠道', resizable: true, width: 100 }

    ],
    defaultColumnOption: {
        width: 60

    },
    rows,
    scrollThrottleRate: 10,
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
            { name: 'Download', icon: 'vg-download', disabled: true }
        ]
    }
})
const detailEvent = (data: any) => {
    orderDetailDialog.value.setFormData(data)
    orderDetailDialog.value.showDialog = true
}
const visualGrid = ref<InstanceType<typeof VisualGrid> | null>(null)

watch(visualGrid, () => {
    if (visualGrid.value?.gridInstance) {
        visualGrid.value.gridInstance.on('afterCellDbClicked', (data) => {
            const row = rows[parseInt(data.row)]
            //
            detailEvent(row)
        })
    }
})
const orderDetailDialog: Record<string, any> | null = ref(null)
/**
 * 查看详情
 * @param data
 */
// const columns = ([
//     { field: 'name', key: 'a', title: 'Name', align: 'center' },
//     { field: 'date', key: 'b', title: 'Date', align: 'left' },
//     { field: 'hobby', key: 'c', title: 'Hobby', align: 'right' },
//     { field: 'address', key: 'd', title: 'Address' }
// ])
// const tableData = ([
//     {
//         name: 'John',
//         date: '1900-05-20',
//         hobby: 'coding and coding repeat',
//         address: 'No.1 Century Avenue, Shanghai'
//     },
//     {
//         name: 'Dickerson',
//         date: '1910-06-20',
//         hobby: 'coding and coding repeat',
//         address: 'No.1 Century Avenue, Beijing'
//     },
//     {
//         name: 'Larsen',
//         date: '2000-07-20',
//         hobby: 'coding and coding repeat',
//         address: 'No.1 Century Avenue, Chongqing'
//     },
//     {
//         name: 'Geneva',
//         date: '2010-08-20',
//         hobby: 'coding and coding repeat',
//         address: 'No.1 Century Avenue, Xiamen'
//     },
//     {
//         name: 'Jami',
//         date: '2020-09-20',
//         hobby: 'coding and coding repeat',
//         address: 'No.1 Century Avenue, Shenzhen'
//     }
// ])

</script>
<style  >
.visual-grid-container {

  width: 95%;
  /* max-width: 1200px; */
  height: 380px;

}

</style>
