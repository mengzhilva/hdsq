<?php if (!defined('THINK_PATH')) exit();?>
<div class="pageContent">
	<form method="post" action="/Admin/Webset/update/navTabId/listcity/callbackType/closeCurrent"  class="pageForm required-validate" 
		onsubmit="return validateCallback(this,navTabAjaxDone);"><?php  ?>
		<input type="hidden" name="id" value="<?php echo ($info["ID"]); ?>"/>
		<div class="pageFormContent nowrap" layoutH="60" >
			<dl>
				<dt>名称：</dt>
				<dd><input type="text" class="required"  style="width:100%" name="name" value="<?php echo ($info["NAME"]); ?>"/></dd>
			</dl>
			
			<dl>
				<dt>域名：</dt>
				<dd><input type="text" class="required"  style="width:100%" name="DOMAIN" value="<?php echo ($info["DOMAIN"]); ?>"/></dd>
			</dl>
			<dl>
				<dt>联系方式：</dt>
				<dd><input type="text" class="required"  style="width:100%" name="phone" value="<?php echo ($info["phone"]); ?>"/></dd>
			</dl>
			<dl>
				<dt>SEO标题：</dt>
				<dd><input type="text"   style="width:100%" name="SEONAME" value="<?php echo ($info["SEONAME"]); ?>"/></dd>
			</dl>
			<dl>
				<dt>SEO关键字：</dt>
				<dd><input type="text"   style="width:100%" name="SEOKEYWORD" value="<?php echo ($info["SEOKEYWORD"]); ?>"/></dd>
			</dl>
			<dl>
				<dt>SEO描述：</dt>
				<dd><input type="text"   style="width:100%" name="SEODESCRIPTION" value="<?php echo ($info["SEODESCRIPTION"]); ?>"/></dd>
			</dl>
			<dl>
				<dt>备案号：</dt>
				<dd><input type="text"   style="width:100%" name="beian" value="<?php echo ($info["beian"]); ?>"/></dd>
			</dl>

			<dl>
				<dt>页眉logo图片：</dt>
				<dd>

				<img id="uploadimg" style="display:blodk;float:left;width:200px;height:100px;" src="<?php echo ($info["headerlogo"]); ?>"/>
				<a class="button" href="/Admin/Demo/add"  target="dialog"><span>上传图片</span></a>

				<input type="hidden" style="width:100%" name="headerlogo" id="background" value="<?php echo ($info["headerlogo"]); ?>" class="valid">
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
</div>