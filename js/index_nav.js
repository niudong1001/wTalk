/******************************************************************_nav���***************************************/
var nav_num=getCookie("nav_num");//��õ�ǰ������ֵ
if(nav_num=='')
	nav_num=1;
var nav_left=navClick("nav_left_container","span",nav_num-1,"#F8F8F8","");
nav_left.changeBg();
nav_left.childs[0].onclick=function()
{
	nav_left.returnBg();//��ԭ������ʽ�ÿ�
	nav_left.now_child=this;
	nav_left.changeBg();//�ı��Լ�����ʽ
	setCookie("nav_num",1,3600);
	parent.changeHeaderText(this.innerText);//���岿�ֱ������ı�
}
nav_left.childs[1].onclick=function()
{
	nav_left.returnBg();//��ԭ������ʽ�ÿ�
	nav_left.now_child=this;
	nav_left.changeBg();//�ı��Լ�����ʽ
	setCookie("nav_num",2,3600);
	parent.changeHeaderText(this.innerText);//���岿�ֱ������ı�	
}
nav_left.childs[2].onclick=function()
{
	nav_left.returnBg();//��ԭ������ʽ�ÿ�
	nav_left.now_child=this;
	nav_left.changeBg();//�ı��Լ�����ʽ
	setCookie("nav_num",3,3600);
	parent.changeHeaderText(this.innerText);//���岿�ֱ������ı�
}
function changeCookie(num)//�����ڶ�֮ʵ�ֿ�����
{
	setCookie("nav_num",num,3600);
}
function navEqualChange(num)//�ȼ۵��
{
	nav_left.equalClick(num);
}

/******************************************************************_nav���***************************************/