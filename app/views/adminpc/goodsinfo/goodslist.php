<div class="right-contents"  id="right-contents">                           
		
    <!--搜索查询-->
    <div>
    	<form class="well form-inline" action="<?php echo $this->config->item('base_url').'/adminpc/Goodsinfo/index'?>" method="post" name="searchform" id="searchform">
        	<div class="form-group">
                <label class="userId">商品名称:</label>
                <input type="text" class="input" placeholder="商品名称"  name="goodsTitle" id="goodsTitle" value="<?php echo !empty($param['goodsTitle']) ? $param['goodsTitle'] : '';?>">
            </div>  
            <div class="form-group">
                <label class="isShow">商品状态:</label>
				<select class="input" name="isShow">
                	<option value="0" selected="selected">请选择</option>
                	<option value="1" <?php if($param['isShow'] == 1){echo 'selected';}?>>热销中</option>
                    <option value="2" <?php if($param['isShow'] == 2){echo 'selected';}?>>未上架</option>
                    <option value="3" <?php if($param['isShow'] == 3){echo 'selected';}?>>已下架</option>
				</select>
            </div>    
            <div class="form-group">
                <label class="isShow">商品分类:</label>
				<select class="input" name="typeId">
                	<option value="0">请选择</option>
                	<?php if(!empty($typelist)) foreach($typelist as $k=>$v){?>
					<option value="<?php echo !empty($v['typeId']) ? $v['typeId'] : '';?>"<?php if($param['typeId']==$v['typeId']){echo 'selected';}?>><?php echo !empty($v['typeName']) ? $v['typeName'] : '';?></option>
					<?php }?>
				</select>
            </div>   
                <button type="submit" class="btn btn-primary">查询</button>
                <a  class="btn btn-success" style="float:right" href="<?php echo $this->config->item('base_url').'/adminpc/Goodsinfo/editGoods'?>">发布商品</a>
			</form>
	</div> 
    <div class="table-responsive clearfix" >
			<table class="table table-striped">
				<thead>
					<tr>
						<th>
							商品编号
						</th>
						<th>
                        	商品名称
                        </th>
                        <th>
                        	封面图
                        </th>
						<th>
							商品价格
						</th>
                        <th>
							商品库存
						</th>
                        <th>
							销售量
						</th>
                        <th>
							评论量
						</th>
						<th>
							操作
						</th>
					</tr>
				</thead>
				<tbody>
                <?php if($goodslist) foreach($goodslist as $key=>$val){?>
					<tr class="info">
						<td>
							<?php echo !empty($val['goodsId']) ? $val['goodsId'] : '';?>
						</td>
						<td>
							<?php echo !empty($val['goodsTitle']) ? $val['goodsTitle'] : '';?>
						</td>
                        <td>
							<img src="<?php echo !empty($val['goodsCover']) ? $this->config->item('base_url').$val['goodsCover'] : $this->config->item('base_url').'/public/admin/img/noimg_160.gif';?>" width="50" height="50"/>
						</td>
						<td>
							<?php echo !empty($val['goodsPrice']) ? $val['goodsPrice'] : '0.00';?>元
						</td>
                        <td>
							<?php echo !empty($val['goodsStock']) ? $val['goodsStock'] : 0;?>
						</td>
                        <td>
							<?php echo !empty($val['salesNum']) ? $val['salesNum'] : 0;?>
						</td>
                         <td>
							<?php echo !empty($val['commentNum']) ? $val['commentNum'] : 0;?>
						</td>
						<td>
							<a href="<?php echo $this->config->item('base_url').'/adminpc/Goodsinfo/editGoods/'.$val['goodsId']?>">编辑</a>
                            <a href="#">下架</a>
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
                    	<a>共(<?php echo $count;?>)中商品</a>
                    </li>
					<?php echo $this->pagination->create_links($pageparam);?>
				</ul>
			</nav>
            <!--分页end-->            
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
