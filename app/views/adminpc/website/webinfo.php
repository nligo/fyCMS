<?php $adminheader;?>
<?php $adminfooter;?>
<?php $breadcrumb;?>
<div class="right-contents"  id="right-contents">
<h3 class="text-left"><?php echo !empty($title) ? $title : '';?></h3>
 <div class="alert alert-warning alert-dismissible" role="alert" style="display:none" id="warningmsg">
                                    <div id="msglinkadmin"><strong>Warning!</strong> Better check yourself, you're not looking too good.</div>
                                </div>
<div class="tabbable" id="tabs-219353">
				<ul class="nav nav-tabs">
					<li class="active">
						 <a href="#panel-231695" data-toggle="tab">网站设置</a>
					</li>
					<li>
						 <a href="#panel-174424" data-toggle="tab">邮件设置</a>
					</li>
				</ul>
				<div class="tab-content">
               
					<div class="tab-pane active" id="panel-231695">
                            <!-- ================================================== --> 
                <form class="form-horizontal hor" method="post" action="<?php echo $this->config->item('base_url').'/adminpc/Website/opWebsite';?>" enctype="multipart/form-data" name="myform" id="myform">
                                    <div class="form-group hor">
                                        <label for="linkName" class="control-label col-md-2">网站名称：</label>
                                        <div class="col-md-3">
                                            <input type="text" name="webName" id="webName" class="form-control" maxlength="15" value="<?php echo !empty($info['webName']) ? $info['webName'] : '';?>"/>
                                        </div>
                                    </div>
                                    <div class="form-group hor">
                                        <label for="keyWord" class="control-label col-md-2">网站URL:</label>
                                        <div class="col-md-3">
                                        <input  type="text" name="webUrl" class="form-control"  id="webUrl" maxlength="50" value="<?php echo !empty($info['webUrl']) ? $info['webUrl'] : '';?>"/>
                                        <input type="hidden" id="webId" name="webId" value="<?php echo !empty($info['webId']) ? $info['webId'] : '';?>"/>
                                        </div>
                                    </div>
                                    <div class="form-group hor">
                                        <label for="linkUrl" class="control-label col-md-2">网站关键字：</label>
                                        <div class="col-md-3">
                                        <input type="text" class="form-control" name="webKeyWord" id="webKeyWord" maxlength="200" value="<?php echo !empty($info['webKeyWord']) ? $info['webKeyWord'] : '';?>"/>
                                        </div>
                                    </div>                               
                                    <div class="form-group hor">
                                        <label for="displayOrder" class="control-label col-md-2">网站备案信息：</label>
                                        <div class="col-md-3">
                                        <input type="text" class="form-control" name="webRecordInfo"  id="webRecordInfo" maxlength="30" value="<?php echo !empty($info['webRecordInfo']) ? $info['webRecordInfo'] : '';?>"/>
                                        </div>
                                    </div>
                                    <div class="form-group hor">
                                        <label for="recipient-name" class="control-label col-md-2">管理员名称：</label>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" name="webAdminName"  id="webAdminName" maxlength="20" value="<?php echo !empty($info['webAdminName']) ? $info['webAdminName'] : '';?>"/>
                                        </div>
                                    </div>
                                    <div class="form-group hor">
                                        <label for="recipient-name" class="control-label col-md-2">管理员邮箱：</label>
                                        <div class="col-md-3">
                                            <input type="email" class="form-control" name="webAdminEmail"  id="webAdminEmail" maxlength="30"  value="<?php echo !empty($info['webAdminEmail']) ? $info['webAdminEmail'] : '';?>"/>
                                        </div>
                                    </div>
                                    <div class="form-group hor">
                                        <label for="recipient-name" class="control-label col-md-2">网站描述：</label>
                                        <div class="col-md-5">
                                            <textarea class="form-control" name="webDescribe" id="webDescribe"> <?php echo !empty($info['webDescribe']) ? $info['webDescribe'] : '';?></textarea>
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
					<div class="tab-pane" id="panel-174424">
						<form class="form-horizontal hor" method="post" action="<?php echo $this->config->item('base_url').'/adminpc/Website/opEmail';?>" enctype="multipart/form-data" name="emailform" id="emailform">
                                    <div class="form-group hor">
                                        <label for="linkName" class="control-label col-md-2">服务器主机：</label>
                                        <div class="col-md-3">
                                            <input type="text" name="emailHost" id="emailHost" class="form-control" maxlength="15" value="<?php echo !empty($emailinfo['emailHost']) ? $emailinfo['emailHost'] : '';?>"/>
                                        </div>
                                    </div>
                                    <div class="form-group hor">
                                        <label for="keyWord" class="control-label col-md-2">邮箱用户名:</label>
                                        <div class="col-md-3">
                                        <input  type="email" name="emailUserName" class="form-control"  id="emailUserName" maxlength="50" value="<?php echo !empty($emailinfo['emailUserName']) ? $emailinfo['emailUserName'] : '';?>"/>
                                        <input type="hidden" id="emailId" name="emailId" value="<?php echo !empty($emailinfo['emailId']) ? $emailinfo['emailId'] : '';?>"/>
                                        </div>
                                    </div>
                                    <div class="form-group hor">
                                        <label for="linkUrl" class="control-label col-md-2">邮箱配置密码：</label>
                                        <div class="col-md-3">
                                        <input type="text" class="form-control" name="emailPassword" id="emailPassword" maxlength="200" value="<?php echo !empty($emailinfo['emailPassword']) ? $emailinfo['emailPassword'] : '';?>"/>
                                        </div>
                                    </div>                               
                                    <div class="form-group hor">
                                        <label for="displayOrder" class="control-label col-md-2">端口：</label>
                                        <div class="col-md-3">
                                        <input type="text" class="form-control" name="emailPort"  id="emailPort" maxlength="30" value="<?php echo !empty($emailinfo['emailPort']) ? $emailinfo['emailPort'] : '';?>" />
                                        </div>
                                    </div>
                                    <div class="form-group hor">
                                        <label for="recipient-name" class="control-label col-md-2">发件人名称：</label>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" name="sendName"  id="sendName" maxlength="30"   value="<?php echo !empty($emailinfo['sendName']) ? $emailinfo['sendName'] : '';?>"/>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group hor">
                                      
                                        <div class="control-label col-md-3">
                                            <button type="submit" class="btn btn-primary"  onclick="javascript:return checkButton2()">提交</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                        </div>
                                    </div>
                                </form>     
					</div>
				</div>
			</div>
</div>
<script type="text/javascript">
function checkButton(){
	var webName = $("#webName").val();
    if(webName == '')
    {
     	warning('<strong>错误：</strong>&nbsp;&nbsp;网站名称不能为空');return false;
    }
    if(webName.length>15)
    {
     	warning('<strong>错误：</strong>&nbsp;&nbsp;栏目名称不能超过15个字');return false;
    }
	
	var webUrl = $("#webUrl").val();
	if(webUrl == '')
    {
     	warning('<strong>错误：</strong>&nbsp;&nbsp;网站地址不能为空');return false;
    }
	var Expression=/http(s)?:\/\/([\w-]+\.)+[\w-]+(\/[\w- .\/?%&=]*)?/; 
	var objExp=new RegExp(Expression);
	if(objExp.test(webUrl)==false)
	{
		warning('<strong>错误：</strong>&nbsp;&nbsp;网站地址不合法');return false;
	}
	
	var webKeyWord = $("#webKeyWord").val();
	if(webKeyWord == '')
    {
     	warning('<strong>错误：</strong>&nbsp;&nbsp;网站关键字不能为空');return false;
    }
	
	var webAdminName = $("#webAdminName").val();
	if(webAdminName == '')
    {
     	warning('<strong>错误：</strong>&nbsp;&nbsp;管理员不能为空');return false;
    }
	
	var webAdminEmail = $("#webAdminEmail").val();
	if(webAdminEmail == '')
    {
     	warning('<strong>错误：</strong>&nbsp;&nbsp;管理员邮箱不能为空');return false;
    }
	var webDescribe = $("#webDescribe").val();
	if(webDescribe == '')
    {
     	warning('<strong>错误：</strong>&nbsp;&nbsp;网站描述不能为空');return false;
    }
	 
 	$('#myform').submit(function (){
 		$(this).serialize();
 	});
 }


function checkButton2(){
	var emailHost = $("#emailHost").val();
    if(emailHost == '')
    {
     	warning('<strong>错误：</strong>&nbsp;&nbsp;服务器主机不能为空');return false;
    }
	
	var emailUserName = $("#emailUserName").val();
	if(emailUserName == '')
    {
     	warning('<strong>错误：</strong>&nbsp;&nbsp;邮箱用户名不能为空');return false;
    }
	
	var emailPassword = $("#emailPassword").val();
	if(emailPassword == '')
    {
     	warning('<strong>错误：</strong>&nbsp;&nbsp;邮箱密码不能为空');return false;
    }
	
	var emailPort = $("#emailPort").val();
	if(emailPort == '')
    {
     	warning('<strong>错误：</strong>&nbsp;&nbsp;邮箱端口不能为空');return false;
    }
	
	var sendName = $("#sendName").val();
	if(sendName == '')
    {
     	warning('<strong>错误：</strong>&nbsp;&nbsp;发件人姓名不能为空');return false;
    }

 	$('#emailform').submit(function (){
 		$(this).serialize();
 	});
 }
 	     
function warning(a)
{
	$('#msglinkadmin').html(a);
	$('#warningmsg').show();
}

</script>                      