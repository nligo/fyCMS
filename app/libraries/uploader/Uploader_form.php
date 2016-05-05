<?php
// 处理普通 form 上传的文件
class Uploader_form
{
	public function __construct(){}
	// 保存文件到指定路径
    public function save($path)
	{
        return move_uploaded_file($_FILES['qqfile']['tmp_name'], $path);
    }

	// 获取文件名: 客户端原文件名
    public function get_file_name()
	{
        return $_FILES['qqfile']['name'];
    }

	// 获取文件大小，整型数字
	public function get_file_size() {
        return $_FILES['qqfile']['size'];
    }
}
