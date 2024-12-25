<template>
  <div class="main-container">

    <el-card class="box-card !border-none" shadow="never">
      <el-form :model="formData" label-width="120px" ref="formRef" :rules="formRules" class="page-form"
               v-loading="loading">

        <el-row :gutter="20">
          <el-col :span="12">
            <el-form-item label="请求报文内容" prop="template_name" label-position="top">
              <el-input v-model.trim="formData.request_data"
                        type="textarea"
                        :rows="14"
                        placeholder=""
              >
              </el-input>
            </el-form-item>
          </el-col>
          <el-col :span="12">
            <el-form-item label="返回报文" prop="template_name" label-position="top">
              <el-input v-model.trim="response_data"
                        type="textarea"
                        :rows="14"
                        placeholder=""
              >
              </el-input>
            </el-form-item>
          </el-col>
        </el-row>
        <el-row :gutter="20">
          <el-form-item label="OrderCode" prop="template_name">
            <el-input v-model.trim="formData.OrderCode" class="input-width"/>
          </el-form-item>
          <el-form-item label="EBusinessID" prop="template_name">
            <el-input v-model.trim="formData.api_key" class="input-width"/>
          </el-form-item>

        </el-row>
        <el-row :gutter="20">
          <el-form-item label="Key" prop="template_name">
            <el-input v-model.trim="formData.api_secret" class="input-width" style=" width: 600px"/>

          </el-form-item>

        </el-row>

        <el-row :gutter="20">
          <el-form-item label="请求地址" prop="template_name">
            <el-input v-model.trim="formData.url" class="input-width" style=" width: 600px"/>

          </el-form-item>

        </el-row>
        <el-row :gutter="20">
          <el-form-item :label="t('status')" prop="status">
            <el-select v-model="api_id" clearable placeholder="选择测试接口"
                       class="input-width">
              <!--              <el-option label="选择测试接口" value="0" />-->

              <el-option :label="'(' + item[0] + ')'+item[1] " :value="item[0]" v-for="(item, index) in apiList"
                         :key="index"/>
            </el-select>
            {{ api_id }}
          </el-form-item>

        </el-row>

        <el-row :gutter="20">
          <el-form-item>
            <el-button type="primary" @click="save(formRef)">发送</el-button>

          </el-form-item>

        </el-row>

      </el-form>
    </el-card>

  </div>

</template>

<script lang="ts" setup>
import { ref, reactive, computed, watch } from 'vue'
import { t } from '@/lang'
import type { ElTree, FormInstance, ElMessage } from 'element-plus'
import md5Hex from 'md5-hex'
import querystring from 'querystring'
import { AnyObject } from '@/types/global'
import { useRoute, useRouter } from 'vue-router'
import { Buffer } from 'buffer'
import { getAreatree } from '@/app/api/sys'
import { filterDigit } from '@/utils/common'
import Test from '@/utils/test'
import {
    getApiKeyById,
    sendSandBox,
    getApiNameList,
    getApiData,
    getApiDomain,
    getCBNameList, getCBData, getCBDomain
} from '@/addon/fengchao/api/api'
import { addCompany, editCompany } from '@/addon/fengchao/api/delivery'

const showSelectAreaDialog = ref(false)
const route = useRoute()
const router = useRouter()
const loading = ref(false)

const apiList = ref([])
const api_id = ref(0)
const response_data = ref()
const domain = ref()
/**
 * 表单数据
 */
const initialFormData = {
    OrderCode: 0,
    site_id: '',
    api_id: '',
    api_name: '',
    api_key: '',
    api_secret: '',
    callback_url: '',
    request_data: '',
    url: ''

}

const pageName = route.meta.title
const formData: Record<string, any> = reactive({ ...initialFormData })

formData.id = ref(route.query.id)

watch(() => formData.OrderCode, (nval, oval) => {
    if (formData.request_data) {
        const RequestData = JSON.parse(formData.request_data)
        RequestData.Data[0].OrderCode = formData.OrderCode

        console.log(RequestData)
        formData.request_data = JSON.stringify(RequestData, null, 2)
    }
}, { immediate: true })

const formRef = ref<FormInstance>()

if (route.query.id) {
    loading.value = true
    getApiKeyById(route.query.id).then(({ data }) => {
        if (data) {
            Object.keys(formData).forEach((key: string) => {
                if (data[key] != undefined) formData[key] = data[key]
            })
            if (formData.request_data) {
                const RequestData = JSON.parse(formData.request_data)
                RequestData.Data[0].OrderCode = formData.OrderCode

                console.log(RequestData)
                formData.request_data = JSON.stringify(RequestData, null, 2)
            }
            // console.log("data.fee_data",data.fee_data)
            formData.value = data.fee_data
            api_id.value = 103
        }
        loading.value = false
    }).catch(() => {
        loading.value = false
    })
}

const getApiNameData = async () => {
    const res = await (await getCBNameList()).data

    // apiList.value = res
    // const data = Object.entries(res)

    const sortedList = [
        ['103', '已分配快递员'],
        ['104', '推送已取件'],
        ['2', '推送在途中状态'],
        ['203', '订单取消'],
        ['208', '修正重量（用户举报客服对账)'],
        ['3', '已签收'],
        ['301', '揽件状态（包含费用明细）'],
        ['401', '工单回推'],
        ['601', '推送费用状态(仅指定申通下单)'],
        ['99', '调度失败']
    ]
    apiList.value = sortedList
}
const getDomain = async () => {
    domain.value = await (await getCBDomain()).data
    formData.url = domain.value
}

getApiNameData()
getDomain()

watch(api_id, () => {
    if (api_id.value) {
        getCBData(formData.site_id, api_id.value).then(({ data }) => {
            if (data) {
                // console.log("data.fee_data",data.fee_data)
                formData.api_id = api_id
                formData.request_data = JSON.stringify(data, null, 2)
            }
            // loading.value = false
        }).catch(() => {
            // loading.value = false
        })
    }
})
// 表单验证规则
const formRules = computed(() => {
    return {}
})
const repeat = ref(false)

const save = async (formEl: FormInstance | undefined) => {
    if (repeat.value || !formEl) return

    await formEl.validate(async (valid) => {
        if (valid) {
            repeat.value = true

            const data = formData
            const RequestData = JSON.parse(data.request_data)
            RequestData.Data.OrderCode = data.OrderCode
            const ApiKey = data.api_secret
            data.EBusinessID = data.api_key
            data.RequestData = JSON.stringify(RequestData)
            data.RequestType = 103

            // console.log("json")
            // console.log(RequestData)
            // console.log(ApiKey)
            const DataSign = Buffer.from(md5Hex(JSON.stringify(RequestData) + ApiKey)).toString('base64')

            data.DataSign = encodeURIComponent(DataSign)
            sendSandBox(domain.value, data).then(res => {
                // router.push('/fengchao/order/delivery/company')
                repeat.value = false

                const jsonData = (res)
                console.log(res)
                response_data.value = JSON.stringify(jsonData, null, 2)
            }).catch((e) => {
                console.log(e)
                repeat.value = false
            })
        }
    })
}
const back = () => {
    router.push({ path: '/fengchao/site/list' })
}
</script>

<style lang="scss" scoped>
:deep(.el-tree-node.is-expanded>.el-tree-node__children) {
  display: flex !important;
  flex-wrap: wrap;
}

:deep(.area-input .el-input__wrapper) {
  box-shadow: none !important;
  padding: 0 !important;
  background: none;

  input {
    cursor: pointer;
  }
}
</style>
