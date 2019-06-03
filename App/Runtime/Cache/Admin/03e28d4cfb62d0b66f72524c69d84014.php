<?php if (!defined('THINK_PATH')) exit();?>
<div class="pageContent">
	<form method="post" action="/Admin/Demo/doUpload/navTabId/listnode/callbackType/closeCurrent"  class="pageForm required-validate" enctype="multipart/form-data"
		onsubmit="return iframeCallback(this,fileback);"><?php  ?>
		<div class="pageFormContent" layoutH="60">
			<dl>
				<dt>文件：</dt>
				<dd><input type="file"  style="width:100%" name="pic"/></dd>
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