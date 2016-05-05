<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Fastdfsclient
{
	private $tracker = array();
	private $server = array();
	private $storage = array();
	public function __construct()
	{
		/* $this->tracker = fastdfs_tracker_get_connection();
		if(empty($this->tracker)){
			throw new Exception('tracker为空');
		}
		
		$this->server = fastdfs_connect_server($this->tracker['ip_addr'], $this->tracker['port']);
		$this->storage = fastdfs_tracker_query_storage_store();

		$this->server = fastdfs_connect_server($this->storage['ip_addr'], $this->storage['port']);
		if (!$this->server){
			error_log("errno1: " . fastdfs_get_last_error_no() . ", error info: " . fastdfs_get_last_error_info());
			exit(1);
		}

		$this->storage['sock'] = $this->server['sock']; */
	}
	
	public function gettracke()
	{
		$this->tracker = fastdfs_tracker_get_connection();
		if(empty($this->tracker)){
			throw new Exception('tracker为空');
		}
		
		$this->server = fastdfs_connect_server($this->tracker['ip_addr'], $this->tracker['port']);
		$this->storage = fastdfs_tracker_query_storage_store();
		
		$this->server = fastdfs_connect_server($this->storage['ip_addr'], $this->storage['port']);
		if (!$this->server){
			error_log("errno1: " . fastdfs_get_last_error_no() . ", error info: " . fastdfs_get_last_error_info());
			exit(1);
		}
		
		$this->storage['sock'] = $this->server['sock'];
	}
	
	/**
	 * 上传主文件
	 * */
	public function fdfs_upload($file_name)
	{
		$this->gettracke();
		$file_info = fastdfs_storage_upload_by_filename($file_name, null, array(), null, $this->tracker, $this->storage);
		 
		if($file_info){
			$group_name = $file_info['group_name'];
			$remote_filename = $file_info['filename'];

			$i = fastdfs_get_file_info($group_name, $remote_filename);
			$storage_ip = $i['source_ip_addr'];
			//var_dump($file_info);
			return array('filename'=>$group_name.'/'.$remote_filename,'sourcefile'=>$remote_filename, 'group_name'=>$group_name, 'source_ip_addr'=>$storage_ip, 'tmpfilename'=>$file_name);
		}
		return false;
	}
	
	/**
	 * 上传从文件
	 * */
	public function fdfs_upload_slave($lessfilename ,$group_name, $mainfilename, $keyword)
	{
		$this->gettracke();
		$thumbnail_info = fastdfs_storage_upload_slave_by_filename($lessfilename, $group_name, $mainfilename, $keyword);
		if($thumbnail_info){
			$group_name = $thumbnail_info['group_name'];
			$remote_filename = $thumbnail_info['filename'];
		
			$i = fastdfs_get_file_info($group_name, $remote_filename);
			$storage_ip = $i['source_ip_addr'];
			//var_dump($file_info);
			return array('filename'=>$group_name.'/'.$remote_filename,'sourcefile'=>$remote_filename, 'group_name'=>$group_name, 'source_ip_addr'=>$storage_ip);
		}
		return false;
	}

	/**
	 * 下载文件
	 * */
	public function fdfs_down($group_name, $file_id)
	{
		$this->gettracke();
		$file_content = fastdfs_storage_download_file_to_buff($group_name, $file_id);
		return $file_content;
	}

	/**
	 * 删除文件
	 * */
	public function fdfs_del($group_name, $file_id)
	{
		$this->gettracke();
		$bool = fastdfs_storage_delete_file($group_name, $file_id);
		return $bool;
	}
	
	public function __destruct()
	{		
		fastdfs_tracker_close_all_connections();
	}
}

