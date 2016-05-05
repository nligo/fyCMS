<script type="text/javascript" src="<?php echo $this->config->item('base_url');?>/public/ueditor/ueditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="<?php echo $this->config->item('base_url');?>/public/ueditor/ueditor.all.js"></script>
<div class="right-contents" id="right-contents">
	<?php if(!empty($info)){?>
    <h3 class="text-left"><button class="btn btn-lg btn-info">编辑新闻</button></h3>
    <?php }else{?>
    <h3 class="text-left"><button class="btn btn-lg btn-info">发布新闻</button></h3>
	<?php }?>
    <div class="alert alert-warning alert-dismissible" role="alert" style="display:none" id="warningmsg">
    	<div id="msglinkadmin"><strong>Warning!</strong> Better check yourself, you're not looking too good.</div>
    </div>
	<form class="form-horizontal  hor" method="post" action="<?php echo $this->config->item('base_url').'/adminpc/News/opNews';?>" enctype="multipart/form-data" name="myform" id="myform">
		<div class="form-group hor">
			<label for="goodsTitle" class="control-label col-md-2">新闻标题：</label>
			<div class="col-md-8">
				<input type="text" name="newsTitle" id="newsTitle" class="form-control" maxlength="50" placeholder="请输入新闻标题" value="<?php echo !empty($info['newsTitle']) ? $info['newsTitle'] : '';?>"/>
			</div>
		</div>
		<div class="form-group hor">
			<label for="newsSource" class="control-label col-md-2">新闻来源:</label>
			<div class="col-md-2">
				<input type="text" name="newsSource" class="form-control"  id="newsSource" maxlength="15" value="<?php echo !empty($info['newsSource']) ? $info['newsSource'] : '';?>"  placeholder="请输入新闻来源" />
                <input type="hidden" name="newsId" id="newsId" value="<?php echo !empty($info['newsId']) ? $info['newsId'] : 0;?>" />
			</div>
		</div>                 
        <div class="form-group">
                <label for="CoverImgPath" class="col-sm-2 control-label"><span class="xx">*</span>新闻封面图:</label>
                <div class="col-sm-5 clearfix">
                        <img src="<?php echo !empty($info['CoverImgPath']) ? $this->config->item('base_url').$info['CoverImgPath'] : $this->config->item('base_url').'/public/admin/img/noimg_160.gif' ;?>" width="260" height="180" class="img" id="CoverImgPath">
                        <input type="file" class="form-control" id="CoverImgPath" name="CoverImgPath">
                        <input type="hidden" name="oldNewsCover" id="oldNewsCover" value="<?php echo !empty($info['CoverImgPath']) ? $info['CoverImgPath'] : '';?>" />
                </div>
		 </div>     
		<div class="form-group">
			<label for="linkUrl" class="control-label col-md-2">新闻内容：</label>
			<div class="col-md-2">
				<script id="newsContents" name="newsContents" type="text/plain" width="500">
         <?php echo !empty($info['newsContents']) ? $info['newsContents'] : '';?>
    </script>
			</div>
		</div>                            
		<div class="form-group">
			<div class="control-label col-md-3">
				<button type="submit" class="btn btn-primary" onclick="javascript:return checkButton()">提交</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
			</div>
		</div>                            
	</form>            
</div>   
<script type="text/javascript">
	$('input[name="CoverImgPath"]').on('change',function() {
		
		if(typeof this.files == 'undefined'){
			return;
		}
		var img		 = this.files[0];//获取图片信息
		var type		 = img.type;//获取图片类型，判断使用
		var url		 = getObjectURL(this.files[0]);//使用自定义函数，获取图片本地url
		var fd			 = new FormData();//实例化表单，提交数据使用
		fd.append('img',img);//将img追加进去
		if(url)
			$('#CoverImgPath').attr('src',url).show();//展示图片
		if(type.substr(0,5) != 'image'){//无效的类型过滤
			alert('非图片类型，无法上传！');
			return;
		}
	});
	
	//自定义获取图片路径函数
	function getObjectURL(file) {
		var url = null ;
		if (window.createObjectURL!=undefined) { // basic
			url = window.createObjectURL(file) ;
		} else if (window.URL!=undefined) { // mozilla(firefox)
			url = window.URL.createObjectURL(file) ;
		} else if (window.webkitURL!=undefined) { // webkit or chrome
			url = window.webkitURL.createObjectURL(file) ;
		}
		return url ;
	}
</script>
<script type="text/javascript">
	var ue = UE.getEditor('newsContents');
</script>
<script type="text/javascript">
function checkButton(){
	var newsTitle = $("#newsTitle").val();
    if(newsTitle == '')
    {
     	warning('<strong>错误：</strong>&nbsp;&nbsp;新闻标题不能为空');return false;
    }
    if(newsTitle.length>50)
    {
     	warning('<strong>错误：</strong>&nbsp;&nbsp;标题不能超过50个字');return false;
    }
	
	var newsSource = $("#newsSource").val();
    if(newsSource == '')
    {
     	warning('<strong>错误：</strong>&nbsp;&nbsp;新闻来源不能为空');return false;
    }

	if(ue == '')
	{
		warning('<strong>错误：</strong>&nbsp;&nbsp;新闻内容不能为空');return false;
	}
 	$('#myform').submit(function (){
 		$(this).serialize();
 	});
 }
 	     
function warning(a)
{
	$('#msglinkadmin').html(a);
	$('#warningmsg').show();
}

</script>                         