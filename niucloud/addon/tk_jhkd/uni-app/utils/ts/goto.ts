export async function goto(url : string) {
	uni.redirectTo({
		url: url
	})
}
export async function gotourl(url : string) {
	console.log('goto跳转网站测试')
}
export async function goback() {
	uni.navigateBack()
}