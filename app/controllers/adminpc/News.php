<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 新闻管理model
 * Class News
 */
class News extends CI_Controller
{
	public static $data = array();

	public function __construct()
	{
		parent::__construct();
		$this->load->model('publicclass/Viewclass_model', 'viewmodel');
		self::$data['adminheader'] = $this->viewmodel->adminHeader('News');
		self::$data['adminfooter'] = $this->viewmodel->adminFooter();
		self::$data['breadcrumb'] = $this->viewmodel->breadcrumb('News');
		self::$data['title'] = '新闻管理';
		$this->load->model('adminpc/News_model','news');
		$this->viewmodel->checkUser();
	}

	/**
	 * 新闻列表
	 */
	public function index()
	{
		$condition = $param = array();
		$limit = 10;
		$start = $this->uri->segment(4);
		$start = isset($start) ? intval($start) : 0;

		$newsTitle = $this->input->get_post('newsTitle');
		$newsTitle = isset($newsTitle) ? trim($newsTitle) : '';
		if(!empty($newsTitle))
		{
			$condition['newsTitle'] = $newsTitle;
		}
		$param['newsTitle'] = $newsTitle;
		$count = $this->news->getNewsCount($condition);
		$this->viewmodel->create_page('/adminpc/News/index', $count, $limit, 4);
		$pageparam = $this->viewmodel->dealparam($param);
		$newslist = $this->news->getNewsList($condition,$start,$limit);
		self::$data['newslist'] = $newslist;
		self::$data['count'] = $count;
		self::$data['param'] = $param;
		self::$data['pageparam'] = $pageparam;
		$this->load->view('adminpc/news/newslist',self::$data);
	}

	/**
	 * 编辑新闻
	 */
	public function editNews($newsId = false)
	{
		$newsId = intval($newsId);
		if(!empty($newsId))
		{
			$info = $this->news->getNewsById($newsId);
		}
		else
		{
			$info = '';
		}
		self::$data['info'] = $info;
		$this->load->view('adminpc/news/editnews',self::$data);
	}

	/**
	 * 新闻数据入库处理
	 */
	public function opNews()
	{
		$opImg = $_FILES['CoverImgPath'];
		$this->load->library('uploader');
		$newsId = intval($this->input->post('newsId'));
		$newsTitle = trim($this->input->post('newsTitle'));
		$newsContents = trim($this->input->post('newsContents'));
		$newsSource = trim($this->input->post('newsSource'));
		if($opImg['name'] != '')
		{
			$imgName = $this->uploader->upload_file('CoverImgPath');
			$length = strlen($imgName);
			$CoverImgPath = substr($imgName,1,$length);
		}
		$oldNewsCover = trim($this->input->post('oldNewsCover'));
		if(!empty($newsId))
		{
			if(!empty($CoverImgPath))
			{
				$arr = array(
					'newsTitle' => $newsTitle,
					'newsSource' => $newsSource,
					'newsContents' => $newsContents,
					'CoverImgPath' => $CoverImgPath,
					'createTime' => time()
				);
				if(file_exists($oldNewsCover)){
					  unlink($oldNewsCover);
				}
			}
			else
			{
				$arr = array(
					'newsTitle' => $newsTitle,
					'newsSource' => $newsSource,
					'newsContents' => $newsContents,
					'CoverImgPath' => $oldNewsCover,
					'createTime' => time()
				);
			}
			$this->news->updateAndInsert($arr,$newsId);
			echo "<script language=javascript>alert('修改成功！');history.back();</script>";
			exit;
		}
		else
		{
			if(!empty($CoverImgPath))
			{
				$arr = array(
					'newsTitle' => $newsTitle,
					'newsSource' => $newsSource,
					'newsContents' => $newsContents,
					'CoverImgPath' => $CoverImgPath,
					'createTime' => time()
				);
			}
			else
			{
				$arr = array(
					'newsTitle' => $newsTitle,
					'newsSource' => $newsSource,
					'newsContents' => $newsContents,
					'createTime' => time()
				);
			}
			$this->news->updateAndInsert($arr);
			echo "<script language=javascript>alert('发布成功！');history.back();</script>";
			exit;
		}

	}
}
