<template>
	<view class="bg-[#f8f8f8] min-h-screen overflow-hidden">
		<view class="fixed left-0 top-0 right-0 z-10" v-if="statusLoading">
			<scroll-view scroll-x="true" class="scroll-Y box-border px-[24rpx] bg-white">
				<view class="flex whitespace-nowrap justify-around">
					<view :class="[
              'text-sm leading-[90rpx]',
              { 'class-select': orderState === item.status.toString() },
            ]" @click="orderStateFn(item.status)" v-for="(item, index) in orderStateList">{{ item.name }}
					</view>
				</view>
			</scroll-view>
		</view>
		<view class="h-[44rpx]"></view>
		<mescroll-body ref="mescrollRef" top="44rpx" @init="mescrollInit" @down="downCallback" @up="getOrderListFn">
			<view v-if="list.length > 0" class="tk-card m-2 mt-4 rounded-xl shadow-xl" v-for="(item, index) in list"
				:key="index">
				<view class="fb flex justify-between">
					<view class="text-xs font-weight">
						订单号:{{ item.order_id }}
						<view v-if="item.orderInfo.delivery_id" class="flex items-center"
							@click="copy(item.orderInfo.delivery_id)">
							<text class="mr-2 text-primary text-xs mt-1">运单号:{{ item.orderInfo.delivery_id }}
							</text>
							<view>
								<up-icon class="border-1 rounded" name="cut" color="#4541c7" size="16"></up-icon>
							</view>
						</view>
					</view>
					<view class="text-xs h-5 text-red-600" v-if="item.order_status_data.name == '已关闭'">
						{{ item.order_status_data.name }}
					</view>
					<view class="text-xs h-5" v-else>{{
            item.order_status_data.name
          }}</view>
				</view>
				<view class="flex justify-center mt-3">
					<view class="flex items-center">
						<view class="mr-2">
							<text class="qu-tag text-sm p-2 rounded-xl">寄</text>
						</view>
						<view class="flex flex-col items-center">
							<view class="text-sm font-bold flex">
								<view class="">{{ JSON.parse(item.orderInfo.start_address).address.split('-')[0] }}
								</view>
							</view>
							<view class="tk-sltext text-xs text-[#4b4b4b]">
								{{ JSON.parse(item.orderInfo.start_address).name }}
							</view>

						</view>
					</view>
					<view class="flex items-center ml-4 mr-4">
						<view class="flex">

							<view>
								<up-icon name="more-dot-fill" color="#63625f" size="28"></up-icon>
							</view>
							<view>
								<up-icon name="more-dot-fill" color="#63625f" size="28"></up-icon>
							</view>
							<view>
								<up-icon name="arrow-right" color="#63625f" size="28"></up-icon>
							</view>
						</view>

					</view>
					<view class="flex items-center">
						<view class="mr-4">
							<text class="song-tag text-sm p-2 rounded-xl">收</text>
						</view>
						<view class="">

							<view class="flex flex-col items-center">
								<view class="text-sm font-bold flex">
									<view class="">{{ JSON.parse(item.orderInfo.end_address).address.split('-')[0] }}
									</view>
								</view>
								<view class="tk-sltext text-xs text-[#4b4b4b]">
									{{ JSON.parse(item.orderInfo.end_address).name }}
								</view>

							</view>
						</view>
					</view>
				</view>
				<view class="flex mt-4 items-center justify-between">
					<view class="text-xs text-slate-600">下单时间:{{item.create_time}}</view>
					<view class="text-red font-bold text-[32rpx]">￥{{item.order_money}}</view>
				</view>
				<view class="text-[16rpx] pl-1 mt-1 text-[#7e7e7e]">
					注意：下单 1 分钟后才能取消订单哦</view>

				<view v-if="item.addorderInfo&&item.deliveryRealInfo.fee_weight>0&&item.addorderInfo.order_status==0">
					<view class="line-box1"></view>
					<view
						class="flex items-center mt-1 mb-2 flex text-xs font-bold p-2 text-[24rpx] bg-[#e5fffb] rounded-lg text-red bg-opacity-50">
						<view v-if="item.deliveryRealInfo.fee_weight>item.orderInfo.weight" class="">
							超重:
							{{Math.ceil(item.deliveryRealInfo.fee_weight-item.orderInfo.weight)}}kg;￥{{Math.ceil(item.deliveryRealInfo.fee_weight-item.orderInfo.weight)*item.orderInfo.price_rule.add??3}};
						</view>
						<block v-if="item.deliveryRealInfo.fee_blockList"
							v-for="(item1,index1) in item.deliveryRealInfo.fee_blockList">
							<view class="">
								{{item1.name}}:￥{{item1.fee}}
							</view>
						</block>
					</view>
					<view class='flex justify-end mt-1 items-center'>

						<view class='font-bold text-red text-[28rpx]'>
							需补差价:￥{{item.addorderInfo.order_money}}</view>
					</view>

				</view>
				<view v-else>
					<view class="flex">

						<view v-if="item.addorderInfo&&item.addorderInfo.order_status==1"
							class="flex text-xs font-bold ml-2 p-2 text-[24rpx] bg-[#e5fffb] rounded-lg text-red bg-opacity-50">
							已补差价：￥
							{{item.addorderInfo.order_money}}
						</view>
					</view>
				</view>
				<view class="line-box1"></view>

				<view class="flex mt-2 items-center justify-between">
					<view class="flex">
						<block v-if="item.order_status_arr"
							v-for="(item1, index1) in item.order_status_arr.member_action">
							<view class="tk-tag mr-4" @click="clickbut(item1.class, item)">{{
                item1.name
              }}</view>
						</block>
					</view>
					<view class="flex">
						<view class="tk-tag" @click="goto('/addon/fengchao/pages/orderdetail?id=' + item.id)">查看详情</view>
						<view v-if="item.addorderInfo&&item.addorderInfo.order_status==0"
							@click="payAdd(item.addorderInfo.id)" class="tk-tag1 ml-2">补差价</view>
					</view>

				</view>
			</view>

			<mescroll-empty :option="{ icon: img('static/resource/images/empty.png') }"
				v-if="!list.length && loading"></mescroll-empty>
		</mescroll-body>
	</view>
	<up-modal :show="orders.show" @confirm="confirm(item1.class, item)" ref="uModal" @cancel="orders.show = false"
		:showCancelButton="true" :content="orders.msg" :asyncClose="true"></up-modal>

	<tabbar addon="fengchao" />
	<pay ref="payRef" @close="payLoading = false"></pay>
</template>

<script setup lang="ts">
	import { ref } from "vue";
	import { t } from "@/locale";
	import { img, redirect, copy } from "@/utils/common";
	import {
		getOrderList,
		getOrderStatus,
		applyRefund,
		deleteOrder,
		closeOrder,
	} from "@/addon/fengchao/api/order";
	import MescrollBody from "@/components/mescroll/mescroll-body/mescroll-body.vue";
	import MescrollEmpty from "@/components/mescroll/mescroll-empty/mescroll-empty.vue";
	import useMescroll from "@/components/mescroll/hooks/useMescroll";
	import { onLoad, onPageScroll, onReachBottom } from "@dcloudio/uni-app";
	import { goto } from "@/addon/fengchao/utils/ts/goto";
	import { confirm } from "@/addon/fengchao/utils/ts/alert";
	// import { checkAddPayEvent } from "@/addon/fengchao/utils/ts/common"
	// checkAddPayEvent()
	const payAdd = (e) => {
		payLoading.value = true;
		payRef.value?.open(
			"jhkdOrderAddPay",
			e,
			"/addon/fengchao/pages/orderlist"
		);
	};
	interface Order {
		id : string;
		order_id : string;
		orderInfo : {
			delivery_id : string;
			start_address : string;
			end_address : string;
			goods : string;
			weight : number;
			long : number;
			width : number;
			height : number;
		};
		order_status_data : {
			name : string;
		};
		order_status_arr : {
			member_action : Array<{ class : string; name : string }>;
		};
	}

	const payRef = ref(null);
	const payLoading = ref(false);
	const orders = ref<{ show : boolean; msg : string }>({
		show: false,
		msg: "",
	});
	const { mescrollInit, downCallback, getMescroll } = useMescroll(
		onPageScroll,
		onReachBottom
	);
	const list = ref<Order[]>([]);
	const loading = ref<boolean>(false);
	const statusLoading = ref<boolean>(false);
	const orderState = ref<string>("");
	const orderStateList = ref<Array<{ name : string; status : string }>>([]);

	onLoad((option : { status : string }) => {
		orderState.value = option.status || "";
		getOrderStatusFn();
	});

	const clickbut = (action : string, item : Order) => {
		if (action === "gopay") {
			gopay(item);
		} else if (action === "del") {
			confirm("确定要删除订单吗？", del, item);
		} else if (action === "refund") {
			confirm("确定要申请退款吗？", refund, item);
		} else if (action === "close") {
			confirm("确定要关闭订单吗？", close, item);
		}
	};
	//支付
	const gopay = (item : any) => {
		payLoading.value = true;
		payRef.value?.open(
			item.payInfo.trade_type,
			item.payInfo.trade_id,
			"/addon/fengchao/pages/orderlist?status=" + orderState.value
		);
	};
	const del = async (item : Order) => {
		await deleteOrder(item.id);
		getMescroll().resetUpScroll();
	};
	const close = async (item : Order) => {
		await closeOrder(item.id);
		getMescroll().resetUpScroll();
	};
	const refund = async (item : Order) => {
		const params = {
			id: item.id,
			close_reason: "用户主动退款",
		};
		await applyRefund(params);
		getMescroll().resetUpScroll();
	};

	const getOrderListFn = (mescroll : any) => {
		loading.value = false;
		const data = {
			page: mescroll.num,
			limit: mescroll.size,
			order_status: orderState.value,
		};
		getOrderList(data)
			.then((res) => {
				const newArr = res.data.data as Order[];
				if (mescroll.num === 1) {
					list.value = [];
				}
				list.value = list.value.concat(newArr);
				mescroll.endSuccess(newArr.length);
				loading.value = true;
			})
			.catch(() => {
				loading.value = true;
				mescroll.endErr();
			});
	};

	const getOrderStatusFn = () => {
		statusLoading.value = false;
		orderStateList.value = [];
		const obj = { name: "全部", status: "" };
		orderStateList.value.push(obj);
		getOrderStatus()
			.then((res) => {
				Object.values(res.data).forEach((item) => {
					orderStateList.value.push(item);
				});
				statusLoading.value = true;
			})
			.catch(() => {
				statusLoading.value = true;
			});
	};

	const orderStateFn = (status : string) => {
		orderState.value = status.toString();
		list.value = [];
		getMescroll().resetUpScroll();
	};
</script>

<style lang="scss" scoped>
	//@import "@/addon/fengchao/utils/styles/common.scss";
	.line-box1 {
		background-color: #e3e3e3;
		height: 2rpx;
		width: 100%;
		margin-top: 12rpx;
		margin-bottom: 12rpx;
	}

	page {
		--primary-color: #4541c7;
		--primary-color-dark: #f26f3e;
		--primary-color-disabled: #ffb397;
		--primary-color-light: #ffeae2;
		--page-bg-color: #f7f7f7;
		--price-text-color: #e1251b;
	}

	.qu-tag {
		background: #fba92d;
		color: #ffffff;
		height: 28rpx;
		line-height: 28rpx;
		text-align: center;
		width: 32rpx;
		display: inline-block;
	}

	.song-tag {
		background: #4541c7;
		color: #ffffff;
		height: 28rpx;
		line-height: 28rpx;
		text-align: center;
		width: 32rpx;
		display: inline-block;
	}

	.tk-card {
		padding: 20rpx;
		margin-top: 24rpx;
		background: #fff;
		box-shadow: 0rpx 1rpx 4rpx rgba(0, 0, 0, 0.1);
		margin-bottom: 10rpx;
	}

	.tk-tag1 {
		background: #4541c7;
		color: #ffffff;
		border: 1rpx solid #4541c7;
		font-size: 22rpx;
		padding: 5rpx 20rpx;
		border-radius: 10rpx;
	}

	.tk-tag {
		color: #4541c7;
		border: 1rpx solid #4541c7;
		font-size: 22rpx;
		padding: 5rpx 20rpx;
		border-radius: 10rpx;
	}
</style>