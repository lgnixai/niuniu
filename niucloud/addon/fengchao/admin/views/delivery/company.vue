<template>
  <div class="main-container">
    <el-card class="box-card !border-none" shadow="never">

      <div class="flex justify-between items-center">
        <div class="detail-head !m-0">
          <span class="right">{{ pageName }}</span>
        </div>
        <el-form-item>
          <el-button type="primary" @click="addEvent">{{ t('addCompany') }}</el-button>
          <el-button @click="initEvent">{{ t('initCompany') }}</el-button>
        </el-form-item>
      </div>

      <el-card class="box-card !border-none my-[10px] table-search-wrap" shadow="never">
        <el-form :inline="true" :model="companyTable.searchParam" ref="searchFormRef">
          <el-form-item :label="t('companyName')" prop="company_name">
            <el-input v-model.trim="companyTable.searchParam.company_name" :placeholder="t('companyNamePlaceholder')"/>
          </el-form-item>
          <el-form-item>
            <el-button type="primary" @click="loadCompanyList()">{{ t('search') }}</el-button>
            <el-button @click="resetForm(searchFormRef)">{{ t('reset') }}</el-button>
          </el-form-item>
        </el-form>
      </el-card>

      <div class="mt-[10px]">
        <el-table :data="companyTable.data" size="large" v-loading="companyTable.loading">
          <template #empty>
            <span>{{ !companyTable.loading ? t('emptyData') : '' }}</span>
          </template>
          <el-table-column prop="company_name" :label="t('companyName')" min-width="120"/>

          <el-table-column prop="express_no" :label="t('expressNo')" min-width="120"/>

          <el-table-column :label="t('operation')" fixed="right" align="right" min-width="120">
            <template #default="{ row }">
              <el-button type="primary" link @click="editEvent(row)">{{ t('edit') }}</el-button>
              <el-button type="primary" link @click="deleteEvent(row.company_id)">{{ t('delete') }}
              </el-button>
            </template>
          </el-table-column>

        </el-table>
        <div class="mt-[16px] flex justify-end">
          <el-pagination v-model:current-page="companyTable.page" v-model:page-size="companyTable.limit"
                         layout="total, sizes, prev, pager, next, jumper" :total="companyTable.total"
                         @size-change="loadCompanyList()" @current-change="loadCompanyList"/>
        </div>
      </div>
    </el-card>
  </div>
</template>

<script lang="ts" setup>
import {reactive, ref} from 'vue'
import {t} from '@/lang'
import {getCompanyPageList, deleteCompany, initCompany} from '@/addon/fengchao/api/delivery'
import {img} from '@/utils/common'
import {ElMessageBox, FormInstance} from 'element-plus'
import {useRoute, useRouter} from 'vue-router'

const route = useRoute()
const router = useRouter()
const pageName = route.meta.title

const companyTable = reactive({
  page: 1,
  limit: 10,
  total: 0,
  loading: true,
  data: [],
  searchParam: {
    company_name: '',
    logo: '',
    url: '',
    create_time: '',
    modify_time: ''
  }
})

const searchFormRef = ref<FormInstance>()

/**
 * 获取物流公司列表
 */
const loadCompanyList = (page: number = 1) => {
  companyTable.loading = true
  companyTable.page = page

  getCompanyPageList({
    page: companyTable.page,
    limit: companyTable.limit,
    ...companyTable.searchParam
  }).then(res => {
    companyTable.loading = false
    companyTable.data = res.data.data
    companyTable.total = res.data.total
  }).catch(() => {
    companyTable.loading = false
  })
}
loadCompanyList()

/**
 * 添加物流公司
 */
const addEvent = () => {
  router.push('/fengchao/order/delivery/company_add')
}

/**
 * 编辑物流公司
 * @param data
 */
const editEvent = (data: any) => {
  router.push('/fengchao/order/delivery/company_edit?company_id=' + data.company_id)
}

/**
 * 删除物流公司
 */
const deleteEvent = (id: number) => {
  ElMessageBox.confirm(t('companyDeleteTips'), t('warning'),
      {
        confirmButtonText: t('confirm'),
        cancelButtonText: t('cancel'),
        type: 'warning'
      }
  ).then(() => {
    deleteCompany(id).then(() => {
      loadCompanyList()
    }).catch(() => {
    })
  })
}

/**
 * 初始化物流公司数据
 */
const initEvent = () => {
  ElMessageBox.confirm(t('companyInitDataTips'), t('warning'),
      {
        confirmButtonText: t('confirm'),
        cancelButtonText: t('cancel'),
        type: 'warning'
      }
  ).then(() => {
    initCompany().then(() => {
      loadCompanyList()
    }).catch(() => {
    })
  })
}
const resetForm = (formEl: FormInstance | undefined) => {
  if (!formEl) return
  formEl.resetFields()
  loadCompanyList()
}
</script>

<style lang="scss" scoped>
</style>
