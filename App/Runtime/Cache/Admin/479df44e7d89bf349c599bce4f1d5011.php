<?php if (!defined('THINK_PATH')) exit();?>
<div class="pageContent">
	<form method="post" action="/Admin/Hd/chajianupdate/navTabId/listhdcj/callbackType/closeCurrent"  class="pageForm required-validate" 
		onsubmit="return validateCallback(this,navTabAjaxDone);"><?php  ?>
		<input type="hidden" name="id" value="<?php echo ($vo["chid"]); ?>"/>
		<div class="pageFormContent nowrap" layoutH="60"  >
			
			<dl>
				<dt>标题：</dt>
				<dd><?php echo ($vo["name"]); echo ($vo["chid"]); ?></dd>
			</dl>
			<?php if(!in_array(($vo["cjid"]), explode(',',"10,20,24,28,29"))): ?><dl>
		
				<dt>字体颜色：</dt>
				<dd>
		            <input style="width:80px;background:<?php echo ($vo['color']); ?>" name="color" type="text" id="colors" class="add_tr4_input" value="<?php echo ($vo["color"]); ?>" />
		         	
					<input style="display:none;" type="color" id="color" />
					<a id="btn">选择颜色</a>
				</dd>
			

			</dl>
                        <?php if(in_array(($vo["cjid"]), explode(',',"4,14"))): ?><dl>
                            <dt>字体大小：</dt>
                            <dd>
                                <input name="font_size" type="text" maxlength="3" class="digits" value="<?php echo ($vo["font_size"]); ?>">
                                       <span class="info">单位(像素),默认值PC:23,M:26,只需要输入数字即可</span>
                            </dd>
                        </dl><?php endif; endif; ?>
			<?php if($vo['cjid'] == 3 or $vo['cjid'] == 10 or $vo['cjid'] == 20 or $vo['cjid'] == 13 or $vo['cjid'] == 28 or $vo['cjid'] == 29): ?><dl>
				<dt>链接：</dt>
				<dd>
					<input type="text" id="url" name="url" value="<?php echo ($vo['curl']); ?>"/>
				</dd>
			
			</dl><?php endif; ?>
			<?php if($vo['cjid'] == 21 or $vo['cjid'] == 22 or $vo['cjid'] == 24 or $vo['cjid'] == 28 or $vo['cjid'] == 29): ?><dl>
				<dt>背景图片：</dt>
				<dd>
				<div style="display:blodk;width:500px;">
				<img id="backgroundimgi"  style="display:blodk;float:left;width:200px;height:100px;" src="<?php echo ($vo["backgroundimg"]); ?>"/>
				<a style="display:blodk;float:left;width:100px;height:50px;padding-top:50px;padding-left:20px;" href="/Admin/Hd/upindex/type/backgroundimg"  target="dialog">上传图片</a>
				</div>
				
				
				<input type="hidden" style="width:100%" name="backgroundimg" id="backgroundimg" value="<?php echo ($vo["backgroundimg"]); ?>" class="valid">
			</dl><?php endif; ?>
			<?php if($vo['cjid'] == 1 or $vo['cjid'] == 2 or $vo['cjid'] == 11 or $vo['cjid'] == 12 or $vo['cjid'] == 21 or $vo['cjid'] == 22 or $vo['cjid'] == 23 or $vo['cjid'] == 25 or $vo['cjid'] == 28 or $vo['cjid'] == 29): ?><dl>			
			<?php if($vo['cjid'] == 28 or $vo['cjid'] == 29): ?><dt>鼠标移入图片：(150px*36px)</dt>
			<?php else: ?>
				<dt>提交图片：(150px*36px)</dt><?php endif; ?>
				<dd>
				<div style="display:blodk;width:500px;">
				<img id="imagei"  style="display:blodk;float:left;width:200px;height:100px;" src="<?php echo ($vo["image"]); ?>"/>
				<a style="display:blodk;float:left;width:100px;height:50px;padding-top:50px;padding-left:20px;" href="/Admin/Hd/upindex/type/image"  target="dialog">上传图片</a>
				</div>
				
				
				<input type="hidden" style="width:100%" name="image" id="image" value="<?php echo ($vo["image"]); ?>" class="valid">
			</dl><?php endif; ?>
			
			<?php if($vo['cjid'] == 9 ): ?><dl>
				<dt>宽：</dt>
				<dd>
					<input type="text" id="url" name="width" value="<?php echo ($vo['hwidth']); ?>"/>
				</dd>
			
			</dl>
			<dl>
				<dt>高：</dt>
				<dd>
					<input type="text" id="url" name="height" value="<?php echo ($vo['hheight']); ?>"/>
				</dd>
			
			</dl><?php endif; ?>
                        <?php if($vo['cjid'] == 26 or $vo['cjid'] == 27): ?><dl>
                                <dt>案例ID：</dt>
                                <dd>
					<input type="text" id="caseid" name="caseid" value="<?php echo ($vo['caseid']); ?>"/>
				</dd>
                            </dl><?php endif; ?>
		</div>
		
		<div class="formBar">
			<ul>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
				<li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
			</ul>
		</div>
	</form>
	<?php if(!in_array(($vo["cjid"]), explode(',',"10,20,24,28,29"))): ?><script type="text/javascript">
document.getElementById('btn').onclick = function(){
	$("#color").show();
	document.getElementById('color').click();
};

document.getElementById('color').onchange = function(){
	$("#colors").val(this.value);
	$("#colors").css('background',this.value);
	$("#color").hide();
};

</script><?php endif; ?>

    <script>
    function filebackgood(json){

        if(json.state == 200){
            var pho = ""+json.msg;
            // alert(pho);
            switch(json.type){
                case "image":
                    $.pdialog.closeCurrent();
                    $("#imagei").attr('src',pho);
                    $("#image").val(json.msg);
                    break;
                case "backgroundimg":
                    $.pdialog.closeCurrent();
                    $("#backgroundimgi").attr('src',pho);
                    $("#backgroundimg").val(json.msg);
                    break;
            }
        }
    }
    </script>
</div>