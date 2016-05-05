<div class="right-contents"   id="right-contents">

	<h3 class="text-left"><button class="btn btn-lg btn-info">用户信息</button></h3>
	<div class="alert alert-warning alert-dismissible" role="alert" style="display:none" id="warningmsg">
                                    <div id="msglinkadmin"><strong>Warning!</strong> Better check yourself, you're not looking too good.</div>
                                </div>
<form class="form-horizontal hor" method="post" action="<?php echo $this->config->item('base_url').'/adminpc/User/opUser';?>" enctype="multipart/form-data" name="myform" id="myform">
									<div class="form-group hor">
                                        <label for="userNickName" class="control-label col-md-2">用户ID：</label>
                                            <span><?php echo !empty($info['userId']) ? $info['userId'] : '';?></span>
                                    </div>
                                    <div class="form-group hor">
                                        <label for="userNickName" class="control-label col-md-2">用户昵称<small>(手机号码)</small>：</label>
                                            <span><?php echo !empty($info['userNickName']) ? $info['userNickName'] : '';?></span>
                                    </div>
                                    <div class="form-group hor">
                                        <label for="userNickName" class="control-label col-md-2">用户角色：</label>
                                            <span><?php echo !empty($info['roleName']) ? $info['roleName'] : '';?></span>
                                    </div>
                                    <div class="form-group hor">
                                        <label for="userNickName" class="control-label col-md-2">用户姓名：</label>
                                            <span><?php echo !empty($info['userRealName']) ? $info['userRealName'] : '';?></span>
                                    </div>
                                    <div class="form-group hor">
                                        <label for="userNickName" class="control-label col-md-2">用户邮箱：</label>
                                            <span><?php echo !empty($info['userEmail']) ? $info['userEmail'] : '';?></span>
                                    </div>
                                    <div class="form-group hor">
                                        <label for="userNickName" class="control-label col-md-2">用户性别：</label>
                                            <span>
												<?php
												if($info['userSex'] == 0)
												{
													echo '男性';
												}	
												elseif($info['userSex'] == 1)
												{
													echo '女性';
												}
												else
												{
													echo '未公开';		
												}
												?>
                                            </span>
                                    </div>                              
                                    <div class="form-group hor">
                                        <label for="userNickName" class="control-label col-md-2">创建时间：</label>
                                            <span><?php echo !empty($info['createTime']) ? date('Y-m-d H:i',$info['createTime']) : '';?></span>
                                    </div>
                                    <div class="form-group hor">
                                      
                                        <div class="control-label col-md-3">
                                        <a href="<?php echo $this->config->item('base_url').'/adminpc/User/resetPass/'.$info['userId']?>" onclick="return confirm('确认重置该用户的密码吗？');"  class="btn btn-danger">重置密码</a>
                                        </div>
                                    </div>
                                </form>    
</div>
<script type="text/javascript">
function checkButton(){
	var res = '';
	var userNickName = $("#userNickName").val();
    if(userNickName == '')
    {
     	warning('<strong>错误：</strong>&nbsp;&nbsp;用户名不能为空');return false;
    }
    if(userNickName.length>15)
    {
     	warning('<strong>错误：</strong>&nbsp;&nbsp;用户名不能超过15个字');return false;
    }
	var reg = /^0?1[3|4|5|8][0-9]\d{8}$/;
	if(reg.test(userNickName) == false)
	{
		warning('<strong>错误：</strong>&nbsp;&nbsp;手机号码格式不正确');return false;
	}
	$.ajax
		({ //一个Ajax过程
		type: "post", //以post方式与后台沟通
		url : "<?php echo $this->config->item('base_url').'/adminpc/User/ajaxCheck';?>", //与此php页面沟通
		dataType:'json',//从php返回的值以 JSON方式 解释
		async:false,
		data: 'userNickName='+userNickName,
		success: function(response)
		{//如果调用php成功
			res = response;
		}
		});
		if(res.err == 1)
		{
			warning('<strong>错误：</strong>&nbsp;&nbsp;手机号已存在，请重新输入号码');return false;
		}
	var userPassWordF = $("#userPassWordF").val();
	var passRes = /^[0-9a-zA-Z]+$/;
    if(userPassWordF == '')
    {
     	warning('<strong>错误：</strong>&nbsp;&nbsp;密码不能为空');return false;
    }
	if(userPassWordF.length<6)
	{
			warning('<strong>错误：</strong>&nbsp;&nbsp;密码不能小于6位数');return false;
	}
	if(userPassWordF.length>15)
	{
			warning('<strong>错误：</strong>&nbsp;&nbsp;密码不能大于15位数');return false;
	}
	if(passRes.test(userPassWordF) == false)
	{
		warning('<strong>错误：</strong>&nbsp;&nbsp;密码只能设为字母跟数字');return false;
	}
	var userPassWordS = $("#userPassWordS").val();
    if(userPassWordS == '')
    {
     	warning('<strong>错误：</strong>&nbsp;&nbsp;请核对密码');return false;
    }
	if(userPassWordF != userPassWordS)
	{
		warning('<strong>错误：</strong>&nbsp;&nbsp;两次密码不一致');return false;
	}
	var userRealName = $('#userRealName').val();
	var nameReg = /^[a-zA-Z\u4e00-\u9fa5]+$/; 
	if(userRealName == '')
	{
		warning('<strong>错误：</strong>&nbsp;&nbsp;真实姓名不能为空');return false;
	}
	if(nameReg.test(userRealName) == false)
	{
		warning('<strong>错误：</strong>&nbsp;&nbsp;姓名只能为英文或中文');return false;
	} 
	
	var emailRes = '';
	var userEmail = $('#userEmail').val();
	if(userEmail == '')
	{
		warning('<strong>错误：</strong>&nbsp;&nbsp;邮箱不能为空');return false;
	}
	$.ajax
		({ //一个Ajax过程
		type: "post", //以post方式与后台沟通
		url : "<?php echo $this->config->item('base_url').'/adminpc/User/ajaxCheck';?>", //与此php页面沟通
		dataType:'json',//从php返回的值以 JSON方式 解释
		async:false,
		data: 'userEmail='+userEmail,
		success: function(response)
		{//如果调用php成功
			emailRes = response;
		}
		});
		if(emailRes.err == 1)
		{
			warning('<strong>错误：</strong>&nbsp;&nbsp;邮箱已经存在，请重新输入');return false;
		}
	
	var roleId = $('#roleId').val();
	if(roleId == 0)
	{
		warning('<strong>错误：</strong>&nbsp;&nbsp;请选择角色');return false;
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