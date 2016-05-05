<div class="right-contents"  id="right-contents">
<h3 class="text-left"><?php echo !empty($title) ? $title : '';?></h3>
                            <!--错误提示-->
                <div class="alert alert-warning alert-dismissible" role="alert" style="display:none" id="warningmsg">
                                    <div id="msglinkadmin"><strong>Warning!</strong> Better check yourself, you're not looking too good.</div>
                                </div>
                            <!-- ================================================== --> 
                <form class="form-horizontal hor" method="post" action="<?php echo $this->config->item('base_url').'/adminpc/Linkadmin/OpMysqlColumn';?>" enctype="multipart/form-data" name="myform" id="myform">
                                    <div class="form-group hor">
                                        <label for="exampleInputEmail2" class="control-label col-md-2">所属栏目：</label>
                                        <div class="col-md-3">
                                        <select name="parentId" id="parentId" class="form-control">
                                        <?php if($info['parentId'] == 0){?>
                                            <option value="0" selected="selected">请选择</option>
                                        <?php }else{?>    
                                            <?php if(!empty($leftMenuPlink)) foreach($leftMenuPlink as $k=>$v){?>
                                            <option value="<?php echo !empty($v['linkId']) ? $v['linkId'] : '';?>" <?php if($v['linkId'] == $info['parentId']){echo 'selected';}?>><?php echo !empty($v['linkName']) ? $v['linkName'] : '';?></option>
                                            <?php }?>
                                        <?php }?>    
                                        </select>
                                        </div>
                                    </div>
                                    <div class="form-group hor">
                                        <label for="linkName" class="control-label col-md-2">栏目名称：</label>
                                        <div class="col-md-3">
                                            <input type="text" name="linkName" id="linkName" class="form-control" maxlength="15" value="<?php echo !empty($info['linkName']) ? $info['linkName'] : '';?>" <?php if($info['parentId'] == 0){?>disabled="disabled"<?php }?>/>
                                            <input type="hidden" name="linkName2" id="linkName2" class="form-control"  value="<?php echo !empty($info['linkName']) ? $info['linkName'] : '';?>" />
                                        </div>
                                    </div>
                                    <div class="form-group hor">
                                        <label for="keyWord" class="control-label col-md-2">栏目关键字：</label>
                                        <div class="col-md-3">
                                        <input  type="text" name="keyWord" class="form-control"  id="keyWord" maxlength="20" value="<?php echo !empty($info['keyWord']) ? $info['keyWord'] : '';?>" disabled="disabled"/>
                                        <input type="hidden" id="linkId" name="linkId" value="<?php echo !empty($info['linkId']) ? $info['linkId'] : '';?>" />
                                        <input type="hidden" id="keyWord" name="keyWord" value="<?php echo !empty($info['keyWord']) ? $info['keyWord'] : '';?>" />
                                        </div>
                                    </div>
                                    <div class="form-group hor">
                                        <label for="linkUrl" class="control-label col-md-2">栏目链接：</label>
                                        <div class="col-md-3">
                                        <input type="text" class="form-control" name="linkUrl" id="linkUrl" maxlength="200"  value="<?php echo !empty($info['linkUrl']) ? $info['linkUrl'] : '';?>"  <?php if($info['parentId'] == 0){?>disabled="disabled"<?php }?>/>
                                        </div>
                                    </div>                               
                                    <div class="form-group hor">
                                        <label for="displayOrder" class="control-label col-md-2">排序：</label>
                                        <div class="col-md-3">
                                        <input type="text" class="form-control" name="displayOrder"  id="displayOrder" maxlength="6"  value="<?php echo !empty($info['displayOrder']) ? $info['displayOrder'] : '';?>"  <?php if($info['parentId'] == 0){?>disabled="disabled"<?php }?>/>
                                        </div>
                                    </div>
                                    <div class="form-group hor">
                                        <label for="recipient-name" class="control-label col-md-2">系统角色：</label>
                                        <div class="col-md-5">
                                            <?php if(!empty($rolelist)) foreach($rolelist as $key=>$val){?>
                                            <label class="checkbox-inline">
                                                <input type="checkbox"  name="userTypeId[]" value="<?php echo !empty($val['roleId']) ? $val['roleId'] : '';?>" <?php if(strstr($info['linkRoleId'],$val['roleId'])){?>checked="checked"<?php }?>><?php echo !empty($val['roleName']) ? $val['roleName'] : '';?>
                                                
                                            </label>
                                        <?php }?>    
                                        </div>
                                    </div>
                                    <div class="form-group hor">
                                      
                                        <div class="control-label col-md-3">
                                            <button type="submit" class="btn btn-primary"  onclick="javascript:return checkButton()">提交</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                        </div>
                                    </div>
                                   
                                </form>                
            </div>
<script type="text/javascript">
function checkButton(){
	//用户名验证
	var res = '';
	var linkName = $("#linkName").val();
	var linkName2 = $("#linkName2").val();
    if(linkName == '')
    {
     	warning('<strong>错误：</strong>&nbsp;&nbsp;栏目名称不能为空');return false;
    }
	if(linkName != linkName2)
	{
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

</script>          