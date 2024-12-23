<template>
	<view class="tk-card !bg-[#f4f4f4]">


		<view class="fb flex item-center">
			<view class="">
				<text class="tag">寄</text>
			</view>
			<view class="w-[380rpx]">
				<text v-if="form.startAddress == []" class="font-bold">从哪里寄？</text>
				<text v-if="form.startAddress == []" class="tk-sltext">请选择寄件地址</text>

				<text v-if="form.startAddress" class="font-bold tk-sltext text-sm">
					{{ form.startAddress.name }}
					<text class="font-bold text-xs text-slate-600">
						{{ form.startAddress.mobile }}
					</text>
				</text>
				<text v-if="form.startAddress" class="text-xs font-bold">{{ form.startAddress.address
              }}</text>
			</view>
			<view class="">
				<text class="bt text-sm" @click="toSelectAddress('startaddress')">地址簿</text>
			</view>
		</view>
		<view class="line-box1 mt-2"></view>
		<view class="fb fb flex item-center mt-2">
			<view class="">
				<text class="tag" style="background: #4541c7; color: #ffffff">收</text>
			</view>
			<view class="w-[380rpx]">
				<view v-if="form.endAddress == []" class="font-bold">收件人信息？</view>
				<text v-if="form.endAddress == []" class="tk-sltext">请选择收件地址</text>
				<text v-if="form.endAddress" class="font-bold tk-sltext text-sm">
					{{ form.endAddress.name }}
					<text class="font-bold text-xs text-slate-600">
						{{ form.endAddress.mobile }}
					</text>
				</text>
				<text v-if="form.endAddress" class="text-xs font-bold">{{ form.endAddress.address
              }}</text>
			</view>
			<view class="">
				<text class="bt text-sm" @click="toSelectAddress('endaddress')">地址簿</text>
			</view>
		</view>

		<view class="text-sm mt-2 text-[#686868] font-bold">
			请认真核实地址,填写实际重量再下单！
		</view>
	</view>
	<view class="tk-card">
		<view class="fb">
			<view class="fl items-center">
				<view class="text-xs tk-tag mr-1">必填</view>
				<view class="mr-2">物品信息</view>
				<view class="font-weight text-[#272822] text-sm">{{ form.goods }},{{ form.weight }}kg</view>
			</view>
			<u-icon size="22" name="edit-pen" @click="writeGood()"></u-icon>
		</view>
	</view>
	<view class="pl-2 pr-2">
		<u-alert :title="tip.title" type="info" :closable="tip.closable" :description="tip.description"></u-alert>
	</view>
	<view v-if="preData" class="mt-[40rpx] overflow-y-auto">
		<block v-for="(item, index) in preData" :key="index">
			<view class="fb p-[12rpx] tk-card1" :class="[
		
		   { 'selectitemclass': currentIndex == index },
		 ]" @click="selectPre(index)" v-if="item.onlinePay == 'Y'">
				<view class="fl">
					<view>
						<image style="width: 68rpx; height: 68rpx; border-radius: 8rpx" :src="img(item.logo)" mode="">
						</image>
					</view>

					<view class="ml-[18rpx]" style="width:100% !import">
						<view class="flex items-center justify-between w-[580rpx]">
							<view class="flex items-center">
								<view class="font-weight text-xs text-sltext w-[260rpx]">{{
								  item.channelName
								}}</view>
								<view class="text-xs text-[#272822] ml-4  w-[160rpx]">限重:{{ item.limitWeight }}kg</view>
							</view>

							<view class="font-weight text-sm w-[160rpx]">{{ item.showPrice }}元 </view>
						</view>
						<view class="line-box1 mt-1"></view>
						<view v-if="item.price_rule.add" class="flex text-xs  mt-1 font-bold">
							<view
								class="text-[24rpx] text-center p-1 bg-[#cbe3e0] rounded-lg text-slate-600 bg-opacity-50">
								首重:{{item.price_rule.first}}元/{{item.price_rule.start}}kg</view>
							<view
								class="text-[24rpx]  text-center ml-2  p-1 bg-[#cbe3e0] rounded-lg text-slate-600 bg-opacity-50">
								续重:{{item.price_rule.add}}元/kg
							</view>

						</view>

					</view>
				</view>

			</view>
		</block>
	</view>
	<view class="tk-card" v-if="jhkdservice">
		<checkbox-group class="uni-list" @change="checkboxChange">
			<label class="text-xs fl items-center uni-list-cell uni-list-cell-pd">
				<view>
					<checkbox color="#3c4cde" style="transform: scale(0.6)" value="true" :checked="isOpenAgreement">
					</checkbox>
				</view>
				<view @click="
            redirect({
              url: '/addon/fengchao/pages/agreement?type=jhkdyesgoods',
            })
          ">
					阅读并同意《{{
            jhkdservice.title ? jhkdservice.title : "寄件服务协议"
          }}》</view>
			</label>
		</checkbox-group>
	</view>
	<view class="mt-[380rpx] mb-[260rpx] flex items-center"></view>
	<!-- 物品信息弹出框 -->
	<u-popup class="safe-area-inset-bottom" :round="10" @close="close" closeable="true" :show="goodshow" mode="bottom"
		border-radius="12">
		<view class="tk-card h-[760rpx] overflow-y-auto">
			<view class="flex items-center">
				<view class="senddetail"> 物品名称 </view>
				<u-input clearable="true" border="bottom" class="mt-[8rpx] text-sm" v-model="form.goods"
					placeholder="如:生活用品,点击标签快速填写" />
			</view>
			<view class="fl flex-wrap mt-2">
				<block v-for="(item, index) in goods" key="index">
					<view class="mt-1 mr-2 mb-1">
						<u-tag borderColor="#444444" color="#1d1d1d" :text="item" type="success" plain
							@click="goodswrite(index)"></u-tag>
					</view>
				</block>
			</view>
			<view class="font-bold text-xs mt-2" @click="
          redirect({ url: '/addon/fengchao/pages/agreement?type=jhkdyesgoods' })
        ">
				《违禁品查询》</view>
			<view class="flex items-center mt-[24rpx]">
				<view class="senddetail"> 物品重量 </view>
				<u-number-box button-size="24" color="#0000ff" bgColor="#e6e6e6" iconStyle="color: #0000ff" integer
					:min="form.customerType == 'kd' ? 1 : 30" :max="10000" class="text-sm"
					v-model="form.weight"></u-number-box>
				<text class="ml-4 text-[#a3a3a3]">kg</text>
			</view>
			<view class="font-bold text-xs text-red">请填写打包完成后包裹的重量，超重需按照快递原价补差价，将不会享受寄件折扣</view>
			<view class="flex items-center mt-[24rpx]">
				<view class="senddetail"> 包裹数量 </view>
				<u-number-box button-size="24" color="#0000ff" bgColor="#e6e6e6" iconStyle="color: #0000ff" integer
					:min="1" :max="100" class="text-sm" v-model="form.packageCount"></u-number-box>
				<text class="ml-4 text-[#a3a3a3]">个</text>
			</view>
			<view class="flex items-center mt-[24rpx]">
				<view class="senddetail"> 物品体积 </view>
				<view class="w-48px">
					<u-input border="bottom" maxlength="3" v-model="form.vloumLong"></u-input>
				</view>
				<text class="text-[#a3a3a3] mr-[8rpx]">x</text>
				<view class="w-48px">
					<u-input border="bottom" maxlength="3" v-model="form.vloumWidth"></u-input>
				</view>
				<text class="text-[#a3a3a3] mr-[8rpx]">x</text>
				<view class="w-48px">
					<u-input border="bottom" maxlength="3" v-model="form.vloumHeight"></u-input>
				</view>
				<text class="ml-4 text-[#a3a3a3]">单位：cm</text>
			</view>
			<view class="flex items-center mt-[24rpx]">
				<view class="senddetail"> 保价金额 </view>
				<u-input placeholder="不保价可不填" type="number" v-model="form.guaranteeValueAmount"></u-input>

				<text class="ml-4 text-[#a3a3a3]">元</text>
			</view>
			<view class="mt-4 text-sm text-[#a3a3a3]">订单备注</view>
			<u-input class="mt-[14px]" v-model="form.remark" placeholder="小哥辛苦了!"></u-input>
		</view>
		<view class="pl-2 pr-2">
			<u-alert :title="atip.title" type="warning" :closable="atip.closable"
				:description="atip.description"></u-alert>
		</view>
		<u-loading-icon class="mt-4" duration="1000" mode="circle" on="linear" color="#4541c7" v-if="bjshow == true"
			:vertical="true"></u-loading-icon>
		<!-- <view v-if="bjshow==false" class="tk-card butto text-xl" @click="closeShow()">获取报价</view>
		<view v-if="bjshow==true" class="tk-card butto text-xl" @click=" ">正在计算</view> -->
		<view v-if="bjshow == false" class="flex flex-1 p-4">
			<button class="w-[100%] !h-[72rpx] leading-[72rpx] text-[26rpx] rounded-[50rpx]"
				style="color:#ffffff;backgroundColor:#4541c7" type="default" @click="closeShow()">
				获取报价
			</button>
		</view>
		<view v-if="bjshow == true" class="flex flex-1 p-4">
			<button class="w-[100%] !h-[72rpx] leading-[72rpx] text-[26rpx] rounded-[50rpx]"
				style="color:#ffffff;backgroundColor:#4541c7" type="default">
				AI比价中
			</button>
		</view>
		<u-safe-bottom></u-safe-bottom>
	</u-popup>
	<view class="mt-[98rpx]"></view>

	<view class="b-tabbar safe-area-inset-bottom">

		<view class="b-tabbar-back">
			<view v-if="selectData&&selectData.price_rule.add>0"
				class="flex text-xs font-bold p-2 text-[24rpx] bg-[#e5fffb] rounded-lg text-[#ff557f] bg-opacity-50">
				<view>首重:{{selectData.price_rule.first}}元/{{selectData.price_rule.start}}kg</view>
				<view class="ml-2">续重:{{selectData.price_rule.add}}元/kg</view>
			</view>
			<view class=" fb items-center pl-2 pr-2 pb-2 pt-2">
				<view class="">
					<view class="flex">
						<view class="text-xs">
							快递：
						</view>
						<view class="text-xs font-bold tk-sltext">{{ selectData ? selectData.channelName : "请选择快递" }}
						</view>
					</view>

					<view class="flex items-center">
						<view class="text-xs">快递费：</view>
						<view class="font-bold">{{
						  selectData ? selectData.showPrice+'元' : "请先选择快递"
						}}</view>
					</view>

				</view>
				<text class="tt-bbut text-center" @click="submitOrder()">立即下单</text>
			</view>

		</view>
		<u-safe-bottom></u-safe-bottom>
	</view>
	<button @click="shareEvent()" class="fixed bottom-48 right-4 z-50 rounded-full p-2 text-white hover:bg-blue-700">
		<u-icon name="share" color="#000000" size="24"></u-icon>
	</button>
	<share-poster ref="sharePosterRef" posterType="fengchao_poster" :posterId="poster_id" :posterParam="posterParam"
		:copyUrlParam="copyUrlParam" />
	<pay ref="payRef" @close="payLoading = false"></pay>
</template>-
<script setup lang="ts">
	import useDiyStore from "@/app/stores/diy";
	import { ref, reactive, computed } from "vue";
	import { goto } from "@/addon/fengchao/utils/ts/goto";
	import { onLoad, onShow } from "@dcloudio/uni-app";
	import {
		preOrder,
		createOrder,
		getJhkdAddressInfo,
		getAgreement,
		checkFenxiao,
	} from "@/addon/fengchao/api/tkjhkd";

	import { redirect, img, handleOnloadParams } from "@/utils/common";
	import { getAddressInfo } from "@/app/api/member";
	import { useSubscribeMessage } from "@/hooks/useSubscribeMessage";
	import { useLogin } from "@/hooks/useLogin";
	import useMemberStore from "@/stores/member";
	const memberStore = useMemberStore();
	const userInfo = computed(() => memberStore.info);
	import { getToken, isWeixinBrowser, getSiteId } from "@/utils/common";
	import { checkAddPayEvent } from "@/addon/fengchao/utils/ts/common"
	checkAddPayEvent()
	const list = ref([""]);
	const startaddress = ref(null);
	const endaddress = ref(null);
	const preData = ref();
	const selectIndex = ref();
	const selectData = ref();
	const payRef = ref(null);
	const payLoading = ref(false);
	const isReadJhkdService = ref(false);
	const isOpenAgreement = ref(true);
	const bjshow = ref(false);
	const currentIndex = ref(null);
	const tip = ref({
		title: "快速下单必读",
		description:
			"先地址簿添加/编辑地址，选择取/收货地址，填写物品信息，选择渠道下单",
		closable: false,
	});
	const goods = ref([
		"普货",
		"文件",
		"美妆用品",
		"数码产品",
		"服装鞋帽",
		"珠宝首饰",
		"零食特产",
		"办公用品",
	]);

	/************* 分享海报-start **************/
	let sharePosterRef = ref(null);
	let copyUrlParam = ref("");
	let posterParam = {};
	const poster_id = ref(0);
	// 分享海报链接
	const copyUrlFn = () => {
		if (userInfo.value && userInfo.value.member_id)
			copyUrlParam.value += "?mid=" + userInfo.value.member_id;
	};
	const shareEvent = () => {
		// 检测是否登录
		if (!userInfo.value) {
			useLogin().setLoginBack({ url: "/addon/fengchao/pages/ordersubmit" });
			return false;
		}

		if (userInfo.value && userInfo.value.member_id)
			posterParam.member_id = userInfo.value.member_id;
		copyUrlFn();
		sharePosterRef.value.openShare();
	};
	/************* 分享海报-end **************/

	const goodswrite = (index) => {
		uni.$u.toast(goods.value[index]);
		form.goods = goods.value[index];
	};
	const checkboxChange = (e) => {
		if (isOpenAgreement.value == true) {
			isOpenAgreement.value = false;
		} else {
			isOpenAgreement.value = true;
		}
	};
	const atip = ref({
		title: "填写须知",
		description:
			"物品名称必须填写，物品重量需按照实际重量填写,超长物品请填写实际尺寸，如需要保价请填写保价金额",
		closable: false,
	});
	const form = reactive({
		startAddress: uni.getStorageSync("startAddress"),
		endAddress: uni.getStorageSync("endAddress"),
		customerType: "kd", //寄件渠道，快递，快运，得物
		goods: "", //托寄物名称
		packageCount: 1, //包裹数量
		weight: 1.0, //单位kg,保留两位
		vloumLong: 10, //cm
		vloumWidth: 10,
		vloumHeight: 10,
		guaranteeValueAmount: null,
		remark: "",
		showPrice: "0",
		payMethod: "",
		delivery_info: [],
		key: "",
		delivery_index: "",
		price_rule: [],
		original_rule: []
	});
	const close = () => {
		goodshow.value = false;
		bjshow.value = false
	};
	const goodshow = ref(false);
	const goodstype = ref(["0000", "15222"]);
	const toSelectAddress = (type) => {
		uni.setStorage({
			key: "selectAddressCallback",
			data: {
				back: "/addon/fengchao/pages/ordersubmit",
				delivery: type,
				value: type,
			},
			success() {
				redirect({
					url: "/addon/fengchao/pages/address/address",
					param: { type: "address" },
				});
			},
		});
	};
	const addressInfo = async (id) => {
		if (id > 0) {
			const data = await getJhkdAddressInfo(id);
			return data.data;
		}
	};

	const selectAddress = uni.getStorageSync("selectAddressCallback");
	if (selectAddress) {
		// 赋能取件地址
		if (selectAddress.delivery == "startaddress") {
			addressInfo(selectAddress.address_id)
				.then((data) => {
					uni.setStorageSync("startAddress", data);
					form.startAddress = uni.getStorageSync("startAddress");
				})
				.catch((error) => {
					console.error(error);
				});
		}
		if (selectAddress.delivery == "endaddress") {
			addressInfo(selectAddress.address_id)
				.then((data) => {
					uni.setStorageSync("endAddress", data);
					form.endAddress = uni.getStorageSync("endAddress");
				})
				.catch((error) => {
					console.error(error);
				});
		}
		uni.removeStorage({ key: "selectAddressCallback" });
	}
	const writeGood = () => {
		if (form.startAddress == []) {
			toSelectAddress("startaddress");
			uni.$u.toast("请填写取件地址");
			return;
		}
		if (form.endAddress == []) {
			toSelectAddress("endaddress");
			uni.$u.toast("请填写送件地址");
			return;
		}
		useSubscribeMessage().request("fengchao_order_sign");
		goodshow.value = true;
		form.delivery_info = [];
	};
	const closeShow = async () => {
		if (form.goods == "") {
			uni.$u.toast("请填写物品名称");
			return;
		}
		if (form.startAddress == []) {
			toSelectAddress("startaddress");
			uni.$u.toast("请填写取件地址");
			return;
		}
		if (form.endAddress == []) {
			toSelectAddress("endaddress");
			uni.$u.toast("请填写送件地址");
			return;
		}
		bjshow.value = true;
		const data = await preOrder(form);
		form.key = data.data.key;
		preData.value = data.data.list;
		bjshow.value = false;
		goodshow.value = false;
		form.delivery_info = [];
	};
	const submitOrder = async () => {
		checkAddPayEvent()
		if (!userInfo.value) {
			useLogin().setLoginBack({ url: "/addon/fengchao/pages/ordersubmit" });
			return false;
		}
		if (form.goods == "") {
			goodshow.value = true;
			uni.$u.toast("请填写物品名称");
			return;
		}
		if (form.startAddress == []) {
			toSelectAddress("startaddress");
			uni.$u.toast("请填写取件地址");
			return;
		}
		if (form.endAddress == []) {
			toSelectAddress("endaddress");
			uni.$u.toast("请填写送件地址");
			return;
		}
		if (preData.value == null) {
			uni.$u.toast("请完善信息再获取报价");
			return;
		}
		if (selectData.value == null) {
			uni.$u.toast("请选择发货渠道");
			return;
		}
		if (isOpenAgreement.value == false) {
			uni.$u.toast("请先阅读并同意协议");
			return;
		}

		useSubscribeMessage().request(
			"fengchao_order_pay,fengchao_order_pick,fengchao_order_add"
		);
		const data = await createOrder(form);
		form.delivery_info = [];
		selectData.value = null;
		preData.value = null;
		payLoading.value = true;
		payRef.value?.open(
			data.data.trade_type,
			data.data.trade_id,
			"/addon/fengchao/pages/orderlist"
		);
	};
	const selectPre = (e) => {
		currentIndex.value = e;
		selectData.value = preData.value[e];
		form.showPrice = selectData.value.showPrice;
		form.delivery_info = selectData.value;
		form.delivery_index = e;
		form.price_rule = selectData.value.price_rule
		form.original_rule = selectData.value.original_rule
	};
	const jhkdservice = ref();
	const checkServiceAgreement = async () => {
		const data = await getAgreement("jhkdservice");
		jhkdservice.value = data.data;
	};
	onLoad((option) => {
		// #ifdef MP-WEIXIN
		// 处理小程序场景值参数
		option = handleOnloadParams(option);
		// #endif
		if (!getToken()) {
			const login = useLogin();
			// 第三方平台自动登录
			// #ifdef MP
			login.getAuthCode();
			// #endif
		}
		let pid = uni.getStorageSync("pid");
		if (pid && pid > 0) {
			checkFenxiao({ pid: pid });
		}

		//传入判断，type,寄件
		form.customerType = option.type ? option.type : "kd";
		if (form.customerType == "ky") {
			form.weight = 30;
		}
		checkServiceAgreement();
	});
</script>

<style lang="scss" scoped>
	@import "@/addon/fengchao/utils/styles/common.scss";

	:root,
	.tk-card1 {
		background-color: rgba(181, 213, 214, 0.3);
		margin: 24rpx;
		border-radius: 12rpx;
		padding: 12rpx;
		box-shadow: 0 1px 1px 0 rgba(234, 234, 234, 0.2), 0 2px 2px 0 rgba(231, 231, 231, 0.2);
	}

	page {
		--primary-color: #4541c7;
		--primary-color-dark: #f26f3e;
		--primary-color-disabled: #ffb397;
		--primary-color-light: #ffeae2;
		--page-bg-color: #f7f7f7;
		--price-text-color: #e1251b;
	}



	.selectitemclass {
		background-color: #e4feff;
		padding: 20rpx;
		/* 假设 p-2 对应 20rpx */
		color: #ff557f;
		font-size: 32rpx;
		border-radius: 8rpx;
		/* 假设 rounded 对应 8rpx */
	}



	.tag {
		background: #dddddd;
		padding: 6rpx 12rpx;
		text-align: center;
		border-radius: 8rpx;
		font-weight: bold;
	}

	.bt {
		padding: 4rpx 12rpx;
		border-radius: 12rpx;
		border: #cfddce solid 2rpx;
	}

	.tk-tag {
		padding: 4rpx 8rpx;
		background: #4541c7;
		color: #ffffff;
		border-radius: 8rpx;
		font-size: 22rpx;
	}

	.butto {
		background: #4541c7;
		text-align: center;
		width: 680rpx;
		border-radius: 12rpx;
		color: #ffffff;
		font-size: 32rpx;
		padding: 16rpx auto;
		margin-top: 48rpx;
		margin-bottom: 16rpx;
		margin-left: 12rpx;
	}

	.senddetail {
		background: #dee6ff;
		margin: 8rpx 0rpx;
		margin-right: 14rpx;
		padding: 8rpx 16rpx;
		border-radius: 12rpx;
		font-size: 24rpx;
		color: #4541c7;
		border: 1px solid #4541c7;
	}

	.b-tabbar {
		position: fixed;
		bottom: 12rpx;
		left: 0;
		right: 0;
		margin: 0rpx 24rpx;
		border-radius: 12rpx;
		padding: 12rpx;
	}

	.b-tabbar-back {
		background: rgba(214, 234, 248, 0.9);
		border-radius: 12rpx;
		// box-shadow: inset 1px 1px 1px rgba(0, 0, 0, 0.1), 1px 1px 1px rgba(0, 0, 0, 0.1);
	}

	.tt-bbut {
		background: #4541c7;
		padding: 12rpx 34rpx;
		border-radius: 8rpx;
		color: #ffffff;
		font-size: 28rpx;
	}
</style>