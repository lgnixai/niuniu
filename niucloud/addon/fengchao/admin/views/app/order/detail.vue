<template>
  <el-dialog v-model="showDialog"  title="订单明细" width="900px" :destroy-on-close="true">
    <el-scrollbar height="500px" v-loading="loading">
      <el-card class="order-card" shadow="hover">
        <h2>订单详情</h2>

        <!-- 基本订单信息 -->
        <el-row :gutter="20" class="section">
          <el-col :span="12">
            <el-descriptions title="基本信息" column="1" border>
              <el-descriptions-item label="订单 ID">{{ order.OrderId }}</el-descriptions-item>
              <el-descriptions-item label="客户订单号">{{ order.deliveryInfo.client_order_code }}</el-descriptions-item>
              <el-descriptions-item label="重量">{{ order.deliveryInfo.order_info.Weight }}</el-descriptions-item>
            </el-descriptions>
          </el-col>

          <el-col :span="12">
            <el-descriptions title="物流信息" column="1" border>
              <el-descriptions-item label="快递公司">{{ order.deliveryInfo.order_info.ShipperCode }}</el-descriptions-item>
              <el-descriptions-item label="快递单号">{{ order.deliveryInfo.logistic_order_code }}</el-descriptions-item>
              <el-descriptions-item label="状态">{{ order.deliveryInfo.order_status_desc }}</el-descriptions-item>

            </el-descriptions>
          </el-col>
        </el-row>
        <br /><br />
        <!-- 收发货信息 -->
        <el-row :gutter="20" class="section">
          <el-col :span="12">
            <el-descriptions title="收货信息" column="1" border>
              <el-descriptions-item label="收货人">{{ order.deliveryInfo.order_info.Receiver.Name }}</el-descriptions-item>
              <el-descriptions-item label="手机号">{{ order.deliveryInfo.order_info.Receiver.Mobile }}</el-descriptions-item>
              <el-descriptions-item label="省">{{ order.deliveryInfo.order_info.Receiver.ProvinceName }}</el-descriptions-item>
              <el-descriptions-item label="市">{{ order.deliveryInfo.order_info.Receiver.CityName }}</el-descriptions-item>
              <el-descriptions-item label="区/县">{{ order.deliveryInfo.order_info.Receiver.ExpAreaName }}</el-descriptions-item>
              <el-descriptions-item label="详细地址">{{ order.deliveryInfo.order_info.Receiver.Address }}</el-descriptions-item>
            </el-descriptions>
          </el-col>

          <el-col :span="12">
            <el-descriptions title="发货信息" column="1" border>
              <el-descriptions-item label="发货人">{{ order.deliveryInfo.order_info.Sender.Name }}</el-descriptions-item>
              <el-descriptions-item label="手机号">{{ order.deliveryInfo.order_info.Sender.Mobile }}</el-descriptions-item>
              <el-descriptions-item label="省">{{ order.deliveryInfo.order_info.Sender.ProvinceName }}</el-descriptions-item>
              <el-descriptions-item label="市">{{ order.deliveryInfo.order_info.Sender.CityName }}</el-descriptions-item>
              <el-descriptions-item label="区/县">{{ order.deliveryInfo.order_info.Sender.ExpAreaName }}</el-descriptions-item>
              <el-descriptions-item label="详细地址">{{ order.deliveryInfo.order_info.Sender.Address }}</el-descriptions-item>
            </el-descriptions>
          </el-col>
        </el-row>
        <br /><br />
        <el-row :gutter="20" class="section">
          <el-col :span="24">
            <el-descriptions title="商品信息" column="3" border>
              <el-descriptions-item v-for="(item, index) in order.deliveryInfo.order_info.Commodity" :key="`goods-${index}`" label="商品名称">
                {{ item.GoodsName }}
              </el-descriptions-item>
              <el-descriptions-item v-for="(item, index) in order.deliveryInfo.order_info.Commodity" :key="`quantity-${index}`" label="商品件数">
                {{ item.GoodsQuantity }}
              </el-descriptions-item>
              <el-descriptions-item v-for="(item, index) in order.deliveryInfo.order_info.Commodity" :key="`price-${index}`" label="商品价格">
                {{ item.GoodsPrice }}
              </el-descriptions-item>
            </el-descriptions>
          </el-col>
        </el-row>
        <br /><br />
        <!-- 支付信息 -->
        <el-row :gutter="20" class="section">
          <el-col :span="24">
            <el-descriptions title="费用信息" column="2" border>
<!--              <el-descriptions-item label="基础运费">{{ order.pay_info.cost }}</el-descriptions-item>-->
<!--              <el-descriptions-item label="首重金额">{{ order.pay_info.first_weight_amount }}</el-descriptions-item>-->
<!--              <el-descriptions-item label="续重总金额">{{ order.pay_info.continuous_weight_amount }}</el-descriptions-item>-->
<!--              <el-descriptions-item label="额外费用">{{ order.pay_info.other_fee }}</el-descriptions-item>-->
              <el-descriptions-item label="计费重量">{{ order.pay_info.weight }}</el-descriptions-item>
              <el-descriptions-item label="总费用">{{ order.pay_info.total_fee }}</el-descriptions-item>
            </el-descriptions>
          </el-col>
        </el-row>
      </el-card>

    </el-scrollbar>

    <template #footer>
            <span class="dialog-footer">
                <el-button @click="showDialog = false">{{ t('cancel') }}</el-button>
            </span>
    </template>
  </el-dialog>
</template>

<script lang="ts" setup>
import { reactive, ref } from 'vue'
import { t } from '@/lang'
import { getOrderDetail } from '@/addon/fengchao/api/order'

const showDialog = ref(false)
const loading = ref(false)
const initialFormData = {
    id: 3,
    site_id: 100008,
    order_id: '20241216511606390439936',
    order_money: null,
    order_discount_money: '0.00',
    order_add_money: '0.00',
    order_status: 0,
    add_price_status: 1,
    refund_status: 0,
    out_trade_no: null,
    pay_time: null,
    create_time: '2024-12-16 23:31:43',
    close_reason: null,
    close_time: null,
    ip: '127.0.0.1',
    update_time: '2024-12-16 23:32:20',
    delete_time: 0,
    deliveryInfo: {
        order_id: '20241216511606390439936',
        line_price_id: 4992,
        client_order_code: 'f48e1890-6dd2-38b7-8d39-232a17d866e9',
        service_order_code: 'KDNSIT2412162310000001',
        logistic_order_code: 'SF1390004911440',
        order_info: {
            TransportType: 1,
            ShipperType: 5,
            ShipperCode: 'YTO',
            OrderCode: 'f48e1890-6dd2-38b7-8d39-232a17d866e9',
            ExpType: 1,
            PayType: 3,
            Receiver: {
                ProvinceName: '广东省',
                CityName: '佛山市',
                ExpAreaName: '福田区',
                Address: '和 Street',
                Name: '倪子安',
                Mobile: '11898604843'
            },
            Sender: {
                ProvinceName: '河南省',
                CityName: '郑州市',
                ExpAreaName: '管城区',
                Address: '毛 Street',
                Name: '商智渊',
                Mobile: '11898604843'
            },
            Weight: 0.5,
            Quantity: 1,
            Remark: '',
            Commodity: [
                {
                    GoodsName: '食品',
                    GoodsQuantity: 1,
                    GoodsPrice: 752.02
                }
            ],
            result: {
                OrderCode: 'f48e1890-6dd2-38b7-8d39-232a17d866e9',
                KDNOrderCode: 'KDNSIT2412162310000001'
            }
        },
        picker_info: [
            {
                PersonName: '宋建硕',
                PersonTel: '18100006672',
                PickupCode: '1234',
                PersonCode: ''
            }
        ],
        pay_info: null,
        height: null,
        weight: 2,
        volume: 19200,
        volume_weight: 0.5,
        total_fee: 13,
        order_status_desc: '订单已分配快递员',
        order_status: '103',
        create_time: '2024-12-16 23:31:43',
        update_time: '2024-12-16 23:40:02',
        delete_time: null
    },
    pay_info: {
        id: 2,
        order_id: '20241216511606390439936',
        order_type: 2,
        weight: '2.00',
        first_weight_amount: '5.50',
        continuous_weight_amount: '6.50',
        cost: '12.00',
        insure_amount: '0.00',
        package_fee: '0.00',
        over_fee: '0.00',
        other_fee: '1.00',
        other_fee_detail: {
            其他费用: '1.00'
        },
        total_fee: '13.00',
        volume: '19200.00',
        volume_weight: '0.50'
    }
}

const order: Record<string, any> = reactive({ ...initialFormData })

const getOrder = async () => {
    getOrderDetail(order.OrderId).then(res => {
        loading.value = false
        const data = res.data
        if (data) {
            Object.keys(order).forEach((key: string) => {
                if (data[key] != undefined) order[key] = data[key]
            })
        }
    })
    loading.value = false
}

const setFormData = async (row: any = null) => {
    loading.value = true
    if (row) {
        order.OrderId = row.order_id
        getOrder()
    }
}

defineExpose({
    showDialog,
    setFormData
})
</script>

<style lang="scss" scoped></style>
