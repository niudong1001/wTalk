<?php

class records extends dbConnect//获得指定数量的记录
{
	var $record_began=0;//开始记录号
	var $result_rows_expect=0;//期待的行数
	var $result_rows_real=-1;//实际行数
	function recordsInitialize($sql,$record_began,$num)//初始化records
	{
		$this->result_rows_expect=$num;
		$this->record_began=$record_began;
		$sql=$sql." limit $record_began,$this->result_rows_expect";
		$this->dbSqlExecute($sql);//执行sql
		$this->result_rows_real=$this->num;
	}
	function recordsIsEqual()//想要获得数目与实际获得是否相等
	{
		if($this->result_rows_expect==$this->result_rows_real)
			return true;
		return false;
	}
}
/*
$page=new page();
$property=array("class_id","class_name");
$class_=array("id_class","name_class");
$page->pageStyleSet($property,$class_,"container_id","class_for_infoRow","class_for_button");
$sql="select * from class";
$page->pageSet('test.php');
$page->pageDisplay($sql,10);
*/
class page extends records//获得一页数据
{
	var $page_num;//访问第几页
	//样式
	var $container_id;//所有内容与下面的按钮共同的父层
	var $property=Array();//要显示的属性组
	var $class_=Array();//为属性组建的class组
	var $class_for_infoRow;//每一条记录公共样式
	var $class_for_button;//按钮样式
	var $href_flag=Array();//是否建立链接
	var $href=Array();//链接值
	var $primary_key;//主键
	var $submit_page;//请求提交页面
	function pageStyleSet($flag,$property,$class_,$container_id,$class_for_infoRow,$class_for_button)//样式设置
	{
		$this->property=$property;
		$this->class_=$class_;
		$this->container_id=$container_id;
		$this->class_for_infoRow=$class_for_infoRow;
		$this->class_for_button=$class_for_button;
		$this->flag=$flag;
	}
	function pageSet($submit_page,$href_flag=null,$href=null,$primary_key)//页面操作设置
	{
		$this->submit_page=$submit_page;
		$this->href_flag=$href_flag;
		$this->href=$href;
		$this->primary_key=$primary_key;
	}
	function pageDisplay($sql,$num_expect)//按要求显示数据
	{
		$flag=$this->flag;
		//test($flag);
		if(!isset($this->page_num))
			$this->page_num=1;
		if(isset($_GET['page_num']))
		{
			$this->page_num=$_GET['page_num'];
		}
		$startNum=($this->page_num-1)*$num_expect;
		
		$this->recordsInitialize($sql,$startNum,$num_expect);
		$temp=$this->dbGetRows();
		$length=$this->dbGetRowsNum();//获得行数
		$len=count($this->property);//获得属性数目
		echo "<div id=$this->container_id>";
		if($length<1||$temp==false)
		{
			echo "<div class=$this->class_for_infoRow>";
			echo " 暂无信息";
			echo "</div>";
			echo "<hr class='hr_for_info'/>";
		}
		else
		{
			for($i=0;$i<$length;$i++)
			{
				$temp_=$temp[$i];//获得某一行
				echo "<div class=$this->class_for_infoRow>";
				$j=0;
				for($j;$j<$len;$j++)
				{
					$t9=$this->class_[$j];
					$test9=$this->property[$j];
					//test($test9);
					$temp__=$temp_[$test9];
					if($flag==1&&$j==0)
					{
						echo "<span class=$t9><img src='../images/comments.png'/>$temp__</span> ";
					}
					else
					{
						if($this->href_flag[$j]==0)//不用建立链接
							echo "<span class=$t9>$temp__</span> ";
						else
						{
							$tt=$this->href[$j];
							echo "<span class=$t9><a href='$tt?click_key=";
							echo $this->property[$j];
							echo "&primary_key=";
							echo $temp_[$this->primary_key];
							echo "' target='_top'>$temp__</a></span> ";
						}
					}
				}
				echo "</div>";
				echo "<hr class='hr_for_info'/>";
			}
		}
		echo "<div class=$this->class_for_button>";
		if($this->page_num!=1)
		{
			echo "<a href='$this->submit_page?page_num=";
			echo 1;
			echo "'>首页</a>";
			echo " <a href='$this->submit_page?page_num=";
			echo $this->page_num-1;
			echo "'>上一页 </a>";
		}
		for($i=$this->page_num;$i<$this->page_num+$this->recordsIsEqual()?1:0;$i++)
		{
			if($this->page_num==1&&$this->recordsIsEqual()==FALSE)
				echo "第";
			echo "<a href='$this->submit_page?page_num=";
			echo $i;
			echo "'>";
			echo $i;
			echo "</a>";
			if($this->page_num==1&&$this->recordsIsEqual()==FALSE)
				echo "页";
		}
		if($this->recordsIsEqual())
		{
			echo " <a href='$this->submit_page?page_num=";
			echo $this->page_num+1;
			echo "'>下一页</a>";
		}
		echo "</div>";
		echo "</div>";
	}
}
class dbConnect//数据库连接类
{
  var $db;//数据库标识
  var $result;//查询结果
  var $rows=Array();//所有结果行
  var $num=0;//记录条数
  var $flag=100;//判断结果状态标识(-1错误sql,0空集,1有结果)
  var $isDbSet=0;//使用者是否进行了dbSet
  function dbSet($db_name='forum',$db_locate='localhost',$user='root',$psw='729499')//构造函数
  {
	$this->db=mysql_connect($db_locate,$user,$psw) or die("数据库连接失败!");
	mysql_select_db($db_name,$this->db) or die("连接".$this->db_name."数据库失败!");
	$this->isDbSet=1;
  }
  function dbSqlExecute($newSql,$type="SET NAMES 'utf8'")//执行sql
  {
	if($this->isDbSet==0)
	  $this->dbSet();
	mysql_query($type); 
	$this->result=mysql_query($newSql,$this->db);
	$this->resultCheck();
	$this->initializeRows();
  }
  function dbSqlExecute_($newSql,$type="SET NAMES 'utf8'")//非select语句
  {
	 if($this->isDbSet==0)
	  $this->dbSet();
	mysql_query($type); 
	if($this->isDbSet==0)
	  $this->dbSet();
	$this->result=mysql_query($newSql,$this->db);
	$this->resultCheck_();
  }
  function dbGetRows()//返回所有行
  {
	 if($this->flag==1||$this->flag==0)
		return $this->rows;
	 else
		return false;
  }
  function dbGetRowsNum()//返回记录条数
  {
	  return $this->num;
  } 
   function dbGetFlag()//返回标志位
  {
	  return $this->flag;
  }
   private function resultCheck()//结果检查(错误sql置-1,空集置0,有结果置1)
  {
	  if($this->result==false)
		 $this->flag=-1;
	  else if(mysql_num_rows($this->result)==0)
		$this->flag=0;
	  else $this->flag=1;
  }
  private function resultCheck_()//结果检查，针对非select
  {
	  if($this->result==false)
		 $this->flag=-1;
	 else if(mysql_affected_rows()==0)
		$this->flag=0;
	  else $this->flag=1;
  }
  private function initializeRows()//计算行数，并将结果写入数组
  {
	if($this->flag==1||$this->flag==0)
	{
		$this->num=0;
		while($row=mysql_fetch_array($this->result,MYSQL_ASSOC))
		{	
			$this->rows[]=$row;
			$this->num++;
		}
	}
  }
}
//验证码类
class Vcode 
{
  private $width; //宽
  private $height; //高
  private $num;  //数量
  private $code; //验证码
  private $img;  //图像的资源
  //构造方法， 三个参数
  function __construct($width=80, $height=20, $num=4) {
   $this->width = $width;
   $this->height = $height;
   $this->num = $num;
   $this->code = $this->createcode(); //调用自己的方法
  }
  //获取字符的验证码， 用于保存在服务器中
  function getcode() {
   return $this->code;
  }
  //输出图像
  function outimg() {
   //创建背景 (颜色， 大小， 边框)
   $this->createback();
   //画字 (大小， 字体颜色)
   $this->outstring();
   //干扰元素(点， 线条)
   $this->setdisturbcolor();
   //输出图像
   $this->printimg();
  }
  //创建背景
  private function createback() {
   //创建资源
   $this->img = imagecreatetruecolor($this->width, $this->height);
   //设置随机的背景颜色
   $bgcolor = imagecolorallocate($this->img, rand(225, 255), rand(225, 255), rand(225, 255)); 
   //设置背景填充
   imagefill($this->img, 0, 0, $bgcolor);
   //画边框
   $bordercolor = imagecolorallocate($this->img, 0, 0, 0);
    imagerectangle($this->img, 0, 0, $this->width-1, $this->height-1, $bordercolor);
  } 
  //画字
  private function outstring() {
   for($i=0; $i<$this->num; $i++) {
    $color= imagecolorallocate($this->img, rand(0, 128), rand(0, 128), rand(0, 128)); 
    $fontsize=rand(3,5); //字体大小
    $x = 3+($this->width/$this->num)*$i; //水平位置
    $y = rand(0, imagefontheight($fontsize)-3);
    //画出每个字符
    imagechar($this->img, $fontsize, $x, $y, $this->code{$i}, $color);
   }
  }
  //设置干扰元素
  private function setdisturbcolor() {
   //加上点数
   for($i=0; $i<100; $i++) {
    $color= imagecolorallocate($this->img, rand(0, 255), rand(0, 255), rand(0, 255)); 
    imagesetpixel($this->img, rand(1, $this->width-2), rand(1, $this->height-2), $color);
   }
   //加线条
   for($i=0; $i<10; $i++) {
    $color= imagecolorallocate($this->img, rand(0, 255), rand(0, 128), rand(0, 255)); 
    imagearc($this->img,rand(-10, $this->width+10), rand(-10, $this->height+10), rand(30, 300), rand(30, 300), 55,44, $color);
   }
  }
  //输出图像
  private function printimg() {
   if (imagetypes() & IMG_GIF) {
     header("Content-type: image/gif");
     imagegif($this->img);
   } elseif (function_exists("imagejpeg")) {
     header("Content-type: image/jpeg");
     imagegif($this->img);
   } elseif (imagetypes() & IMG_PNG) {
     header("Content-type: image/png");
     imagegif($this->img);
   } else {
     die("No image support in this PHP server");
   } 
  }
  //生成验证码字符串
  private function createcode() {
   $codes = "123456789abcdefgh";
   $code = "";
   for($i=0; $i < $this->num; $i++) {
    $code .=$codes{rand(0, strlen($codes)-1)}; 
   }
   return $code;
  }
  //用于自动销毁图像资源
  function __destruct() {
   imagedestroy($this->img);
  }
 }
 function test($str_='test!')//test页面
{
	echo "<script>alert('$str_');</script>";
}
?>