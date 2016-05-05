<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Viewclass_model extends CI_Model
{
	public static $view_data = array();
	public function __construct()
	{
		parent::__construct();
		$this->load->model('adminpc/Linkadmin_model','linkadmin');
		$this->load->model('adminpc/Roleadmin_model','roleadmin');
		$this->load->library('myredis');
	}

	/**
	 * @author  gf
	 */
	public function checkUser()
	{

		$check = $this->myredis->isExists('log_userinfo');
		if(empty($check))
		{
			redirect('Login/index');
		}
	}

	/**
	 * 后台管理头部文件
	 */
	public function adminHeader($keyWord = '')
	{
		$condition = $param = array();
		$condition['parentId'] = 0;
		$condition['deleteFlag'] = $param['deleteFlag'] = 0;
		$userinfo = $this->myredis->get('log_userinfo');
		if(!empty($userinfo))
		{
			$userinfo = json_decode($userinfo,true);
			$roleId = explode(',',$userinfo['roleId']);

			for($i = 0;$i<count($roleId);$i++)
			{
				$roleinfo[$i] = $this->roleadmin->getRoleById($roleId[$i]);

			}
			$roleinfo = json_encode($roleinfo);
			$this->myredis->set('ft_rolelist',$roleinfo);
			$roleinfo = $this->myredis->get('ft_rolelist');
			$roleinfo = json_decode($roleinfo,true);
		}
		else
		{
			$userinfo = '';
		}
		$leftMenu = $this->linkadmin->getLinkList($condition,$userinfo['nowRoleId']);
		foreach($leftMenu as $k=>$v)
		{

			$param['parentId'] = $v['linkId'];
			$leftMenu[$k]['leftMenuSonLink'] = $this->linkadmin->getLinkList($param);
			$leftMenu[$k]['linkRoleId'] = explode(',',$v['linkRoleId']);
		}
		$segment = $this->uri->segment(2);
		$leftMenu = json_encode($leftMenu);
		$keyWord = json_encode($keyWord);
		$segment = json_encode($segment);
		$this->myredis->set('viewclass_leftMenu',$leftMenu);
		$this->myredis->set('viewclass_checkWord',$keyWord);
		$this->myredis->set('viewclass_keyword',$segment);
		$leftMenu = $this->myredis->get('viewclass_leftMenu');
		$leftMenu = json_decode($leftMenu,true);
		$keyWord = $this->myredis->get('viewclass_checkWord');
		$keyWord = json_decode($keyWord,true);
		$segment = $this->myredis->get('viewclass_keyword');
		$segment = json_decode($segment,true);
		self::$view_data['rolelist'] = $roleinfo;
		self::$view_data['log_userinfo'] = $userinfo;
		self::$view_data['keyword'] = $segment;
		self::$view_data['leftMenu'] = $leftMenu;
		self::$view_data['checkWord'] = $keyWord;
		return $this->load->view('adminpc/common/header',self::$view_data);
	}

	/**
	 * @author  gf
	 * 公共底部
	 */
	public function adminFooter()
	{
		return $this->load->view('adminpc/common/footer',self::$view_data);
	}

	/**
	 * 面包屑导航
	 * @param string $keyWord
	 * @return mixed
	 */
	public function breadcrumb($keyWord = '')
	{
		$keyWord = trim($keyWord);
		$condition['keyWord'] = $keyWord;
		$breadNav = $this->linkadmin->getLinkById($condition);

		$param['linkId'] = $breadNav['parentId'];
		$pLink = $this->linkadmin->getLinkById($param);
		self::$view_data['pLink'] = $pLink;
		self::$view_data['sLink'] = $breadNav;
		return $this->load->view('adminpc/common/breadcrumb',self::$view_data);
	}

	/**
	 *  分页
	 * */
	public function create_page($base_url, $count_all, $per_page, $uri_segment = 4, $num_links = 5)
	{
		$this->load->library('pagination');
		$config['base_url'] = base_url($base_url); // 分页链接
		$config['total_rows'] = $count_all; // 总数据条数
		$config['per_page'] = $per_page; // 每页显示数量
		$config['use_page_numbers'] = FALSE; // 默认分页URL中是显示每页记录数,启用use_page_numbers后显示的是当前页码
		$config['first_link'] = '<span aria-hidden="true">&laquo;</span>'; // 自定义 首页名称
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['next_link'] = '<span aria-hidden="true">&gt;</span>'; // 自定义 下一页名称
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '<span aria-hidden="true">&lt;</span>'; // 自定义 上一页名称
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['last_link'] = '<span aria-hidden="true">&raquo;</span>'; // 自定义 末页名称
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['display_pages'] = TRUE; // 是否显示数字链接
		$config['uri_segment'] = $uri_segment; // 指定index.php后第几位是分页数
		$config['num_links'] = $num_links; // 指定当前页前后各显示几页
		$config['cur_tag_open'] = '<li><a class="active">'; // 选中页码标签开始
		$config['cur_tag_close'] = '</a></li>'; // 选中页码标签结束
		$config['num_tag_open'] = '<li>'; // 自定义数字链接
		$config['num_tag_close'] = '</li>'; // 自定义数字链接
		$this->pagination->initialize($config);
		return true;
	}

	/**
	 * 处理参数
	 * */
	public function dealparam($param)
	{

		$url = array();
		if(!empty($param)){
			foreach ($param as $k=>$v)
			{
				if($v !== '')
				{
					$url[] = $k.'='.$v;
				}
			}
		}
		return !empty($url) ? implode('&', $url) : '';
	}

}
