                <div class="right-contents"  id="right-contents">
						<h3 class="text-right">
  							<button type="button" class="btn btn-primary" id="modal-356218" onClick="showRoleInfo()">添加角色</button>
						</h3>
                        <div class="panel-group">
                            <div class="panel panel-default" id="bigceng1" >
                              <div class="panel-heading" role="tab" id="heading1">
                                <h4 class="panel-title text-center"> <a data-toggle="collapse" data-parent="#accordion" href="#collapse" aria-expanded="true" aria-controls="collapse1">显示的角色 </a>
                                </h4>
                              </div>
                              <div id="collapse" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading1">
                                <div class="panel-body">
                                  <div class="row" id="addlanmu1">
                                    <?php if(!empty($rolelist)) foreach($rolelist as $k=>$v){?>
                                    <div class="col-sm-2 col-md-3" id="lanmuxianyou72">
                                      <div class="thumbnail"  id="yangshidel72" >
                                        <div class="caption clearfix">
                                         <h4 class="text-center"><strong><?php echo !empty($v['roleName']) ? $v['roleName'] : '';?></strong></h4>
                                          <div class="text-center">
                                         
                                          
                                          <a href="<?php echo $this->config->item('base_url').'/adminpc/Roleadmin/editRole/'.$v['roleId'];?>" class="btn btn-primary btn-xs" >编辑</a> 
                                          
                                          <a href="<?php echo $this->config->item('base_url').'/adminpc/Roleadmin/changeStatus/'.$v['roleId'].'/1';?>" class="btn btn-danger btn-xs"onclick="return confirm('确认隐藏该角色吗？')">隐藏</a> 
                                            <!--a href="#" class="btn btn-default btn-xs" onClick="program_management_del('http://bwww.bl.com/admincp/linkadmin/add/72')">删除</a--> 
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <?php }?>
                                  </div>
                                </div>
                               </div> 
                            </div>
                        </div>
					<div class="panel panel-default" id="bigceng1" >
						<div class="panel-heading" role="tab" id="heading1">
                            <h4 class="panel-title text-center"> <a data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="true" aria-controls="collapse1">隐藏的角色 </a>
                            </h4>
							</div>
						<div id="collapse2" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading1">
                            <div class="panel-body">
                              <div class="row" id="addlanmu1">
                                <?php if(!empty($rolelisttwo)) foreach($rolelisttwo as $k=>$v){?>
                                <div class="col-sm-2 col-md-3" id="lanmuxianyou72">
                                  <div class="thumbnail"  id="yangshidel72" >
                                    <div class="caption clearfix">
                                     <h4 class="text-center"><strong><?php echo !empty($v['roleName']) ? $v['roleName'] : '';?></strong></h4>
                                      <div class="text-center">
                                      
                                      <a href="<?php echo $this->config->item('base_url').'/adminpc/Roleadmin/editRole/'.$v['roleId'];?>" class="btn btn-primary btn-xs" >编辑</a> 
                                      
                                      <a href="<?php echo $this->config->item('base_url').'/adminpc/Roleadmin/changeStatus/'.$v['roleId'].'/0';?>" class="btn btn-inverse btn-xs" onclick="return confirm('确认显示该角色吗？')">显示</a> 
                                        <!--a href="#" class="btn btn-default btn-xs" onClick="program_management_del('http://bwww.bl.com/admincp/linkadmin/add/72')">删除</a--> 
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <?php }?>
                              </div>
                            </div>
						</div> 
					</div>
				</div>
			</div>        

<!--添加弹出对话框-->
<div class="modal fade" id="showRoleInfo">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
							 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title" id="myModalLabel">
								添加角色
							</h4>
						</div>
           	<div class="modal-body">
                            <!--错误提示-->
                <div class="alert alert-warning alert-dismissible" role="alert" style="display:none" id="warningmsg">
                                    <div id="msglinkadmin"><strong>Warning!</strong> Better check yourself, you're not looking too good.</div>
                                </div>
                            <!-- ================================================== --> 
                <form class="form-horizontal hor" method="post" action="<?php echo $this->config->item('base_url').'/adminpc/Roleadmin/OpRoleadmin';?>" enctype="multipart/form-data" name="myform" id="myform">
                                    
                                    <div class="form-group hor">
                                        <label for="typeName" class="control-label col-md-3">角色名称：</label>
                                        <div class="col-md-7">
                                            <input type="text" name="roleName" id="roleName" class="form-control" maxlength="15"/>
                                        </div>
                                    </div>
                                    <div class="form-group hor">
                                        <label for="isShow" class="control-label col-md-3">是否显示：</label>
                                        <div class="col-md-7">
                                            <label>
                                              <input type="radio"  class="form-control"  name="isShow" id="isShow" value="0" id="isShow" checked="checked"/>
                                              显示</label>
                                            <label>
                                              <input type="radio"  class="form-control"  name="isShow" value="1" />
                                              隐藏</label>
                                        </div>
                                    </div>
                                    <div class="form-group hor">
                                        <label for="typeContents" class="control-label col-md-3">角色描述：</label>
                                        <div class="col-md-7">
                                        	<textarea class="form-control" name="roleContents" id="roleContents" maxlength="200"></textarea> 
                                        </div>
                                    </div>    
                                     <div class="form-group hor">
                                        <label for="typeName" class="control-label col-md-3">排序：</label>
                                        <div class="col-md-7">
                                            <input type="text" name="displayOrder" id="displayOrder" class="form-control" maxlength="15"/>
                                        </div>
                                    </div>                           
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary"   onclick="javascript:return checkButton()">提交</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                    </div>
                                </form>                
            </div>
		</div>				
	</div>				
</div>
<script type="text/javascript">
function checkButton(){
	var res = '';
	var roleName = $("#roleName").val();
    if(roleName == '')
    {
     	warning('<strong>错误：</strong>&nbsp;&nbsp;角色名称不能为空');return false;
    }
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

function showRoleInfo()
{
	$("#showRoleInfo").modal('show');
}
</script>
