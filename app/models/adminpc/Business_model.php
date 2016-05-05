<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 商家model
 * Class Business_model
 */
class Business_model extends CI_Model
{
	private $table = 'ft_business';
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * @author  gf
	 * 写入数据
	 * @param $data
	 * @param bool|false $bId
	 * @return mixed
	 */
	public function updateAndInsert($data, $bId = false)
	{
		$bId = intval($bId);
		if (!empty($bId)) {
			$this->db->where('bId', $bId);
			return $this->db->update($this->table, $data);
		} else {
			$this->db->insert($this->table, $data);
			return $this->db->insert_id();
		}
	}

	/**
	 * @author	gf
	 * @param array $condition
	 * @param int $start
	 * @param int $limit
	 * @return mixed
	 */
	public function getBusinessList($condition = array(),$start = 0,$limit = 10)
	{
		$limit = intval($limit);
		$start = intval($start);
		$where = $this->_getWhere($condition);
		$this->db->where($where);
		$this->db->limit($limit,$start);
		$res = $this->db->get($this->table)->result_array();
		return $res;
	}

	/**
	 * @author	gf
	 * 搜索条件
	 * @param array $condition
	 * @return array
	 */
	private function _getWhere($condition = array())
	{
		$where = array();
		return $where;
	}

	/**
	 * @author	gf
	 * 拿取单条数据
	 * @param int $bId
	 * @param bool $IDcardNo
	 * @return mixed
	 */
	public function getBusiness($bId = 0 , $IDcardNo = false)
	{
		$bId = intval($bId);
		if(!empty($bId))
		{
			$this->db->where('bId',$bId);
		}
		$IDcardNo = trim($IDcardNo);
		if(!empty($IDcardNo))
		{
			$this->db->where('IDcardNo',$IDcardNo);
		}
		$res = $this->db->get($this->table)->row_array();
		return $res;
	}
}
