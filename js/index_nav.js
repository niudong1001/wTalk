/******************************************************************_nav点击***************************************/
var nav_num=getCookie("nav_num");//获得当前的序列值
if(nav_num=='')
	nav_num=1;
var nav_left=navClick("nav_left_container","span",nav_num-1,"#F8F8F8","");
nav_left.changeBg();
nav_left.childs[0].onclick=function()
{
	nav_left.returnBg();//将原来的样式置空
	nav_left.now_child=this;
	nav_left.changeBg();//改变自己的样式
	setCookie("nav_num",1,3600);
	parent.changeHeaderText(this.innerText);//主体部分标题跟随改变
}
nav_left.childs[1].onclick=function()
{
	nav_left.returnBg();//将原来的样式置空
	nav_left.now_child=this;
	nav_left.changeBg();//改变自己的样式
	setCookie("nav_num",2,3600);
	parent.changeHeaderText(this.innerText);//主体部分标题跟随改变	
}
nav_left.childs[2].onclick=function()
{
	nav_left.returnBg();//将原来的样式置空
	nav_left.now_child=this;
	nav_left.changeBg();//改变自己的样式
	setCookie("nav_num",3,3600);
	parent.changeHeaderText(this.innerText);//主体部分标题跟随改变
}
function changeCookie(num)//父窗口对之实现跨域传输
{
	setCookie("nav_num",num,3600);
}
function navEqualChange(num)//等价点击
{
	nav_left.equalClick(num);
}

/******************************************************************_nav点击***************************************/