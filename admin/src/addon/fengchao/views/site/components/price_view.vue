<template>
    <el-dialog v-model="showDialog" :title="t('adjustBalance')" width="95%" :destroy-on-close="true">

      <el-scrollbar>
        <div class="price-table">
          <!-- 价格组按钮 -->
          <div class="group-buttons">
            <button
                v-for="(group, index) in priceGroups"
                :key="index"
                @click="selectGroup(group.id)"
                :class="{ active: selectedGroupId === group.id }"
            >
              ({{ index + 1 }}) [首重：{{ group.first_weight }},续重{{ group.continuous_weight }}]
            </button>
          </div>

          <!-- 表格 -->
          <table border="1" cellspacing="0" cellpadding="5">
            <thead>
            <tr>
              <th>{{ t('始发省份') }}</th>
              <th v-for="(province, index) in formData.headers" :key="index">
                {{ province }}
              </th>
            </tr>
            </thead>
            <tbody>
            <tr
                v-for="(row, rowIndex) in filteredTableData"
                :key="rowIndex"
                :class="{
            highlighted: isHighlighted(row.sender_province)
          }"
            >
              <td>{{ row.sender_province }}</td>
              <td v-for="(province, colIndex) in formData.headers" :key="colIndex">
                {{ row[province] || '' }}
              </td>
            </tr>
            </tbody>
          </table>
        </div>
      </el-scrollbar>

    </el-dialog>
</template>

<script lang="ts" setup>
import { ref, reactive, computed } from 'vue'
import { t } from '@/lang'
import type { FormInstance } from 'element-plus'
import { adjustBalance } from '@/addon/fengchao/api/site'

const showDialog = ref(false)
const loading = ref(true)
const repeat = ref(false)

/**
 * 表单数据
 */
const initialFormData = {
    data: [],
    headers: [], // 表格的列头 (接收省份)
    tableData: [] // 处理后的表格数据
}
const formData: Record<string, any> = reactive({ ...initialFormData })

// 分组信息与当前选择的组
interface PriceGroup {
  id: number
  first_weight: string
  continuous_weight: string
  data: any[]
}
const priceGroups = ref<PriceGroup[]>([])
const selectedGroupId = ref<number | null>(null)
const filteredTableData = ref<any[]>([])

// 数据处理逻辑
const processData = () => {
    // 1. 提取接收省份
    const provinces = Array.from(
        new Set(formData.data.map((item: any) => item.receive_province))
    )
    formData.headers = provinces

    // 2. 分组数据
    const groupMap = new Map<string, PriceGroup>()
    formData.data.forEach((item: any) => {
        const groupKey = `${item.first_weight}-${item.continuous_weight}`
        if (!groupMap.has(groupKey)) {
            groupMap.set(groupKey, {
                id: groupMap.size + 1,
                first_weight: item.first_weight,
                continuous_weight: item.continuous_weight,
                data: []
            })
        }
    groupMap.get(groupKey)!.data.push(item)
    })

    priceGroups.value = Array.from(groupMap.values())

    // 3. 生成表格数据
    const senders = Array.from(
        new Set(formData.data.map((item: any) => item.sender_province))
    )
    formData.tableData = senders.map((sender) => {
        const row: Record<string, any> = { sender_province: sender }
        formData.headers.forEach((receiver) => {
            const match = formData.data.find(
                (item: any) =>
                    item.sender_province === sender &&
              item.receive_province === receiver
            )
            row[receiver] = match
                ? groupMap.get(`${match.first_weight}-${match.continuous_weight}`)?.id
                : null
        })
        return row
    })

    applyFilter()
}

// 过滤逻辑
const selectGroup = (groupId: number) => {
    selectedGroupId.value = groupId
    applyFilter()
}

const applyFilter = () => {
    // 保持所有数据在表格中
    filteredTableData.value = formData.tableData.map((row) => {
        const newRow = { ...row }

        // 根据选中的组设置数据为空或高亮
        formData.headers.forEach((receiver) => {
            const groupId = row[receiver]
            if (selectedGroupId.value !== null && groupId === selectedGroupId.value) {
                // 如果该行属于选中的组，保持数据，否则置空
                newRow[receiver] = row[receiver] || '-'
            } else {
                newRow[receiver] = null
            }
        })

        return newRow
    })
}

// 判断是否是选中的组的行，用于高亮显示
const isHighlighted = (row: any, province: string) => {
    if (selectedGroupId.value === null) return false
    const selectedGroup = priceGroups.value.find(
        (group) => group.id === selectedGroupId.value
    )
    return selectedGroup?.data.some(
        (item) => item.sender_province === row.sender_province
    )
}

const setFormData = async (row: any = null) => {
    loading.value = true
    Object.assign(formData, initialFormData)
    if (row) {
        Object.keys(formData).forEach((key: string) => {
            if (row[key] != undefined) formData[key] = row[key]
        })
    }
    processData()
    // }
    //
    // // 1. 提取所有接收省份 (headers)
    // const provinces = Array.from(
    //     new Set(formData.data.map((item) => item.receive_province))
    // )
    // formData.headers = provinces
    //
    // // 2. 提取所有始发省份，并构建交叉数据
    // const senders = Array.from(
    //     new Set(formData.data.map((item) => item.sender_province))
    // )
    //
    // // 初始化数据结构
    // formData.tableData = senders.map((sender) => {
    //     const row = { sender_province: sender }
    //     formData.headers.forEach((receiver) => {
    //         // 查找匹配的 `first_weight` 值
    //         const match = formData.data.find((item) =>
    //             item.sender_province === sender &&
    //               item.receive_province === receiver
    //         )
    //         row[receiver] = match ? match.first_weight : null
    //     })
    //     return row
    // })

    loading.value = false
}

defineExpose({
    showDialog,
    setFormData
})
</script>

<style scoped>
.group-buttons {
  margin-bottom: 10px;
}

.group-buttons button {
  margin-right: 5px;
  padding: 5px 10px;
  cursor: pointer;
  border: 1px solid #ccc;
  background-color: #f0f0f0;
}

.group-buttons button.active {
  background-color: #007bff;
  color: white;
  border-color: #007bff;
}

table {
  width: 100%;
  border-collapse: collapse;
}

th,
td {
  text-align: center;
  border: 1px solid #ddd;
  padding: 5px;
}
</style>
