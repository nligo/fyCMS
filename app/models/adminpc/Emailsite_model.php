<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author  gf
 * Class Emailsite_model
 */
class Emailsite_model extends CI_Model
{
	private $table = 'ft_emailsite';
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
	public function updateAndInsert($data,$emailId = false)
	{
		$emailId = intval($emailId);
		if(!empty($emailId))
		{
			$this->db->where('emailId',$emailId);
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
	 * @param bool|false $emailId
	 * @return mixed
	 */
	public function getInfoById($emailId = false)
	{
		$emailId = intval($emailId);
		if(!empty($emailId))
		{
			$this->db->where('emailId',$emailId);
		}
		return $this->db->get($this->table)->row_array();
	}
}
