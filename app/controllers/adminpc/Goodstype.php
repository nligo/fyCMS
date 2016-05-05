<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author  gf
 * 商品分类
 * Class Goodstype
 */
class Goodstype extends CI_Controller
{
	public static $data = array();

	public function __construct()
	{
		parent::__construct();
		$this->load->model('publicclass/Viewclass_model', 'viewmodel');
		self::$data['adminheader'] = $this->viewmodel->adminHeader('Goodstype');
		self::$data['adminfooter'] = $this->viewmodel->adminFooter();
		self::$data['breadcrumb'] = $this->viewmodel->breadcrumb('Goodstype');
		self::$data['title'] = '分类管理';
		$this->load->model('adminpc/Goodstype_model','goodstype');
		$this->viewmodel->checkUser();
	}

	/**
	 * 分类列表
	 */
	public function index()
	{
		$condition = $param = array();
		$start = $this->uri->segment(4);
		$start = isset($start) ? intval($start) : 0;
		$limit = 15;
		$count = $this->goodstype->getTypeCount();
		$this->viewmodel->create_page('/adminpc/Goodstype/index', $count, $limit, 4);
		$condition['isShow'] = 1;
		$typelist = $this->goodstype->getTypeList($condition,$start,$limit);
		$hideParm['isShow'] = 2;
		$hidetypelist = $this->goodstype->getTypeList($hideParm,$start,$limit);
		self::$data['showtypelist'] = $typelist;
		self::$data['hidetypelist'] = $hidetypelist;
		self::$data['count'] = $count;
//		var_dump($count,$typelist);
		$this->load->view('adminpc/goodstype/typelist',self::$data);
	}

	/**
	 * 入库操作
	 */
	public function opType()
	{
		$typeId = intval($this->input->post('typeId'));
		$typeName = trim($this->input->post('typeName'));
		$typeContents = trim($this->input->post('typeContents'));
		$isShow = intval($this->input->post('isShow'));
		if(empty($typeName))
		{
			echo "<script language=javascript>alert('栏目名不能为空！');history.back();</script>";
			exit;
		}
		if(empty($typeContents))
		{
			echo "<script language=javascript>alert('栏目描述不能为空！');history.back();</script>";
			exit;
		}

		if(!empty($typeId))
		{
			$arr = array(
				'typeName' => $typeName,
				'typeContents' => $typeContents,
				'isShow' => $isShow
			);
			$this->goodstype->updateAndInsert($arr,$typeId);
			echo "<script language=javascript>alert('修改成功！');history.back();</script>";
			exit;
		}
		else
		{
			$arr = array(
				'typeName' => $typeName,
				'typeContents' => $typeContents,
				'isShow' => $isShow,
				'createTime' => time()
			);
			$this->goodstype->updateAndInsert($arr);
			echo "<script language=javascript>alert('添加成功！');history.back();</script>";
			exit;
		}
	}

	/**
	 * ajax效验栏目
	 */
	public function ajaxCheck()
	{
		$res = array('err' => 0);
		$typeName = trim($this->input->post('typeName'));
		if (empty($typeName))
		{
			echo "<script language=javascript>alert('参数错误！');history.back();</script>";
			exit;
		}
		else
		{
			$condition['typeName'] = $typeName;
			$info = $this->goodstype->getTypeList($condition);
			if(empty($info))
			{
				echo "<script language=javascript>alert('栏目不存在！');history.back();</script>";
				exit;
			}
			else
			{
				$res = array('err' => 1);
			}
		}
		echo json_encode($res);exit;
	}

	/**
	 * 隐藏显示
	 * @param bool|false $typeId
	 * @param bool|false $isShow
	 */
	public function changeStatus($typeId = false , $isShow = false)
	{
		$typeId = intval($typeId);
		$isShow = intval($isShow);
		if($typeId == 0)
		{
			echo "<script language=javascript>alert('参数错误！');history.back();</script>";
			exit;
		}
		else
		{
			$arr = array(
				'isShow' => $isShow
			);
			$this->goodstype->updateAndInsert($arr,$typeId);
			echo "<script language=javascript>alert('操作成功！');history.back();</script>";
			exit;
		}
	}
}
