<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author  gf
 * 角色管理
 * Class Roleadmin_model
 */
class Roleadmin_model extends CI_Model
{
	private $table = 'ft_roleadmin';
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * @author  gf
	 * 写入数据跟修改数据
	 * @param $data
	 * @param bool|false $linkId
	 * @return mixed
	 */
	public function updateAndInsert($data,$roleId = false)
	{
		$roleId = intval($roleId);
		if(!empty($roleId))
		{
			$this->db->where('roleId',$roleId);
			return $this->db->update($this->table, $data);
		}
		else
		{
			$this->db->insert($this->table, $data);
			return $this->db->insert_id();
		}
	}

	/**
	 * 获取角色列表
	 * @param array $condition
	 * @return mixed
	 */
	public function getRoleList($condition = array())
	{
		$where = $this->_getWhere($condition);
		$this->db->where($where);
		$this->db->order_by('displayOrder','ASC');
		$res = $this->db->get($this->table)->result_array();
		return $res;
	}

	/**
	 * 搜索条件
	 * @param array $condition
	 * @return array
	 */
	private function _getWhere($condition = array())
	{
		$where = array();
		if(isset($condition['isShow']))
		{
			$where['isShow'] = $condition['isShow'];
		}

		if(isset($condition['roleName']))
		{
			$where['roleName'] = $condition['roleName'];
		}
		return $where;
	}

	/**
	 * 拿取单条数据
	 * @param bool|false $roleId
	 */
	public function getRoleById($roleId = false)
	{
		$roleId = intval($roleId);
		if(!empty($roleId))
		{
			$this->db->where('roleId' , $roleId);
		}
		$res = $this->db->get($this->table)->row_array();
		return $res;
	}
}
