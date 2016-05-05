<?php
// 处理支持 ajax 上传的浏览器上传的文件
class Uploader_xhr
{
	public function __construct(){}
	// 保存文件到指定路径
    public function save($path)
    {    
        $input = fopen("php://input", "r");
        $temp = tmpfile();
        $size = stream_copy_to_stream($input, $temp);
        fclose($input);
        
        if ($size != $this->get_file_size()){            
            return false;
        }
        
        $target = fopen($path, "w");        
        fseek($temp, 0, SEEK_SET);
        stream_copy_to_stream($temp, $target);
        fclose($target);
        
        return true;
    }

	// 获取文件名: 客户端原文件名
	public function get_file_name()
	{
        return $_GET['qqfile'];
    }

	// 获取文件大小，整型数字
	public function get_file_size()
	{
		if(isset($_SERVER["CONTENT_LENGTH"]))
		{
			return (int)$_SERVER["CONTENT_LENGTH"];         
		}
		else
		{
			throw new Exception('不支持获取文件大小.');
		}
	}
}
