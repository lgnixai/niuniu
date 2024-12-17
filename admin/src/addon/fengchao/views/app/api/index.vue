<template>
  <div class="main-container">
    <el-card class="box-card !border-none" shadow="never">

      <div class="flex justify-between items-center">
        <span class="text-page-title">{{ pageName }}</span>
        <el-button type="primary" @click="addEvent">
          {{ t('addApi') }}
        </el-button>
      </div>


      <div class="mt-[10px]">
        <el-table :data="apiTable.data" size="large" v-loading="apiTable.loading" @sort-change="sortChange">
          <template #empty>
            <span>{{ !apiTable.loading ? t('emptyData') : '' }}</span>
          </template>
          <el-table-column prop="api_name" :label="t('apiName')" min-width="120"/>
          <el-table-column prop="api_key" :label="t('api_key')" min-width="120"/>
          <el-table-column prop="callback_url" :label="t('callbackUrl')" min-width="120"/>


          <el-table-column :label="t('operation')" fixed="right" align="right" min-width="120">
            <template #default="{ row }">
              <el-button type="primary" link @click="sandboxEvent(row.id)">{{ t('sandbox') }}
              </el-button>
              <el-button type="primary" link @click="callbackEvent(row.id)">{{ t('sandbox1') }}
              </el-button>
              <el-button type="primary" link @click="deleteEvent(row.id)">{{ t('delete') }}
              </el-button>
            </template>
          </el-table-column>

        </el-table>
        <div class="mt-[16px] flex justify-end">
          <el-pagination v-model:current-page="apiTable.page" v-model:page-size="apiTable.limit"
                         layout="total, sizes, prev, pager, next, jumper" :total="apiTable.total"
                         @size-change="loadApiList()" @current-change="loadApiList"/>
        </div>
      </div>

      <api-edit ref="editapiDialog" @complete="loadApiList"/>
    </el-card>
  </div>
</template>

<script lang="ts" setup>
import {reactive, ref} from 'vue'
import {t} from '@/lang'
import {deleteApi, getApiList} from '@/addon/fengchao/api/api'
import {img, debounce} from '@/utils/common'
import {ElMessageBox, FormInstance, ElMessage} from 'element-plus'
import apiEdit from '@/addon/fengchao/views/app/api/api_edit.vue'
import {useRoute} from 'vue-router'
import router from "@/router";

const route = useRoute()
const pageName = route.meta.title

const apiTable = reactive({
  page: 1,
  limit: 10,
  total: 0,
  loading: true,
  data: [],
  searchParam: {
    api_name: '',
    order: '',
    sort: ''
  }
})

const searchFormRef = ref<FormInstance>()

// 监听排序
const sortChange = (event: any) => {
  let sort = ''
  if (event.order == 'ascending') {
    sort = 'asc'
  } else if (event.order == 'descending') {
    sort = 'desc'
  }
  if (sort) {
    apiTable.searchParam.order = event.prop
    apiTable.searchParam.sort = sort
  }
  loadApiList()
}

/**
 * 获取商品品牌列表
 */
const loadApiList = (page: number = 1) => {
  apiTable.loading = true
  apiTable.page = page

  getApiList().then(res => {
    apiTable.loading = false
    apiTable.data = res.data

  }).catch(() => {
    apiTable.loading = false
  })
}
loadApiList()

const editapiDialog: Record<string, any> | null = ref(null)

/**
 * 添加商品品牌
 */
const addEvent = () => {
  editapiDialog.value.setFormData()
  editapiDialog.value.showDialog = true
}

/**
 * 编辑商品品牌
 * @param data
 */
const editEvent = (data: any) => {
  editapiDialog.value.setFormData(data)
  editapiDialog.value.showDialog = true
}

/**
 * 删除商品品牌
 */
const deleteEvent = (id: number) => {
  ElMessageBox.confirm(t('apiDeleteTips'), t('warning'),
      {
        confirmButtonText: t('confirm'),
        cancelButtonText: t('cancel'),
        type: 'warning'
      }
  ).then(() => {
    deleteApi(id).then(() => {
      loadApiList()
    }).catch(() => {
    })
  })
}
const sandboxEvent = (id: number) => {
  router.push('/fengchao/api/sandbox?id=' + id)
}

const callbackEvent = (id: number) => {
  router.push('/fengchao/api/sandbox1?id=' + id)
}


const resetForm = (formEl: FormInstance | undefined) => {
  if (!formEl) return
  formEl.resetFields()
  loadApiList()
}
</script>

<style lang="scss" scoped>
</style>
