<template>
  <el-dialog v-model="showDialog" title="订单明细" width="900px" :destroy-on-close="true">
    <el-scrollbar height="500px" v-loading="loading">
      <el-card class="order-card" shadow="hover">

        <!-- 基本订单信息 -->
        <el-row :gutter="20" class="section">
          <el-col :span="12">
            <el-descriptions title="基本信息" column="1" border>
              <el-descriptions-item label="平台单号">{{ order.OrderId }}</el-descriptions-item>
              <el-descriptions-item label="客户订单号">{{ order.orderInfo.client_order_code }}</el-descriptions-item>
              <el-descriptions-item label="重量">{{ order.orderInfo.order_info.Weight }}</el-descriptions-item>
            </el-descriptions>
          </el-col>

          <el-col :span="12">
            <el-descriptions title="物流信息" column="1" border>
              <el-descriptions-item label="快递公司">{{
                  order.orderInfo.order_info.ShipperCode
                }}
              </el-descriptions-item>
              <el-descriptions-item label="快递单号">{{ order.orderInfo.delivery_id }}</el-descriptions-item>
              <el-descriptions-item label="状态">{{ order.order_status_arr.name }}</el-descriptions-item>

            </el-descriptions>
          </el-col>
        </el-row>
        <br/><br/>
        <!-- 收发货信息 -->
        <el-row :gutter="20" class="section">
          <el-col :span="12">
            <el-descriptions title="收货信息" column="1" border>
              <el-descriptions-item label="收货人">{{
                  order.orderInfo.order_info.Receiver.Name
                }}
              </el-descriptions-item>
              <el-descriptions-item label="手机号">{{
                  order.orderInfo.order_info.Receiver.Mobile
                }}
              </el-descriptions-item>
              <el-descriptions-item label="省">{{
                  order.orderInfo.order_info.Receiver.ProvinceName
                }}
              </el-descriptions-item>
              <el-descriptions-item label="市">{{
                  order.orderInfo.order_info.Receiver.CityName
                }}
              </el-descriptions-item>
              <el-descriptions-item label="区/县">{{
                  order.orderInfo.order_info.Receiver.ExpAreaName
                }}
              </el-descriptions-item>
              <el-descriptions-item label="详细地址">{{
                  order.orderInfo.order_info.Receiver.Address
                }}
              </el-descriptions-item>
            </el-descriptions>
          </el-col>

          <el-col :span="12">
            <el-descriptions title="发货信息" column="1" border>
              <el-descriptions-item label="发货人">{{
                  order.orderInfo.order_info.Sender.Name
                }}
              </el-descriptions-item>
              <el-descriptions-item label="手机号">{{
                  order.orderInfo.order_info.Sender.Mobile
                }}
              </el-descriptions-item>
              <el-descriptions-item label="省">{{
                  order.orderInfo.order_info.Sender.ProvinceName
                }}
              </el-descriptions-item>
              <el-descriptions-item label="市">{{
                  order.orderInfo.order_info.Sender.CityName
                }}
              </el-descriptions-item>
              <el-descriptions-item label="区/县">{{
                  order.orderInfo.order_info.Sender.ExpAreaName
                }}
              </el-descriptions-item>
              <el-descriptions-item label="详细地址">{{
                  order.orderInfo.order_info.Sender.Address
                }}
              </el-descriptions-item>
            </el-descriptions>
          </el-col>
        </el-row>
        <br/><br/>
        <el-row :gutter="20" class="section">
          <el-col :span="24">
            <el-descriptions title="商品信息" column="3" border>
              <el-descriptions-item v-for="(item, index) in order.orderInfo.order_info.Commodity"
                                    :key="`goods-${index}`" label="商品名称">
                {{ item.GoodsName }}
              </el-descriptions-item>
              <el-descriptions-item v-for="(item, index) in order.orderInfo.order_info.Commodity"
                                    :key="`quantity-${index}`" label="商品件数">
                {{ item.GoodsQuantity }}
              </el-descriptions-item>
              <el-descriptions-item v-for="(item, index) in order.orderInfo.order_info.Commodity"
                                    :key="`price-${index}`" label="商品价格">
                {{ item.GoodsPrice }}
              </el-descriptions-item>
            </el-descriptions>
          </el-col>
        </el-row>
        <br/><br/>
        <!-- 支付信息 -->
        <el-row :gutter="20" class="section">
          <el-col :span="24">
            <el-descriptions title="费用信息" column="2" border>
              <!--              <el-descriptions-item label="基础运费">{{ order.pay_info.cost }}</el-descriptions-item>-->
              <!--              <el-descriptions-item label="首重金额">{{ order.pay_info.first_weight_amount }}</el-descriptions-item>-->
              <!--              <el-descriptions-item label="续重总金额">{{ order.pay_info.continuous_weight_amount }}</el-descriptions-item>-->
              <!--              <el-descriptions-item label="额外费用">{{ order.pay_info.other_fee }}</el-descriptions-item>-->
              <el-descriptions-item label="计费重量">{{ order.orderFee.weight }}</el-descriptions-item>
              <el-descriptions-item label="总费用">{{ order.orderFee.total_fee }}</el-descriptions-item>
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
    order_status_arr: {
        name: '待支付',
        status: 0,
        is_refund: 0,
        action: [],
        member_action: [
            {
                name: '立即支付',
                class: 'gopay',
                params: ''
            },
            {
                name: '关闭订单',
                class: 'close',
                params: ''
            }
        ]
    },
    id: 3,
    site_id: 100009,
    member_id: null,
    order_from: null,
    order_id: '20241226515129176354816',
    order_money: null,
    order_discount_money: '0.00',
    is_send: '0',
    is_pick: '0',
    order_status: 0,
    refund_status: 0,
    out_trade_no: null,
    remark: null,
    pay_time: null,
    create_time: '2024-12-26 22:25:59',
    close_reason: null,
    is_enable_refund: null,
    close_time: null,
    ip: '127.0.0.1',
    update_time: '2024-12-26 22:25:59',
    delete_time: 0,
    send_log: null,
    orderInfo: {
        order_id: '20241226515129176354816',
        site_id: 100009,
        line_price_id: null,
        platform: 'yunjie',
        app_id: '100009323030',
        client_order_code: 'ea8e38b3-a159-3a9e-a4bf-1f959b1943b5',
        service_order_code: 'YTZY202412262225594913',
        delivery_id: 'JDVC27951392612',
        delivery_status: 1,
        delivery_type: 'JD',
        start_date: null,
        end_date: null,
        goods: '电子产品',
        package_count: 1,
        pickup_info: null,
        order_info: {
            ShipperCode: 'JD',
            OrderCode: 'ea8e38b3-a159-3a9e-a4bf-1f959b1943b5',
            ExpType: 'P1',
            PayType: 2,
            Receiver: {
                ProvinceName: '广东省',
                CityName: '深圳市',
                ExpAreaName: '南山区',
                Address: '海德二路茂业时代广场',
                Name: '戴杨',
                Mobile: 15603003393
            },
            Sender: {
                ProvinceName: '河南省',
                CityName: '洛阳市',
                ExpAreaName: '涧西区',
                Address: '南昌路丽晶大酒店',
                Name: '伏洪',
                Mobile: 15603003392
            },
            Weight: 3.5,
            Quantity: 1,
            Remark: '',
            Commodity: [
                {
                    GoodsName: '电子产品',
                    GoodsQuantity: 4,
                    GoodsPrice: 521.7
                }
            ],
            order_id: '20241226515129176354816',
            platform: 'yunjie'
        },
        pay_info: null,
        height: null,
        weight: 3.5,
        volume: null,
        volume_weight: null,
        total_fee: null,
        order_status_desc: null,
        order_status: '0',
        create_time: '2024-12-26 22:26:00',
        update_time: '2024-12-26 22:26:00',
        delete_time: null,
        delivery_arry: {
            name: '圆通速递',
            logo: 'addon\/fengchao\/logo\/yt.png'
        }
    },
    deliveryRealInfo: {
        order_id: '20241226515129176354816',
        weight: 3.5,
        fee_weight: null,
        volume: null,
        package_count: null,
        fee_blockList: [],
        total_fee: null,
        pay_fee: null,
        create_time: '2024-12-26 22:26:00',
        update_time: '2024-12-26 22:26:00',
        delete_time: null
    },
    orderFee: {
        order_id: '20241226515129176354816',
        fee_type: 2,
        weight: '3.50',
        platform: 'yunjie',
        official_price: '34.00',
        discount: '5.30',
        first_weight: '0.00',
        first_weight_price: '0.00',
        first_weight_amount: '0.00',
        continuous_weight: '0.00',
        continuous_weight_price: '0.00',
        continuous_weight_amount: '0.00',
        cost: null,
        insure_amount: null,
        package_fee: null,
        over_fee: null,
        back_fee: null,
        other_fee: null,
        other_fee_detail: null,
        total_fee: '18.02',
        volume: null,
        volume_weight: null
    },
    payInfo: null
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
