import { checkAddPay } from "@/addon/tk_jhkd/api/orderadd";
import { redirect } from "@/utils/common"
export function dateChange(date) {
	return new Date(date).getTime() // 将日期值转换为时间戳
}
export function timeChange(timestamp) {
	const date = new Date(timestamp * 1000);
	const year = date.getFullYear();
	const month = date.getMonth() + 1;
	const day = date.getDate();
	const hours = date.getHours();
	const minutes = date.getMinutes();
	const seconds = date.getSeconds();
	return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
}
export function checkAddPayEvent(type = '') {
	checkAddPay().then((res) => {
		if (res.data.type === 'redirect') {
			uni.$u.toast('请先支付未补差价订单')
			redirect({ url: res.data.page });
		}
	});
}