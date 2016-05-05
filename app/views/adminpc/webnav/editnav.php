<div class="right-contents"  id="right-contents">
	<h3 class="text-left">编辑导航</h3>
                            <!--错误提示-->
	<div class="alert alert-warning alert-dismissible" role="alert" style="display:none" id="warningmsg">
    	<div id="msglinkadmin"><strong>Warning!</strong> Better check yourself, you're not looking too good.</div>
    </div>
    <form class="form-horizontal hor" method="post" action="<?php echo $this->config->item('base_url').'/adminpc/Webnav/opWebnav';?>" enctype="multipart/form-data" name="myform" id="myform">
                                    
                                  <div class="form-group hor">
                                        <label for="navName" class="control-label col-md-2">导航名称：</label>
                                        <div class="col-md-3">
                                            <input type="text" name="navName" id="navName" class="form-control" maxlength="15" value="<?php echo !empty($info['navName']) ? $info['navName'] : '';?>"/>
                                            <input type="hidden" name="navName2" id="navName2" value="<?php echo !empty($info['navName']) ? $info['navName'] : '';?>" />
                                            <input type="hidden" name="navId" id="navId" value="<?php echo !empty($info['navId']) ? $info['navId'] : 0;?>" />
                                        </div>
                                    </div>
                                    <div class="form-group hor">
                                        <label for="navType" class="control-label col-md-2">显示位置：</label>
                                        <div class="col-md-3">
                                            <label>
                                              <input type="radio"  class="form-control"  name="navType" id="isShow" value="0"  <?php if($info['navType'] == 0){?>checked="checked"<?php }?>/>
                                              顶部导航</label>
                                            <label>
                                              <input type="radio"  class="form-control"  id="isShow" name="navType"  value="1" <?php if($info['navType'] == 1){?>checked="checked"<?php }?>/>
                                              底部导航</label>
                                        </div>
                                    </div>
                                    <div class="form-group hor">
                                        <label for="navUrl" class="control-label col-md-2">导航链接：</label>
                                        <div class="col-md-3">
                                        	<input type="text" name="navUrl" id="navUrl" class="form-control"  value="<?php echo !empty($info['navUrl']) ? $info['navUrl'] : '';?>"/>
                                        </div>
                                    </div>    
                                     <div class="form-group hor">
                                        <label for="typeName" class="control-label col-md-2">导航关键字：</label>
                                        <div class="col-md-3">
                                            <input type="text" name="navKeyWord" id="navKeyWord" class="form-control" maxlength="40" value="<?php echo !empty($info['navKeyWord']) ? $info['navKeyWord'] : '';?>"/>
                                            <input type="hidden" name="navKeyWord2" id="navKeyWord2" value="<?php echo !empty($info['navKeyWord']) ? $info['navKeyWord'] : '';?>">
                                        </div>
                                    </div>
                                    <div class="form-group hor">
                                        <label for="typeName" class="control-label col-md-2">导航排序：</label>
                                        <div class="col-md-3">
                                            <input type="text" name="navSort" id="navSort" class="form-control" maxlength="40" value="<?php echo !empty($info['navSort']) ? $info['navSort'] : '';?>"/>
                                        </div>
                                    </div>                           
                                    <div class="form-group">
                                        <div class="control-label col-md-3">
                                            <button type="submit" class="btn btn-primary" onclick="javascript:return checkButton()">提交</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                        </div>
		</div>          
</div>

<script>
function checkButton(){
	var navName = $("#navName").val();
	var navName2 = $("#navName2").val();
	var navType = $('input[name="navType"]:checked ').val();
	var res = '';
    if(navName == '')
    {
     	warning('<strong>错误：</strong>&nbsp;&nbsp;导航名称不能为空');return false;
    }
	if(navName != navName2)
	{
		$.ajax
		({ //一个Ajax过程
		type: "post", //以post方式与后台沟通
		url : "<?php echo $this->config->item('base_url').'/adminpc/Webnav/ajaxWebnav';?>", //与此php页面沟通
		dataType:'json',//从php返回的值以 JSON方式 解释
		async:false,
		data: {'navName':navName,'navType':navType},
		success: function(response)
		{//如果调用php成功
			res = response;
		}
		});
		if(res.err == 1)
		{
			warning('<strong>错误：</strong>&nbsp;&nbsp;该栏目下已存在该导航，请重新输入');return false;
		}	
	}
	
	var navUrl = $("#navUrl").val();
	if(navUrl == '')
	{
		warning('<strong>错误：</strong>&nbsp;&nbsp;导航链接不能为空，请重新输入');return false;
	}
	
	
	var navKeyWord = $("#navKeyWord").val();
	var navKeyWord2 = $("#navKeyWord2").val();
	if(navKeyWord == '')
	{
		warning('<strong>错误：</strong>&nbsp;&nbsp;导航关键字不能为空，请重新输入');return false;
	}
	if(navKeyWord != navKeyWord2)
	{
		$.ajax
		({ //一个Ajax过程
		type: "post", //以post方式与后台沟通
		url : "<?php echo $this->config->item('base_url').'/adminpc/Webnav/ajaxWebnav';?>", //与此php页面沟通
		dataType:'json',//从php返回的值以 JSON方式 解释
		async:false,
		data: {'navKeyWord':navKeyWord},
		success: function(response)
		{//如果调用php成功
			res = response;
		}
		});
		if(res.err == 1)
		{
			warning('<strong>错误：</strong>&nbsp;&nbsp;关键字已存在，请重新输入');return false;
		}	
	}
	
	
	var navSort = $("#navSort").val();
	if(navSort == '')
	{
		warning('<strong>错误：</strong>&nbsp;&nbsp;排序不能为空，请重新输入');return false;
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

function showNavInfo()
{
	$("#showNavInfo").modal('show');
}
</script>