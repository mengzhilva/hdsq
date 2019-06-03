<?php if (!defined('THINK_PATH')) exit();?><form id="pagerForm" action="/Admin/Hd/chajianlist" method="post">
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
					<b>搜索</b>城市 
					<select name="CityID">
					<option value="">全部</option>
					<?php if(is_array($city)): $i = 0; $__LIST__ = $city;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['ID']); ?>" <?php if($_POST['CityID']== $vo['ID']): ?>selected<?php endif; ?>><?php echo ($vo['NAME']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
 				</select>
					&nbsp; 活动名称：<input type="text" name="keyword" value="<?php echo ($_POST['keyword']); ?>" /> 
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
			<li><a class="edit" href="/Admin/Hd/chajianedit/id/<?php echo (C("TMPL_L_DELIM")); ?>item_id<?php echo (C("TMPL_R_DELIM")); ?>"  width="550" height="380" target="dialog"><span>修改</span></a></li>
			<li class="line">line</li>
			<li><a class="icon"  href="javascript:navTabPageBreak()"><span>刷新</span></a></li>
			<!--<li><a class="icon" href="demo/common/dwz-team.xls" target="dwzExport" targetType="navTab" title="实要导出这些记录吗?"><span>导出EXCEL</span></a></li>-->
		</ul>
	</div>
	<table class="table" width="100%" layoutH="112">
		<thead>
			<tr>
				<th width="40" orderField="chid" <?php if($_REQUEST['_order']== 'chid'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>ID</th>
				<th width="150" orderField="Title" <?php if($_REQUEST['_order']== 'Title'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>活动名称</th>
				<th width="150" orderField="Title" <?php if($_REQUEST['_order']== 'Title'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>城市</th>
				<th width="150" orderField="CityID" <?php if($_REQUEST['_order']== 'CityID'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>插件标题</th>
				<th width="150" orderField="name" <?php if($_REQUEST['_order']== 'name'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>字体颜色</th>
				<th width="100" orderField="color" <?php if($_REQUEST['_order']== 'color'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>提交图片</th>
				<th width="100" orderField="color" <?php if($_REQUEST['_order']== 'color'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>热点链接地址</th>
				<th width="100" orderField="caseid" <?php if($_REQUEST['_order']== 'caseid'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>案例ID</th>
				<th width="150" orderField="age" <?php if($_REQUEST['_order']== 'age'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>基本操作</th>
				
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr target="item_id" rel="<?php echo ($vo["chid"]); ?>">
					<td><?php echo ($vo["chid"]); ?></td>
					<td><?php echo ($vo["Title"]); ?></td>
					<td><?php echo (getcityname($vo["CityID"])); ?></td>
					<td><?php echo ($vo["name"]); echo ($vo["chid"]); ?></td>
					<td><?php echo ($vo["color"]); ?></td>
					<td><?php if($vo['image'] != ''): ?><img src="<?php echo ($vo["image"]); ?>" ><?php endif; ?></td>
					<td><?php echo ($vo["curl"]); ?></td>
                                        <td><?php echo ($vo["caseid"]); ?></td>
					<td>
					<?php if( $vo['cjid'] != 5 && $vo['cjid'] != 6 && $vo['cjid'] != 7): ?><a class="edit" href="/Admin/Hd/chajianedit/id/<?php echo ($vo["chid"]); ?>"  width="550" height="380" target="navTab"><span>修改</span></a><?php endif; ?>
					<?php if( $vo['cjid'] == 9 or $vo['cjid'] == 19): ?><a class="edit" href="/Admin/Hd/hdplist/id/<?php echo ($vo["chid"]); ?>"  width="550" height="380" target="navTab" rel="hdlist"><span>图片管理</span></a><?php endif; ?>
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


 </script>
</div>