<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>飞羽CMS后台管理系统</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<!-- basic styles -->
        <style>
			.right-contents {margin:0 20px 0 210px;}
			.chenge-right-contents {margin:20px 20px 0 0px;}
			.opLinkClass{display:block}
			.hor .form-group {overflow:hidden;}
    	</style>
		<link href="<?php echo $this->config->item('base_url').'/public/admin'?>/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="<?php echo $this->config->item('base_url').'/public/admin'?>/css/font-awesome.min.css" />
        <script src="<?php echo $this->config->item('base_url'); ?>/public/admin/js/jquery-1.7.2.min.js"></script>

		<!-- fonts -->

		<link rel="stylesheet" href="http://fonts.useso.com/css?family=Open+Sans:400,300" />

		<!-- ace styles -->

		<link rel="stylesheet" href="<?php echo $this->config->item('base_url').'/public/admin'?>/css/ace.min.css" />
		<link rel="stylesheet" href="<?php echo $this->config->item('base_url').'/public/admin'?>/css/ace-rtl.min.css" />
		<link rel="stylesheet" href="<?php echo $this->config->item('base_url').'/public/admin'?>/css/ace-skins.min.css" />
        

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="<?php echo $this->config->item('base_url').'/public/admin'?>/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->

		<script src="<?php echo $this->config->item('base_url').'/public/admin'?>/js/ace-extra.min.js"></script>
		<script src="<?php echo $this->config->item('base_url').'/public/admin'?>/js/plmain.js"></script>
        

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

		<!--[if lt IE 9]>
		<script src="<?php echo $this->config->item('base_url').'/public/admin'?>/js/html5shiv.js"></script>
		<script src="<?php echo $this->config->item('base_url').'/public/admin'?>/js/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>
		<div class="navbar navbar-default" id="navbar">
			<script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>

			<div class="navbar-container" id="navbar-container">
				<div class="navbar-header pull-left">
					<a href="#" class="navbar-brand">
						<small>
							<i class="icon-leaf"></i>
							飞羽CMS后台管理系统
						</small>
					</a><!-- /.brand -->
				</div><!-- /.navbar-header -->

				
                <div class="navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="<?php echo $this->config->item('base_url').'/public/admin'?>/avatars/user.jpg" alt="Jason's Photo" />
								<span class="user-info">
									<small>欢迎光临,</small>
									<?php echo !empty($log_userinfo) ? $log_userinfo['userRealName'] : '';?>
								</span>

								<i class="icon-caret-down"></i>
							</a>

							<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="#">
										<i class="icon-cog"></i>
										设置
									</a>
								</li>

								<li>
									<a href="#">
										<i class="icon-user"></i>
										个人资料
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="<?php echo $this->config->item('base_url').'/Login/logout'?>" onClick="return confirm('确认注销吗？');">
										<i class="icon-off"></i>
										退出
									</a>
								</li>
							</ul>
						</li>
					</ul><!-- /.ace-nav -->
				</div>
                <div class="navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
                            <?php echo !empty($log_userinfo) ? $log_userinfo['roleName'] : '';?>
								<i class="icon-caret-down"></i>
							</a>
							
							<ul class="light-blue pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">				
                            <?php if(!empty($rolelist)) foreach($rolelist as $k=>$v){?>
								<li class="light-blue">
									<a href="javascript:;"  onClick="changuserrole(<?php echo $v['roleId'];?>)">
										<i class="icon-user"></i>
										<?php echo !empty($v['roleName']) ? $v['roleName'] : '';?>
									</a>
								</li>
							<?php }?>
							</ul>
						</li>
					</ul><!-- /.ace-nav -->
				</div><!-- /.navbar-header -->
			</div><!-- /.container -->
		</div>

		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

			<div class="main-container-inner">
				<a class="menu-toggler" id="menu-toggler" href="#">
					<span class="menu-text"></span>
				</a>

				<div class="sidebar" id="sidebar">
					<script type="text/javascript">
						try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
					</script>

					<div class="sidebar-shortcuts" id="sidebar-shortcuts">

						<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
							<span class="btn btn-success"></span>

							<span class="btn btn-info"></span>

							<span class="btn btn-warning"></span>

							<span class="btn btn-danger"></span>
						</div>
					</div><!-- #sidebar-shortcuts -->

					<ul class="nav nav-list">
						<li class="active">
							<a href="index.html">
								<i class="icon-dashboard"></i>
								<span class="menu-text"> 飞羽CMS控制台 </span>
							</a>
						</li>
                        
						<?php if(!empty($leftMenu)) foreach($leftMenu as $k=>$v){?>
						<li>
							<a href="#dropdown-toggle" onClick="shownav(<?php echo $v['linkId']?>)">
								<i class="icon-list"></i>
								<span class="menu-text"><?php echo !empty($v['linkName']) ? $v['linkName'] : '';?> </span>
								<b class="arrow icon-angle-down"></b>
							</a>

							<ul class="submenu" id="submenu<?php echo $v['linkId']?>"  style="display:none">
                            	<?php if(!empty($v['leftMenuSonLink'])) foreach($v['leftMenuSonLink'] as $k2=>$v2){?>								<script>
                                function shownav(aa)
								{
									
									if($("#submenu"+aa).css("display")=="none"){
										$("#submenu"+aa).show();
									}else{
										$("#submenu"+aa).hide();
										}
								}
                                </script>
								<?php if($checkWord == $v2['keyWord']){?>
                                <script>
                                	$(function(){
										$("#submenu<?php echo $v['linkId']?>").show();
										})
                                </script>
                                <?php }?>
                                <li>
									<a <?php if($keyword == $v2['keyWord']){?>style="color:#03F"<?php }?> href="<?php echo !empty($v2['linkUrl']) ? $this->config->item('base_url').$v2['linkUrl'] : '';?>">
										<i class="icon-double-angle-right"></i>
										<?php echo !empty($v2['linkName']) ? $v2['linkName'] : '';?>
									</a>
								</li>
                           		<?php }?>
							</ul>
                                 
						</li>	
                        <?php }?>
					</ul><!-- /.nav-list -->

					<div class="sidebar-collapse" id="sidebar-collapse">
						<i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
					</div>

					<script type="text/javascript">
						try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
					</script>
				</div>
					<script type="text/javascript">
                        $(function(){
                            $("#sidebar-collapse").click(function(){
                                if($("#sidebar").hasClass("menu-min")){
                                $("#right-contents").css("margin-left","220px");
								$("#main-content").css("margin-left","180px");
                                }else{
                                    $("#right-contents").css("margin-left","53px");
									$("#main-content").css("margin-left","43px");
                                    }
                                })                            
                            
                            })
						function changuserrole(roleId)
						{
							var res ='';
							var roleId = roleId;
							$.ajax
							({ //一个Ajax过程
							type: "post", //以post方式与后台沟通
							url : "<?php echo $this->config->item('base_url').'/Login/changeRole';?>", //与此php页面沟通
							dataType:'json',//从php返回的值以 JSON方式 解释
							async:false,
							data: 'roleId='+roleId,
							success: function(response)
							{//如果调用php成功
								res = response;
							}
							});
							if(res.err == 1)
							{
								history.back();
							}
							else
							{
								alert('系统错误');
							}
						}
                    </script>  	

			