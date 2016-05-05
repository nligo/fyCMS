<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author  gf
 * 角色管理
 * Class Role
 */
class Roleadmin extends CI_Controller
{
	public static $data = array();

	public function __construct()
	{
		parent::__construct();
		$this->load->model('publicclass/Viewclass_model', 'viewmodel');
		self::$data['adminheader'] = $this->viewmodel->adminHeader('Roleadmin');
		self::$data['adminfooter'] = $this->viewmodel->adminFooter();
		self::$data['breadcrumb'] = $this->viewmodel->breadcrumb('Roleadmin');
		self::$data['title'] = '角色管理';
		$this->load->model('adminpc/Roleadmin_model','roleadmin');
		$this->viewmodel->checkUser();
	}

	/**
	 * 角色列表
	 */
	public function index()
	{
		$condition = $param = array();
		$condition['isShow'] = 0;
		$param['isShow'] = 1;
		$rolelist = $this->roleadmin->getRoleList($condition);
		$rolelisttwo = $this->roleadmin->getRoleList($param);
		self::$data['rolelist'] = $rolelist;
		self::$data['rolelisttwo'] = $rolelisttwo;
		$this->load->view('adminpc/roleadmin/rolelist',self::$data);
	}

	/**
	 * 角色入库操作
	 */
	public function OpRoleadmin()
	{
		$roleId = intval($this->input->post('roleId'));
		$roleName = trim($this->input->post('roleName'));
		$roleContents = trim($this->input->post('roleContents'));
		$displayOrder = intval($this->input->post('displayOrder'));
		$isShow = intval($this->input->post('isShow'));
		if(empty($roleName))
		{
			echo "<script language=javascript>alert('角色名入库出错！');history.back();</script>";
			exit;
		}
		if(empty($roleContents))
		{
			echo "<script language=javascript>alert('角色描述入库出错！');history.back();</script>";
			exit;
		}
		$arr = array(
			'roleName' => $roleName,
			'roleContents' => $roleContents,
			'displayOrder' => $displayOrder,
			'isShow' => $isShow
		);;
		if(!empty($roleId))
		{
			$this->roleadmin->updateAndInsert($arr,$roleId);
			echo "<script language=javascript>alert('修改成功！');history.back();</script>";

		}
		else
		{
			$this->roleadmin->updateAndInsert($arr);
			echo "<script language=javascript>alert('添加成功！');history.back();</script>";
		}
	}

	/**
	 * 删除恢复
	 * @param bool|false $linkId
	 * @param bool|false $deleteFlag
	 */
	public function changeStatus($roleId = false , $isShow = false)
	{
		$roleId = intval($roleId);
		$isShow = intval($isShow);
		if($roleId == 0)
		{
			echo "<script language=javascript>alert('参数错误！');history.back();</script>";
			exit;
		}
		else
		{
			$arr = array(
				'isShow' => $isShow
			);
			$this->roleadmin->updateAndInsert($arr,$roleId);
			echo "<script language=javascript>alert('操作成功！');history.back();</script>";
			exit;
		}
	}

	/**
	 * 编辑信息
	 * @param bool|false $roleId
	 */
	public function editRole($roleId = false)
	{
		$roleId = intval($roleId);
		if(!empty($roleId))
		{
			$info = $this->roleadmin->getRoleById($roleId);
			self::$data['info'] = $info;
			$this->load->view('adminpc/roleadmin/editRole',self::$data);
		}
		else
		{
			echo "<script language=javascript>alert('参数错误！');history.back();</script>";
			exit;
		}
	}

	/**
	 * 效验角色是否存在
	 */
	public function ajaxCheckRole()
	{
		$res = array('err' => 0, 'msg' => '错误');
		$roleName = trim($this->input->post('roleName'));
		if (!empty($roleName))
		{
			$condition['roleName'] = $roleName;
			$info = $this->roleadmin->getRoleList($condition);
			if(!empty($info))
			{
				$res = array('err' => 1, 'msg' => '成功');
			}
		}
		echo json_encode($res);exit;
	}
}
