<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author  gf
 * 商品管理model
 * Class Goodsinfo_model
 */
class Goodsinfo_model extends CI_Model
{
	private $table = 'ft_goodsinfo';

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * @author  gf
	 * 写入数据
	 * @param $data
	 * @param bool|false $goodsId
	 * @return mixed
	 */
	public function updateAndInsert($data, $goodsId = false)
	{
		$goodsId = intval($goodsId);
		if (!empty($goodsId)) {
			$this->db->where('goodsId', $goodsId);
			return $this->db->update($this->table, $data);
		} else {
			$this->db->insert($this->table, $data);
			return $this->db->insert_id();
		}
	}

	/**
	 * @author  gf
	 * 获取商品数据
	 * @param array $condition
	 * @param int $limit
	 * @param int $start
	 */
	public function getGoodsList($condition = array(), $start = 0, $limit = 10)
	{
		$start = intval($start);
		$limit = intval($limit);
		$this->db->limit($limit, $start);
		$this->db->order_by('createTime', 'DESC');
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
		if (isset($condition['goodsTitle'])) {
			$where['goodsTitle like'] = "%" . $condition['goodsTitle'] . "%";
		}
		if (isset($condition['isShow'])) {
			$where['isShow'] = $condition['isShow'];
		}
		if (isset($condition['typeId'])) {
			$where['typeId'] = $condition['typeId'];
		}
		return $where;
	}

	/**
	 * @author  gf
	 * 获取总数
	 */
	public function getGoodsCount($condition = array())
	{
		$where = $this->_getwhere($condition);
		$this->db->where($where);
		$count = $this->db->get($this->table)->num_rows();
		return $count;
	}

	/**
	 * @author  gf
	 * @param int $goodsId
	 * @return mixed
	 */
	public function getGoodsById($goodsId = 0)
	{
		$goodsId = intval($goodsId);
		if (!empty($goodsId)) {
			$this->db->where('goodsId', $goodsId);
		}
		$query = $this->db->get($this->table)->row_array();
		return $query;
	}


}
