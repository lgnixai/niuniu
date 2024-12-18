<template>
	<view class="">
		<view class="tk-card">
			<view class="order-num-card">
				<view class="text-xs font-weight text-slate-600">订单号:{{form.order_id}}</view>
				<view class="fb mt-1">
					<view class="text-xs font-weight text-slate-500">{{form.create_time}}</view>
					<view class="mr-4 tk-tag" v-if="form.order_status_arr">{{form.order_status_arr.name}}</view>
				</view>
			</view>
			<view class="flex mt-1 items-center">
				<view class="mr-4">
					<text class="qu-tag text-xs">取</text>
				</view>
				<view class="" v-if="form.orderInfo">
					<view class="tk-sltext text-xs text-[#4b4b4b] font-bold">
						{{JSON.parse(form.orderInfo.start_address).address}}
					</view>
					<view class="text-xs flex">
						<view class="tk-sltext">
							{{JSON.parse(form.orderInfo.start_address).full_address}}
						</view>
					</view>
					<view class="text-xs flex">
						<view class="tk-sltext">
							{{JSON.parse(form.orderInfo.start_address).mobile}}
						</view>
					</view>
				</view>
			</view>
			<view class="flex mt-2 items-center">
				<view class="mr-4">
					<text class="song-tag text-xs">送</text>
				</view>
				<view class="" v-if="form.orderInfo">
					<view class="tk-sltext text-xs text-[#4b4b4b] font-bold">
						{{JSON.parse(form.orderInfo.end_address).address}}
					</view>
					<view class="text-xs flex">
						<view class="tk-sltext w-3/4">{{JSON.parse(form.orderInfo.end_address).full_address}}</view>
					</view>
					<view class="text-xs flex">
						<view class="tk-sltext w-3/4">{{JSON.parse(form.orderInfo.end_address).mobile}}</view>
					</view>
				</view>
			</view>

			<view class="detail-tag text-xs font-weight p-4 text-[#878787]" v-if="form.orderInfo">
				物品:{{form.orderInfo.goods}}下单重量:{{form.orderInfo.weight}}kg {{form.orderInfo.goods}}
				{{form.orderInfo.long}}x{{form.orderInfo.width}}x{{form.orderInfo.height}}cm
			</view>

			<view class="detail-tag font-weight p-4 text-[#313131]">备注:{{form.remark}}

			</view>

			<view class="flex justify-end mt-2">

				<block v-if="form.order_status_arr" v-for="(item, index) in form.order_status_arr.member_action">
					<view class="tk-tag mr-4" @click="clickbut(item.class)">{{ item.name }}</view>
				</block>
			</view>
		</view>
		<view>
			<up-collapse @change="change001" @close="close001" @open="open001">
				<up-collapse-item title="计费信息" name="Docs guide">
					<view class="p-2 !bg-[#f7f7f7] font-bold">
						<view v-if="form.orderInfo" class="flex">
							<view class="">首重:{{form.orderInfo.price_rule.first}}元/{{form.orderInfo.price_rule.start}}kg
							</view>
							<view class="ml-6">续重:{{form.orderInfo.price_rule.add}}元/kg</view>
						</view>
						<view v-if="form.deliveryRealInfo" class="">
							<view class="flex">
								<view v-if="form.deliveryRealInfo.fee_weight>0">
									计费重量:{{form.deliveryRealInfo.fee_weight }}kg
								</view>
								<view v-if="form.deliveryRealInfo.volume
								>0" class="ml-8">体积:{{form.deliveryRealInfo.volume}}cm³
								</view>
							</view>

							<block v-if="form.deliveryRealInfo&&form.deliveryRealInfo.fee_blockList.length>0"
								v-for="(item,index) in form.deliveryRealInfo.fee_blockList">
								<view class="flex">
									<view>{{item.name}}</view>
									<view>{{item.fee}}元</view>
								</view>
							</block>
						</view>
					</view>
				</up-collapse-item>

			</up-collapse>
		</view>
		<view class="tk-card">
			<view class="mb-2 font-weight text-xs text-slate-600"
				v-if="form.orderInfo &&pickInfo&&form.orderInfo.order_status==1">
				<view class="fl items-center">
					<view v-if="pickInfo.courierName" class="">揽件员：{{pickInfo.courierName}}</view>
					<view v-if="pickInfo.courierPhone" class="ml-4 mr-1" @click="telPicker(pickInfo.courierPhone)">
						联系电话：{{pickInfo.courierPhone}}
					</view>
					<u-icon v-if="pickInfo.courierPhone" name="phone" color="#676767" size="18"
						@click="telPicker(pickInfo.courierPhone)"></u-icon>
				</view>
				<view v-if="pickInfo&&pickInfo.pickUpCode" class="mt-2">
					<view class="font-bold text-[32rpx]">取件码：{{pickInfo.pickUpCode}}</view>
				</view>
			</view>

			<view class="mt-2 flex items-center" v-show="form.orderInfo && form.orderInfo.delivery_arry">
				<image
					:src="img(form.orderInfo && form.orderInfo.delivery_arry ? form.orderInfo.delivery_arry.logo : '')"
					mode="" style="width: 34px;height: 34px;border-radius: 100%;"></image>
				<view class="">
					<view class="ml-2 text-sm">
						{{ form.orderInfo && form.orderInfo.delivery_arry ? form.orderInfo.delivery_arry.name : '' }}
					</view>
					<view class="ml-2 font-weight text-xs text-slate-600">
						{{form.orderInfo &&form.orderInfo.delivery_id?form.orderInfo.delivery_id:'暂无单号'}}
					</view>

				</view>

			</view>
		</view>

		<view class="tk-card">
			<view class="p-2" v-if="deliveryInfo&&deliveryInfo.length>0">
				<u-steps dot="true" direction="column">
					<block v-for="(item,index) in deliveryInfo" key=index>
						<u-steps-item :title="item.desc" :desc="item.time">
						</u-steps-item>
					</block>
				</u-steps>
			</view>
			<view v-else class="text-xs text-slate-400">暂无运单动态</view>
		</view>
	</view>
	<tabbar addon="tk_jhkd" />
	<pay ref="payRef" @close="payLoading = false"></pay>
</template>

<script setup lang="ts">
	import {
		ref,
		reactive
	} from 'vue'
	import {
		onLoad
	} from '@dcloudio/uni-app'
	import {
		getOrderDetail, applyRefund, deleteOrder, getDeliveryInfo, closeOrder
	} from '@/addon/tk_jhkd/api/order'
	import {
		goback, goto
	} from '@/addon/tk_jhkd/utils/ts/goto';
	import {
		timeChange
	} from '@/addon/tk_jhkd/utils/ts/common';
	import { img, copy } from '@/utils/common'
	const payRef = ref(null)
	const payLoading = ref(false)
	const form = reactive({})
	const deliveryInfo = ref()
	const pickInfo = ref()
	const clickbut = (action) => {
		if (action == 'gopay') {
			gopay()
		}
		if (action == 'del') {
			del()
		}
		if (action == 'refund') {
			refund()
		}
		if (action == 'close') {
			close()
		}
	}
	//联系快递
	const telPicker = (phone) => {
		uni.makePhoneCall({
			phoneNumber: phone
		});
	}
	//关闭
	const close = async () => {
		await closeOrder(form.id)
		goto('/addon/tk_jhkd/pages/orderlist')
	}
	//删除
	const del = async () => {
		await deleteOrder(form.id)
		goto('/addon/tk_jhkd/pages/orderlist')
	}
	//退款
	const refund = async () => {
		let params : object = {
			id: form.id,
			close_reason: '用户主动退款'
		};
		await applyRefund(params)
		goto('/addon/tk_jhkd/pages/orderlist')
	}
	//评价
	const evaluate = () => {
		console.log('evaluate')
	}
	//再来一单
	const again = () => {
		console.log('again')
	}
	const gopay = () => {
		payLoading.value = true
		payRef.value?.open(form.payInfo.trade_type, form.payInfo.trade_id, '/tk_jhkd/pages/orderdetail?id=' + form.id)
	}
	const getTrance = async (deliveryid) => {
		const data = await getDeliveryInfo(deliveryid)
		deliveryInfo.value = data.data
	}
	const getData = async (id : number) => {
		const data = await getOrderDetail(id)
		if (data.data.order_status_arr == null) {
			uni.$u.toast('订单不存在或删除')
			setTimeout(function () {
				goto('/addon/tk_jhkd/pages/orderlist');
			}, 1000);
		}
		Object.assign(form, data.data)
		if (form.orderInfo.delivery_id) {
			getTrance(form.orderInfo.delivery_id)
		}
		if (form.orderInfo.courier_context) {
			pickInfo.value = JSON.parse(form.orderInfo.courier_context)
		}
	}
	onLoad((options : any) => {
		if (options.id) {
			getData(options.id)
		}
	})
</script>

<style lang="scss" scoped>
	@import '@/addon/tk_jhkd/utils/styles/common.scss';

	.class-select {
		position: relative;
		font-weight: bold;

		&::after {
			content: "";
			position: absolute;
			bottom: 0;
			height: 6rpx;
			background-color: var(--primary-color);
			width: 90%;
			left: 50%;
			transform: translateX(-50%);
		}
	}

	.detail-tag {
		background-color: aliceblue;
		padding: 4rpx 16rpx;
		font-size: 16rpx;
	}

	.qu-tag {
		background-color: #b9b9b9;
		color: #ffffff;
		padding: 4rpx 8rpx;
		border-radius: 16rpx;
	}

	.song-tag {
		background-color: #4451c2;
		color: #ffffff;
		padding: 4rpx 8rpx;
		border-radius: 16rpx;
	}

	.order-num-card {
		background-color: rgba(0, 85, 255, 0);
		padding: 12rpx;
		border-radius: 8rpx;
	}
</style>