<div class="right-contents"  id="right-contents">
	<h3 class="text-left"><?php echo !empty($title) ? $title : '';?></h3>
                            <!--错误提示-->
	<div class="alert alert-warning alert-dismissible" role="alert" style="display:none" id="warningmsg">
    	<div id="msglinkadmin"><strong>Warning!</strong> Better check yourself, you're not looking too good.</div>
    </div>
    <form class="form-horizontal hor" method="post" action="<?php echo $this->config->item('base_url').'/adminpc/Roleadmin/OpRoleadmin';?>" enctype="multipart/form-data" name="myform" id="myform">
                                    
                                    <div class="form-group hor">
                                        <label for="typeName" class="control-label col-md-3">角色名称：</label>
                                        <div class="col-md-3">
                                            <input type="text" name="roleName" id="roleName" class="form-control" maxlength="15" value="<?php echo !empty($info['roleName']) ? $info['roleName'] : '';?>"/>
                                            <input type="hidden" name="roleId" id="roleId" value="<?php echo !empty($info['roleId']) ? $info['roleId'] : '';?>" />
                                            <input type="hidden" name="roleName2" id="roleName2" value="<?php echo !empty($info['roleName']) ? $info['roleName'] : '';?>" />
                                        </div>
                                    </div>
                                    <div class="form-group hor">
                                        <label for="isShow" class="control-label col-md-3">是否显示：</label>
                                        <div class="col-md-3">
                                            <label>
                                              <input type="radio"  class="form-control"  name="isShow" id="isShow" value="0" id="isShow" <?php if($info['isShow'] == 0){?>checked="checked"<?php }?>/>
                                              显示</label>
                                            <label>
                                              <input type="radio"  class="form-control"  name="isShow" value="1"  <?php if($info['isShow'] == 1){?>checked="checked"<?php }?>/>
                                              隐藏</label>
                                        </div>
                                    </div>
                                    <div class="form-group hor">
                                        <label for="typeContents" class="control-label col-md-3">角色描述：</label>
                                        <div class="col-md-3">
                                        	<textarea class="form-control" name="roleContents" id="roleContents" maxlength="200"><?php echo !empty($info['roleContents']) ? $info['roleContents'] : '';?></textarea> 
                                        </div>
                                    </div>    
                                     <div class="form-group hor">
                                        <label for="typeName" class="control-label col-md-3">排序：</label>
                                        <div class="col-md-1">
                                            <input type="text" name="displayOrder" id="displayOrder" class="form-control" maxlength="15" value="<?php echo !empty($info['displayOrder']) ? $info['displayOrder'] : '';?>"/>
                                        </div>
                                    </div>   
                                    <div class="form-group hor">
                                        <div class="control-label col-md-5">
                                            <button type="submit" class="btn btn-primary"   onclick="javascript:return checkButton()">提交</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                        </div>
                                    </div>                          
                                    
                                </form>                               
</div>
<script type="text/javascript">
function checkButton(){
	var roleName = $("#roleName").val();
	var roleName2 = $("#roleName2").val();
    if(roleName == '')
    {
     	warning('<strong>错误：</strong>&nbsp;&nbsp;角色名称不能为空');return false;
    }
	
	if(roleName != roleName2)
	{
		$.ajax
		({ //一个Ajax过程
		type: "post", //以post方式与后台沟通
		url : "<?php echo $this->config->item('base_url').'/adminpc/Roleadmin/ajaxCheckRole';?>", //与此php页面沟通
		dataType:'json',//从php返回的值以 JSON方式 解释
		async:false,
		data: 'roleName='+roleName,
		success: function(response)
		{//如果调用php成功
			res = response;
		}
		});
		if(res.err == 1)
		{
			warning('<strong>错误：</strong>&nbsp;&nbsp;角色已存在，请重新输入');return false;
		}
	}
	

	var roleContents = $("#roleContents").val();
	if(roleContents == '')
    {
     	warning('<strong>错误：</strong>&nbsp;&nbsp;角色描述不能为空');return false;
    }
	
	displayOrder = $("#displayOrder").val();
	if(displayOrder == '')
    {
     	warning('<strong>错误：</strong>&nbsp;&nbsp;排序不能为空');return false;
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