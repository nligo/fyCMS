<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 栏目管理
 * Class Linkadmin
 */
class Linkadmin extends CI_Controller
{
	public static $data = array();

	public function __construct()
	{
		parent::__construct();
		$this->load->model('publicclass/Viewclass_model', 'viewmodel');
		self::$data['adminheader'] = $this->viewmodel->adminHeader('Linkadmin');
		self::$data['adminfooter'] = $this->viewmodel->adminFooter();
		self::$data['breadcrumb'] = $this->viewmodel->breadcrumb('Linkadmin');
		self::$data['title'] = '栏目操作';
		$this->load->model('adminpc/Linkadmin_model','linkadmin');
		$this->load->model('adminpc/Roleadmin_model','roleadmin');
		$this->load->library('myredis');
		$this->viewmodel->checkUser();
	}

	/**
	 * @author  gf
	 * 添加导航
	 */
	public function index()
	{
		$userinfo = json_decode($this->myredis->get('log_userinfo'),true);
		$condition['parentId'] = 0;
		$leftMenuPlink = $this->linkadmin->getLinkList($condition ,$userinfo['nowRoleId']);
		if(!empty($leftMenuPlink)) foreach($leftMenuPlink as $k=>$v)
		{
			$param['parentId'] = $v['linkId'];
			$leftMenuPlink[$k]['sonLinkList'] = $this->linkadmin->getLinkList($param);
		}
		self::$data['leftMenuPlink'] = $leftMenuPlink;
		$roleParam = array();
		$rolelist = $this->roleadmin->getRoleList($roleParam);
		self::$data['rolelist'] = $rolelist;
		$this->load->view('adminpc/linkadmin/linklist',self::$data);
	}


	/**
	 * 栏目数据操作
	 */
	public function OpMysqlColumn()
	{
		$parentId = intval($this->input->post('parentId'));
		$linkName = trim($this->input->post('linkName'));
		$keyWord = trim($this->input->post('keyWord'));
		$linkUrl = trim($this->input->post('linkUrl'));
		$displayOrder = intval($this->input->post('displayOrder'));
		$linkRoleId = $this->input->post('userTypeId');
		$linkId = intval($this->input->post('linkId'));
		$linkRoleId = implode(',',$linkRoleId);
		if(empty($linkId))
		{
			$arrData = array(
				'parentId' => $parentId,
				'linkName' => $linkName,
				'keyWord' => $keyWord,
				'linkUrl' => $linkUrl,
				'displayOrder' => $displayOrder,
				'linkRoleId' => $linkRoleId
			);
			$this->linkadmin->updateAndInsert($arrData);
		}
		else
		{
			$arrData = array(
				'parentId' => $parentId,
				'linkName' => $linkName,
				'linkUrl' => $linkUrl,
				'displayOrder' => $displayOrder,
				'linkRoleId' => $linkRoleId
			);
			$this->linkadmin->updateAndInsert($arrData,$linkId);
		}
		redirect('adminpc/Linkadmin/index');
	}

	/**
	 *编辑栏目
	 */
	public function editLink($linkId = false)
	{
		$linkId = intval($linkId);
		if(empty($linkId))
		{
			$roleParam = array();
			$rolelist = $this->roleadmin->getRoleList($roleParam);
			self::$data['rolelist'] = $rolelist;
			$this->load->view('adminpc/linkadmin/linkInfo',self::$data);
		}
		else
		{
			$condition = array();
			$condition['linkId'] = $linkId;
			$menuParam['parentId'] = 0;
			self::$data['info'] = $this->linkadmin->getLinkById($condition);
			$leftMenuPlink = $this->linkadmin->getLinkList($menuParam);
			self::$data['leftMenuPlink'] = $leftMenuPlink;
			$roleParam = array();
			$rolelist = $this->roleadmin->getRoleList($roleParam);
			self::$data['rolelist'] = $rolelist;
			$this->load->view('adminpc/linkadmin/linkInfo',self::$data);
		}
	}

	/**
	 * 删除恢复
	 * @param bool|false $linkId
	 * @param bool|false $deleteFlag
	 */
	public function changeStatus($linkId = false , $deleteFlag = false)
	{
		$linkId = intval($linkId);
		$deleteFlag = intval($deleteFlag);
		if($linkId == 0)
		{
			echo "<script language=javascript>alert('参数错误！');history.back();</script>";
			exit;
		}
		else
		{
			$arr = array(
				'deleteFlag' => $deleteFlag
			);
			$this->linkadmin->updateAndInsert($arr,$linkId);
			echo "<script language=javascript>alert('操作成功！');history.back();</script>";
			exit;
		}
	}

	/**
	 * 效验链接名称与关键词
	 */
	public function ajaxLink()
	{
		$res = array('err' => 0, 'msg' => '错误');
		$linkName = trim($this->input->post('linkName'));
		if (!empty($linkName))
		{
			$condition['linkName'] = $linkName;
			$info = $this->linkadmin->getLinkList($condition);
			if(!empty($info))
			{
				$res = array('err' => 1, 'msg' => '成功');
			}
		}
		$keyWord = trim($this->input->post('keyWord'));
		if (!empty($keyWord))
		{
			$param['keyWord'] = $keyWord;
			$info = $this->linkadmin->getLinkList($param);
			if(!empty($info))
			{
				$res = array('err' => 1, 'msg' => '成功');
			}
		}
		echo json_encode($res);exit;
	}
}
