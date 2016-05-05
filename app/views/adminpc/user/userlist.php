<div class="right-contents"  id="right-contents">
	
		
    <!--搜索查询-->
    <div>
    	<form class="well form-inline" action="<?php echo $this->config->item('base_url').'/adminpc/User/index'?>" method="post" name="searchform" id="searchform">
        	<div class="form-group">
                <label class="userId">用户ID:</label>
                <input type="text" class="input-small" placeholder="索引用户ID"  name="userId" id="userId" value="<?php echo !empty($param['userId']) ? $param['userId'] : '';?>">
            </div> 
            <div class="form-group">
                <label class="userId">用户名:</label>
                <input type="text" class="input" placeholder="用户名或手机号"  name="userNickName" value="<?php echo !empty($param['userNickName']) ? $param['userNickName'] : '';?>">
            </div> 
            <div class="form-group">
                <label class="userId">选择角色:</label>
				<select class="input" name="roleId">
                	<option value="0" <?php if($param['roleId'] == 0){echo 'selected';}?>>请选择角色</option>
                    <?php if(!empty($rolelist)) foreach($rolelist as $k=>$v){?>
                    <option value="<?php echo !empty($v['roleId']) ? $v['roleId'] : '';?>" <?php if($param['roleId'] == $v['roleId']){echo 'selected';}?>><?php echo !empty($v['roleName']) ? $v['roleName'] : '';?></option>
                    <?php }?>
				</select>
            </div>    
                <button type="submit" class="btn btn-primary">查询</button>
                <button type="button" class="btn btn-success" style="float:right" id="modal-356218" onClick="showOpUser()">添加用户</button>
			</form>
	</div> 
    <div class="table-responsive clearfix" >
			<table class="table table-striped">
				<thead>
					<tr>
						<th>
							用户ID
						</th>
						<th>
							用户名<small>（手机号）</small>
						</th>
						<th>
							真实姓名
						</th>
                        <th>
							用户性别
						</th>
                        <th>
							注册时间
						</th>
						<th>
							操作
						</th>
					</tr>
				</thead>
				<tbody>
                <?php if($userlist) foreach($userlist as $key=>$val){?>
					<tr class="info">
						<td>
							<?php echo !empty($val['userId']) ? $val['userId'] : '';?>
						</td>
						<td>
							<?php echo !empty($val['userNickName']) ? $val['userNickName'] : '';?>
						</td>
						<td>
							<?php echo !empty($val['userRealName']) ? $val['userRealName'] : '';?>:
                            (<small><?php echo empty($val['roleInfo']) ? '' : $val['roleInfo']['roleName']?></small>)
						</td>
                        <td>
							<?php
							if($val['userSex']==0)
							{
								echo'男';
							}
							elseif($val['userSex'] == 1)
							{
								echo '女';
							}
							else
							{
								echo '保密';
							}
							;?>
						</td>
                        <td>
							<?php echo !empty($val['createTime']) ? date('Y-m-d H:i',$val['createTime']) : '';?>
						</td>
						<td>
							<a href="<?php echo $this->config->item('base_url').'/adminpc/User/resetPass/'.$val['userId']?>" onclick="return confirm('确认重置该用户的密码吗？');">重置密码</a>
                            <a href="<?php echo $this->config->item('base_url').'/adminpc/User/editUser/'.$val['userId']?>">查看用户</a>
						</td>
					</tr>
                 <?php }?>   
					
				</tbody>
			</table>
		</div>
        <!--分页start-->
            <nav data-step="8" data-intro="翻页查看更多！">
				<ul class="pagination">
					<li>
                    	<a>共(<?php echo $count;?>)位用户</a>
                    </li>
					<?php echo $this->pagination->create_links($pageparam);?>
				</ul>
			</nav>
            <!--分页end-->            
    <!--model层显示开始-->
    <div class="modal fade" id="showOpUser">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title" id="myModalLabel">
                                    添加用户
                                </h4>
                            </div>
                <div class="modal-body">
                                <!--错误提示-->
                    <div class="alert alert-warning alert-dismissible" role="alert" style="display:none" id="warningmsg">
						<div id="msglinkadmin"><strong>Warning!</strong> Better check yourself, you're not looking too good.</div>
					</div>
                                <!-- ================================================== --> 
                    <form class="form-horizontal" method="post" action="<?php echo $this->config->item('base_url').'/adminpc/User/opUser';?>" enctype="multipart/form-data" name="myform" id="myform">
						<div class="form-group">
							<label for="userNickName" class="control-label col-md-3">用户昵称：</label>
							<div class="col-md-7">
								<input type="text" name="userNickName" id="userNickName" class="form-control" maxlength="11" placeholder="请输入正确的手机号码"/>
							</div>
						</div>
                        <div class="form-group">
							<label for="userPassWordF" class="control-label col-md-3">输入密码:</label>
							<div class="col-md-7">
								<input  type="password" name="userPassWordF" class="form-control"  id="userPassWordF" maxlength="15" />
							</div>
						</div>                
						<div class="form-group">
							<label for="userPassWordS" class="control-label col-md-3">请核对密码:</label>
							<div class="col-md-7">
								<input  type="password" name="userPassWordS" class="form-control"  id="userPassWordS" maxlength="15" />
							</div>
						</div>
						<div class="form-group">
							<label for="userRealName" class="control-label col-md-3">真实姓名：</label>
							<div class="col-md-7">
								<input type="text" class="form-control" name="userRealName" id="userRealName" maxlength="15" />
							</div>
						</div> 
						<div class="form-group">
							<label for="linkUrl" class="control-label col-md-3">用户邮箱：</label>
							<div class="col-md-7">
								<input type="email" class="form-control" name="userEmail" id="userEmail" maxlength="30"/>
							</div>
						</div>                               
						<div class="form-group">
							<label for="roleId" class="control-label col-md-3">用户角色：</label>
							<div class="col-md-7">
							<?php if(!empty($rolelist)) foreach($rolelist as $k=>$v){?>
                    			<input type="checkbox" name="roleId[]" value="<?php echo !empty($v['roleId']) ? $v['roleId'] : '';?>" <?php if($param['roleId'] == $v['roleId'] || empty($param['roleId'])){echo 'checked';}?>/><?php echo !empty($v['roleName']) ? $v['roleName'] : '';?>
							<?php }?>
							</div>
						</div>
                        <div class="form-group">
							<div class="control-label col-md-7">
								<button type="submit" class="btn btn-primary"  onclick="javascript:return checkButton()">提交</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
							</div>
						</div>                            
					</form>            
                </div>
            </div>				
		</div>				
    </div>
    <!--model层显示结束-->
    
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
function showOpUser()
{
	$("#showOpUser").modal('show');
}
</script>
