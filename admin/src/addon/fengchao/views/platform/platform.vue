<template>
  <!--平台设置-->
  <div class="main-container">
    <el-card class="box-card !border-none" shadow="never">
      <div style="width: 840px" class="mb-2">
        <el-alert type="info" title="提示：请正确配置并启用相关三方平台，启用多个平台将会返回价格最低的平台给用户"
                  :closable="false" show-icon/>
      </div>
      <div class="mt-[20px]">
        <el-table :data="platformTableData.data" size="large" v-loading="platformTableData.loading">
          <template #empty>
            <span>{{ !platformTableData.loading ? t('emptyData') : '' }}</span>
          </template>

          <el-table-column prop="name" label="平台名称" min-width="80" :show-overflow-tooltip="true"/>
          <el-table-column prop="balance" label="平台余额" min-width="80" :show-overflow-tooltip="true"/>
          <el-table-column label="是否使用" min-width="100" align="center">
            <template #default="{ row }">
              <el-tag class="ml-2" type="success" v-if="row.is_use == 1">{{
                  t('statusNormal')
                }}
              </el-tag>
              <el-tag class="ml-2" type="error" v-if="row.is_use == 0">{{
                  t('statusDeactivate')
                }}
              </el-tag>
            </template>
          </el-table-column>
          <el-table-column :label="t('operation')" align="right" fixed="right" width="100">
            <template #default="{ row, $index }">
              <el-button type="primary" link @click="editEvent(row, $index)">设置</el-button>
            </template>
          </el-table-column>
        </el-table>
      </div>
      <div style="width: 840px" class="mb-2 mt-8">
        <el-alert type="info" title="启用相关平台后请正确配置回调地址在对应平台配置处" :closable="false" show-icon/>
        <block v-if="config" v-for="(item, index) in config.url_data" :key="index">
          <div class="flex p-2">
            <div class="w-[80px] text-slate-400">{{ item.name }}</div>
            <div class="font-bold text-slate-600">{{ item.url }}</div>
          </div>
        </block>
      </div>
      <template v-for="(item, index) in platformTableData.data">
        <component :is="item.component" :ref="(el) => setPlatformTypeRefs(el, index)" v-if="item.component"
                   @complete="loadPlatformList()"/>
      </template>
    </el-card>
  </div>
</template>

<script lang="ts" setup>
import { defineAsyncComponent, reactive, ref } from 'vue'
import { t } from '@/lang'
import { getPlatformList } from '@/addon/fengchao/api/platform'
import { useRoute } from 'vue-router'
import {
    getJhkdConfig
} from '@/addon/fengchao/api/tkjhkd'

const config = ref()
const getData = async () => {
    const data = await getJhkdConfig({})
    config.value = data.data.value
}
getData()
const route = useRoute()
const pageName = route.meta.title
const platformTypeRefs = ref([])

const platformTableData = reactive({
    loading: true,
    data: []
})

const modules: any = import.meta.glob('@/**/*.vue')
/**
 * 获取配置信息
 */
const loadPlatformList = () => {
    platformTableData.loading = true
    getPlatformList()
        .then(({ data }) => {
            Object.keys(data).forEach((key: string) => {
                data[key].component &&
          (data[key].component = defineAsyncComponent(
              modules[data[key].component]
          ))
            })
            platformTableData.data = data
            platformTableData.loading = false
        })
        .catch(() => {
            platformTableData.loading = false
        })
}

const setPlatformTypeRefs = (el, index) => {
    platformTypeRefs.value[index] = el
}

loadPlatformList()
const editEvent = (data: any, index: number) => {
    platformTypeRefs.value[index].setFormData(data)
    platformTypeRefs.value[index].showDialog = true
}
</script>

<style lang="scss" scoped></style>
