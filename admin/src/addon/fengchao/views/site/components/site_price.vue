<template>
  <div>
    <div class="flex border-t border-b main-wrap border-color w-full" :class="scene == 'select' ? 'h-[40vh]' : 'h-full'"
         v-if="prop.type == 'kdniao'">

      <!-- 分组 -->
      <div class="group-wrap w-[180px] p-[15px] h-full border-r border-color flex flex-col">

        <div class="group-list flex-1 my-[10px] h-0">
          <el-scrollbar>
            <div class="group-item p-[10px] leading-none text-xs rounded cursor-pointer"
                 :class="{ active: brandParam.express_no == 0 }" @click="brandParam.express_no = 0">
              {{ t('selectPlaceholder') }}
            </div>
            <div class="group-item px-[10px] text-xs rounded cursor-pointer flex"
                 v-for="(item, index) in brandList.data" :key="index"
                 :class="{ active: brandParam.express_no == item.express_no }">
              <div class="flex-1 leading-none truncate py-[10px]" @click="brandParam.express_no = item.express_no">
                {{ item.company_name }}
              </div>
            </div>
          </el-scrollbar>
        </div>

      </div>

      <!-- 素材 -->
      <div class="attachment-list-wrap flex flex-col p-[15px] flex-1 overflow-hidden">
        <el-row :gutter="15" class="h-[32px]">
          <el-col :span="10">
            <div class="flex">
              <el-button type="primary" @click="importEvent">导入价格</el-button>
              <div>
                <el-button class="ml-[10px]" type="primary" @click="checkPriceView">价格全览</el-button>
              </div>
            </div>
          </el-col>
        </el-row>
        <div class=" ">

          <div class="mt-[10px]  ">
            <el-scrollbar height="500px">

              <VisualGrid ref="visualGrid" :options="gridConfig"/>
            </el-scrollbar>
          </div>
          <el-row :gutter="20">
            计录条数{{ priceTable.total }}
          </el-row>

        </div>
        <price-view ref="priceViewDialog" @complete="loadOrderList"/>
        <import-price ref="importPriceDialog"/>
      </div>
    </div>
    <div class="flex border-t border-b main-wrap border-color w-full" :class="scene == 'select' ? 'h-[40vh]' : 'h-full'"
         v-if="prop.type == 'yunjie'">

      <discount :siteId="priceTable.site_id"></discount>
    </div>

  </div>
</template>

<script lang="ts" setup>
import { ref, reactive, watch, computed, toRaw } from 'vue'
import { t } from '@/lang'

import { debounce, img, getToken } from '@/utils/common'
import { ElMessage, UploadFile, UploadFiles, ElMessageBox, MessageParams, FormInstance, FormRules } from 'element-plus'
import storage from '@/utils/storage'
import { getBrandAll, getLinePrice } from '@/addon/fengchao/api/site'
import VisualGrid from '@/addon/fengchao/views/components/VisualGrid.vue'
import { GridOptions, RowData } from '@visualjs/grid'
import { useRoute, useRouter } from 'vue-router'
import PriceView from '@/addon/fengchao/views/site/components/price_view.vue'
import ImportPrice from '@/addon/fengchao/views/site/components/import_price.vue'

import discount from '@/addon/fengchao/views/site/components/discount.vue'

const route = useRoute()
const router = useRouter()
const rows: RowData[] = []

const attachmentCategoryName = ref('')
const operate = ref(false)
const prop = defineProps({
    // 选择数量限制
    limit: {
        type: Number,
        default: 1
    },
    type: {
        type: String,
        default: 'image'
    },
    // 场景
    scene: {
        type: String,
        default: 'kdniao' // select 选择图片 attachment 素材中心
    }
})

// 选中的文件
const selectedFile: Record<string, any> = reactive({})

const selectedFileIndex: any = reactive([])

const brandList: Record<string, any> = reactive({
    data: []
})

const attachment: Record<string, any> = reactive({
    loading: true,
    page: 1,
    total: 0,
    limit: prop.scene == 'select' ? 10 : 20,
    data: []
})

if (prop.scene == 'select') {
    attachment.limit = 10
    if (prop.type == 'icon') {
        attachment.limit = 20
    }
} else {
    attachment.limit = 20
    if (prop.type == 'icon') {
        attachment.limit = 30
    }
}

const categoryParam = reactive({
    name: ''
})

const brandParam = reactive({
    real_name: '',
    express_no: ''
})
const priceTable = reactive({
    site_id: ref(route.query.site_id),
    page: 1,
    limit: 10,
    total: 0,
    loading: true,
    data: [],
    searchParam: {
        order_id: '',
        create_time: ''
    }
})

const loadOrderList = async (page: number = 1) => {
    priceTable.loading = true
    priceTable.page = page

    getLinePrice({
        site_id: priceTable.site_id,
        express_no: brandParam.express_no

    }).then(res => {
        priceTable.loading = false

        priceTable.data = res.data
        priceTable.total = res.data.length

        const data = res.data
        let rowId = 0
        rows.length = 0
        if (data.length > 0) {
            data.map((row) => {
                const r = {
                    id: String(rowId++),
                    site_id: row.site_id,
                    express_no: row.express_no,
                    sender_province: row.sender_province,
                    receive_province: row.receive_province,
                    first_weight: row.first_weight,
                    continuous_weight: row.continuous_weight,
                    delivery: row.delivery

                }

                rows.push(r)
            })
            // visualGrid.value.gridInstance.store('row').dispatch('setRows', rows)
        } else {
            rows.length = 0
        }
        visualGrid.value.gridInstance.store('row').dispatch('setRows', rows)
    }).catch(async () => {
        priceTable.loading = false
    })
}
loadOrderList()

const gridConfig = reactive<GridOptions>({
    columns: [

        {
            field: 'id',
            headerName: 'id',
            resizable: true,
            width: 10
        },
        {
            field: 'site_id',
            headerName: '网站ID',
            resizable: true,
            width: 50
        },
        {
            field: 'express_no',
            headerName: '物流公司',
            resizable: true,
            width: 100
        },
        {
            field: 'sender_province',
            headerName: '发件省',
            resizable: true,
            width: 100
        },
        {
            field: 'receive_province',
            headerName: '收件省',
            resizable: true,
            width: 100
        },
        {
            field: 'first_weight',
            headerName: '首重',
            resizable: true,
            width: 100
        },
        {
            field: 'continuous_weight',
            headerName: '续重',
            resizable: true,
            width: 100
        },
        {
            field: 'delivery',
            headerName: '平台',
            resizable: true,
            width: 100
        }

    ],
    defaultColumnOption: {
        width: 60

    },
    rows,
    scrollThrottleRate: 10,
    fillable: 'xy',
    getColumnMenuItems: (params) => {
        const options = params.grid.getColumnOptions(params.column)

        const setColumnPinned = (pinned?: 'left' | 'right') => {
            params.grid.setColumnPinned(params.column, pinned)
        }

        const pinnedIcon = (pinned?: 'left' | 'right') => {
            if (pinned === options.pinned) {
                return 'vg-checkmark'
            }
        }

        return [
            {
                name: 'Pin Current Column',
                icon: 'vg-pin',
                disabled: options.readonly,
                subMenus: [
                    {
                        name: 'Pin Left',
                        action: () => setColumnPinned('left'),
                        icon: pinnedIcon('left')
                    },
                    {
                        name: 'Pin Right',
                        action: () => setColumnPinned('right'),
                        icon: pinnedIcon('right')
                    },
                    {
                        name: 'No Pin',
                        action: () => setColumnPinned(),
                        icon: pinnedIcon()
                    }
                ]
            },
            {
                name: 'Flex',
                icon: options.flex ? 'vg-checkmark' : '',
                action: () => {
                    params.grid.setColumnWidth(params.column, {
                        flex: Number(!options.flex)
                    })
                }
            },
            {
                name: 'Visible',
                icon: options.visible ? 'vg-checkmark' : '',
                action: () => {
                    params.grid.setColumnVisible(params.column, false)
                }
            }
        ]
    }

})

const visualGrid = ref<InstanceType<typeof VisualGrid> | null>(null)

watch(visualGrid, () => {
    if (visualGrid.value?.gridInstance) {
        visualGrid.value.gridInstance.on('afterCellDbClicked', (data) => {
            const row = rows[parseInt(data.row)]
            //
            // detailEvent(row)
        })
    }
})

/**
 * 查询分组
 */
const getAttachmentCategoryList = debounce(() => {
    getBrandAll().then(res => {
        brandList.data = res.data
    }).catch(() => {

    })
})

getAttachmentCategoryList()

watch(() => brandParam.express_no, () => {
    loadOrderList()
})
const priceViewDialog: Record<string, any> | null = ref(null)

const checkPriceView = (data: any) => {
    priceViewDialog.value.setFormData({ data: rows })
    priceViewDialog.value.showDialog = true
}
const importPriceDialog: Record<string, any> | null = ref(null)
/**
 * 添加站点
 */
const importEvent = (data: any) => {
    importPriceDialog.value.setFormData({ site_id: priceTable.site_id })
    importPriceDialog.value.showDialog = true
}

defineExpose({
    selectedFile,
    selectedFileIndex
})
</script>

<style lang="scss" scoped>
.group-list {
  .group-item {
    height: 32px;
    margin-top: 3px;

    .operate {
      display: none;
    }

    &.active {
      background-color: var(--el-color-primary-light-9);
      color: var(--el-color-primary);
    }

    &:hover {
      background-color: var(--el-color-primary-light-9);

      .operate {
        display: block;
      }
    }
  }
}

.attachment-item:hover {
  .attachment-action {
    display: block;
  }
}

.attachment-list-wrap {
  .attachment-wrap {
    background: var(--el-border-color-extra-light);
  }
}

.file-box-active {
  &:after {
    content: '';
    display: block;
    position: absolute;
    border: 15px solid;
    border-bottom-color: var(--el-color-primary);
    border-right-color: var(--el-color-primary);
    border-top-color: transparent;
    border-left-color: transparent;
    bottom: 0;
    right: 0;
  }

  span {
    font-style: normal;
  }
}
</style>
<style lang="scss">
.video-preview {
  background: none !important;
  box-shadow: none !important;

  .el-dialog__headerbtn .el-dialog__close {
    border-radius: 50%;
    width: 34px;
    height: 34px;
    font-size: 24px;
    color: #fff;
    background-color: var(--el-text-color-regular);
    border-color: #fff;
  }
}

.el-upload-list {
  position: absolute !important;
  z-index: 10;

  .el-upload-list__item {
    background: #fff !important;
    box-shadow: var(--el-box-shadow-light);
  }
}</style>
<style>
.visual-grid-container {
  width: 100%;
  height: 350px;
  width: 95%;
  /* max-width: 1200px; */
  height: 380px;

}

</style>
