<link rel="stylesheet" href="<?php echo $this->config->item('base_url').'/public/reg/'?>css/normalize.css">
      <link rel="stylesheet" href="<?php echo $this->config->item('base_url').'/public/reg/'?>css/bootstrap.offcanvas.min.css">

    <link rel="stylesheet" href="<?php echo $this->config->item('base_url').'/public/reg/'?>css/font-awesome/font-awesome.css" type="text/css" charset="utf-8">

<div class="right-contents" id="right-contents">
	<?php if(!empty($info)){?>
    <h3 class="text-left"><button class="btn btn-lg btn-info">编辑商品</button></h3>
    <?php }else{?>
    <h3 class="text-left"><button class="btn btn-lg btn-info">添加商品</button></h3>
	<?php }?>
    <div class="alert alert-warning alert-dismissible" role="alert" style="display:none" id="warningmsg">
    	<div id="msglinkadmin"><strong>Warning!</strong> Better check yourself, you're not looking too good.</div>
    </div>
	<form class="form-horizontal  hor" method="post" action="<?php echo $this->config->item('base_url').'/adminpc/Goodsinfo/opGoods';?>" enctype="multipart/form-data" name="myform" id="myform">
		<div class="form-group hor">
			<label for="goodsTitle" class="control-label col-md-2">商品名称：</label>
			<div class="col-md-2">
				<input type="text" name="goodsTitle" id="goodsTitle" class="form-control" maxlength="20" placeholder="请输入商品名称" value="<?php echo !empty($info['goodsTitle']) ? $info['goodsTitle'] : '';?>"/>
			</div>
		</div>
		<div class="form-group hor">
			<label for="goodsPrice" class="control-label col-md-2">商品价格:</label>
			<div class="col-md-2">
				<input type="text" name="goodsPrice" class="form-control"  id="goodsPrice" maxlength="15" value="<?php echo !empty($info['goodsPrice']) ? $info['goodsPrice'] : '';?>"/>
                <input type="hidden" name="goodsId" id="goodsId" value="<?php echo !empty($info['goodsId']) ? $info['goodsId'] : 0;?>" />
			</div>
		</div>
        <div class="form-group hor">
			<label for="goodsStock" class="control-label col-md-2">商品库存:</label>
			<div class="col-md-2">
				<input type="text" name="goodsStock" class="form-control"  id="goodsStock" maxlength="15" value="<?php echo !empty($info['goodsStock']) ? $info['goodsStock'] : '';?>"/>
			</div>
		</div>
        <?php if(!empty($info['isshow'])){?>                 
		<div class="form-group">
			<label for="goodsStock" class="control-label col-md-2">商品状态：</label>
			<div class="col-md-2">
				<label>
					<input type="radio" name="isShow" value="1" id="isShow1"<?php if($info['isshow'] == 1){echo ' checked="checked"';}?>/>上架
			  	</label>
				<label>
					<input type="radio" name="isShow" value="2" id="isShow2" <?php if($info['isshow'] == 2){echo 'checked="checked"';}?>/>未上架
				</label>
				<label>
					<input type="radio" name="isShow" value="3" id="isShow3" <?php if($info['isshow'] == 3){echo 'checked="checked"';}?>/>下架
				</label>
			</div>
		</div>
        <?php }else{?>
        <div class="form-group">
			<label for="goodsStock" class="control-label col-md-2">商品状态：</label>
			<div class="col-md-2">
				<label>
					<input type="radio" name="isShow" value="1" id="isShow1" checked="checked"/>上架
			  	</label>
				<label>
					<input type="radio" name="isShow" value="2" id="isShow2"/>未上架
				</label>
				<label>
					<input type="radio" name="isShow" value="3" id="isShow3"/>下架
				</label>
			</div>
		</div>
        <?php }?> 
		<div class="form-group">
			<label for="linkUrl" class="control-label col-md-2">所属分类：</label>
			<div class="col-md-2">
				<select name="typeId" id="typeId">
				<?php if(!empty($typelist)) foreach($typelist as $k=>$v){?>
					<option value="<?php echo !empty($v['typeId']) ? $v['typeId'] : '';?>" <?php if(!empty($info['typeId']) && $info['typeId'] == $v['typeId']){echo 'selected';}?>><?php echo !empty($v['typeName']) ? $v['typeName'] : '';?></option>
				<?php }?>
				</select>
			</div>
		</div>
        <div class="form-group">
                <label for="goodsCover" class="col-sm-2 control-label"><span class="xx">*</span>商品封面图:</label>
                <div class="col-sm-5 clearfix">
                        <img src="<?php echo !empty($info['goodsCover']) ? $this->config->item('base_url').$info['goodsCover'] : $this->config->item('base_url').'/public/admin/img/noimg_160.gif' ;?>" width="260" height="180" class="img" id="goodsCover">
                        <input type="file" class="form-control" id="goodsCover" name="goodsCover">
                        <input type="hidden" name="oldGoodsCover" id="oldGoodsCover" value="<?php echo !empty($info['goodsCover']) ? $info['goodsCover'] : '';?>" />
                </div>
		 </div>     
		<div class="form-group">
			<label for="linkUrl" class="control-label col-md-2">商品描述：</label>
			<div class="col-md-2">
				<textarea name="goodsConents" id="goodsConents"><?php echo !empty($info['goodsContents']) ? $info['goodsContents'] : '';?></textarea>
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
	$('input[name="goodsCover"]').on('change',function() {
		
		if(typeof this.files == 'undefined'){
			return;
		}
		var img		 = this.files[0];//获取图片信息
		var type		 = img.type;//获取图片类型，判断使用
		var url		 = getObjectURL(this.files[0]);//使用自定义函数，获取图片本地url
		var fd			 = new FormData();//实例化表单，提交数据使用
		fd.append('img',img);//将img追加进去
		if(url)
			$('#goodsCover').attr('src',url).show();//展示图片
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
function checkButton(){
	var goodsTitle = $("#goodsTitle").val();
    if(goodsTitle == '')
    {
     	warning('<strong>错误：</strong>&nbsp;&nbsp;商品名称不能为空');return false;
    }
    if(goodsTitle.length>20)
    {
     	warning('<strong>错误：</strong>&nbsp;&nbsp;商品名称不能超过20个字');return false;
    }
	var goodsPrice = $("#goodsPrice").val();
	var isNum = /^\d+(\.\d+)?$/;
    if(goodsPrice == '')
    {
     	warning('<strong>错误：</strong>&nbsp;&nbsp;商品价格不能为空');return false;
    }
	if(isNum.test(goodsPrice) == false)
	{
		warning('<strong>错误：</strong>&nbsp;&nbsp;请输入正确的金额');return false;
	}
	var goodsStock = $("#goodsStock").val();
    if(goodsStock == '')
    {
     	warning('<strong>错误：</strong>&nbsp;&nbsp;请输入商品库存');return false;
    }
	if(isNum.test(goodsStock) == false)
	{
		warning('<strong>错误：</strong>&nbsp;&nbsp;请输入正确的库存');return false;
	}
	var goodsConents = $('#goodsConents').val();
	if(goodsConents == '')
	{
		warning('<strong>错误：</strong>&nbsp;&nbsp;商品描述不能为空');return false;
	}
	if(goodsConents.length > 200)
	{
		warning('<strong>错误：</strong>&nbsp;&nbsp;商品描述超过200字');return false;
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