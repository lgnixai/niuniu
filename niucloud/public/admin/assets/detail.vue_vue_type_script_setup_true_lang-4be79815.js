import{O as C,d as T,r as N,n as k,h as i,s as m,w as e,a as _,e as o,i as r,t as a,u as R,q as A,R as F,c as g,F as h,T as I,af as V,ag as G,aN as B,aO as $,a7 as M,V as q,E as K,X as L,Y as Q}from"./index-6405d5ac.js";/* empty css                   *//* empty css                  *//* empty css                   *//* empty css                  *//* empty css                     *//* empty css                *//* empty css               *//* empty css                             */function ue(p){return C.get("fengchao/order/list",{params:p})}function W(p){return C.get(`fengchao/order/detail/${p}`)}const Y=_("h2",null,"订单详情",-1),j=_("br",null,null,-1),U=_("br",null,null,-1),X=_("br",null,null,-1),z=_("br",null,null,-1),H=_("br",null,null,-1),J=_("br",null,null,-1),Z={class:"dialog-footer"},fe=T({__name:"detail",setup(p,{expose:S}){const y=N(!1),v=N(!1),t=k({...{id:3,site_id:100008,order_id:"20241216511606390439936",order_money:null,order_discount_money:"0.00",order_add_money:"0.00",order_status:0,add_price_status:1,refund_status:0,out_trade_no:null,pay_time:null,create_time:"2024-12-16 23:31:43",close_reason:null,close_time:null,ip:"127.0.0.1",update_time:"2024-12-16 23:32:20",delete_time:0,deliveryInfo:{order_id:"20241216511606390439936",line_price_id:4992,client_order_code:"f48e1890-6dd2-38b7-8d39-232a17d866e9",service_order_code:"KDNSIT2412162310000001",logistic_order_code:"SF1390004911440",order_info:{TransportType:1,ShipperType:5,ShipperCode:"YTO",OrderCode:"f48e1890-6dd2-38b7-8d39-232a17d866e9",ExpType:1,PayType:3,Receiver:{ProvinceName:"广东省",CityName:"佛山市",ExpAreaName:"福田区",Address:"和 Street",Name:"倪子安",Mobile:"11898604843"},Sender:{ProvinceName:"河南省",CityName:"郑州市",ExpAreaName:"管城区",Address:"毛 Street",Name:"商智渊",Mobile:"11898604843"},Weight:.5,Quantity:1,Remark:"",Commodity:[{GoodsName:"食品",GoodsQuantity:1,GoodsPrice:752.02}],result:{OrderCode:"f48e1890-6dd2-38b7-8d39-232a17d866e9",KDNOrderCode:"KDNSIT2412162310000001"}},picker_info:[{PersonName:"宋建硕",PersonTel:"18100006672",PickupCode:"1234",PersonCode:""}],pay_info:null,height:null,weight:2,volume:19200,volume_weight:.5,total_fee:13,order_status_desc:"订单已分配快递员",order_status:"103",create_time:"2024-12-16 23:31:43",update_time:"2024-12-16 23:40:02",delete_time:null},pay_info:{id:2,order_id:"20241216511606390439936",order_type:2,weight:"2.00",first_weight_amount:"5.50",continuous_weight_amount:"6.50",cost:"12.00",insure_amount:"0.00",package_fee:"0.00",over_fee:"0.00",other_fee:"1.00",other_fee_detail:{其他费用:"1.00"},total_fee:"13.00",volume:"19200.00",volume_weight:"0.50"}}}),E=async()=>{W(t.OrderId).then(f=>{v.value=!1;const d=f.data;d&&Object.keys(t).forEach(l=>{d[l]!=null&&(t[l]=d[l])})}),v.value=!1};return S({showDialog:y,setFormData:async(f=null)=>{v.value=!0,f&&(t.OrderId=f.order_id,E())}}),(f,d)=>{const l=V,s=G,u=B,b=$,D=M,w=q,O=K,x=L,P=Q;return i(),m(x,{modelValue:y.value,"onUpdate:modelValue":d[1]||(d[1]=n=>y.value=n),title:"订单明细",width:"900px","destroy-on-close":!0},{footer:e(()=>[_("span",Z,[o(O,{onClick:d[0]||(d[0]=n=>y.value=!1)},{default:e(()=>[r(a(R(A)("cancel")),1)]),_:1})])]),default:e(()=>[F((i(),m(w,{height:"500px"},{default:e(()=>[o(D,{class:"order-card",shadow:"hover"},{default:e(()=>[Y,o(b,{gutter:20,class:"section"},{default:e(()=>[o(u,{span:12},{default:e(()=>[o(s,{title:"基本信息",column:"1",border:""},{default:e(()=>[o(l,{label:"订单 ID"},{default:e(()=>[r(a(t.OrderId),1)]),_:1}),o(l,{label:"客户订单号"},{default:e(()=>[r(a(t.deliveryInfo.client_order_code),1)]),_:1}),o(l,{label:"重量"},{default:e(()=>[r(a(t.deliveryInfo.order_info.Weight),1)]),_:1})]),_:1})]),_:1}),o(u,{span:12},{default:e(()=>[o(s,{title:"物流信息",column:"1",border:""},{default:e(()=>[o(l,{label:"快递公司"},{default:e(()=>[r(a(t.deliveryInfo.order_info.ShipperCode),1)]),_:1}),o(l,{label:"快递单号"},{default:e(()=>[r(a(t.deliveryInfo.logistic_order_code),1)]),_:1}),o(l,{label:"状态"},{default:e(()=>[r(a(t.deliveryInfo.order_status_desc),1)]),_:1})]),_:1})]),_:1})]),_:1}),j,U,o(b,{gutter:20,class:"section"},{default:e(()=>[o(u,{span:12},{default:e(()=>[o(s,{title:"收货信息",column:"1",border:""},{default:e(()=>[o(l,{label:"收货人"},{default:e(()=>[r(a(t.deliveryInfo.order_info.Receiver.Name),1)]),_:1}),o(l,{label:"手机号"},{default:e(()=>[r(a(t.deliveryInfo.order_info.Receiver.Mobile),1)]),_:1}),o(l,{label:"省"},{default:e(()=>[r(a(t.deliveryInfo.order_info.Receiver.ProvinceName),1)]),_:1}),o(l,{label:"市"},{default:e(()=>[r(a(t.deliveryInfo.order_info.Receiver.CityName),1)]),_:1}),o(l,{label:"区/县"},{default:e(()=>[r(a(t.deliveryInfo.order_info.Receiver.ExpAreaName),1)]),_:1}),o(l,{label:"详细地址"},{default:e(()=>[r(a(t.deliveryInfo.order_info.Receiver.Address),1)]),_:1})]),_:1})]),_:1}),o(u,{span:12},{default:e(()=>[o(s,{title:"发货信息",column:"1",border:""},{default:e(()=>[o(l,{label:"发货人"},{default:e(()=>[r(a(t.deliveryInfo.order_info.Sender.Name),1)]),_:1}),o(l,{label:"手机号"},{default:e(()=>[r(a(t.deliveryInfo.order_info.Sender.Mobile),1)]),_:1}),o(l,{label:"省"},{default:e(()=>[r(a(t.deliveryInfo.order_info.Sender.ProvinceName),1)]),_:1}),o(l,{label:"市"},{default:e(()=>[r(a(t.deliveryInfo.order_info.Sender.CityName),1)]),_:1}),o(l,{label:"区/县"},{default:e(()=>[r(a(t.deliveryInfo.order_info.Sender.ExpAreaName),1)]),_:1}),o(l,{label:"详细地址"},{default:e(()=>[r(a(t.deliveryInfo.order_info.Sender.Address),1)]),_:1})]),_:1})]),_:1})]),_:1}),X,z,o(b,{gutter:20,class:"section"},{default:e(()=>[o(u,{span:24},{default:e(()=>[o(s,{title:"商品信息",column:"3",border:""},{default:e(()=>[(i(!0),g(h,null,I(t.deliveryInfo.order_info.Commodity,(n,c)=>(i(),m(l,{key:`goods-${c}`,label:"商品名称"},{default:e(()=>[r(a(n.GoodsName),1)]),_:2},1024))),128)),(i(!0),g(h,null,I(t.deliveryInfo.order_info.Commodity,(n,c)=>(i(),m(l,{key:`quantity-${c}`,label:"商品件数"},{default:e(()=>[r(a(n.GoodsQuantity),1)]),_:2},1024))),128)),(i(!0),g(h,null,I(t.deliveryInfo.order_info.Commodity,(n,c)=>(i(),m(l,{key:`price-${c}`,label:"商品价格"},{default:e(()=>[r(a(n.GoodsPrice),1)]),_:2},1024))),128))]),_:1})]),_:1})]),_:1}),H,J,o(b,{gutter:20,class:"section"},{default:e(()=>[o(u,{span:24},{default:e(()=>[o(s,{title:"费用信息",column:"2",border:""},{default:e(()=>[o(l,{label:"计费重量"},{default:e(()=>[r(a(t.pay_info.weight),1)]),_:1}),o(l,{label:"总费用"},{default:e(()=>[r(a(t.pay_info.total_fee),1)]),_:1})]),_:1})]),_:1})]),_:1})]),_:1})]),_:1})),[[P,v.value]])]),_:1},8,["modelValue"])}}});export{fe as _,ue as g};
