<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author  gf
 * 登录
 * Class Login
 */
class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('adminpc/User_model','user');
		$this->load->model('adminpc/Roleadmin_model','role');
		$this->load->model('Login_model','login');
		$this->load->model('publicclass/Viewclass_model', 'viewmodel');
		$this->load->library('myredis');
	}

	/**
	 * 登录页面
	 */
	public function index()
	{
		$check = $this->myredis->isExists('log_userinfo');
		if(!empty($check))
		{
			redirect('adminpc/Linkadmin/index');
		}
		else
		{
			$this->load->view('log');
		}
	}

	/**
	 * @author  gf
	 * 效验用户名
	 */
	public function checkUser()
	{
		$res = array('err' =>0);
		$preg = '/^0?1[3|4|5|8][0-9]\d{8}$/';
		$userNickName = trim($this->input->post('userNickName'));
		if(!empty($userNickName))
		{
			$info = $this->user->getUserById(0,$userNickName);
			if(!empty($info))
			{
				$res = array('err'=>1);
			}
		}
		echo json_encode($res);exit;
	}

	/**
	 * 验证登录
	 */
	public function checkLog()
	{
		$userNickName = trim($this->input->post('userNickName'));
		$userPassWord = md5($this->input->post('userPassWord'));
		if(!empty($userNickName) && !empty($userPassWord))
		{
			$checkUser = $this->login->checkUser($userNickName,$userPassWord);

			if(!empty($checkUser))
			{
				$roleIds = explode(',',$checkUser['roleId']);
				$roleadmininfo = $this->role->getRoleById($roleIds[0]);
				$checkUser['nowRoleId'] = $roleadmininfo['roleId'];
				$checkUser['roleName'] = $roleadmininfo['roleName'];
				$checkUser = json_encode($checkUser);
				$this->myredis->set('log_userinfo',$checkUser,7200);
				redirect('adminpc/Linkadmin/index');
			}
			else
			{
				redirect('Login/index');
			}
		}
		else
		{
			redirect('Login/index');
		}
	}

	/**
	 * @author  gf
	 * 注销
	 */
	public function logout()
	{
		$check = $this->myredis->isExists('log_userinfo');
		if(!empty($check))
		{
			$this->myredis->del('log_userinfo');
			redirect('Login/index');
		}
		else
		{
			redirect('Login/index');
		}
	}

	/**
	 * @author  gf
	 */
	public function changeRole()
	{
		$res = array('err'=>0);
		$check = $this->myredis->isExists('log_userinfo');
		$roleId = intval($this->input->post('roleId'));
		if(!empty($roleId))
		{
			if(!empty($check))
			{
				$userinfo = $this->myredis->get('log_userinfo');
				$userinfo = json_decode($userinfo,true);
				$userinfo['nowRoleId'] = $roleId;
				$roleinfo = $this->role->getRoleById($roleId);
				$userinfo['roleName'] = $roleinfo['roleName'];
				$userinfo = json_encode($userinfo);
				$this->myredis->set('log_userinfo',$userinfo);
				$res = array('err'=>1);
			}
		}
		echo json_encode($res);exit;
	}
}
