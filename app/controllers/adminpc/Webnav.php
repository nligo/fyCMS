<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Webnav extends CI_Controller
{
	public static $data = array();

	public function __construct()
	{
		parent::__construct();
		$this->load->model('publicclass/Viewclass_model', 'viewmodel');
		self::$data['adminheader'] = $this->viewmodel->adminHeader('Webnav');
		self::$data['adminfooter'] = $this->viewmodel->adminFooter();
		self::$data['breadcrumb'] = $this->viewmodel->breadcrumb('Webnav');
		self::$data['title'] = '导航管理';
		$this->load->model('adminpc/Webnav_model','webnav');
		$this->viewmodel->checkUser();
	}

	/**
	 * 导航主页
	 */
	public function index()
	{
		$topParam['navType'] = 0;
		$topNavList = $this->webnav->getNavList($topParam);
		$topCount = $this->webnav->getNavCount($topParam);
		$bottomParam['navType'] = 1;
		$bottomNavList = $this->webnav->getNavList($bottomParam);
		$bottomCount = $this->webnav->getNavCount($bottomParam);
		self::$data['topNavList'] = $topNavList;
		self::$data['bottomNavList'] = $bottomNavList;
		$this->load->view('adminpc/webnav/navlist',self::$data);
	}

	/**
	 * ajax效验
	 */
	public function ajaxWebnav()
	{
		$res = array('err' => 0);
		$navName = trim($this->input->post('navName'));
		$navType = intval($this->input->post('navType'));
		$navKeyWord = trim($this->input->post('navKeyWord'));
		if(!empty($navName))
		{
			$param['navType'] = $navType;
			$param['navName'] = $navName;
			$info = $this->webnav->getNavList($param);
			if(!empty($info))
			{
				$res = array('err' => 1);
			}
		}
		if(!empty($navKeyWord))
		{
			$param['navKeyWord'] = $navKeyWord;
			$info = $this->webnav->getNavList($param);
			if(!empty($info))
			{
				$res = array('err' => 1);
			}

		}
		echo json_encode($res);exit;
	}

	/**
	 * 导航数据入库
	 */
	public function OpWebNav()
	{
		$navId = intval($this->input->post('navId'));
		$navName = trim($this->input->post('navName'));
		$navType = intval($this->input->post('navType'));
		$navUrl = trim($this->input->post('navUrl'));
		$navKeyWord = trim($this->input->post('navKeyWord'));
		$navSort = intval($this->input->post('navSort'));
		if(empty($navName))
		{
			echo "<script language=javascript>alert('导航名称不能为空！');history.back();</script>";
			exit;
		}
		if(empty($navUrl))
		{
			echo "<script language=javascript>alert('导航链接不能为空！');history.back();</script>";
			exit;
		}
		if(empty($navKeyWord))
		{
			echo "<script language=javascript>alert('导航关键字不能为空！');history.back();</script>";
			exit;
		}
		$arr = array(
			'navName' => $navName,
			'navType' => $navType,
			'navUrl' => $navUrl,
			'navKeyWord' => $navKeyWord,
			'navSort' => $navSort
		);
		if(!empty($navId))
		{
			$this->webnav->updateAndInsert($arr,$navId);
			echo "<script language=javascript>alert('修改成功！');history.back();</script>";
			exit;
		}
		else
		{
			$this->webnav->updateAndInsert($arr);
			echo "<script language=javascript>alert('添加成功！');history.back();</script>";
			exit;
		}
	}

	/**
	 * @author  gf
	 * 编辑导航
	 */
	public function editNav($navId = false)
	{
		$navId = intval($navId);
		if(!empty($navId))
		{
			$info = $this->webnav->getNavById($navId);
			self::$data['info'] = $info;
			$this->load->view('adminpc/webnav/editnav',self::$data);
		}
		else
		{
			echo "<script language=javascript>alert('参数错误！');history.back();</script>";
			exit;
		}
	}

	/**
	 * @author  gf
	 * 改变导航状态
	 * @param bool|false $navId
	 * @param bool|false $isShow
	 */
	public function changeStatus($navId =false,$isShow = false)
	{
		$navId = intval($navId);
		$isShow = intval($isShow);
		if(!empty($navId))
		{
			$arr = array(
				'isShow' => $isShow
			);
			$this->webnav->updateAndInsert($arr,$navId);
			echo "<script language=javascript>alert('操作成功！');history.back();</script>";
			exit;
		}
		else
		{
			echo "<script language=javascript>alert('参数错误！');history.back();</script>";
			exit;
		}
	}
}
