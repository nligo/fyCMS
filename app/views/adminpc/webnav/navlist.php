                <div class="right-contents"  id="right-contents">
						<h3 class="text-right">
  							<button type="button" class="btn btn-primary" id="modal-356218" onClick="showNavInfo()">添加导航</button>
						</h3>
                        <div class="panel-group">
                            <div class="panel panel-default" id="bigceng1" >
                              <div class="panel-heading" role="tab" id="heading1">
                                <h4 class="panel-title text-center"> <a data-toggle="collapse" data-parent="#accordion" href="#collapse0" aria-expanded="true" aria-controls="collapse1">顶部导航 </a>
                                </h4>
                              </div>
                              <div id="collapse0" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading1">
                                <div class="panel-body">
                                  <div class="row" id="addlanmu1">
                                    <?php if(!empty($topNavList)) foreach($topNavList as $k=>$v){?>
                                    <div class="col-sm-2 col-md-3" id="lanmuxianyou72">
                                      <div class="thumbnail"  id="yangshidel72" >
                                        <div class="caption clearfix">
                                         <h4 class="text-center"><strong><?php echo !empty($v['navName']) ? $v['navName'] : '';?></strong></h4>
                                          <div class="text-center">
                                         
                                          
                                          <a href="<?php echo $this->config->item('base_url').'/adminpc/Webnav/editNav/'.$v['navId'];?>" class="btn btn-primary btn-xs" >编辑</a> 
                                          
                                         <?php if($v['isShow'] == 0){?>
                                      <a href="<?php echo $this->config->item('base_url').'/adminpc/Webnav/changeStatus/'.$v['navId'].'/1';?>" class="btn btn-danger btn-xs" onclick="return confirm('确认隐藏该导航吗？')">隐藏</a> 
                                      <?php }else{?>
                                      <a href="<?php echo $this->config->item('base_url').'/adminpc/Webnav/changeStatus/'.$v['navId'].'/0';?>" class="btn btn-inverse btn-xs" onclick="return confirm('确认显示该导航吗？')">显示</a> 
                                      <?php }?>
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
                            <h4 class="panel-title text-center"> <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="true" aria-controls="collapse1">底部导航 </a>
                            </h4>
							</div>
						<div id="collapse1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading1">
                            <div class="panel-body">
                              <div class="row" id="addlanmu1">
                                <?php if(!empty($bottomNavList)) foreach($bottomNavList as $k=>$v){?>
                                <div class="col-sm-2 col-md-3" id="lanmuxianyou72">
                                  <div class="thumbnail"  id="yangshidel72" >
                                    <div class="caption clearfix">
                                     <h4 class="text-center"><strong><?php echo !empty($v['navName']) ? $v['navName'] : '';?></strong></h4>
                                      <div class="text-center">
                                      
                                      <a href="<?php echo $this->config->item('base_url').'/adminpc/Webnav/editNav/'.$v['navId'];?>" class="btn btn-primary btn-xs" >编辑</a> 
                                      <?php if($v['isShow'] == 0){?>
                                      <a href="<?php echo $this->config->item('base_url').'/adminpc/Webnav/changeStatus/'.$v['navId'].'/1';?>" class="btn btn-danger btn-xs" onclick="return confirm('确认隐藏该导航吗？')">隐藏</a> 
                                      <?php }else{?>
                                      <a href="<?php echo $this->config->item('base_url').'/adminpc/Webnav/changeStatus/'.$v['navId'].'/0';?>" class="btn btn-inverse btn-xs" onclick="return confirm('确认显示该导航吗？')">显示</a> 
                                      <?php }?>
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
<div class="modal fade" id="showNavInfo">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
							 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title" id="myModalLabel">
								添加导航
							</h4>
						</div>
           	<div class="modal-body">
                            <!--错误提示-->
                <div class="alert alert-warning alert-dismissible" role="alert" style="display:none" id="warningmsg">
                                    <div id="msglinkadmin"><strong>Warning!</strong> Better check yourself, you're not looking too good.</div>
                                </div>
                            <!-- ================================================== --> 
                <form class="form-horizontal hor" method="post" action="<?php echo $this->config->item('base_url').'/adminpc/Webnav/OpWebNav';?>" enctype="multipart/form-data" name="myform" id="myform">
                                    
                                    <div class="form-group hor">
                                        <label for="navName" class="control-label col-md-3">导航名称：</label>
                                        <div class="col-md-7">
                                            <input type="text" name="navName" id="navName" class="form-control" maxlength="15"/>
                                        </div>
                                    </div>
                                    <div class="form-group hor">
                                        <label for="navType" class="control-label col-md-3">显示位置：</label>
                                        <div class="col-md-7">
                                            <label>
                                              <input type="radio"  class="form-control"  name="navType" id="isShow" value="0"  checked="checked"/>
                                              顶部导航</label>
                                            <label>
                                              <input type="radio"  class="form-control"  id="isShow" name="navType"  value="1" />
                                              底部导航</label>
                                        </div>
                                    </div>
                                    <div class="form-group hor">
                                        <label for="navUrl" class="control-label col-md-3">导航链接：</label>
                                        <div class="col-md-7">
                                        	<input type="text" name="navUrl" id="navUrl" class="form-control" />
                                        </div>
                                    </div>    
                                     <div class="form-group hor">
                                        <label for="typeName" class="control-label col-md-3">导航关键字：</label>
                                        <div class="col-md-7">
                                            <input type="text" name="navKeyWord" id="navKeyWord" class="form-control" maxlength="40"/>
                                        </div>
                                    </div>
                                    <div class="form-group hor">
                                        <label for="typeName" class="control-label col-md-3">导航排序：</label>
                                        <div class="col-md-7">
                                            <input type="text" name="navSort" id="navSort" class="form-control" maxlength="40"/>
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
	var navName = $("#navName").val();
	var navType = $('input[name="navType"]:checked ').val();
	var res = '';
    if(navName == '')
    {
     	warning('<strong>错误：</strong>&nbsp;&nbsp;导航名称不能为空');return false;
    }
	
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
	
	var navUrl = $("#navUrl").val();
	if(navUrl == '')
	{
		warning('<strong>错误：</strong>&nbsp;&nbsp;导航链接不能为空，请重新输入');return false;
	}
	
	
	var navKeyWord = $("#navKeyWord").val();
	if(navKeyWord == '')
	{
		warning('<strong>错误：</strong>&nbsp;&nbsp;导航关键字不能为空，请重新输入');return false;
	}
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
