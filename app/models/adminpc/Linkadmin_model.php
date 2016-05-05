<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author  gf
 * 栏目管理model
 * Class Linkadmin_model
 */
class Linkadmin_model extends CI_Model
{
	private $table = 'ft_linkadmin';
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
	public function updateAndInsert($data,$linkId = false)
	{
		$linkId = intval($linkId);
		if(!empty($linkId))
		{
			$this->db->where('linkId',$linkId);
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
	 * 拿取全部数据
	 * @param array $condition
	 * @return mixed
	 */
	public function getLinkList($condition = array() , $roleId = 0)
	{
		$where = $this->_getWhere($condition);
		$this->db->where($where);
		$roleId = intval($roleId);
		if(!empty($roleId))
		{
			$where = 'FIND_IN_SET('.$roleId.', linkRoleId)';
			$this->db->where($where);
		}
		$res = $this->db->get($this->table)->result_array();
		return $res;
	}

	/**
	 * where条件
	 * @param array $condition
	 * @return array
	 */
	private function _getWhere($condition = array())
	{
		$where = array();
		if(isset($condition['parentId']))
		{
			$where['parentId'] = $condition['parentId'];
		}

		if(isset($condition['deleteFlag']))
		{
			$where['deleteFlag'] = $condition['deleteFlag'];
		}

		if(isset($condition['linkId']))
		{
			$where['linkId'] = $condition['linkId'];
		}

		if(isset($condition['keyWord']))
		{
			$where['keyWord'] = $condition['keyWord'];
		}

		if(isset($condition['linkName']))
		{
			$where['linkName'] = $condition['linkName'];
		}
		return $where;
	}

	/**
	 * 获取单条数据
	 * @param array $conditon
	 * @return mixed
	 */
	public function getLinkById($conditon = array())
	{
		$where = $this->_getWhere($conditon);
		$this->db->where($where);
		$res = $this->db->get($this->table)->row_array();
		return $res;
	}
}
