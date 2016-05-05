<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 站点设置
 * Class Website
 */
class Website extends CI_Controller
{
	public static $data = array();

	public function __construct()
	{
		parent::__construct();
		$this->load->model('publicclass/Viewclass_model', 'viewmodel');
		self::$data['adminheader'] = $this->viewmodel->adminHeader('Website');
		self::$data['adminfooter'] = $this->viewmodel->adminFooter();
		self::$data['breadcrumb'] = $this->viewmodel->breadcrumb('Website');
		self::$data['title'] = '站点设置';
		$this->load->model('adminpc/Website_model','website');
		$this->load->model('adminpc/Emailsite_model','emailsite');
		$this->viewmodel->checkUser();
	}

	/**
	 * @author  gf
	 * 站点信息
	 */
	public function index()
	{
		$info = $this->website->getInfoById();
		$emailinfo = $this->emailsite->getInfoById();
		self::$data['info'] = $info;
		self::$data['emailinfo'] = $emailinfo;
		$this->load->view('adminpc/website/webinfo',self::$data);
	}

	/**
	 * @author  gf
	 * 站点信息入库操作
	 */
	public function opWebsite()
	{
		$webId = intval($this->input->post('webId'));
		$webName = trim($this->input->post('webName'));
		$webUrl = trim($this->input->post('webUrl'));
		$webKeyWord = trim($this->input->post('webKeyWord'));
		$webRecordInfo = trim($this->input->post('webRecordInfo'));
		$webAdminName = trim($this->input->post('webAdminName'));
		$webAdminEmail = trim($this->input->post('webAdminEmail'));
		$webDescribe = trim($this->input->post('webDescribe'));
		if(empty($webName))
		{
			echo "<script language=javascript>alert('网站名称不能为空！');history.back();</script>";
			exit;
		}
		if(empty($webUrl))
		{
			echo "<script language=javascript>alert('网站地址不能为空！');history.back();</script>";
			exit;
		}
		if(empty($webKeyWord))
		{
			echo "<script language=javascript>alert('网站关键字不能为空！');history.back();</script>";
			exit;
		}
		if(empty($webAdminName))
		{
			echo "<script language=javascript>alert('网站管理员不能为空！');history.back();</script>";
			exit;
		}
		if(empty($webAdminEmail))
		{
			echo "<script language=javascript>alert('网站管理员邮箱不能为空！');history.back();</script>";
			exit;
		}
		$arr = array(
			'webName' => $webName,
			'webUrl' => $webUrl,
			'webKeyWord' => $webKeyWord,
			'webRecordInfo' => $webRecordInfo,
			'webAdminName' => $webAdminName,
			'webAdminEmail' => $webAdminEmail,
			'webDescribe' => $webDescribe
		);
		if(!empty($webId))
		{
			$this->website->updateAndInsert($arr,$webId);
			echo "<script language=javascript>alert('修改成功！');history.back();</script>";
			exit;
		}
		else
		{
			$this->website->updateAndInsert($arr);
			echo "<script language=javascript>alert('添加成功！');history.back();</script>";
			exit;
		}
	}

	/**
	 * @auhtor  gf
	 * 操作邮箱数据入库
	 */
	public function opEmail()
	{
		$emailId = intval($this->input->post('emailId'));
		$emailHost = trim($this->input->post('emailHost'));
		$emailUserName = trim($this->input->post('emailUserName'));
		$emailPassword = trim($this->input->post('emailPassword'));
		$emailPort = trim($this->input->post('emailPort'));
		$sendName = trim($this->input->post('sendName'));
		if(empty($emailHost))
		{
			echo "<script language=javascript>alert('主机不能为空！');history.back();</script>";
			exit;
		}
		if(empty($emailUserName))
		{
			echo "<script language=javascript>alert('邮箱用户名不能为空！');history.back();</script>";
			exit;
		}
		if(empty($emailPassword))
		{
			echo "<script language=javascript>alert('邮箱配置密码不能为空！');history.back();</script>";
			exit;
		}
		if(empty($emailPort))
		{
			echo "<script language=javascript>alert('邮箱配置端口不能为空！');history.back();</script>";
			exit;
		}
		if(empty($sendName))
		{
			echo "<script language=javascript>alert('发件人名称不能为空！');history.back();</script>";
			exit;
		}
		$arr = array(
			'emailHost' => $emailHost,
			'emailUserName' => $emailUserName,
			'emailPassword' => $emailPassword,
			'emailPort' => $emailPort,
			'sendName' => $sendName,
		);
		if(!empty($emailId))
		{
			$this->emailsite->updateAndInsert($arr,$emailId);
			echo "<script language=javascript>alert('修改成功！');history.back();</script>";
			exit;
		}
		else
		{
			$this->emailsite->updateAndInsert($arr);
			echo "<script language=javascript>alert('添加成功！');history.back();</script>";
			exit;
		}
	}
}
