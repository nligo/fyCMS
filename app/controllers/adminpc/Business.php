<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 商家管理
 * Class Business
 */
class Business extends CI_Controller
{
	public static $data = array();

	public function __construct()
	{
		parent::__construct();
		$this->load->model('publicclass/Viewclass_model', 'viewmodel');
		self::$data['adminheader'] = $this->viewmodel->adminHeader('Business');
		self::$data['adminfooter'] = $this->viewmodel->adminFooter();
		self::$data['breadcrumb'] = $this->viewmodel->breadcrumb('Business');
		self::$data['title'] = '商家管理';
		$this->load->model('adminpc/Business_model','business');
		$this->viewmodel->checkUser();
	}

	/**
	 * 商家中心主页
	 */
	public function index()
	{

		$this->load->view('adminpc/business/businessreg',self::$data);
	}

	/**
	 * @author gf
	 * 处理注册信息
	 */
	public function doreg()
	{	
		$this->load->library('uploader');
		$bTitle = trim($this->input->post('bTitle'));
		if(empty($bTitle))
		{
			echo "<script language=javascript>alert('商铺名称不能为空');history.back();</script>";
			exit;
		}

		$bNaddress = trim($this->input->post('bNaddress'));
		if(empty($bNaddress))
		{
			echo "<script language=javascript>alert('商铺地址不能为空');history.back();</script>";
			exit;
		}

		$kgPosition = trim($this->input->post('kgPosition'));
		if(empty($kgPosition))
		{
			echo "<script language=javascript>alert('坐标不能为空');history.back();</script>";
			exit;
		}

		$bName = trim($this->input->post('bName'));
		if(empty($bName))
		{
			echo "<script language=javascript>alert('法人姓名不能为空');history.back();</script>";
			exit;
		}

		$IDcardNo = trim($this->input->post('IDcardNo'));
		if(empty($IDcardNo))
		{
			echo "<script language=javascript>alert('身份证号码不能为空');history.back();</script>";
			exit;
		}

		$usersex = intval($this->input->post('usersex'));
		// 创建商家信息文件夹
		$fileName = $IDcardNo;
		$imgPath = './uploads/businessInfo/'.$fileName;

		$imgArr = array('theDoorImg','IDpositivePath','IDoppositePath','kbisImg');
		for($i=0;$i<count($imgArr);$i++)
		{
			$returnImgPath = $this->uploader->upload_file($imgArr[$i],$imgPath);
			$newArr[$i] = $returnImgPath;
		}
	}
}
