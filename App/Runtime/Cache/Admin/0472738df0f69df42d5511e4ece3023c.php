<?php if (!defined('THINK_PATH')) exit();?><form id="pagerForm" action="/Admin/Hd/index" method="post">
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
					<b>搜索</b> &nbsp;
					城市 ：
				</td>
				<td>
					<select name="CityID" class="combox">
						<option value="">全部</option>
						<?php if(is_array($city)): $i = 0; $__LIST__ = $city;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vos): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vos['ID']); ?>" <?php if($_REQUEST['CityID']== $vos['ID']): ?>selected<?php endif; ?>><?php echo ($vos['NAME']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
				</td>
				<td>
					状态：
				</td>
				<td>
					<select name="status" class="combox">
						<option value="">全部</option>
						<option value="0" <?php if($_REQUEST['status']== '0'): ?>selected<?php endif; ?>>未审核</option>
						<option value="-1" <?php if($_REQUEST['status']== '-1'): ?>selected<?php endif; ?>>审核不通过</option>
						<option value="1" <?php if($_REQUEST['status']== '1'): ?>selected<?php endif; ?>>审核通过</option>
				  	</select>
				</td>
				<td>
				 	关键字：
				</td>
				<td>
					<input type="text" name="keyword" value="<?php echo ($_REQUEST['keyword']); ?>" /> 
				</td>		
				<td>
					是否m站：
				</td>
				<td>
					<select name="Ism" class="combox">
						<option value="">全部</option>
						<option value="0" <?php if($_REQUEST['Ism']== '0'): ?>selected<?php endif; ?>>否</option>
						<option value="1" <?php if($_REQUEST['Ism']== '1'): ?>selected<?php endif; ?>>是</option>
				  	</select> 
						
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
			<li><a class="add" href="/Admin/Hd/add" target="navTab" width="550" height="380" rel="user_msg" title="添加活动"><span>添加</span></a></li>
			<li><a class="delete" href="/Admin/Hd/del/id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>/navTabId/liststu" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
			<li><a class="edit" href="/Admin/Hd/edit/id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>"  width="550" height="380" target="navTab"><span>修改</span></a></li>
			<li class="line">line</li>
			<li><a class="icon"  href="javascript:navTabPageBreak()"><span>刷新</span></a></li>
			<!--<li><a class="icon" href="demo/common/dwz-team.xls" target="dwzExport" targetType="navTab" title="实要导出这些记录吗?"><span>导出EXCEL</span></a></li>-->
			<li><a class="delete" href="/Admin/Hd/audit/type/y" target="selectedTodo" postType="string" title="确定审核通过？"><span>批量审核通过</span></a></li>
			<li><a class="delete" href="/Admin/Hd/audit/type/n" target="selectedTodo" postType="string" title="确定审核不通过？"><span>批量审核不通过</span></a></li>
		</ul>
	</div>
	<table class="table" width="100%" layoutH="112">
		<thead>
			<tr>
				<th width="2"><input type="checkbox" group="ids" class="checkboxCtrl"></th>
				<th width="5" orderField="ID" <?php if($_REQUEST['_order']== 'ID'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>ID</th>
				<th width="10" orderField="Title" <?php if($_REQUEST['_order']== 'Title'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>标题</th>
				<th width="40" orderField="EndTime" <?php if($_REQUEST['_order']== 'EndTime'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>结束时间</th>
				<th width="50" orderField="UpdateTime" <?php if($_REQUEST['_order']== 'UpdateTime'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>更新时间</th>
				<th width="20" >报名人数</th>
				<th width="20" >是否m站</th>
				<th width="2%" >外链地址</th>
				<th width="30" >活动链接</th>
				<th width="40" orderField="Status" <?php if($_REQUEST['_order']== 'Status'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>状态</th>
				<th width="50">备注</th>
				<th width="110" >基本操作</th>
				
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr target="item_id" rel="<?php echo ($vo["ID"]); ?>">
					<td><input name="ids" value="<?php echo ($vo["ID"]); ?>" type="checkbox"></td>
					<td><?php echo ($vo["ID"]); ?></td>
					<td><?php echo ($vo["Title"]); ?></td>
					<td><?php echo ($vo["EndTime"]); ?></td>
					<td><?php echo ($vo["UpdateTime"]); ?></td>
					<td><?php echo (gethdbmnum($vo["ID"])); ?></td>
					<td><?php if($vo["Ism"] == '0'): ?>否<?php else: ?>是<?php endif; ?></td>
					<td><?php echo ($vo["LinkUrl"]); ?></td>
					<td>
						<?php if($vo["Ism"] == '0'): ?><a href="http://<?php echo ($webset["DOMAIN"]); ?>/hd/index/id/<?php echo ($vo["ID"]); ?>.html" target="_blank">预览</a>

						<?php else: ?>
							<a href="http://<?php echo ($webset["DOMAIN"]); ?>/hd/index/id/<?php echo ($vo["ID"]); ?>/type/m.html" target="_blank">预览</a><?php endif; ?>
					</td>
					<td>
						<?php switch($vo["Status"]): case "0": ?>待审核<?php break;?>    
							<?php case "1": ?>审核通过<?php break;?>    
							<?php case "-1": ?>审核不通过<?php break;?>    
							<?php default: ?>待审核<?php endswitch;?>
					</td>
					<td><?php echo ($vo["StatusDescription"]); ?></td>
					<td>
					<a class="edit" href="/Admin/Hd/check/id/<?php echo ($vo["ID"]); ?>"  width="550" height="380" target="navTab"><span>审核</span></a>
					<a class="edit" href="/Admin/Hd/edit/id/<?php echo ($vo["ID"]); ?>"  width="550" height="380" target="navTab"><span>修改</span></a>
					<?php if($vo["LinkUrl"] == ''): ?><a class="edit" <?php if($vo["Ism"] == '0'): ?>href="javascript:display(<?php echo ($vo["ID"]); ?>)"<?php else: ?>href="javascript:mdisplay(<?php echo ($vo["ID"]); ?>)"<?php endif; ?>  width="550" height="380" ><span>编辑活动页面</span></a><?php endif; ?>
					<a class="edit" href="/Admin/Hd/del/id/<?php echo ($vo["ID"]); ?>"  width="550" height="380" target="ajaxTodo"  title="确定要删除吗?"><span>删除</span></a>
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
	var url = "/Admin/Hd/editDisplay/id/"+id;
	 var xpwidth=window.screen.width-10;
		var xpheight=window.screen.height-105;
	   // alert(xpheight);
		//window.open('map/mapview.aspx', '_blank', 'resizable=yes,directories=no,top=0,left=0,width='+xpwidth+',height='+xpheight);
	window.open(url,'newWindow','scrollbars=yes, resizable=yes,resizable=yes,directories=no,top=0,left=0,width='+xpwidth+',height='+xpheight);

	
}

function mdisplay(id){
	//alert(img.width());
	//alert(image);
	var url = "/Admin/Hd/meditDisplay/id/"+id;
	 var xpwidth=window.screen.width-10;
		var xpheight=window.screen.height-105;
	   // alert(xpheight);
		//window.open('map/mapview.aspx', '_blank', 'resizable=yes,directories=no,top=0,left=0,width='+xpwidth+',height='+xpheight);
	window.open(url,'newWindow','scrollbars=yes, resizable=yes,resizable=yes,directories=no,top=0,left=0,width='+xpwidth+',height='+xpheight);

	
}


 </script>
</div>
<script type="text/javascript">
	//定义函数处理选择框的选择
	function doSelect(m){
		//获取上面所有的input节点
		var list = document.getElementsByTagName("input");
		//遍历
		for(var i=0;i<list.length;i++){
			//判断如何选择中
			switch(m){
				case 0: list[i].checked=true;   break; //全选
				case 1: list[i].checked=false;  break; //全不选
				case 2: list[i].checked=!list[i].checked;  break; //反选
			}
		}
	}
</script>