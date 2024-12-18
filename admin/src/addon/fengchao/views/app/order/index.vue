<template>
  <div class="main-container">
    <el-card class="box-card !border-none" shadow="never">

      <div class="flex justify-between items-center">
        <div class="detail-head !m-0">
          <span class="right">{{ pageName }}</span>
        </div>

      </div>

      <el-card class="box-card !border-none my-[10px] table-search-wrap" shadow="never">
        <el-form :inline="true" :model="orderTable.searchParam" ref="searchFormRef">
          <el-form-item :label="t('orderCode')" prop="order_code">
            <el-input v-model.trim="orderTable.searchParam.order_code" :placeholder="t('orderCodePlaceholder')"/>
          </el-form-item>
          <el-form-item :label="t('createTime')" prop="create_time">
            <el-date-picker v-model="orderTable.searchParam.create_time" type="datetimerange"
                            value-format="YYYY-MM-DD HH:mm:ss" :start-placeholder="t('startDate')"
                            :end-placeholder="t('endDate')"/>
          </el-form-item>

          <el-form-item>
            <el-button type="primary" @click="loadOrderList()">{{ t('search') }}</el-button>
            <el-button @click="resetForm(searchFormRef)">{{ t('reset') }}</el-button>
            <el-button type="primary" @click="exportEvent">{{ t('export') }}</el-button>

          </el-form-item>
        </el-form>
      </el-card>

      <div class="mt-[10px]">
        <el-table :data="orderTable.data" size="large" v-loading="orderTable.loading">
          <template #empty>
            <span>{{ !orderTable.loading ? t('emptyData') : '' }}</span>
          </template>

          <el-table-column prop="order_code" fixed :label="t('orderCode')" min-width="220" style="width: 100%">
            <template #default="{ row }">
              <el-tooltip
                  class="item"
                  effect="dark"
                  :content="row.order_id"
                  placement="top"
              >
                <span> {{ (row.order_id) }}</span>
              </el-tooltip>
            </template>
          </el-table-column>

          <el-table-column prop="client_order_code" label="商家订单号" min-width="200"/>
          <el-table-column prop="logistic_order_code" label="运单号" min-width="200"/>
          <el-table-column prop="order_info.Sender.ProvinceName" label="发件省" min-width="120"/>
          <el-table-column prop="order_info.Sender.Name" label="发件人" min-width="120"/>
          <el-table-column prop="order_info.Receiver.ProvinceName" label="收件省" min-width="120"/>
          <el-table-column prop="order_info.Receiver.Name" label="收件人" min-width="120"/>
          <el-table-column prop="order_info.ShipperCode" label="物流公司" min-width="120"/>

          <el-table-column :label="t('operation')" fixed="right" align="right" min-width="120">
            <template #default="{ row }">
              <el-button type="primary" link @click="detailEvent(row)">{{ t('detailInfo') }}</el-button>

            </template>
          </el-table-column>

        </el-table>
        <div class="mt-[16px] flex justify-end">
          <el-pagination v-model:current-page="orderTable.page" v-model:page-size="orderTable.limit"
                         layout="total, sizes, prev, pager, next, jumper" :total="orderTable.total"
                         @size-change="loadOrderList()" @current-change="loadOrderList"/>
        </div>
      </div>

      <export-sure ref="exportSureDialog" :show="flag" type="fengchao_order" :searchParam="orderTable.searchParam"
                   @close="handleClose"/>
      <order-detail ref="orderDetailDialog"/>

    </el-card>
  </div>
</template>

<script lang="ts" setup>
import { reactive, ref } from 'vue'
import { t } from '@/lang'
import { getOrderList } from '@/addon/fengchao/api/order'

import { FormInstance } from 'element-plus'
import { useRoute, useRouter } from 'vue-router'
import OrderDetail from '@/addon/fengchao/views/app/order/detail.vue'

const route = useRoute()
const router = useRouter()
const pageName = '订单列表'

const orderTable = reactive({
    page: 1,
    limit: 10,
    total: 0,
    loading: true,
    data: [],
    searchParam: {
        order_code: '',
        create_time: ''
    }
})
// const formatOrderCode = function (code) {
//     if (code.length <= 6) {
//         return code // 如果长度小于等于6，不做缩略
//     }
//     const start = code.slice(0, 3) // 取前三位
//     const end = code.slice(-3) // 取后三位
//     return `${start}...${end}` // 拼接缩略显示
// }

const searchFormRef = ref<FormInstance>()

/**
 * 获取物流公司列表
 */
const loadOrderList = (page: number = 1) => {
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
    }).catch(() => {
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
const orderDetailDialog: Record<string, any> | null = ref(null)

const detailEvent = (data: any) => {
    orderDetailDialog.value.setFormData(data)
    orderDetailDialog.value.showDialog = true
}
const exportSureDialog = ref(null)
const flag = ref(false)
const handleClose = (val) => {
    flag.value = val
}
const exportEvent = (data: any) => {
    flag.value = true
}
</script>

<style lang="scss" scoped>
</style>
