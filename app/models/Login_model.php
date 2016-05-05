<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model
{
	private $usertable = 'ft_user';
	private $roleadmin = 'ft_roleadmin';
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * 验证用户名密码
	 * @param string $userNickName
	 * @param string $userPassWord
	 * @return bool
	 */
	public function checkUser($userNickName = '',$userPassWord = '')
	{
		$userNickName = trim($userNickName);
		$userPassWord = trim($userPassWord);
		if(!empty($userNickName) && !empty($userPassWord))
		{
			$this->db->where('userNickName',$userNickName);
			$this->db->where('userPassWord',$userPassWord);
			$res = $this->db->get($this->usertable)->row_array();
			return $res;
		}
		else
		{
			return false;
		}
	}
}
