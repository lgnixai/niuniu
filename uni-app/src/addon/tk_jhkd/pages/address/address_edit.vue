<template>
	<view class="px-[30rpx]" :style="themeColor()">
		<u-form labelPosition="left" :model="formData" labelWidth="200rpx" errorType='toast' :rules="rules"
			ref="formRef">
			<view class="mt-[10rpx]">
				<u-form-item :label="t('name')" prop="name" :border-bottom="true">
					<u-input v-model.trim="formData.name" border="none" clearable maxlength="25"
						:placeholder="t('namePlaceholder')" />
				</u-form-item>
			</view>
			<view class="mt-[10rpx]">
				<u-form-item :label="t('mobile')" prop="mobile" :border-bottom="true">
					<u-input v-model="formData.mobile" border="none" clearable :placeholder="t('mobilePlaceholder')" />
				</u-form-item>
			</view>
			<view class="mt-[10rpx]">
				<u-form-item :label="t('selectArea')" prop="area" :border-bottom="true" @click="selectArea">
					<view v-if="!formData.area" class="text-gray-placeholder text-[30rpx]">
						{{ t('selectAreaPlaceholder') }}
					</view>
					<view v-else class="text-[30rpx]">{{ formData.area }}</view>
				</u-form-item>
			</view>
			<view class="mt-[10rpx]">
				<u-form-item :label="t('address')" prop="address" :border-bottom="true">
					<u-input v-model.trim="formData.address" border="none" clearable maxlength="120"
						:placeholder="t('addressPlaceholder')" />
				</u-form-item>
			</view>
			<view class="mt-[10rpx]">
				<u-form-item :label="t('defaultAddress')" prop="name" :border-bottom="true">
					<u-switch v-model="formData.is_default" size="20" :activeValue="1" :inactiveValue="0"
						activeColor="var(--primary-color)" />
				</u-form-item>
			</view>
			<view class="tk-card1 p-2 mt-4 mb-4">
				<u-textarea clearable border="none" v-model="addressInfo" height="40" placeholder="在此处输入粘贴地址可以快速自动识别"
					maxlength="240" @keydown.enter="handleEnter" @keydown.shift.enter="handleShiftEnter"
					@paste="handlePaste" autoHeight />
				<view class="flex justify-end
				 tk-tag w-48px text-xs mt-1 ml-2" @click="fanyiAddressEvent()">地址识别</view>
			</view>
			<view class="mt-[40rpx]">
				<u-button type="primary" shape="circle" :text="t('save')" @click="save" :disabled="btnDisabled"
					:loading="operateLoading"></u-button>
			</view>
		</u-form>
		<area-select ref="areaRef" @complete="areaSelectComplete" :area-id="formData.district_id" />

	</view>

</template>

<script setup lang="ts">
	import { ref, computed } from 'vue'
	import { onLoad } from '@dcloudio/uni-app'
	import { redirect } from '@/utils/common'
	import { t } from '@/locale'
	import { addAddress, editAddress, getAddressInfo } from '@/app/api/member'
	import { fanyiAddress } from '@/addon/fengchao/api/tkjhkd'
	const addressInfo = ref()
	const formData = ref({
		id: 0,
		name: '',
		mobile: '',
		province_id: 0,
		city_id: 0,
		district_id: 0,
		address: '',
		full_address: '',
		is_default: 0,
		area: '',
		type: 'address'
	})

	const areaRef = ref()
	const formRef = ref(null)
	const type = ref('')
	const source = ref('')
	const btnDisabled = ref(false)
	const handlePaste = () => {
		setTimeout(() => {
			fanyiAddressEvent()
		}, 500)
	}
	const fanyiAddressEvent = () => {
		if (!addressInfo.value) {
			uni.$u.toast('请填写解析地址')
			return
		}
		fanyiAddress({ address: addressInfo.value }).then(res => {
			Object.assign(formData.value, res.data)
			uni.$u.toast('地址解析成功')
			addressInfo.value = ''

		})
	}
	onLoad((data) => {
		if (data.id) {
			getAddressInfo(data.id)
				.then(({ data }) => {
					data && Object.assign(formData.value, data)
				})
				.catch()
		}
		type.value = data.type || ''
		source.value = data.source || ''
	})

	const rules = computed(() => {
		return {
			'name': {
				type: 'string',
				required: true,
				message: t('namePlaceholder'),
				trigger: ['blur', 'change'],
			},
			'mobile': [
				{
					type: 'string',
					required: true,
					message: t('mobilePlaceholder'),
					trigger: ['blur', 'change'],
				},
				{
					validator(rule, value, callback) {
						let mobile = /^1[3-9]\d{9}$/;
						if (!mobile.test(value)) {
							callback(new Error(t('mobileError')))
						} else {
							callback()
						}
					}
				}
			],
			'area': {
				validator() {
					return !uni.$u.test.isEmpty(formData.value.area)
				},
				message: t('selectAreaPlaceholder')
			},
			'address': {
				type: 'string',
				required: true,
				message: t('addressPlaceholder'),
				trigger: ['blur', 'change'],
			}
		}
	})

	const selectArea = () => {
		areaRef.value.open()
	}

	const areaSelectComplete = (event) => {
		formData.value.province_id = event.province.id || 0
		formData.value.city_id = event.city.id || 0
		formData.value.district_id = event.district.id || 0
		formData.value.area = `${event.province.name || ''}${event.city.name || ''}${event.district.name || ''}`
	}

	const operateLoading = ref(false)
	const save = () => {
		const save = formData.value.id ? editAddress : addAddress

		formRef.value.validate().then(() => {
			if (operateLoading.value) return
			operateLoading.value = true

			btnDisabled.value = true

			formData.value.full_address = formData.value.area + formData.value.address

			save(formData.value).then((res) => {
				operateLoading.value = false
				setTimeout(() => {
					btnDisabled.value = false
					redirect({
						url: '/addon/fengchao/pages/address/address',
						mode: 'redirectTo',
						param: { type: type.value, source: source.value }
					})
				}, 1000)
			}).catch(() => {
				operateLoading.value = false
				btnDisabled.value = false
			})
		})
	}
</script>

<style lang="scss" scoped>
	@import '@/addon/fengchao/utils/styles/common.scss';

	page {
		--primary-color: #4541c7;
		--primary-color-dark: #F26F3E;
		--primary-color-disabled: #FFB397;
		--primary-color-light: #FFEAE2;
		--page-bg-color: #f7f7f7;
		--price-text-color: #e1251b;
	}

	.tk-tag {
		padding: 4rpx 8rpx;
		background: var(--primary-color);
		color: #ffffff;
		border-radius: 8rpx;
		font-size: 22rpx;
	}

	.tk-card1 {
		background-color: rgba(255, 255, 255, 0.9);

		border-radius: 12rpx;

		bbbox-shadow: 0 1px 1px 0 rgba(234, 234, 234, 0.2), 0 2px 2px 0 rgba(231, 231, 231, 0.2);
	}
</style>