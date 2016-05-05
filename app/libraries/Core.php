<?php
class Core{
	//成员属性：
	public $randnum;
    private $width;
    private $height;
    private $im;
    //初始化方法：
	function __construct($w=80,$h=20){
		$this->width=$w;
		$this->height=$h;
	}
	//成员方法:
	//1).生成四位的随机数：
	private function createRandom(){
		for($i=1;$i<=4;$i++){
			$this->randnum.= dechex(rand(0,15));
		}
	}
	//2).把四位随机数写到画布上
	private function writeWord(){
		//a.创建画布：
		$this->im=imagecreate($this->width, $this->height);
		//b.给画布设背景色，及给添加文字设色
		$bjcolor=imagecolorallocate($this->im, 0, 0, 0);
		$textcolor=imagecolorallocate($this->im, 255, 255, 255);
		//c.写字：
		imagestring($this->im, 5, 10, 3, $this->randnum, $textcolor);
	}
	//3).输出图片
	function outputImage(){
		$this->createRandom();
		$this->writeWord();
		header("content-type:image/jpeg");
		imagejpeg($this->im);
	}
	//4).销毁图片
	function __destruct(){
		imagedestroy($this->im);
	}
}