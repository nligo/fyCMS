<div class="right-contents"  id="right-contents">
	<h3 class="text-right">
        <button class="btn btn-info btn-lg" onClick="showTypeinfo()">添加分类</button>
    </h3>
    <div class="panel-group">
		<div class="panel panel-default" id="bigceng1" >
                              <div class="panel-heading" role="tab" id="heading1">
                                <h4 class="panel-title text-center"> <a data-toggle="collapse" data-parent="#accordion" href="#collapse" aria-expanded="true" aria-controls="collapse1">可见的分类 </a>
                                </h4>
                              </div>
                              <div id="collapse" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading1">
                                <div class="panel-body">
                                  <div class="row" id="addlanmu1">
                                    <?php if(!empty($showtypelist)) foreach($showtypelist as $k=>$v){?>
                                    <div class="col-sm-2 col-md-3" id="lanmuxianyou72">
                                      <div class="thumbnail"  id="yangshidel72" >
                                        <div class="caption clearfix">
                                         <h4 class="text-center"><strong><?php echo !empty($v['typeName']) ? $v['typeName'] : '';?></strong></h4>
                                         <p class="text-center">
                                         	<?php echo !empty($v['typeContents']) ? $v['typeContents'] : '';?>
                                         </p>
                                          <div class="text-center">
                                         
                                          
                                         
                                          
                                          <a href="<?php echo $this->config->item('base_url').'/adminpc/Goodstype/changeStatus/'.$v['typeId'].'/2';?>" class="btn btn-danger btn-xs"onclick="return confirm('确认隐藏该栏目吗？')">隐藏</a> 
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
	
    	<div class="panel panel-default" id="bigceng1" >
						<div class="panel-heading" role="tab" id="heading1">
                            <h4 class="panel-title text-center"> <a data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="true" aria-controls="collapse1">隐藏的分类 </a>
                            </h4>
							</div>
						<div id="collapse2" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading1">
                            <div class="panel-body">
                              <div class="row" id="addlanmu1">
                                <?php if(!empty($hidetypelist)) foreach($hidetypelist as $k=>$v){?>
                                <div class="col-sm-2 col-md-3" id="lanmuxianyou72">
                                  <div class="thumbnail"  id="yangshidel72" >
                                    <div class="caption clearfix">
                                     <h4 class="text-center"><strong><?php echo !empty($v['typeName']) ? $v['typeName'] : '';?></strong></h4>
                                     	<p class="text-center">
                                         	<?php echo !empty($v['typeContents']) ? $v['typeContents'] : '';?>
										</p>
                                      <div class="text-center">
                                      
                                    
                                      
                                      <a href="<?php echo $this->config->item('base_url').'/adminpc/Goodstype/changeStatus/'.$v['typeId'].'/1';?>" class="btn btn-inverse btn-xs" onclick="return confirm('确认显示该栏目吗？')">显示</a> 
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
                    <!--分页start-->
            <nav data-step="8" data-intro="翻页查看更多！">
				<ul class="pagination">
					<li>
                    	<a>共(<?php echo $count;?>)条分类</a>
                    </li>
					<?php echo $this->pagination->create_links();?>
				</ul>
			</nav>
            <!--分页end-->  
	</div>   
                  
    <!--model层显示开始-->
    <div class="modal fade" id="showTypeinfo">
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
                    <form class="form-horizontal" method="post" action="<?php echo $this->config->item('base_url').'/adminpc/Goodstype/opType';?>" enctype="multipart/form-data" name="myform" id="myform">
						<div class="form-group">
							<label for="userNickName" class="control-label col-md-3">类别名称：</label>
							<div class="col-md-7">
								<input type="text" name="typeName" id="typeName" class="form-control" maxlength="11" placeholder="请输入正确的分类名称"/>
							</div>
						</div>
                        <div class="form-group">
							<label for="userPassWordF" class="control-label col-md-3">类别描述:</label>
							<div class="col-md-7">
								<textarea id="typeContents" name="typeContents"></textarea>
							</div>
						</div>                
						<div class="form-group">
							<label for="userPassWordF" class="control-label col-md-3">是否显示:</label>
							<div class="col-md-7">
								  <label>
								    <input type="radio" name="isShow" value="1" id="isShow1" checked="checked">
								    显示</label>
								  <label>
								    <input type="radio" name="isShow" value="2" id="isShow2">
								    隐藏</label>
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
	var typeName = $("#typeName").val();
    if(typeName == '')
    {
     	warning('<strong>错误：</strong>&nbsp;&nbsp;类别名称不能为空');return false;
    }
    if(typeName.length>11)
    {
     	warning('<strong>错误：</strong>&nbsp;&nbsp;类别名称不能超过15个字');return false;
    }
	$.ajax
		({ //一个Ajax过程
		type: "post", //以post方式与后台沟通
		url : "<?php echo $this->config->item('base_url').'/adminpc/Goodstype/ajaxCheck';?>", //与此php页面沟通
		dataType:'json',//从php返回的值以 JSON方式 解释
		async:false,
		data: 'typeName='+typeName,
		success: function(response)
		{//如果调用php成功
			res = response;
		}
		});
		if(res.err == 1)
		{
			warning('<strong>错误：</strong>&nbsp;&nbsp;类别名称已存在，请重新输入');return false;
		}
	var typeContents = $("#typeContents").val();
    if(typeContents == '')
    {
     	warning('<strong>错误：</strong>&nbsp;&nbsp;类别描述不能为空');return false;
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
function showTypeinfo()
{
	$("#showTypeinfo").modal('show');
}
</script>
