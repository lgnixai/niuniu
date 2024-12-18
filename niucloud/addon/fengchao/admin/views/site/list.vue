<template>
  <!--站点列表-->
  <div class="main-container">
    <el-card class="box-card !border-none" shadow="never">

      <div class="flex justify-between items-center">
        <span class="text-page-title">{{ pageName }}</span>
      </div>

      <el-card class="box-card !border-none my-[10px] table-search-wrap" shadow="never">
        <el-form :inline="true" :model="siteTableData.searchParam" ref="searchFormRef">
          <el-form-item :label="t('siteInfo')" prop="keywords">
            <el-input v-model.trim="siteTableData.searchParam.keywords" :placeholder="t('siteNamePlaceholder')"/>
          </el-form-item>

          <el-form-item :label="t('siteDomain')" prop="site_domain">
            <el-input v-model.trim="siteTableData.searchParam.site_domain" :placeholder="t('siteDomainPlaceholder')"/>
          </el-form-item>

          <el-form-item :label="t('status')" prop="status">
            <el-select v-model="siteTableData.searchParam.status" clearable :placeholder="t('groupIdPlaceholder')"
                       class="input-width">
              <el-option :label="t('selectPlaceholder')" value=""/>
              <el-option :label="item" :value="index" v-for="(item, index) in statusList" :key="index"/>
            </el-select>
          </el-form-item>

          <el-form-item>
            <el-button type="primary" @click="loadSiteList()">{{ t('search') }}</el-button>
            <el-button @click="resetForm(searchFormRef)">{{ t('reset') }}</el-button>
          </el-form-item>
        </el-form>
      </el-card>

      <div class="mt-[20px]">
        <el-table :data="siteTableData.data" size="large" v-loading="siteTableData.loading">
          <template #empty>
            <span>{{ !siteTableData.loading ? t('emptyData') : '' }}</span>
          </template>
          <el-table-column prop="site_id" :label="t('siteId')" width="100" :show-overflow-tooltip="true"/>

          <el-table-column :label="t('siteInfo')" width="300" align="left">
            <template #default="{ row }">
              <div class="flex items-center">
                <img class="w-[50px] h-[50px] mr-[10px]" v-if="row.logo" :src="img(row.logo)" alt="">
                <img class="w-[50px] h-[50px] mr-[10px]" v-else src="@/app/assets/images/site_logo.png" alt="">
                <div class="flex flex flex-col">
                  <span>{{ row.site_name || '' }}</span>
                </div>
              </div>
            </template>
          </el-table-column>

          <el-table-column :label="t('manager')" width="150" align="left">
            <template #default="{ row }">
              <div class="flex items-center">
                <div class="flex flex flex-col">
                  <span>{{ row.admin.username || '' }}</span>
                </div>
              </div>
            </template>
          </el-table-column>

          <el-table-column prop="site_domain" :label="t('siteDomain')" width="150" :show-overflow-tooltip="true"/>

          <el-table-column :label="t('status')" width="100" align="center">
            <template #default="{ row }">
              <el-tag class="ml-2" type="success" v-if="row.status == 1">{{ row.status_name }}</el-tag>
              <el-tag class="ml-2" type="error" v-else-if="row.status == 3">
                {{ row.status_name }}
              </el-tag>
              <el-tag class="ml-2" type="error" v-else>
                {{ row.status_name }}
              </el-tag>
            </template>
          </el-table-column>

          <el-table-column :label="t('operation')" min-width="210" align="right" fixed="right">
            <template #default="{ row }">

              <el-button type="primary" class="mt-[5px] !ml-[0]" link @click="viewEvent(row)">价格管理
              </el-button>
<!--              <el-button type="primary" class="mt-[5px] !ml-[0]" link @click="editEvent(row)">{{-->
<!--                  t('editPrice')-->
<!--                }}-->
<!--              </el-button>-->

              <el-button type="primary" class="mt-[5px] !ml-[0]" link @click="adjustBalance(row)">{{
                  t('adjustPrice')
                }}
              </el-button>

            </template>
          </el-table-column>

        </el-table>
        <div class="mt-[16px] flex justify-end">
          <el-pagination v-model:current-page="siteTableData.page" v-model:page-size="siteTableData.limit"
                         layout="total, sizes, prev, pager, next, jumper" :total="siteTableData.total"
                         @size-change="loadSiteList()" @current-change="loadSiteList"/>
        </div>
      </div>

    </el-card>
    <edit-site ref="addSiteDialog" @complete="loadSiteList()"/>

    <balance-edit ref="balanceDialog" @complete="loadSiteList" />

  </div>
</template>

<script lang="ts" setup>
import { reactive, ref } from 'vue'
import { getToken, img } from '@/utils/common'
import { t } from '@/lang'
import { getSiteList, getSiteGroupAll, getStatusList, closeSite, openSite, deleteSite } from '@/app/api/site'
import { ElMessage, ElMessageBox, FormInstance } from 'element-plus'
import { useRouter, useRoute } from 'vue-router'
import EditSite from '@/app/views/site/components/edit-site.vue'
import { getInstalledAddonList } from '@/app/api/addon'
import useUserStore from '@/stores/modules/user'
import { deleteUser } from '@/app/api/user'
import BalanceEdit from '@/addon/fengchao/views/site/components/site-balance-edit.vue'

const route = useRoute()
const pageName = route.meta.title

const groupList = ref({
    all: []
})

const statusList = ref([])

const siteTableData = reactive({
    page: 1,
    limit: 10,
    total: 0,
    loading: true,
    data: [],
    searchParam: {
        keywords: '',
        group_id: '',
        app: 'all',
        status: '',
        site_domain: '',
        create_time: [],
        expire_time: []
    }
})
siteTableData.searchParam.status = route.query.id || ''
const setGroupList = async () => {
    const obj = await (await getSiteGroupAll({})).data

    groupList.value.all = obj
    obj.forEach((item: any, index: any) => {
        if (!groupList.value[item.app]) {
            groupList.value[item.app] = []
            groupList.value[item.app].push(item)
        } else {
            groupList.value[item.app].push(item)
        }
    })
}
setGroupList()

const setStatusList = async () => {
    statusList.value = await (await getStatusList()).data
}

setStatusList()

const searchFormRef = ref<FormInstance>()

const resetForm = (formEl: FormInstance | undefined) => {
    if (!formEl) return

    formEl.resetFields()
    loadSiteList()
}

/**
 * 应用选择
 */
const appChangeFn = () => {
    siteTableData.searchParam.group_id = ''
}

/**
 * 获取应用列表
 */
const addonList = ref([])
getInstalledAddonList().then(({ data }) => {
    addonList.value = data
}).catch()

/**
 * 获取站点列表
 */
const loadSiteList = (page: number = 1) => {
    siteTableData.loading = true
    siteTableData.page = page
    siteTableData.searchParam.app = siteTableData.searchParam.app == 'all' ? '' : siteTableData.searchParam.app
    getSiteList({
        page: siteTableData.page,
        limit: siteTableData.limit,
        ...siteTableData.searchParam
    }).then(res => {
        siteTableData.loading = false
        siteTableData.data = res.data.data
        siteTableData.total = res.data.total
    }).catch(() => {
        siteTableData.loading = false
    })
}
loadSiteList()

const router = useRouter()

const addSiteDialog: Record<string, any> | null = ref(null)

const balanceDialog: Record<string, any> | null = ref(null)

/**
 * 添加站点
 */
const addEvent = (data: any) => {
    addSiteDialog.value.setFormData()
    addSiteDialog.value.showDialog = true
}

/**
 * 站点详情
 * @param data
 */
const infoEvent = (data: any) => {
    router.push({ path: '/admin/site/info', query: { id: data.site_id } })
}

/**
 * 编辑站点详情
 * @param data
 */

const viewEvent = (data: any) => {
    router.push('/fengchao/site/price/view?site_id=' + data.site_id)
}

/**
 * 调整余额
 */
const adjustBalance = (data: any) => {
    console.log(data)
    balanceDialog.value.setFormData(data)
    balanceDialog.value.showDialog = true
}

</script>

<style lang="scss" scoped></style>
