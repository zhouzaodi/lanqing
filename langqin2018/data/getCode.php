<?php
header("Content-Type:image/PNG");//响应头为图片
$num=4;$w=60;$h=20;//4位备选符,宽度60px,高度20px
$data="abcdefghijkmnpqrstuvwxyQWERTYUIOPLKJHGFDSAZXCVBNM3456789";//随机数备选字符
$code="";//空字符串准备接验证码
for($i=0;$i<$num;$i++){
	//for循环随机生成四个数
	$code.=substr($data,rand(0,strlen($data)-1),1);
	//每生成一个在$data字符串内(rand从$data第一个字符到最后一个字符随机生成一个)拼接到code中
}
session_start();//启动session
$_SESSION["code"]=$code;//$code保存进去
$im=imagecreate($w,$h);//创建图片,规定图片的宽和高
$black=imagecolorallocate($im,0,0,0);//分配颜色
$gray=imagecolorallocate($im,200,200,200);//分配颜色
$bgcolor=imagecolorallocate($im,255,255,255);//分配背景颜色
imagefill($im,0,0,$gray);//填充灰色背景
imagerectangle($im,0,0,$w-1,$h-1,$black);//画矩形边框
for($i=0;$i<80;$i++){
	imagesetpixel($im,rand(0,$w),rand(0,$h),$black);
		//在图片中随机生成8个点
}
$strx=rand(3,8);//第一个字的横坐标
for($i=0;$i<$num;$i++){
	$stry=rand(1,6);
	//定义纵坐标
	//依次去写四个字之一
	imagestring(
		$im,5,$strx,$stry,substr($code,$i,1),$black	
		//将字符串中的字写在图片中,绘制字符串(图,字体大小,坐标)
	); 
	$strx+=rand(8,12); //改变横坐标位置
}
imagepng($im);//输出图片
imagedestroy($im);//释放图片所占用的内存