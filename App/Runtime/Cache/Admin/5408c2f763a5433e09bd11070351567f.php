<?php if (!defined('THINK_PATH')) exit();?>
<div class="pageContent">
	<form method="post" action="/Admin/Hd/updatecheck/navTabId/listhd/callbackType/closeCurrent"  class="pageForm required-validate" 
		onsubmit="return validateCallback(this,navTabAjaxDone);"><?php  ?>
		<input type="hidden" name="id" value="<?php echo ($vo["ID"]); ?>"/>
		<div class="pageFormContent" layoutH="60" style="width:700px;overflow-x:hidden !important;">
			<dl style="width:680px;min-height:100px;">
				<dt>审核意见：</dt>
				<dd>
					
				<textarea name="STATUSDESCRIPTION" cols="50" rows="5" class="textInput"><?php echo ($vo["StatusDescription"]); ?></textarea>
				</dd>
			</dl>
			
			<dl style="width:680px;min-height:100px;">
				<dt>审核结果：</dt>
				<dd style="width:380px;min-height:100px;">
                    <label   style="width:50px;;" for="STATUS_0">审核通过</label>
                 <input  style="float:left;" id="STATUS_0" type="radio" name="STATUS" value="1" <?php if($vo["Status"] == 1): ?>checked<?php endif; ?> >
                    <label  style="width:60px;;" for="STATUS_1">审核不通过</label>
                 <input  style="float:left;" id="STATUS_1" type="radio" name="STATUS" value="-1" <?php if($vo["Status"] == '-1'): ?>checked<?php endif; ?>>
             
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