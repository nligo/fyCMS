<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 用户管理
 * Class User
 */

class User extends CI_Controller
{
	public static $data = array();

	public function __construct()
	{
		parent::__construct();
		$this->load->model('publicclass/Viewclass_model', 'viewmodel');
		self::$data['adminheader'] = $this->viewmodel->adminHeader('User');
		self::$data['adminfooter'] = $this->viewmodel->adminFooter();
		self::$data['breadcrumb'] = $this->viewmodel->breadcrumb('User');
		self::$data['title'] = '用户管理';
		$this->load->model('adminpc/Roleadmin_model','roleadmin');
		$this->load->model('adminpc/User_model','user');
		$this->viewmodel->checkUser();
	}

	/**
	 * 用户列表
	 */
	public function index()
	{
		$condition = $param = array();
		$limit = 10;
		$start = $this->uri->segment(4);
		$start = isset($start) ? intval($start) : 0;
		$userNickName = trim($this->input->get_post('userNickName'));
		$userNickName = isset($userNickName) ? $userNickName : '';
		if(!empty($userNickName))
		{
			$condition['userNickName'] = $userNickName;
		}
		$param['userNickName'] = $userNickName;

		$userId = intval($this->input->get_post('userId'));
		$userId = isset($userId) ? $userId : 0;
		if(!empty($userId))
		{
			$condition['userId'] = $userId;
		}
		$param['userId'] = $userId;

		$roleId = intval($this->input->get_post('roleId'));
		$roleId = isset($roleId) ? $roleId : 0;
		if(!empty($roleId))
		{
			$condition['roleId'] = $roleId;
		}
		$param['roleId'] = $roleId;
		$count = $this->user->getUserCount($condition);
		$this->viewmodel->create_page('/adminpc/User/index', $count, $limit, 4);
		$pageparam = $this->viewmodel->dealparam($param);
		$userlist = $this->user->getUserList($condition,$start,$limit);
		foreach($userlist as $k=>$v)
		{
			$userlist[$k]['roleInfo'] = $this->roleadmin->getRoleById($v['roleId']);
		}
		$roleParam['isShow'] = 0;
		$rolelist = $this->roleadmin->getRoleList($roleParam);
		self::$data['rolelist'] = $rolelist;
		self::$data['userlist'] = $userlist;
		self::$data['param'] = $param;
		self::$data['count'] = $count;
		self::$data['pageparam'] = $pageparam;
		$this->load->view('adminpc/user/userlist',self::$data);
	}

	/**
	 * @author  gf
	 * 用户信息入库
	 */
	public function opUser()
	{
		$userNickName = trim($this->input->post('userNickName'));
		if(empty($userNickName))
		{
			echo "<script language=javascript>alert('用户名不能为空');history.back();</script>";
			exit;
		}
		else
		{
			$userPhoneNumber = $userNickName;
		}
		$userPassWordS = md5($this->input->post('userPassWordS'));
		$userPassWordF = md5($this->input->post('userPassWordF'));
		$roleId = $this->input->post('roleId');
		$roleId=implode(',',$roleId);
		if(empty($roleId))
		{
			echo "<script language=javascript>alert('用户角色不能为空');history.back();</script>";
			exit;
		}
		if($userPassWordF == $userPassWordS)
		{
			$userPassWord = $userPassWordS;
		}
		else
		{
			echo "<script language=javascript>alert('两次密码不一致，请重新输入！');history.back();</script>";
			exit;
		}
		$userEmail = trim($this->input->post('userEmail'));
		if(empty($userEmail))
		{
			echo "<script language=javascript>alert('用户邮箱不能为空');history.back();</script>";
			exit;
		}
		$userRealName = trim($this->input->post('userRealName'));
		if(empty($userRealName))
		{
			echo "<script language=javascript>alert('真实姓名不能为空');history.back();</script>";
			exit;
		}
		$arr = array(
			'userNickName' => $userNickName,
			'userPhoneNumber' => $userPhoneNumber,
			'userPassWord' => $userPassWord,
			'userEmail' => $userEmail,
			'roleId' => $roleId,
			'userRealName' => $userRealName,
			'createTime' => time()
		);
		$userId = $this->user->updateAndInsert($arr);
		if($userId)
		{
			echo "<script language=javascript>alert('操作成功！');history.back();</script>";
			exit;
		}
		else
		{
			echo "<script language=javascript>alert('添加失败，请重新添加！');history.back();</script>";
			exit;
		}
	}

	/**
	 * ajax验证
	 */
	public function ajaxCheck()
	{
		$res = array('err' =>0);
		$userEmail = trim($this->input->post('userEmail'));
		$userNickName = trim($this->input->post('userNickName'));
		if(!empty($userEmail))
		{
			$condition['userEmail'] = $userEmail;
			$info = $this->user->getUserList($condition);
			if(!empty($info))
			{
				$res = array('err' =>1);
			}
		}
		if(!empty($userNickName))
		{
			$condition['userNickName'] = $userNickName;
			$info = $this->user->getUserList($condition);
			if(!empty($info))
			{
				$res = array('err' =>1);
			}
		}
		echo json_encode($res);exit;
	}

	/**
	 * 重置密码
	 * @param bool|false $userId
	 */
	public function resetPass($userId = false)
	{
		$userId = intval($userId);
		if(!empty($userId))
		{
			$info = $this->user->getUserById($userId);
			if(empty($info))
			{
				echo "<script language=javascript>alert('重置失败，该用户不存在！');history.back();</script>";
				exit;
			}
			else
			{
				$passWord = md5('123456');
				$updateArr = array(
					'userPassWord' => $passWord
				);
				$uId = $this->user->updateAndInsert($updateArr,$userId);
				if(!empty($uId))
				{
					echo "<script language=javascript>alert('重置成功！');history.back();</script>";
					exit;
				}
				else
				{
					echo "<script language=javascript>alert('重置失败，请稍后重新操作！');history.back();</script>";
					exit;
				}

			}
		}
		else
		{
			echo "<script language=javascript>alert('重置失败，请稍后重新操作！');history.back();</script>";
			exit;
		}
	}

	/**
	 * 查看用户信息
	 * @param bool|false $userId
	 */
	public function editUser($userId = false)
	{
		$userId = intval($userId);
		if(!empty($userId))
		{
			$info = $this->user->getUserById($userId);
			$roleInfo = $this->roleadmin->getRoleById($info['roleId']);
			$info['roleName'] = $roleInfo['roleName'];
			self::$data['info'] = $info;
			$this->load->view('adminpc/user/editUser',self::$data);
		}
		else
		{
			echo "<script language=javascript>alert('参数错误，请重新输入！');history.back();</script>";
			exit;
		}
	}
}
