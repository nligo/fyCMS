<?php $adminheader;?>
<?php $adminfooter;?>
<?php $breadcrumb;?>
<div class="right-contents"  id="right-contents">
<!--信息提示-->
	<?php
	if($isok == 0)
	{
	?>
	 <div class="alert  alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>						
                <strong>成功</strong> <?php echo $title;?>  <span id="jumpTo"></span>
            </div>
	<?php
	}
	else
	{
	?>
	<!--错误提示-->
    <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>						
                    <strong>错误</strong> <?php echo $title;?> <span id="jumpTo"></span>
                </div>            
	<?php
	}
	?>
</div>                 
<script type="text/javascript">
function countDown(secs,surl){
	secs = secs-1;
	var jumpTo = document.getElementById('jumpTo');
	jumpTo.innerHTML=secs+'s';
	if(secs>0){
		setTimeout("countDown("+secs+",'"+surl+"')",1000);
	}
	else{
		location.href=surl;
	}
}

countDown(3,'<?php echo $url;?>');

</script>