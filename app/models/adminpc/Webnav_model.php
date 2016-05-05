<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Webnav_model extends CI_Model
{
	private $table = 'ft_webnav';
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * @author  gf
	 * 写入数据
	 * @param $data
	 * @param bool|false $navId
	 * @return mixed
	 */
	public function updateAndInsert($data,$navId = false)
	{
		$navId = intval($navId);
		if(!empty($navId))
		{
			$this->db->where('navId',$navId);
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
	 * 获取列表数据
	 * @param array $condition
	 * @param int $limit
	 * @param int $start
	 */
	public function getNavList($condition = array() , $start = 0 , $limit = 10)
	{
		$start = intval($start);
		$limit = intval($limit);
		$this->db->limit($limit , $start);
		$this->db->order_by('navSort','DESC');
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
		if(isset($condition['navType']))
		{
			$where['navType'] = $condition['navType'];
		}

		if(isset($condition['navName']))
		{
			$where['navName'] = $condition['navName'];
		}

		if(isset($condition['navKeyWord']))
		{
			$where['navKeyWord'] = $condition['navKeyWord'];
		}
		return $where;
	}

	/**
	 * @author  gf
	 * 获取总数
	 */
	public function getNavCount($condition = array())
	{
		$where = $this->_getwhere($condition);
		$this->db->where($where);
		$count = $this->db->get($this->table)->num_rows();
		return $count;
	}

	/**
	 * @author  gf
	 * 拿取单条数据
	 * @param int $navId
	 * @return mixed
	 */
	public function getNavById($navId = 0)
	{
		$navId = intval($navId);
		if(!empty($navId))
		{
			$this->db->where('navId',$navId);
		}
		$query = $this->db->get($this->table)->row_array();
		return $query;
	}
}
