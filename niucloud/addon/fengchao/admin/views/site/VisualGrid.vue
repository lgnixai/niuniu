<template>
  <div ref="gridContainer" class="visual-grid-container v-grid-default-theme"></div>
</template>

<script lang="ts" setup>
import { ref, watch, onMounted, onBeforeUnmount } from 'vue'
import { Grid } from '@visualjs/grid'
import '@visualjs/grid/dist/style.css'
import '@visualjs/grid/dist/themes/default.css'

const prop = defineProps({
    options: {
        type: Object,
        default: null
    }
})

// DOM 容器
const gridContainer = ref<HTMLDivElement | null>(null)
const gridInstance = ref<Grid | null>(null) // Grid 实例

// 生命周期：挂载时初始化 Grid
onMounted(() => {
    if (gridContainer.value) {
        gridInstance.value = new Grid(gridContainer.value, prop.options)
    }
})

// 生命周期：销毁前清理 Grid 实例
onBeforeUnmount(() => {
    if (gridInstance.value) {
        gridInstance.value.destroy()
        gridInstance.value = null
    }
})

// 监听 Props 的变化并更新 Grid 配置
watch(
    () => prop.options,
    (newOptions) => {
        if (gridInstance.value) {
            gridInstance.value.setColumns(newOptions.columns || [])
            gridInstance.value.clearRows()

            gridInstance.value.appendRows(newOptions.data || [])
        }
    },
    { deep: true }
)

// 暴露的接口
defineExpose({
    gridInstance // 初始值
})

</script>
<style scoped>
.visual-grid-container {
  width: 100%;
  height: 300px;
}
</style>
