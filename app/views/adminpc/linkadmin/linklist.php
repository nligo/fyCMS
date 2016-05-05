<?php $adminheader;?>
<?php $adminfooter;?>
<?php $breadcrumb;?>
                <div class="right-contents"  id="right-contents">
						<h3 class="text-right">
  							<button type="button" class="btn btn-primary" id="modal-356218" onClick="showLinkInfo()">添加栏目</button>
						</h3>
                        <div class="panel-group">
                        <?php if(!empty($leftMenuPlink)) foreach($leftMenuPlink as $k=>$v){?>
                        <div class="panel panel-default" id="bigceng1" >
                          <div class="panel-heading" role="tab" id="heading1">
                            <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $v['linkId']?>" aria-expanded="true" aria-controls="collapse1"> <?php echo !empty($v['linkName']) ? $v['linkName'] : '';?> </a>
                              <div class="pull-right" id="dele_a1" > <a href="<?php echo $this->config->item('base_url').'/adminpc/Linkadmin/editLink/'.$v['linkId']?>" >编辑</a> 
</div>
                            </h4>
                          </div>
                          <div id="collapse<?php echo $v['linkId']?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading1">
                            <div class="panel-body">
                              <div class="row" id="addlanmu1">
                                <?php if(!empty($v['sonLinkList'])) foreach($v['sonLinkList'] as $k2=>$v2){?>
                                <div class="col-sm-2 col-md-3" id="lanmuxianyou72">
                                  <div class="thumbnail"  id="yangshidel72" >
                                    <div class="caption clearfix">
                                      <div class="pull-left" id="childlanmuname72"><?php echo !empty($v2['linkName']) ? $v2['linkName'] : '';?></div>
                                      <div class="pull-right" id="dele_a72"> <a href="<?php echo $this->config->item('base_url').'/adminpc/Linkadmin/editLink/'.$v2['linkId']?>" class="btn btn-primary btn-xs" >编辑</a> 
                                      <?php if($v2['deleteFlag'] == 0){?>
                                      <a href="<?php echo $this->config->item('base_url').'/adminpc/Linkadmin/changeStatus/'.$v2['linkId'].'/1'?>" class="btn btn-danger btn-xs" onClick="return confirm("确认删除吗？")">删除</a> 
                                      <?php }else{?>
                                      <a href="<?php echo $this->config->item('base_url').'/adminpc/Linkadmin/changeStatus/'.$v2['linkId'].'/0'?>" class="btn btn-default btn-xs" onClick="return confirm("确认恢复吗？")">恢复</a> 
                                      <?php }?>
                                        <!--a href="#" class="btn btn-default btn-xs" onClick="program_management_del('http://bwww.bl.com/admincp/linkadmin/add/72')">删除</a--> 
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <?php }?>
                              </div>
                            </div>
                           </div> 
                            <?php }?>
                          </div>
                        </div>
                </div>        

<!--添加弹出对话框-->
<div class="modal fade" id="showLinkInfo">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
							 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title" id="myModalLabel">
								添加栏目
							</h4>
						</div>
           	<div class="modal-body">
                            <!--错误提示-->
                <div class="alert alert-warning alert-dismissible" role="alert" style="display:none" id="warningmsg">
                                    <div id="msglinkadmin"><strong>Warning!</strong> Better check yourself, you're not looking too good.</div>
                                </div>
                            <!-- ================================================== --> 
                <form class="form-horizontal hor" method="post" action="<?php echo $this->config->item('base_url').'/adminpc/Linkadmin/OpMysqlColumn';?>" enctype="multipart/form-data" name="myform" id="myform">
                                    <div class="form-group hor">
                                        <label for="exampleInputEmail2" class="control-label col-md-3">所属栏目：</label>
                                        <div class="col-md-7">
                                        <select name="parentId" id="parentId" class="form-control">
                                            <option value="0" selected="selected">请选择</option>
                                            <?php if(!empty($leftMenuPlink)) foreach($leftMenuPlink as $k=>$v){?>
                                            <option value="<?php echo !empty($v['linkId']) ? $v['linkId'] : '';?>"><?php echo !empty($v['linkName']) ? $v['linkName'] : '';?></option>
                                            <?php }?>
                                        </select>
                                        </div>
                                    </div>
                                    <div class="form-group hor">
                                        <label for="linkName" class="control-label col-md-3">栏目名称：</label>
                                        <div class="col-md-7">
                                            <input type="text" name="linkName" id="linkName" class="form-control" maxlength="15"/>
                                        </div>
                                    </div>
                                    <div class="form-group hor">
                                        <label for="keyWord" class="control-label col-md-3">栏目关键字：</label>
                                        <div class="col-md-7">
                                        <input  type="text" name="keyWord" class="form-control"  id="keyWord" maxlength="20"/>
                                        </div>
                                    </div>
                                    <div class="form-group hor">
                                        <label for="linkUrl" class="control-label col-md-3">栏目链接：</label>
                                        <div class="col-md-7">
                                        <input type="text" class="form-control" name="linkUrl" id="linkUrl" maxlength="200" />
                                        </div>
                                    </div>                               
                                    <div class="form-group hor">
                                        <label for="displayOrder" class="control-label col-md-3">排序：</label>
                                        <div class="col-md-7">
                                        <input type="text" class="form-control" name="displayOrder"  id="displayOrder" maxlength="6" />
                                        </div>
                                    </div>
                                    <div class="form-group hor">
                                        <label for="recipient-name" class="control-label col-md-3">系统角色：</label>
                                        <div class="col-md-7">
                                        <?php if(!empty($rolelist)) foreach($rolelist as $key=>$val){?>
                                            <label class="checkbox-inline">
                                            
                                                <input type="checkbox"  name="userTypeId[]" value="<?php echo !empty($val['roleId']) ? $val['roleId'] : '';?>" <?php if($val['roleName'] == '系统管理员'){?>checked="checked"<?php }?>><?php echo !empty($val['roleName']) ? $val['roleName'] : '';?>
                                                
                                            </label>
                                        <?php }?>    
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
	//用户名验证
	var res = '';
	var linkName = $("#linkName").val();
    if(linkName == '')
    {
     	warning('<strong>错误：</strong>&nbsp;&nbsp;栏目名称不能为空');return false;
    }
	$.ajax
	({ //一个Ajax过程
	type: "post", //以post方式与后台沟通
	url : "<?php echo $this->config->item('base_url').'/adminpc/Linkadmin/ajaxLink';?>", //与此php页面沟通
	dataType:'json',//从php返回的值以 JSON方式 解释
	async:false,
	data: 'linkName='+linkName,
	success: function(response)
	{//如果调用php成功
		res = response;
	}
	});
	if(res.err == 1)
    {
     	warning('<strong>错误：</strong>&nbsp;&nbsp;栏目名已存在');return false;
    }
	
    if(linkName.length>6)
    {
     	warning('<strong>错误：</strong>&nbsp;&nbsp;栏目名称不能超过6个字');return false;
    }
	var keyWord = $("#keyWord").val();
	if(keyWord == '')
    {
     	warning('<strong>错误：</strong>&nbsp;&nbsp;栏目关键字不能为空');return false;
    }
	$.ajax
	({ //一个Ajax过程
	type: "post", //以post方式与后台沟通
	url : "<?php echo $this->config->item('base_url').'/adminpc/Linkadmin/ajaxLink';?>", //与此php页面沟通
	dataType:'json',//从php返回的值以 JSON方式 解释
	async:false,
	data: 'keyWord='+keyWord,
	success: function(response)
	{//如果调用php成功
		res = response;
	}
	});
	if(res.err == 1)
    {
     	warning('<strong>错误：</strong>&nbsp;&nbsp;栏目关键字已存在，请重新输入');return false;
    }
	var linkUrl = $("#linkUrl").val();
	if(linkUrl == '')
    {
     	warning('<strong>错误：</strong>&nbsp;&nbsp;栏目链接不能为空');return false;
    }
	
	var displayOrder = $("#displayOrder").val();
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

function showLinkInfo()
{
	$("#showLinkInfo").modal('show');
}
</script>
