<template>
    <!--会员余额-->
    <div class="main-container">
        <el-card class="box-card !border-none" shadow="never">

            <div class="flex justify-between items-center">
                <span class="text-page-title">{{ pageName }}</span>
            </div>

          <el-card class="box-card !border-none !px-[35px]" shadow="never">
            <el-row class="flex">
              <el-col :span="12">
                <div class="statistic-card">
                  <el-statistic :value="balanceStatistics.balance ? balanceStatistics.balance  : '0.00'"></el-statistic>
                  <div class="statistic-footer">
                    <div class="footer-item text-[14px] text-[#666]">
                      <span>当前余额(元)</span>
                    </div>
                  </div>
                </div>
              </el-col>
              <el-col :span="12">
                <div class="statistic-card">
                  <el-statistic :value="balanceStatistics.balance_get ? balanceStatistics.balance_get  : '0'"></el-statistic>
                  <div class="statistic-footer">
                    <div class="footer-item text-[14px] text-[#666]">
                      <span>累计充值(元)</span>
                    </div>
                  </div>
                </div>
              </el-col>
            </el-row>
          </el-card>


            <el-card class="box-card !border-none mb-[10px] table-search-wrap" shadow="never">
                <el-form :inline="true" :model="siteBalanceLogTableData.searchParam" ref="searchFormRef">


                    <el-form-item :label="t('createTime')" prop="create_time">
                        <el-date-picker v-model="siteBalanceLogTableData.searchParam.create_time" type="datetimerange"
                            value-format="YYYY-MM-DD HH:mm:ss" :start-placeholder="t('startDate')"
                            :end-placeholder="t('endDate')" />
                    </el-form-item>
                    <el-form-item>
                        <el-button type="primary" @click="loadMemberAccountLogList()">{{ t('search') }}</el-button>
                        <el-button @click="resetForm(searchFormRef)">{{ t('reset') }}</el-button>
                      <el-button type="primary" @click="exportEvent">{{ t('export') }}</el-button>

                    </el-form-item>
                </el-form>
            </el-card>

            <div class="mt-[10px]">
                <el-table :data="siteBalanceLogTableData.data" size="large" v-loading="siteBalanceLogTableData.loading">

                    <template #empty>
                        <span>{{ !siteBalanceLogTableData.loading ? t('emptyData') : '' }}</span>
                    </template>
                    <el-table-column prop="site_id" :label="t('siteId')" min-width="100" :show-overflow-tooltip="true">
                        <template #default="{ row }">
                            {{ row.site.site_id }}
                        </template>
                    </el-table-column>
                  <el-table-column prop="site_name" :label="t('siteName')" min-width="100" :show-overflow-tooltip="true">
                        <template #default="{ row }">
                          {{ row.site.site_name }}

                        </template>
                    </el-table-column>

                    <el-table-column prop="account_data" :label="t('accountData')" min-width="100" align="right">
                        <template #default="{ row }">
                            <div class="whitespace-nowrap">
                                <span v-if="row.account_data >= 0">+{{ row.account_data }}</span>
                                <span v-else>{{ row.account_data }}</span>
                            </div>
                        </template>
                    </el-table-column>
                    <el-table-column prop="account_sum" :label="t('accountSum')" min-width="110" align="right" />
                    <el-table-column prop="account_type_name" :label="t('balanceType')" min-width="150" align="center" />
                    <el-table-column prop="from_type_name" :label="t('fromType')" min-width="120" align="" />
                    <el-table-column prop="create_time" :show-overflow-tooltip="true" :label="t('createTime')" min-width="150" />


                </el-table>
                <div class="mt-[16px] flex justify-end">
                    <el-pagination v-model:current-page="siteBalanceLogTableData.page"
                        v-model:page-size="siteBalanceLogTableData.limit" layout="total, sizes, prev, pager, next, jumper"
                        :total="siteBalanceLogTableData.total" @size-change="loadMemberAccountLogList()"
                        @current-change="loadMemberAccountLogList" />
                </div>
            </div>
        </el-card>

        <balance-info ref="balanceDialog" @complete="loadMemberAccountLogList" />
        <export-sure ref="exportSureDialog" :show="flag" type="fengchao_site_balance_log" :searchParam="siteBalanceLogTableData.searchParam" @close="handleClose" />

    </div>
</template>

<script lang="ts" setup>
import { reactive, ref } from 'vue'
import { t } from '@/lang'
// import {
//
//     getChangeTypeList,
//     getBalanceSum,
//     getBalanceStatus,
//     getMoneyList,
//     getAccountType
// } from '@/app/api/member'
import { FormInstance } from 'element-plus'
import { img } from '@/utils/common'
import balanceInfo from '@/app/views/member/components/member-balance-info.vue'
import { useRoute, useRouter } from 'vue-router'
import {getSiteBalanceList,getSiteBalanceSum} from '@/addon/fengchao/api/api'

const route = useRoute()
const pageName = route.meta.title

const member_id: number = parseInt(route.query.id || 0)

const siteBalanceLogTableData = reactive({
    page: 1,
    limit: 10,
    total: 0,
    loading: true,
    data: [],
    searchParam: {
        keywords: '',
        from_type: '',
        create_time: '',

        balance_type: ''
    }
})

const fromTypeList = ref([])



const searchFormRef = ref<FormInstance>()

const resetForm = (formEl: FormInstance | undefined) => {
    if (!formEl) return
    formEl.resetFields()
    loadMemberAccountLogList()
}

/**
 * 获取会员账单表列表
 */
const loadMemberAccountLogList = (page: number = 1) => {
    siteBalanceLogTableData.loading = true
    siteBalanceLogTableData.page = page
    if (siteBalanceLogTableData.searchParam.balance_type == '' || siteBalanceLogTableData.searchParam.balance_type == 'balance') {
      getSiteBalanceList({
            page: siteBalanceLogTableData.page,
            limit: siteBalanceLogTableData.limit,
            ...siteBalanceLogTableData.searchParam
        }).then(res => {
            siteBalanceLogTableData.loading = false
            siteBalanceLogTableData.data = res.data.data
            siteBalanceLogTableData.total = res.data.total
        }).catch(() => {
            siteBalanceLogTableData.loading = false
        })
    } else {

    }
}
loadMemberAccountLogList()

const balanceDialog: Record<string, any> | null = ref(null)
/**
 * 查看详情
 * @param data
 */
const infoEvent = (data: any) => {
    balanceDialog.value.setFormData(data)
    balanceDialog.value.showDialog = true
}

const router = useRouter()

/**
 * 会员详情
 */
const toMember = (member_id: number) => {
    router.push(`/member/detail?id=${member_id}`)
}

/**
 * 获取余额总计
 */
const balanceStatistics = ref(
    {
      balance: 0,
      balance_get: 0
    })
const checkBalanceInfo = () => {
    getSiteBalanceSum().then(res => {
        balanceStatistics.value = res.data
    })
}
checkBalanceInfo()




const exportSureDialog = ref(null)
const flag = ref(false)
const handleClose = (val) => {
  flag.value = val
}
const exportEvent = (data: any) => {
  flag.value = true
}

</script>

<style lang="scss" scoped></style>
