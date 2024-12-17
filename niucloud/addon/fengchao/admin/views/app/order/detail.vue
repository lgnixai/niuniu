<template>
  <!--打款设置-->
  <div class="main-container">

    <el-card class="box-card !border-none" shadow="never">
      <div class="flex justify-between items-center">
        <span class="text-page-title">{{ pageName }}</span>
      </div>

      <div class="mt-[20px]">
        <el-alert :title="t('operationTip')" type="warning" show-icon />
      </div>
    </el-card>

    <el-form class="page-form" :model="formData" label-width="200px" ref="formRef" :rules="formRules" v-loading="loading">
      <el-card class="box-card mt-[15px] !border-none" shadow="never">
        <h3 class="panel-title !text-sm">{{t('orderInfo')}}</h3>

        <el-form-item :label="t('orderCode')" prop="alipay_config.app_id">
          {{formData.order_code}}
        </el-form-item>
        <el-form-item :label="t('kdn_code')" prop="alipay_config.app_id">
          {{formData.kdn_code}}
        </el-form-item>

        <el-form-item :label="t('weight')" prop="alipay_config.app_id">
          {{formData.user_price.Weight}}(KG)
        </el-form-item>
        <el-form-item :label="t('firstWeight')" prop="alipay_config.app_id">
          {{formData.user_price.firstWeight}}(KG)
        </el-form-item>
        <el-form-item :label="t('continuousWeight')" prop="alipay_config.app_id">
          {{formData.user_price.continuousWeight}}(KG)
        </el-form-item>
      </el-card>

      <el-card class="box-card mt-[15px] !border-none" shadow="never">
        <h3 class="panel-title !text-sm">{{t('feeInfo')}}</h3>

        <el-form-item :label="t('Cost')" prop="alipay_config.app_id">
           {{formData.user_price.Cost}}(元)
        </el-form-item>
        <el-form-item :label="t('InsureAmount')" prop="alipay_config.app_id">
           {{formData.user_price.InsureAmount}}(元)
        </el-form-item>
        <el-form-item :label="t('PackageFee')" prop="alipay_config.app_id">
           {{formData.user_price.PackageFee}}(元)
        </el-form-item>
        <el-form-item :label="t('OverFee')" prop="alipay_config.app_id">
           {{formData.user_price.OverFee}}(元)
        </el-form-item>
        <el-form-item :label="t('OtherFee')" prop="alipay_config.app_id">
           {{formData.user_price.OtherFee}}(元)
        </el-form-item>
        <el-form-item :label="t('OtherFeeDetail')" prop="alipay_config.app_id">
           {{formData.user_price.OtherFeeDetail}}(元)
        </el-form-item>
        <el-form-item :label="t('TotalFee')" prop="alipay_config.app_id">
           {{formData.user_price.TotalFee}}(元)
        </el-form-item>

      </el-card>
    </el-form>


  </div>
</template>

<script lang="ts" setup>
import { reactive, ref, computed } from 'vue'
import { t } from '@/lang'
import { getTransferInfo, setTransferInfo } from '@/app/api/sys'
import { FormInstance } from 'element-plus'
import { useRoute } from 'vue-router'
import {getOrderDetail} from "@/addon/fengchao/api/order";
import {getCompanyInfo} from "@/addon/fengchao/api/delivery";

const route = useRoute()
const pageName = route.meta.title

const loading = ref(false)
const OrderId=ref(route.query.order_id)
/**
 * 表单数据
 */


const initialFormData = {
  OrderId: route.query.order_id,
  kdn_code:"",
  order_code:'',
  user_price:{
    Weight:0,
    continuousWeight:0,
    firstWeight:0,
    Cost: 0,
    InsureAmount: 0,
    PackageFee: 0,
    OverFee: 0,
    OtherFee: 0,
    OtherFeeDetail: "",
    TotalFee: 0
  }


}
const formData: Record<string, any> = reactive({ ...initialFormData })

//
const getOrder = async () => {


  getOrderDetail(formData.OrderId).then(res => {
    loading.value = false;
    let data = res.data;
    if (data) {
      Object.keys(formData).forEach((key: string) => {
        if (data[key] != undefined) formData[key] = data[key]
      })
    }
  })
  loading.value = false;

}
getOrder()

</script>

<style lang="scss" scoped></style>
