<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author  gf
 * 商品分类model
 * Class Goodstype_model
 */
class Goodstype_model extends CI_Model
{
	private $table = 'ft_goodstype';
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * @author  gf
	 * 写入数据
	 * @param $data
	 * @param bool|false $typeId
	 * @return mixed
	 */
	public function updateAndInsert($data,$typeId = false)
	{
		$typeId = intval($typeId);
		if(!empty($typeId))
		{
			$this->db->where('typeId',$typeId);
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
	 * 获取商品分类数据
	 * @param array $condition
	 * @param int $limit
	 * @param int $start
	 */
	public function getTypeList($condition = array() , $start = 0 , $limit = 10)
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
		if(isset($condition['typeName']))
		{
			$where['typeName'] = $condition['typeName'];
		}

		if(isset($condition['isShow']))
		{
			$where['isShow'] = $condition['isShow'];
		}
		return $where;
	}

	/**
	 * @author  gf
	 * 获取总数
	 */
	public function getTypeCount($condition = array())
	{
		$where = $this->_getwhere($condition);
		$this->db->where($where);
		$count = $this->db->get($this->table)->num_rows();
		return $count;
	}

	/**
	 * @author  gf
	 * 拿取单条数据
	 * @param int $typeId
	 * @return mixed
	 */
	public function getTypeById($typeId = 0)
	{
		$typeId = intval($typeId);
		if(!empty($typeId))
		{
			$this->db->where('typeId',$typeId);
		}
		$query = $this->db->get($this->table)->row_array();
		return $query;
	}
}
