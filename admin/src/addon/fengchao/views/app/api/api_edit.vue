<template>
  <el-dialog v-model="showDialog" :title="title" width="700px" class="diy-dialog-wrap" :destroy-on-close="true">
    <el-form :model="formData" label-width="100px" ref="formRef" :rules="formRules" class="page-form"
             v-loading="loading">
      <el-form-item :label="t('apiName')" prop="api_name">
        <el-input v-model.trim="formData.api_name" clearable :placeholder="t('apiNamePlaceholder')"
                  class="input-width" maxlength="10" @blur="formData.api_name = $event.target.value"/>
      </el-form-item>

      <el-form-item :label="t('api_key')">
        <el-input v-model.trim="formData.api_key" readonly maxlength="100"   class="input-width" />
      </el-form-item>
      <el-form-item :label="t('api_secret')">
        <el-input v-model.trim="formData.api_secret" readonly maxlength="100"   class="input-width"/>
      </el-form-item>
      <el-form-item :label="t('callbackUrl')" prop="callback_url">
        <el-input v-model.trim="formData.callback_url" clearable :placeholder="t('urlPlaceholder')"
                  class="input-width"   @blur="formData.callback_url = $event.target.value"/>
      </el-form-item>

    </el-form>

    <template #footer>
            <span class="dialog-footer">
                <el-button @click="showDialog = false">{{ t('cancel') }}</el-button>
                <el-button type="primary" :loading="loading" @click="confirm(formRef)">{{ t('confirm') }}</el-button>
            </span>
    </template>
  </el-dialog>
</template>

<script lang="ts" setup>
import { ref, reactive, computed } from 'vue'
import { t } from '@/lang'
import type { FormInstance } from 'element-plus'
import { filterNumber } from '@/utils/common'

import { addApi, getApiList, getNewApi } from '@/addon/fengchao/api/api'

const showDialog = ref(false)
const loading = ref(false)
const title = ref('')

/**
 * 表单数据
 */
const initialFormData = {
    api_name: '',
    api_key: '',
    api_secret: '',
    callback_url: ''

}
const formData: Record<string, any> = reactive({ ...initialFormData })

const formRef = ref<FormInstance>()

// 表单验证规则
const formRules = computed(() => {
    return {
        api_name: [
            { required: true, message: t('apiNamePlaceholder'), trigger: 'blur' }
        ],
        callback_url: [
            { required: true, message: t('urlPlaceholder'), trigger: 'blur' }
            // {
            //     validator: (rule, value, callback) => {
            //         const urlPattern = /^(http?:\/\/)?([\da-z.-]+)\.([a-z.]{2,6})([/\w .-]*)*\/?$/
            //         if (value && !urlPattern.test(value)) {
            //             callback(new Error(t('urlFormatError')))
            //         } else {
            //             callback()
            //         }
            //     },
            //     trigger: 'blur'
            // }
        ]
    }
})

const emit = defineEmits(['complete'])

/**
 * 确认
 * @param formEl
 */
const confirm = async (formEl: FormInstance | undefined) => {
    if (loading.value || !formEl) return
    const save = addApi

    await formEl.validate(async (valid) => {
        if (valid) {
            loading.value = true

            const data = formData

            save(data).then(res => {
                loading.value = false
                showDialog.value = false
                emit('complete')
            }).catch(err => {
                loading.value = false
            })
        }
    })
}

// 获取字典数据

const setFormData = async () => {
    Object.assign(formData, initialFormData)
    loading.value = true

    const data = await (await getNewApi()).data
    title.value = t('addApi')
    if (data) {
        Object.keys(formData).forEach((key: string) => {
            if (data[key] != undefined) formData[key] = data[key]
        })
    }

    loading.value = false
}

const filterSpecial = (event: any) => {
    event.target.value = event.target.value.replace(/[^\u4e00-\u9fa5a-zA-Z0-9]/g, '')
    event.target.value = event.target.value.replace(/[`~!@#$%^&*()_\-+=<>?:"{}|,.\/;'\\[\]·~！@#￥%……&*（）——\-+={}|《》？：“”【】、；‘’，。、]/g, '')
}

defineExpose({
    showDialog,
    setFormData
})
</script>

<style lang="scss" scoped>
.input-width{
  width: 560px;
}
</style>
<style lang="scss">
.diy-dialog-wrap .el-form-item__label {
  height: auto !important;
}

</style>
