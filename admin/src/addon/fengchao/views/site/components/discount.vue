<template>

  <el-form :model="formData" :rules="formRules" label-width="150px" ref="formRef" class="page-form" v-loading="loading">
    <el-card class="box-card !border-none" shadow="never">
      <h3 class="panel-title !text-sm">云杰京东价格折扣</h3>

      <el-form-item label="价格折扣" prop="discount">
        <el-input v-model.trim="formData.discount" placeholder="" class="input-width" clearable/>
      </el-form-item>

    </el-card>

    <div class="fixed-footer1">
      <el-button type="primary" :loading="loading" @click="save(formRef)">{{ t('save') }}</el-button>
    </div>

  </el-form>

</template>

<script lang="ts" setup>
import { computed, reactive, ref, watch } from 'vue'
import { FormInstance, FormRules } from 'element-plus'
import Test from '@/utils/test'
import { t } from '@/lang'
import { setDiscount, getDiscount, getBrandAll } from '@/addon/fengchao/api/site'
import { debounce } from '@/utils/common'

const props = defineProps({
    siteId: {
        type: Number,
        default: 1
    },
    modelValue: {
        type: Object,
        default: () => {
            return {}
        }
    }
})

const loading = ref(false)
const emits = defineEmits(['update:modelValue'])

const formData = ref({
    site_id: props.siteId,
    yunjie_discount: 10,
    discount: ''
})

const getYunjieDiscount = debounce(() => {
    getDiscount(props.siteId).then(res => {
        formData.value.discount = res.data.discount
    }).catch(() => {

    })
})

getYunjieDiscount()

const formRef = ref(null)

const formRules = reactive<FormRules>({
    discount: [
        {
            validator: (rule: any, value: any, callback: any) => {
                if (Test.empty(formData.value.discount)) {
                    callback('请输入折扣')
                }
                if (!Test.decimal(formData.value.discount, 1)) {
                    callback('折扣格式错误')
                }
                if (parseFloat(formData.value.discount) < 0.1 || parseFloat(formData.value.discount) > 9.9) {
                    callback('折扣只能输入0.1~9.9之间的值')
                }
                if (formData.value.discount <= 0) {
                    callback('折扣不能小于等于0')
                }
                callback()
            }
        }
    ]
})

const value = computed({
    get () {
        return props.modelValue
    },
    set (value) {
        emits('update:modelValue', value)
    }
})

watch(() => value.value, (nval, oval) => {
    if ((!oval || !Object.keys(oval).length) && Object.keys(nval).length) {
        formData.value = value.value
    }
}, { immediate: true })

watch(() => formData.value, () => {
    value.value = formData.value
}, { deep: true })

const verify = async () => {
    let verify = true
    await formRef.value?.validate((valid) => {
        verify = valid
    })
    return verify
}
const save = async (formEl: FormInstance | undefined) => {
    if (loading.value || !formEl) return

    await formEl.validate(async (valid) => {
        if (valid) {
            loading.value = true
            formData.value.yunjie_discount = formData.value.discount

            setDiscount(formData.value).then(() => {
                loading.value = false
            }).catch(() => {
                loading.value = false
            })
        }
    })
}
defineExpose({
    verify
})
</script>

<style lang="scss" scoped>
.fixed-footer1 {

  right: 15px;
  bottom: 0;
  left: 15px;
  display: flex;
  height: inherit;

  align-items: center;
  justify-content: center;
  transition: var(--el-transition-duration) width ease-in-out, var(--el-transition-duration) padding-left ease-in-out, var(--el-transition-duration) padding-right ease-in-out;
}
</style>
