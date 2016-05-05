<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 新闻管理model
 * Class News_model
 */
class News_model extends CI_Model
{
	private $table = 'ft_news';
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * @author  gf
	 * 写入数据
	 * @param $data
	 * @param bool|false $newsId
	 * @return mixed
	 */
	public function updateAndInsert($data,$newsId = false)
	{
		$newsId = intval($newsId);
		if(!empty($newsId))
		{
			$this->db->where('newsId',$newsId);
			return $this->db->update($this->table, $data);
		}
		else
		{
			$this->db->insert($this->table, $data);
			return $this->db->insert_id();
		}
	}

	/**
	 * @author  gf
	 * 获取新闻列表
	 * @param array $condition
	 * @param int $limit
	 * @param int $start
	 */
	public function getNewsList($condition = array() , $start = 0 , $limit = 10)
	{
		$start = intval($start);
		$limit = intval($limit);
		$this->db->limit($limit , $start);
		$this->db->order_by('createTime','DESC');
		$where = $this->_getwhere($condition);
		$this->db->where($where);
		$query = $this->db->get($this->table)->result_array();
		return $query;
	}

	/**
	 * @author  gf
	 * 搜索条件
	 * @param array $condition
	 */
	public function _getwhere($condition = array())
	{
		$where = array();
		if(isset($condition['newsTitle']))
		{
			$where['newsTitle'] = '%'.$condition['newsTitle'].'%';
		}
		return $where;
	}

	/**
	 * @author  gf
	 * 获取总数
	 */
	public function getNewsCount($condition = array())
	{
		$where = $this->_getwhere($condition);
		$this->db->where($where);
		$count = $this->db->get($this->table)->num_rows();
		return $count;
	}

	/**
	 * @author  gf
	 * 拿取单条数据
	 * @param int $newsId
	 * @return mixed
	 */
	public function getNewsById($newsId = 0)
	{
		$newsId = intval($newsId);
		if(!empty($newsId))
		{
			$this->db->where('newsId',$newsId);
		}
		$query = $this->db->get($this->table)->row_array();
		return $query;
	}
}
