<?php if (!defined('THINK_PATH')) exit();?>
<div class="pageContent">
	<form method="post" action="/Admin/Hd/insert/navTabId/listhd/callbackType/closeCurrent"  class="pageForm required-validate" 
		onsubmit="return validateCallback(this,navTabAjaxDone);"><?php  ?>
		<div class="pageFormContent nowrap" layoutH="60" >
			<dl style="display:none;">
				<dt>城市：</dt>
				<dd><select name="CityID" class="combox">
					<?php if(is_array($city)): $i = 0; $__LIST__ = $city;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['ID']); ?>" <?php if($info['CityID'] == $vo['ID']): ?>selected<?php endif; ?>><?php echo ($vo['NAME']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select></dd>
			</dl>
			
			<dl>
				<dt>标题：</dt>
				<dd><input type="text" class="required"  style="width:100%" name="Title"/></dd>
			</dl>
			<dl style="display:none;">
				<dt>短信内容：</dt>
				<dd><input type="text"  style="width:100%" name="phonecontent" value="您申请获取的“xxx ”活动的地点：xxx。"/></dd>
			</dl>
			<dl style="display:none;">
				<dt>外链地址：</dt>
				<dd><input type="text"  style="width:100%" name="url"/></dd>
			</dl>
			<dl style="">
				<dt>活动地址：</dt>
				<dd><input type="text" name="address" size="80" class=""></dd>
			</dl>
			<dl>
				<dt>是否m站：</dt>
				<dd>
					<label><input type="radio" name="Ism" value="1">是</label>
					<label><input type="radio" name="Ism" checked value="0">否</label>
				</dd>
			</dl>
			<dl style="display:none;">
				<dt>活动亮点(m站填)：</dt>
				<dd><textarea name="hdld" rows="8" cols="50">
				</textarea></dd>
			</dl>
			<dl>
				<dt>结束时间：</dt>
				<dd><input type="text"  class="date required textInput readonly valid"  name="EndTime"/></dd>
			</dl>
			<dl>
				<dt>活动时间：</dt>
				<dd><input type="text" class="date required textInput readonly valid" name="starttime"></dd>
			</dl>
			<dl>
				<dt>背景图片：<br>电脑端应大于宽1920px，如果是m站活动，上传图片宽度为640px</dt>
				<dd>

				<img id="uploadimg" style="display:blodk;float:left;width:200px;height:100px;" src="<?php echo ($vo["background"]); ?>"/>
				<a class="button" href="/Admin/Demo/add"  target="dialog"><span>上传图片</span></a>

				<input type="hidden" style="width:100%" name="background" id="background" class="valid">
				</dd>
			</dl>
			<dl>
				<dt>背景颜色：</dt>
				<dd>
					<input style="width:80px;background:<?php echo ($vo['color']); ?>" name="backgroundcolor" type="text" id="colors" class="add_tr4_input" value="<?php echo ($vo["color"]); ?>" />
					
					<input style="display:none;" type="color" id="color" />
					<a id="btn">选择颜色</a>
				</dd>
			
			</dl>
			
		</div>
		
		<div class="formBar">
			<ul>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
				<li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
			</ul>
		</div>
	</form>
	<script type="text/javascript">
document.getElementById('btn').onclick = function(){
	$("#color").show();
	document.getElementById('color').click();
};

document.getElementById('color').onchange = function(){
	$("#colors").val(this.value);
	$("#colors").css('background',this.value);
	$("#color").hide();
};
</script>
</div>