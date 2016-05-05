<div class="right-contents"  id="right-contents">                           
		
    <!--搜索查询-->
    <div>
    	<form class="well form-inline" action="<?php echo $this->config->item('base_url').'/adminpc/News/index'?>" method="post" name="searchform" id="searchform">
        	<div class="form-group">
                <label class="userId">新闻标题:</label>
                <input type="text" class="input" placeholder="商品名称"  name="newsTitle" id="newsTitle" value="<?php echo !empty($param['newsTitle']) ? $param['newsTitle'] : '';?>">
            </div>  
                <button type="submit" class="btn btn-primary">查询</button>
                <a  class="btn btn-success" style="float:right" href="<?php echo $this->config->item('base_url').'/adminpc/News/editNews'?>">发布新闻</a>
			</form>
	</div>
    <div class="table-responsive clearfix" >
			<table class="table table-striped">
				<thead>
					<tr>
						<th>
							新闻ID
						</th>
                        <th>
                        	封面图
                        </th>
						<th>
                        	新闻标题
                        </th>
                        
						<th>
							新闻来源
						</th>
                        <th>
							发布时间
						</th>
						<th>
							操作
						</th>
					</tr>
				</thead>
				<tbody>
                <?php if(!empty($newslist)) foreach($newslist as $key=>$val){?>
					<tr class="info">
						<td>
							<?php echo !empty($val['newsId']) ? $val['newsId'] : '';?>
						</td>
                        <td>
							<img src="<?php echo !empty($val['CoverImgPath']) ? $this->config->item('base_url').$val['CoverImgPath'] : $this->config->item('base_url').'/public/admin/img/noimg_160.gif';?>" width="50" height="50"/>
						</td>
                        <td>
							<?php echo !empty($val['newsTitle']) ? $val['newsTitle'] : '';?>
						</td>
						<td>
							<?php echo !empty($val['newsSource']) ? $val['newsSource'] : '';?>
						</td>
                        <td>
							<?php echo !empty($val['createTime']) ? date('Y-m-d H:i',$val['createTime']) : '';?>
						</td>
						<td>
							<a href="<?php echo $this->config->item('base_url').'/adminpc/News/editNews/'.$val['newsId'];?>">编辑</a>
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
                    	<a>共(<?php echo $count;?>)条新闻</a>
                    </li>
					<?php echo $this->pagination->create_links($pageparam);?>
				</ul>
			</nav>
            <!--分页end-->             