<template>
	<view class="bg-[#F6F6F6] min-h-[100vh] w-full" :style="themeColor()" v-if="memberStore.info">
		<view class="reseller fixed w-full z-2 !bg-[#F6F6F6]">
			<view class="top mt-[-44rpx]"
				:style="{ ...headerStyle, backgroundImage: 'url(' + img('addon/tk_jhkd/fenxiao/bjfx.png') + ')' }">

				<view class="top1">
					<view class="num1" style="">
						<view>当前佣金</view>
						<view style="font-size: 25px;">
							{{ memberStore.info ? moneyFormat(memberStore.info.commission) : 0.00 }}
						</view>
					</view>
					<view class="jilu">
						<navigator url="/app/pages/member/detailed_account?type=commission">
							<view class="jl">分销佣金</view>
						</navigator>
					</view>
					<view class="fx" @click="shareEvent()">
						<image class="icon1" :src="img('addon/tk_jhkd/fenxiao/fenxiang.png')" mode="aspectFit">
						</image>
						<view class="fxwz">分享</view>
					</view>
				</view>
				<view class="top1">
					<view class="num">
						<view>累计收益</view>
						<view class="txc">{{ moneyFormat(memberStore.info?.commission_get)|| '0.00' }}</view>
					</view>
					<view v-if="fenxiaoinfo" class="num">
						<view>累计订单</view>
						<view class="txc">{{fenxiaoinfo.first_order_num+fenxiaoinfo.second_order_num}}</view>
					</view>
					<view class="num">
						<view>正在提现</view>
						<view>{{ moneyFormat(memberStore.info?.commission_cash_outing)|| '0.00' }}</view>
					</view>
				</view>
				<view class="tixian" @click="redirect({url:'/app/pages/member/apply_cash_out'})">
					<view class="btn" style="font-size: 16px;">立即提现</view>
				</view>
			</view>
			<view v-if="fenxiaoinfo" class="icon">
				<view class="ico">
					<view class="tubiao">
						<image class="img" :src="img('addon/tk_jhkd/fenxiao/yifx.png')"></image>
					</view>
					<view class="tt">
						<view class="text_r">{{fenxiaoinfo.first_num}}</view>
						<view class="text">一级总数(人)</view>
					</view>
				</view>
				<view class="ico">
					<view class="tubiao">
						<image class="img" :src="img('addon/tk_jhkd/fenxiao/fxtd.png')"></image>
					</view>
					<view class="tt">
						<view class="text_r">{{fenxiaoinfo.second_num}}</view>
						<view class="text">二级总数(人)</view>
					</view>
				</view>
				<view class="ico">
					<view class="tubiao">
						<image class="img" :src="img('addon/tk_jhkd/fenxiao/yidd.png')"></image>
					</view>
					<view class="tt">
						<view class="text_r">{{fenxiaoinfo.first_order_num}}</view>
						<view class="text">一级订单</view>
					</view>
				</view>
				<view class="ico">
					<view class="tubiao">
						<image class="img" :src="img('addon/tk_jhkd/fenxiao/erdd.png')"></image>
					</view>
					<view class="tt">
						<view class="text_r">{{fenxiaoinfo.second_order_num}}</view>
						<view class="text">二级订单</view>
					</view>
				</view>
			</view>

			<view class="kong"></view>
		</view>
	</view>
	<share-poster ref="sharePosterRef" posterType="tk_jhkd_poster" :posterId="poster_id" :posterParam="posterParam"
		:copyUrlParam="copyUrlParam" :copyUrl="'/addon/tk_jhkd/pages/index'" />
	<tabbar addon="tk_jhkd" />
	<pay ref="payRef" @close="payLoading = false"></pay>
</template>

<script setup lang="ts">
	import { ref, computed } from 'vue';
	import { moneyFormat, img, redirect, getToken, isWeixinBrowser, getSiteId, handleOnloadParams } from '@/utils/common';
	import { getMemberCommission } from '@/app/api/member';
	import useMemberStore from '@/stores/member'
	import { onLoad, onPageScroll, onReachBottom } from '@dcloudio/uni-app';
	import {
		checkFenxiao, getFenxiaoInfo
	} from '@/addon/tk_jhkd/api/fenxiao'
	import { useLogin } from '@/hooks/useLogin'
	const userInfo = computed(() => memberStore.info)
	/************* 分享海报-start **************/
	let sharePosterRef = ref(null);
	let copyUrlParam = ref('');
	let posterParam = {};
	const poster_id = ref(0)
	const fenxiaoinfo = ref()
	const getFenxiaoInfoEvent = async () => {
		const res = await getFenxiaoInfo()
		fenxiaoinfo.value = res.data
	}
	getFenxiaoInfoEvent()
	// 分享海报链接
	const copyUrlFn = () => {

		if (userInfo.value && userInfo.value.member_id) copyUrlParam.value += '?mid=' + userInfo.value.member_id;
	}
	const shareEvent = () => {

		// 检测是否登录
		if (!userInfo.value) {
			useLogin().setLoginBack({ url: '/addon/tk_jhkd/pages/index' })
			return false
		}
		if (userInfo.value && userInfo.value.member_id)
			posterParam.member_id = userInfo.value.member_id;
		copyUrlFn()
		sharePosterRef.value.openShare()
	}
	/************* 分享海报-end **************/

	const memberStore = useMemberStore();
	const info = computed(() => memberStore.info)
	// 获取系统状态栏的高度
	let menuButtonInfo : any = {};
	// 如果是小程序，获取右上角胶囊的尺寸信息，避免导航栏右侧内容与胶囊重叠(支付宝小程序非本API，尚未兼容)
	// #ifdef MP-WEIXIN || MP-BAIDU || MP-TOUTIAO || MP-QQ
	menuButtonInfo = uni.getMenuButtonBoundingClientRect();
	// #endif
	const headerStyle = computed(() => {
		return {
			backgroundImage: 'url(' + img('static/resource/images/member/commission/commission_bg.png') + ') ',
			backgroundSize: 'cover',
			backgroundRepeat: 'no-repeat',
			backgroundPosition: 'center',
		}
	})
	//  16为自定头部的padding-bottom
	const mescrollTop = computed(() => {
		return Object.keys(menuButtonInfo).length ? (Number(menuButtonInfo.height) * 2 + menuButtonInfo.top * 2 + 530 + 16) + 'rpx' : '530rpx'
	})
	onLoad((option) => {
		// #ifdef MP-WEIXIN
		// 处理小程序场景值参数
		option = handleOnloadParams(option);
		// #endif
		if (option.mid) {
			uni.setStorageSync('pid', option.mid)

		}
		// 判断是否已登录
		let data = {
			type: ''
		};
		if (!getToken()) {
			const login = useLogin()
			// #ifdef MP
			login.getAuthCode()
			// #endif

		}
		let pid = uni.getStorageSync('pid');
		if (pid && pid > 0) {
			checkFenxiao({ pid: pid })
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

	page {
		background-color: #F5F5F5;
	}

	.reseller {
		background-color: #F5F5F5;
		min-height: 100vh;
		font-size: 14px;

		.top {
			color: #FFFFFF;
			//display: flex;
			justify-content: space-between;
			position: relative;
			width: 100%;
			height: 250px;

			background-size: cover;
			background-position: center;
			background-repeat: no-repeat;

			//background-color: #2196F3;
			//background: linear-gradient(top, #2196F3, #03A9F4);
			.top1 {
				display: flex;
			}

			.title {
				background-color: #FFFFFF
			}

			.num {
				font-size: 15px;
				line-height: 25px;
				text-align: center;
				width: 33%;
				padding-top: 8%;
			}

			.num1 {
				text-align: center;
				width: 100%;
				padding-top: 10%;
			}

		}

		.jilu {
			font-size: 15px;
			position: absolute;
			left: 78%;
			top: 20%;
		}

		.jl {
			font-size: 12px !important;
			background: #ffffff05;
			padding: 10px;
			border-radius: 10px 0px 0px 10px;
		}

		.fx {
			font-size: 15px;
			position: absolute;
			display: flex;
			left: 0;
			top: 20%;
			width: 18%;
			text-align: center;
			background: #ffffff21;
			padding: 10px;
			border-radius: 0px 10px 10px 0px;
		}

		.fx .icon1 {
			width: 15px;
			height: 15px;
			margin-right: 5px;
		}

		.fxwz {
			font-size: 12px !important;
			color: #fffefe;
		}

		.tixian {
			display: flex;
			justify-content: center;
			background-color: #F5F5F5;
			width: 55%;
			height: 60px;
			border-radius: 60px;
			position: absolute;
			bottom: -30px;
			left: 23%;

			.btn {
				margin-top: 7%;
				text-align: center;
				width: 85%;
				background-color: #FF5722;
				height: 40px;
				border: none;
				border-radius: 50px;
				line-height: 40px;
				color: #FFFFFF;
			}


		}

		.icon {
			display: flex;
			justify-content: space-between;
			flex-wrap: wrap;

			margin-left: 3%;
			margin-right: 3%;
			margin-top: 10%;

			.ico {
				border-radius: 10px;
				border: 1px solid #C0C0C0;
				width: 49%;
				height: auto;
				margin-top: 8px;
				padding-bottom: 10px;
				border: none;
				font-size: 15px;
				flex-direction: column;
				background-color: #FFFFFF;

				.img {
					width: 40px;
					height: 40px;
				}

				.tubiao {
					margin-top: 20px;
					margin-left: 10px;
					text-align: center;
					width: 35%;
					float: left;
				}

				.tt {
					float: left;
					margin-top: 17px;
				}

				.text {
					color: #8F8F94;
					text-align: center;
					font-size: 14px;

				}

				.text_r {
					font-size: 18px;
					font-weight: bold;
				}
			}
		}

		.kong {
			height: 100px;
		}
	}
</style>