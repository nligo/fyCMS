<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Goodsinfo extends CI_Controller
{
	public static $data = array();

	public function __construct()
	{
		parent::__construct();
		$this->load->model('publicclass/Viewclass_model', 'viewmodel');
		self::$data['adminheader'] = $this->viewmodel->adminHeader('Goodsinfo');
		self::$data['adminfooter'] = $this->viewmodel->adminFooter();
		self::$data['breadcrumb'] = $this->viewmodel->breadcrumb('Goodsinfo');
		self::$data['title'] = '商品管理';
		$this->load->model('adminpc/Goodsinfo_model','goodsinfo');
		$this->load->model('adminpc/Goodstype_model','goodstype');
		$this->viewmodel->checkUser();
	}

	/**
	 * @author  gf
	 * 商品列表
	 */
	public function index()
	{
		$condition = $param = array();
		$start = $this->uri->segment(4);
		$start = isset($start) ? intval($start) : 0;
		$limit = 15;
		$goodsTitle = trim($this->input->get_post('goodsTitle'));
		$goodsTitle = isset($goodsTitle) ? $goodsTitle : '';
		if(!empty($goodsTitle))
		{
			$condition['goodsTitle'] = $goodsTitle;
		}
		$param['goodsTitle'] = $goodsTitle;

		$isShow = intval($this->input->get_post('isShow'));
		$isShow = isset($isShow) ? $isShow : 0;
		if($isShow != 0)
		{
			$condition['isShow'] = $isShow;
		}
		$param['isShow'] = $isShow;

		$typeId = intval($this->input->get_post('typeId'));
		$typeId = isset($typeId) ? $typeId : 0;
		if($typeId != 0)
		{
			$condition['typeId'] = $typeId;
		}
		$param['typeId'] = $typeId;
		$count = $this->goodsinfo->getGoodsCount($condition);
		$this->viewmodel->create_page('/adminpc/Goodsinfo/index', $count, $limit, 4);
		$pageparam = $this->viewmodel->dealparam($param);
		$goodslist = $this->goodsinfo->getGoodsList($condition,$start,$limit);
		//$condiiton 为搜索条件
		$redis = new Redis();
		$redis->connect('127.0.0.1','6379');
		$goodslist = json_encode($goodslist);
		$redis->set('goodsinfo_goodsinfolist',$goodslist);
		$goodslist = $redis->get('goodsinfo_goodsinfolist');
		if(empty($goodslist))
		{
			show_error('redis的key不存在');
		}
		$goodslist = json_decode($goodslist,true);
		$typeParam['isShow'] = 1;
		$typelist = $this->goodstype->getTypeList($typeParam);
		self::$data['typelist'] = $typelist;
		self::$data['count'] = $count;
		self::$data['goodslist'] = $goodslist;
		self::$data['param'] = $param;
		self::$data['pageparam'] = $pageparam;
		$this->load->view('adminpc/goodsinfo/goodslist',self::$data);
	}

	/**
	 * @author  gf
	 * 发布商品
	 */
	public function editGoods($goodsId = false)
	{
		$goodsInfo = array();
		$goodsId = intval($goodsId);
		if(!empty($goodsId))
		{
			$goodsInfo = $this->goodsinfo->getGoodsById($goodsId);
		}
		self::$data['info'] = $goodsInfo;
		$typeParam['isShow'] = 1;
		$typelist = $this->goodstype->getTypeList($typeParam);
		self::$data['typelist'] = $typelist;
		$this->load->view('adminpc/goodsinfo/goodsinfo',self::$data);
	}

	/**
	 * 操作商品入库
	 */
	public function opGoods()
	{
		$this->load->library('uploader');
		$goodsId = intval($this->input->post('goodsId'));
		$goodsTitle = trim($this->input->post('goodsTitle'));
		$oldGoodsCover = trim($this->input->post('oldGoodsCover'));
		if(empty($goodsTitle))
		{
			echo "<script language=javascript>alert('商品名称不能为空！');history.back();</script>";
			exit;
		}
		$goodsPrice = trim($this->input->post('goodsPrice'));
		if(empty($goodsPrice))
		{
			echo "<script language=javascript>alert('商品价格不能为空！');history.back();</script>";
			exit;
		}
		$isShow = intval($this->input->post('isShow'));
		$typeId = intval($this->input->post('typeId'));
		if(empty($typeId))
		{
			echo "<script language=javascript>alert('商品分类不能为空！');history.back();</script>";
			exit;
		}
		$goodsConents = trim($this->input->post('goodsConents'));
		if(empty($goodsConents))
		{
			echo "<script language=javascript>alert('商品描述不能为空！');history.back();</script>";
			exit;
		}
		$goodsStock = intval($this->input->post('goodsStock'));
		$fileInputName = 'goodsCover';
		$imgName = $this->uploader->upload_file('goodsCover');
		$length = strlen($imgName);
		$goodsCover = substr($imgName,1,$length);
		if(empty($goodsId))
		{
			$arr = array(
				'goodsTitle' => $goodsTitle,
				'goodsPrice' => $goodsPrice,
				'isshow' => $isShow,
				'typeId' => $typeId,
				'goodsContents' => $goodsConents,
				'goodsCover' => $goodsCover,
				'goodsStock' => $goodsStock,
				'createTime' => time(),
				'editTime' => time()
			);
			$this->goodsinfo->updateAndInsert($arr);
			echo "<script language=javascript>alert('发布成功！');history.back();</script>";
			exit;
		}
		else
		{
			if(empty($goodsCover))
			{
				$goodsCover = $oldGoodsCover;
			}
			else
			{
				if(file_exists($oldGoodsCover)){
					  unlink($oldGoodsCover);
				}
			}
			$arr = array(
				'goodsTitle' => $goodsTitle,
				'goodsPrice' => $goodsPrice,
				'isShow' => $isShow,
				'typeId' => $typeId,
				'goodsContents' => $goodsConents,
				'goodsCover' => $goodsCover,
				'goodsStock' => $goodsStock,
			);

			$this->goodsinfo->updateAndInsert($arr,$goodsId);
			echo "<script language=javascript>alert('修改成功！');history.back();</script>";
			exit;
		}
	}
}
