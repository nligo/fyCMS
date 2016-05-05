<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author  gf
 * 站点管理model
 * Class Website_model
 */
class Website_model extends CI_Model
{
	private $table = 'ft_webinfo';
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
	public function updateAndInsert($data,$webId = false)
	{
		$webId = intval($webId);
		if(!empty($webId))
		{
			$this->db->where('webId',$webId);
			return $this->db->update($this->table, $data);
		}
		else
		{
			$this->db->insert($this->table, $data);
			return $this->db->insert_id();
		}
	}

	/**
	 * 拿取单条数据
	 * @param bool|false $webId
	 * @return mixed
	 */
	public function getInfoById($webId = false)
	{
		$webId = intval($webId);
		if(!empty($webId))
		{
			$this->db->where('webId',$webId);
		}
		return $this->db->get($this->table)->row_array();
	}
}
