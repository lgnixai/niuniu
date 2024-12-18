//带确定的函数弹窗
export async function confirm(t, f, v) {
	uni.showModal({
		title: '操作提示',
		content: t,
		confirmColor: '#3569EA',
		cancelColor: '#646464',
		success: function (res) {
			if (res.confirm) {
				f(v)
			} else if (res.cancel) {
				console.log('用户点击取消');
			}
		}
	});
}
//消息提示
export async function totast(t) {
	uni.$u.toast(t)
	// uni.showToast({
	// 	title: t,
	// 	duration: 2000
	// });
}