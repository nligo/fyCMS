<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author  gf
 * 用户model
 * Class User_model
 */

class User_model extends CI_Model
{
	private $table = 'ft_user';
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * @author  gf
	 * 写入数据 修改数据
	 * @param $data
	 * @param bool|false $userId
	 * @return mixed
	 */
	public function updateAndInsert($data,$userId = false)
	{
		$userId = intval($userId);
		if(!empty($userId))
		{
			$this->db->where('userId',$userId);
			return $this->db->update($this->table, $data);
		}
		else
		{
			$this->db->insert($this->table, $data);
			return $this->db->insert_id();
		}
	}

	/**
	 * 获取用户列表
	 * @param array $condition
	 * @param int $start
	 * @param int $limit
	 * @return mixed
	 */
	public function getUserList($condition = array() , $start = 0 , $limit = 10)
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
	 * 用户查询条件
	 * @param array $condition
	 */
	private function _getwhere($condition = array())
	{
		$where = array();
		if(isset($condition['roleId']) && $condition['roleId'] != false)
		{
			$where['roleId'] = $condition['roleId'];
		}
		if(isset($condition['userNickName']))
		{
			$where['userNickName'] = $condition['userNickName'];
		}
		if(isset($condition['userId']))
		{
			$where['userId'] = $condition['userId'];
		}
		if(isset($condition['userEmail']))
		{
			$where['userEmail'] = $condition['userEmail'];
		}
		return $where;
	}

	/**
	 * 获取总数
	 * @param array $condition
	 * @return mixed
	 */
	public function getUserCount($condition = array())
	{
		$where = $this->_getWhere($condition);
		$this->db->where($where);
		$query = $this->db->get($this->table)->num_rows();
		return $query;
	}

	/**
	 * 拿取单条数据
	 * @param bool|false $userId
	 * @return mixed
	 */
	public function getUserById($userId = false , $userNickName = '')
	{
		$userId = intval($userId);
		if(!empty($userId))
		{
			$this->db->where('userId',$userId);
		}
		$userNickName = trim($userNickName);
		if(!empty($userNickName))
		{
			$this->db->where('userNickName',$userNickName);
		}

		$res = $this->db->get($this->table)->row_array();
		return $res;
	}
}
