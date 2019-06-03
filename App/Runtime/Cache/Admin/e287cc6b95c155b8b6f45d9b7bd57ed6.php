<?php if (!defined('THINK_PATH')) exit();?><form id="pagerForm" action="/Admin/Hdbm/index" method="post">
	<input type="hidden" name="pageNum" value="<?php echo ((isset($currentPage) && ($currentPage !== ""))?($currentPage):'1'); ?>" />
	<input type="hidden" name="numPerPage" value="<?php echo ($numPerPage); ?>" /><!--每页显示多少条-->
	<input type="hidden" name="_order" value="<?php echo ($_REQUEST['_order']); ?>"/>
	<input type="hidden" name="_sort" value="<?php echo ($_REQUEST['_sort']); ?>"/>
</form>
<div class="pageHeader">
	<form rel="pagerForm" onsubmit="return navTabSearch(this);" method="post">
	<input type="hidden" name="numPerPage" value="<?php echo ($numPerPage); ?>" /><!--每页显示多少条-->
	<div class="searchBar">
		<table class="searchContent">
			<tr>
				<td>
					<b>搜索</b> 
					客户端
				</td>
				<td>
					<select name="Ism" class="combox">
					<option value="">全部</option>
						<option value="1" <?php if($_REQUEST['Ism']== '1'): ?>selected<?php endif; ?>>M</option>
						<option value="0" <?php if($_REQUEST['Ism']== '0'): ?>selected<?php endif; ?>>PC</option>
					</select>
				</td>
 				<td>
					状态 
				</td>
				<td>
					<select name="Dealstate" class="combox">
						<option value="">全部</option>
							<option value="1" <?php if($_REQUEST['Dealstate']== '1'): ?>selected<?php endif; ?>>已处理</option>
							<option value="0" <?php if($_REQUEST['Dealstate']== '0'): ?>selected<?php endif; ?>>未处理</option>
						
 					</select>
 				</td>
 				<td>
					&nbsp; 渠道：<input type="text" name="qudao" value="<?php echo ($_REQUEST['qudao']); ?>"  size="10"/> 
					&nbsp; 转化关键词：<input type="text" name="utm_term" value="<?php echo ($_REQUEST['utm_term']); ?>" size="10"/> 
					&nbsp; 活动名称：<input type="text" name="keyword" value="<?php echo ($_REQUEST['keyword']); ?>" size="10"/> 
					
                    起始时间 
                    <input name="starttime" type="text" id="starttime" value="<?php echo ($_REQUEST['starttime']); ?>" class='date' size="10"/>
                
                    结束时间 
                      <input name="endtime" type="text" id="endtime" value="<?php echo ($_REQUEST['endtime']); ?>" class='date' size="10"/>
                	
				</td>
				<td>
					<div class="buttonActive"><div class="buttonContent"><button type="submit">检索</button></div></div>
				</td>
			</tr>
		</table>
	</div>
	</form>
</div>
<div class="pageContent">
	<div class="panelBar">
		<ul class="toolBar">
			<li><a class="delete" href="/Admin/Hdbm/del/id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>/navTabId/liststu" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>

			<li class="line">line</li>
			<li><a class="icon"  href="javascript:navTabPageBreak()"><span>刷新</span></a></li>
			<!--<li><a class="icon" href="demo/common/dwz-team.xls" target="dwzExport" targetType="navTab" title="实要导出这些记录吗?"><span>导出EXCEL</span></a></li>-->
		</ul>
	</div>
	<table class="table" width="100%" layoutH="130">
		<thead>
			<tr>
				<th width="40" orderField="ID" <?php if($_REQUEST['_order']== 'ID'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>ID</th>
				<th width="180" orderField="ClassRoomID" <?php if($_REQUEST['_order']== 'ClassRoomID'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>客户端</th>
				<th width="180" orderField="ClassRoomName" <?php if($_REQUEST['_order']== 'ClassRoomName'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>活动标题</th>
				<th width="150" orderField="UserName" <?php if($_REQUEST['_order']== 'UserName'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>报名人</th>
				<th width="150" orderField="TelePhone" <?php if($_REQUEST['_order']== 'TelePhone'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>报名人电话</th>
				<th width="150" orderField="Area" <?php if($_REQUEST['_order']== 'Area'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>备注</th>
				<th width="150" orderField="LpName" <?php if($_REQUEST['_order']== 'LpName'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>楼盘名称</th>
				<th width="150" >推广员</th>
				<th width="150" orderField="qudao" <?php if($_REQUEST['_order']== 'qudao'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>渠道</th>
				<th width="150" orderField="utm_term" <?php if($_REQUEST['_order']== 'utm_term'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>转化关键词</th>
				<th width="150" >处理状态</th>
				<th width="150" orderField="UpdateTime" <?php if($_REQUEST['_order']== 'UpdateTime'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>报名时间</th>
				<th width="150" >基本操作</th>
				
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr target="item_id" rel="<?php echo ($vo["id"]); ?>">
					<td><?php echo ($vo["ID"]); ?></td>
					<td><?php echo (getism($vo["ClassRoomID"])); ?></td>
					<td><?php echo ($vo["ClassRoomName"]); ?></td>
					<td><?php echo ($vo["UserName"]); ?>(<?php echo ($vo["Sex"]); ?>)</td>
<?php if($vo['CityName']=='北京'){ ?>
        <?php if(($user['id'] == '103') OR ($user['id'] == '78')): ?><td><?php echo ($vo["TelePhone"]); ?></td>
        <?php else: ?>
                    <td>******</td><?php endif; ?>
<?php }else{ ?>
                    <td><?php echo ($vo["TelePhone"]); ?></td>
<?php } ?>

					<td><?php echo ($vo["remark"]); echo (getfengshui($vo["ID"])); ?></td>
					<td><?php echo ($vo["LpName"]); ?></td>
					<td><?php if($vo["PromoterId"] == '0'): ?>网站<?php endif; ?>
					<?php if($vo["PromoterId"] != '0'): echo ($vo["PromoterName"]); endif; ?></td>
					<td><?php if($vo["qudao"] != '0'): echo ($vo["qudao"]); endif; ?></td>
					<td><?php if($vo["utm_term"] != '0'): echo ($vo["utm_term"]); endif; ?></td>
					<td><?php if($vo["Dealstate"] == '-1'): ?>已取消<?php endif; if($vo["Dealstate"] == 0): ?>未处理<?php endif; if($vo["Dealstate"] == 1): ?>已处理<?php endif; ?></td>
					<td><?php echo ($vo["UpdateTime"]); ?></td>
					<td>
					<?php if($vo["Dealstate"] == 0): ?><a class="edit" href="/Admin/Hdbm/checkbm/id/<?php echo ($vo["ID"]); ?>" width="550" height="380" target="navTab"><span>处理</span></a><?php endif; ?>
					</td>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</tbody>
	</table>
	<div class="panelBar">
		<div class="pages">
			<span>显示</span>
			<select class="combox" name="numPerPage" onchange="navTabPageBreak(<?php echo (C("TMPL_L_DELIM")); ?>numPerPage:this.value<?php echo (C("TMPL_R_DELIM")); ?>)">
				<option value="10" <?php if($numPerPage == 10): ?>selected<?php endif; ?>>10</option>
				<option value="15" <?php if($numPerPage == 15): ?>selected<?php endif; ?>>15</option>
				<option value="20" <?php if($numPerPage == 20): ?>selected<?php endif; ?>>20</option>
				<option value="25" <?php if($numPerPage == 25): ?>selected<?php endif; ?>>25</option>
				<option value="30" <?php if($numPerPage == 30): ?>selected<?php endif; ?>>30</option>
			</select>
			<span>共<?php echo ($totalCount); ?>条</span>
		</div>
		<div class="pagination" targetType="navTab" totalCount="<?php echo ($totalCount); ?>" numPerPage="<?php echo ($numPerPage); ?>" pageNumShown="5" currentPage="<?php echo ($currentPage); ?>"></div>
	</div>
	<script type="text/javascript">
function display(id){
	//alert(img.width());
	//alert(image);
	var url = "/Admin/Hdbm/editDisplay/id/"+id;
     var xpwidth=window.screen.width-10;
        var xpheight=window.screen.height-105;
       // alert(xpheight);
        //window.open('map/mapview.aspx', '_blank', 'resizable=yes,directories=no,top=0,left=0,width='+xpwidth+',height='+xpheight);
	window.open(url,'newWindow','scrollbars=yes, resizable=yes,resizable=yes,directories=no,top=0,left=0,width='+xpwidth+',height='+xpheight);

	
}


 </script>
</div>