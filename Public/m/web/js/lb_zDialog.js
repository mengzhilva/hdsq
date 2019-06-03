/**
 * zLDialog 2.0
 * 最后修正：2009-12-18
 **/
var IMAGESPATH = 'http://m.sitrue.cc/Public/web/images/';
//var IMAGESPATH = 'http://www.5-studio.com/wp-content/uploads/2009/11/'; //图片路径配置
/*************************一些公用方法和属性****************************/
var isIE = navigator.userAgent.indexOf('MSIE') != -1;
var isIE6 = navigator.userAgent.indexOf('MSIE 6.0') != -1;
var isIE8 = !!window.XDomainRequest && !!document.documentMode;
if(isIE)
	try{ document.execCommand('BackgroundImageCache',false,true); }catch(e){}

var $id = function (id) {
    return typeof id == "string" ? document.getElementById(id) : id;
};
//if (!$) var $ = $id;

Array.prototype.remove = function (s, dust) { //如果dust为ture，则返回被删除的元素
    if (dust) {
        var dustArr = [];
        for (var i = 0; i < this.length; i++) {
            if (s == this[i]) {
                dustArr.push(this.splice(i, 1)[0]);
            }
        }
        return dustArr;
    }
    for (var i = 0; i < this.length; i++) {
        if (s == this[i]) {
            this.splice(i, 1);
        }
    }
    return this;
}

var $topWindow = function () {
    var parentWin = window;
    while (parentWin != parentWin.parent) {
        if (parentWin.parent.document.getElementsByTagName("FRAMESET").length > 0) break;
        parentWin = parentWin.parent;
    }
    return parentWin;
};
var $bodyDimensions = function (win) {
    win = win || window;
    var doc = win.document;
    var cw = doc.compatMode == "BackCompat" ? doc.body.clientWidth : doc.documentElement.clientWidth;
    var ch = doc.compatMode == "BackCompat" ? doc.body.clientHeight : doc.documentElement.clientHeight;
    var sl = Math.max(doc.documentElement.scrollLeft, doc.body.scrollLeft);
    var st = Math.max(doc.documentElement.scrollTop, doc.body.scrollTop); //考虑滚动的情况
    var sw = Math.max(doc.documentElement.scrollWidth, doc.body.scrollWidth);
    var sh = Math.max(doc.documentElement.scrollHeight, doc.body.scrollHeight); //考虑滚动的情况
    var w = Math.max(sw, cw); //取scrollWidth和clientWidth中的最大值
    var h = Math.max(sh, ch); //IE下在页面内容很少时存在scrollHeight<clientHeight的情况
    return {
        "clientWidth": cw,
        "clientHeight": ch,
        "scrollLeft": sl,
        "scrollTop": st,
        "scrollWidth": sw,
        "scrollHeight": sh,
        "width": w,
        "height": h
    }
};

var fadeEffect = function(element, start, end, speed, callback){//透明度渐变：start:开始透明度 0-100；end:结束透明度 0-100；speed:速度1-100
	if(!element.effect)
		element.effect = {fade:0, move:0, size:0};
	clearInterval(element.effect.fade);
	var speed=speed||20;
	element.effect.fade = setInterval(function(){
		start = start < end ? Math.min(start + speed, end) : Math.max(start - speed, end);
		element.style.opacity =  start / 100;
		element.style.filter = "alpha(opacity=" + start + ")";
		if(start == end){
			clearInterval(element.effect.fade);
			if(callback)
				callback.call(element);
		}
	}, 20);
};

/*************************弹出框类实现****************************/
var topWin = $topWindow();
var topDoc = topWin.document;
var LDialog = function () {
    /****以下属性以大写开始，可以在调用show()方法前设置值****/
    this.ID = null;
    this.Width = null;
    this.Height = null;
	this.Div_height = this.Height;
    this.URL = null;
	this.OnLoad=null;
    this.InnerHtml = ""
    this.InvokeElementId = ""
    this.Top = "0";
    this.Left = "50%";
    this.Title = "";
    this.OKEvent = null; //点击确定后调用的方法
    this.CancelEvent = null; //点击取消及关闭后调用的方法
    this.ShowButtonRow = false;
    this.MessageIcon = "window.gif";
    this.MessageTitle = "";
    this.Message = "";
    this.ShowMessageRow = false;
    this.Modal = true;
    this.Drag = true;
    this.AutoClose = null;
    this.ShowCloseButton = true;
	this.Animator = true;
    /****以下属性以小写开始，不要自行改变****/
    this.LDialogDiv = null;
	this.bgDiv=null;
    this.parentWindow = null;
    this.innerFrame = null;
    this.innerWin = null;
    this.innerDoc = null;
    this.zindex = 900;
    this.cancelButton = null;
    this.okButton = null;

    if (arguments.length > 0 && typeof(arguments[0]) == "string") { //兼容旧写法
        this.ID = arguments[0];
    } else if (arguments.length > 0 && typeof(arguments[0]) == "object") {
        LDialog.setOptions(this, arguments[0])
    }
	if(!this.ID)
        this.ID = topWin.LDialog._Array.length + "";

};

LDialog._Array = [];
LDialog.bgDiv = null;
LDialog.setOptions = function (obj, optionsObj) {
    if (!optionsObj) return;
    for (var optionName in optionsObj) {
        obj[optionName] = optionsObj[optionName];
    }
};
LDialog.attachBehaviors = function () {
    if (isIE) {
        document.attachEvent("onkeydown", LDialog.onKeyDown);
        window.attachEvent('onresize', LDialog.resetPosition);
    } else {
        document.addEventListener("keydown", LDialog.onKeyDown, false);
        window.addEventListener('resize', LDialog.resetPosition, false);
    }
};
LDialog.prototype.attachBehaviors = function () {
    if (this.Drag && topWin.Drag) topWin.Drag.init(topWin.$id("_Draghandle_" + this.ID), topWin.$id("_LDialogDiv_" + this.ID)); //注册拖拽方法
    if (!isIE && this.URL) { //非ie浏览器下在拖拽时用一个层遮住iframe，以免光标移入iframe失去拖拽响应
        var self = this;
        topWin.$id("_LDialogDiv_" + this.ID).onDragStart = function () {
            topWin.$id("_Covering_" + self.ID).style.display = ""
        }
        topWin.$id("_LDialogDiv_" + this.ID).onDragEnd = function () {
            topWin.$id("_Covering_" + self.ID).style.display = "none"
        }
    }
};
LDialog.prototype.displacePath = function () {
    if (this.URL.substr(0, 7) == "http://" || this.URL.substr(0, 1) == "/" || this.URL.substr(0, 11) == "javascript:") {
        return this.URL;
    } else {
        var thisPath = this.URL;
        var locationPath = window.location.href;
        locationPath = locationPath.substring(0, locationPath.lastIndexOf('/'));
        while (thisPath.indexOf('../') >= 0) {
            thisPath = thisPath.substring(3);
            locationPath = locationPath.substring(0, locationPath.lastIndexOf('/'));
        }
        return locationPath + '/' + thisPath;
    }
};
LDialog.prototype.setPosition = function () {
    var bd = $bodyDimensions(topWin);
    var thisTop = this.Top,
        thisLeft = this.Left,
		thisLDialogDiv=this.getLDialogDiv();
    if (typeof this.Top == "string" && this.Top.substring(this.Top.length - 1, this.Top.length) == "%") {
        var percentT = this.Top.substring(0, this.Top.length - 1) * 0.01;
        thisTop = bd.clientHeight * percentT - thisLDialogDiv.scrollHeight * percentT + bd.scrollTop;
    }
    if (typeof this.Left == "string" && this.Left.substring(this.Left.length - 1, this.Left.length) == "%") {
        var percentL = this.Left.substring(0, this.Left.length - 1) * 0.01;
        thisLeft = bd.clientWidth * percentL - thisLDialogDiv.scrollWidth * percentL + bd.scrollLeft;
		thisLeft = 0;
    }
	
    thisLDialogDiv.style.top = Math.round(thisTop) + "px";
    thisLDialogDiv.style.left = Math.round(thisLeft) + "px";
};

LDialog.setBgDivSize = function () {
    var bd = $bodyDimensions(topWin);
	if(LDialog.bgDiv){
			if(isIE6){
				LDialog.bgDiv.style.height = bd.clientHeight + "px";
				LDialog.bgDiv.style.top=bd.scrollTop + "px";
				LDialog.bgDiv.childNodes[0].style.display = "none";//让div重渲染,修正IE6下尺寸bug
				LDialog.bgDiv.childNodes[0].style.display = "";
			}else{
				LDialog.bgDiv.style.height = bd.scrollHeight + "px";
			}
		}
};
LDialog.resetPosition = function () {
    LDialog.setBgDivSize();
    for (var i = 0, len = topWin.LDialog._Array.length; i < len; i++) {
        topWin.LDialog._Array[i].setPosition();
    }
};
LDialog.prototype.create = function () {
    var bd = $bodyDimensions(topWin);
    if (typeof(this.OKEvent)== "function") this.ShowButtonRow = true;
    if (!this.Width) this.Width = Math.round(bd.clientWidth * 4 / 10);
    if (!this.Height) this.Height = Math.round(this.Width / 2);
    if (this.MessageTitle || this.Message) this.ShowMessageRow = true;
    var LDialogDivWidth = this.Width;
	var Div_height = this.Height;
	var Div_width = this.Width;
    var LDialogDivHeight = this.Height + 33 + 13 + (this.ShowButtonRow ? 40 : 0) + (this.ShowMessageRow ? 50 : 0);
    if (LDialogDivWidth > bd.clientWidth) this.Width = Math.round(bd.clientWidth - 26);
    if (LDialogDivHeight > bd.clientHeight) this.Height = Math.round(bd.clientHeight - 46 - (this.ShowButtonRow ? 40 : 0) - (this.ShowMessageRow ? 50 : 0));
    
	var html = '\
  <table id="_LDialogTable_' + this.ID  + '" height="' + Div_height + '" width="' + (this.Width) + '" cellspacing="0" cellpadding="0" border="0" onselectstart="return false;" style="-moz-user-select: none; font-size:12px; line-height:1.4;background-color:#000;  ">\
    <tr id="_Draghandle_' + this.ID + '" style="' + (this.Drag ? "cursor: move;" : "") + '">\
      <td width="0" ><div style="width: 0px;"></div></td>\
      <td  ><div style="padding: 9px 0 0 0px; float: left; font-weight: bold;text-align:left; font-size:16px;color:#fa4c06;width:100%;line-height:33px;position:relative;"><span style="font-size:16px;" id="_Title_' + this.ID + '">' + '</span></div>\
        <div onclick="LDialog.getInstance(\'' + this.ID + '\').cancelButton.onclick.apply(LDialog.getInstance(\'' + this.ID + '\').cancelButton,[]);" onmouseout="this.style.backgroundImage=\'url(' + IMAGESPATH + 'dialog_closebtn_over.png)\'" onmouseover="this.style.backgroundImage=\'url(' + IMAGESPATH + 'dialog_closebtn_over.png)\'"  style="right:25px; top:20px; position:absolute; height: 28px; width: 28px;  z-index:999;cursor: pointer; background-image: url(' + IMAGESPATH + 'dialog_closebtn_over.png);' + (this.ShowCloseButton ? "" : "display:none;") + '"></div></td>\
      <td width="0"><div style="width: 0px;"><a id="_forTab_' + this.ID + '" href="#;"></a></div></td>\
    </tr>\
    <tr valign="top">\
      <td align="center"     style="border-collapse:collapse;"><table width="100%" cellspacing="0" cellpadding="0" border="0" >\
          <tr id="_MessageRow_' + this.ID + '" style="' + (this.ShowMessageRow ? "" : "display:none") + '">\
            <td valign="top" height="50"><table width="100%" cellspacing="0" cellpadding="0" border="0" style="background:#eaece9 url(' + IMAGESPATH + 'LDialog_bg.jpg) no-repeat scroll right top;" id="_MessageTable_' + this.ID + '">\
                <tr>\
                  <td width="50" height="50" align="center"><img width="32" height="32" src="' + IMAGESPATH + this.MessageIcon + '" id="_MessageIcon_' + this.ID + '"/></td>\
                  <td align="left" style="line-height: 16px;"><div id="_MessageTitle_' + this.ID + '" style="font-weight:bold">' + this.MessageTitle + '</div>\
                    <div id="_Message_' + this.ID + '">' + this.Message + '</div></td>\
                </tr>\
              </table></td>\
          </tr>\
          <tr>\
            <td valign="top" align="center"><div id="_Container_' + this.ID + '" style="position: relative; width: ' + Div_width + 'px; height: ' + this.Height + 'px;">\
                <div style="position: absolute; height: 100%; width: 100%; display: none; background-color:#fff; opacity: 0.5;" id="_Covering_' + this.ID + '">&nbsp;</div>\
	' + (function (obj) {
        if (obj.InnerHtml) return obj.InnerHtml;
        if (obj.URL) return '<iframe width="100%" height="100%" frameborder="0" style="border:none 0;" allowtransparency="true" id="_LDialogFrame_' + obj.ID + '" src="' + obj.displacePath() + '"></iframe>';
        return "";
    })(this) + '\
              </div></td>\
          </tr>\
          <tr id="_ButtonRow_' + this.ID + '" style="' + (this.ShowButtonRow ? "" : "display:none") + '">\
            <td height="36"><div id="_LDialogButtons_' + this.ID + '" style=" padding: 8px 20px; text-align: right; ">\
                <input type="button" class="buttonStyle" style="display:none;" value="确 定" id="_ButtonOK_' + this.ID + '"/>\
                <input type="button" class="buttonStyle" style="position:absolute; left:528px; top:233px; border:none; background:#fff; color:#555555; font-size:14px; cursor:pointer; text-decoration: underline;" value="取消" onclick="LDialog.getInstance(\'' + this.ID + '\').close();" id="_ButtonCancel_' + this.ID + '"/>\
              </div></td>\
          </tr>\
        </table></td>\
    </tr>\
    <tr>\
      <td width="20" height="13" ></td>\
      <td ></td>\
      <td width="20" height="13" ><a onfocus=\'$id("_forTab_' + this.ID + '").focus();\' href="#;"></a></td>\
    </tr>\
  </table>\
</div>\
'
    var div = topWin.$id("_LDialogDiv_" + this.ID);
    if (!div) {
        div = topDoc.createElement("div");
        div.id = "_LDialogDiv_" + this.ID;
        topDoc.getElementsByTagName("BODY")[0].appendChild(div);
    }
    div.style.position = "fixed";
    div.style.left = "-9999px";
    div.style.top = "-9999px";
    div.innerHTML = html;
    if (this.InvokeElementId) {
        var element = $id(this.InvokeElementId);
        element.style.position = "";
        element.style.display = "";
        if (isIE) {
            var fragment = topDoc.createElement("div");
            fragment.innerHTML = element.outerHTML;
            element.outerHTML = "";
            topWin.$id("_Covering_" + this.ID).parentNode.appendChild(fragment)
        } else {
            topWin.$id("_Covering_" + this.ID).parentNode.appendChild(element)
        }
    }
    this.parentWindow = window;
    if (this.URL) {
        if (topWin.$id("_LDialogFrame_" + this.ID)) {
            this.innerFrame = topWin.$id("_LDialogFrame_" + this.ID);
        };
        var self = this;
        innerFrameOnload = function () {
            try {
				self.innerWin = self.innerFrame.contentWindow;
				self.innerWin.parentLDialog = self;
                self.innerDoc = self.innerWin.document;
                if (!self.Title && self.innerDoc && self.innerDoc.title) {
                    if (self.innerDoc.title) topWin.$id("_Title_" + self.ID).innerHTML = self.innerDoc.title;
                };
            } catch(e) {
                if (console && console.log) console.log("可能存在访问限制，不能获取到iframe中的对象。")
            }
            if (typeof(self.OnLoad)== "function")self.OnLoad();
        };
        if (this.innerFrame.attachEvent) {
            this.innerFrame.attachEvent("onload", innerFrameOnload);
        } else {
            this.innerFrame.onload = innerFrameOnload;
        };
    };
    topWin.$id("_LDialogDiv_" + this.ID).LDialogId = this.ID;
    topWin.$id("_LDialogDiv_" + this.ID).LDialogInstance = this;
    this.attachBehaviors();
    this.okButton = topWin.$id("_ButtonOK_" + this.ID);
    this.cancelButton = topWin.$id("_ButtonCancel_" + this.ID);
	div=null;
};
LDialog.prototype.setSize = function (w, h) {
    if (w && +w > 20) {
        this.Width = +w;
        topWin.$id("_LDialogTable_" + this.ID).width = this.Width + 26;
        topWin.$id("_Container_" + this.ID).style.width = this.Width + "px";
    }
    if (h && +h > 10) {
        this.Height = +h;
        topWin.$id("_Container_" + this.ID).style.height = this.Height + "px";
    }
    this.setPosition();
};
LDialog.prototype.show = function () {
    this.create();
    var bgdiv = LDialog.getBgdiv(),
		thisLDialogDiv=this.getLDialogDiv();
    this.zindex = thisLDialogDiv.style.zIndex = LDialog.bgDiv.style.zIndex + 1;
    if (topWin.LDialog._Array.length > 0) {
        this.zindex = thisLDialogDiv.style.zIndex = topWin.LDialog._Array[topWin.LDialog._Array.length - 1].zindex + 2;
    } else {
        var topWinBody = topDoc.getElementsByTagName(topDoc.compatMode == "BackCompat" ? "BODY" : "HTML")[0];
        //topWinBody.styleOverflow = topWinBody.style.overflow; 去除滚动条
        //topWinBody.style.overflow = "hidden"; 去除滚动条
        bgdiv.style.display = "none";
    }
    topWin.LDialog._Array.push(this);
    if (this.Modal) {
        bgdiv.style.zIndex = topWin.LDialog._Array[topWin.LDialog._Array.length - 1].zindex - 1;
        LDialog.setBgDivSize();
		if(bgdiv.style.display == "none"){
			if(this.Animator){
				var bgMask=topWin.$id("_LDialogBGMask");
				bgMask.style.opacity = 0;
				bgMask.style.filter = "alpha(opacity=0)";
        		bgdiv.style.display = "";
				fadeEffect(bgMask,0,40,isIE6?20:10);
				bgMask=null;
			}else{
        		bgdiv.style.display = "";
			}
		}
    }
    this.setPosition();
    if (this.CancelEvent) {
        this.cancelButton.onclick = this.CancelEvent;
        if(this.ShowButtonRow)this.cancelButton.focus();
    }
    if (this.OKEvent) {
        this.okButton.onclick = this.OKEvent;
        if(this.ShowButtonRow)this.okButton.focus();
    }
    if (this.AutoClose && this.AutoClose > 0) this.autoClose();
    this.opened = true;
	bgdiv=null;
};
LDialog.prototype.close = function () {
	var thisLDialogDiv=this.getLDialogDiv();
    if (this == topWin.LDialog._Array[topWin.LDialog._Array.length - 1]) {
        var isTopLDialog = topWin.LDialog._Array.pop();
    } else {
        topWin.LDialog._Array.remove(this)
    }
    if (this.InvokeElementId) {
        var innerElement = topWin.$id(this.InvokeElementId);
        innerElement.style.display = "none";
        if (isIE) {
            //ie下不能跨窗口拷贝元素，只能跨窗口拷贝html代码
            var fragment = document.createElement("div");
            fragment.innerHTML = innerElement.outerHTML;
            innerElement.outerHTML = "";
            document.getElementsByTagName("BODY")[0].appendChild(fragment)
        } else {
            document.getElementsByTagName("BODY")[0].appendChild(innerElement)
        }

    }
    if (topWin.LDialog._Array.length > 0) {
        if (this.Modal && isTopLDialog) LDialog.bgDiv.style.zIndex = topWin.LDialog._Array[topWin.LDialog._Array.length - 1].zindex - 1;
    } else {
        LDialog.bgDiv.style.zIndex = "900";
        LDialog.bgDiv.style.display = "none";
        var topWinBody = topDoc.getElementsByTagName(topDoc.compatMode == "BackCompat" ? "BODY" : "HTML")[0];
        //if (topWinBody.styleOverflow != undefined) topWinBody.style.overflow = topWinBody.styleOverflow; 去除滚动条
    }
    if (isIE) {
		/*****释放引用，以便浏览器回收内存**/
		thisLDialogDiv.LDialogInstance=null;
		if(this.innerFrame)this.innerFrame.detachEvent("onload", innerFrameOnload);
		this.innerFrame=null;
		this.parentWindow=null;
		this.bgDiv=null;
		if (this.CancelEvent){this.cancelButton.onclick = null;};
		if (this.OKEvent){this.okButton.onclick = null;};
		topWin.$id("_LDialogDiv_" + this.ID).onDragStart=null;
		topWin.$id("_LDialogDiv_" + this.ID).onDragEnd=null;
		topWin.$id("_Draghandle_" + this.ID).onmousedown=null;
		topWin.$id("_Draghandle_" + this.ID).root=null;
		/**end释放引用**/
        thisLDialogDiv.outerHTML = "";
		CollectGarbage();
    } else {
        var RycDiv = topWin.$id("_RycDiv");
        if (!RycDiv) {
            RycDiv = topDoc.createElement("div");
            RycDiv.id = "_RycDiv";
        }
        RycDiv.appendChild(thisLDialogDiv);
        RycDiv.innerHTML = "";
		RycDiv=null;
    }
	thisLDialogDiv=null;
    this.closed = true;
};
LDialog.prototype.autoClose = function () {
    if (this.closed) {
        clearTimeout(this._closeTimeoutId);
        return;
    }
    this.AutoClose -= 1;
    topWin.$id("_Title_" + this.ID).innerHTML = this.AutoClose + " 秒后自动关闭";
    if (this.AutoClose <= 0) {
        this.close();
    } else {
        var self = this;
        this._closeTimeoutId = setTimeout(function () {
            self.autoClose();
        },
        1000);
    }
};
LDialog.getInstance = function (id) {
    var LDialogDiv = topWin.$id("_LDialogDiv_" + id);
    if (!LDialogDiv) alert("没有取到对应ID的弹出框页面对象");
	try{
    	return LDialogDiv.LDialogInstance;
	}finally{
		LDialogDiv = null;
	}
};
LDialog.prototype.addButton = function (id, txt, func) {
    topWin.$id("_ButtonRow_" + this.ID).style.display = "";
    this.ShowButtonRow = true;
    var button = topDoc.createElement("input");
    button.id = "_Button_" + this.ID + "_" + id;
    button.type = "button";
    button.style.cssText = "margin-right:5px";
    button.value = txt;
    button.onclick = func;
    var input0 = topWin.$id("_LDialogButtons_" + this.ID).getElementsByTagName("INPUT")[0];
    input0.parentNode.insertBefore(button, input0);
    return button;
};
LDialog.prototype.removeButton = function (btn) {
    var input0 = topWin.$id("_LDialogButtons_" + this.ID).getElementsByTagName("INPUT")[0];
    input0.parentNode.removeChild(btn);
};
LDialog.getBgdiv = function () {
    if (LDialog.bgDiv) return LDialog.bgDiv;
    var bgdiv = topWin.$id("_LDialogBGDiv");
    if (!bgdiv) {
        bgdiv = topDoc.createElement("div");
        bgdiv.id = "_LDialogBGDiv";
        bgdiv.style.cssText = "position:absolute;left:0px;top:0px;width:100%;height:100%;z-index:900";
        var bgIframeBox = '<div style="position:relative;width:100%;height:100%;">';
		var bgIframeMask = '<div id="_LDialogBGMask" style="position:absolute;background-color:#333;opacity:0.4;filter:alpha(opacity=40);width:100%;height:100%;"></div>';
		var bgIframe = isIE6?'<iframe src="about:blank" style="filter:alpha(opacity=0);" width="100%" height="100%"></iframe>':'';
		bgdiv.innerHTML=bgIframeBox+bgIframeMask+bgIframe+'</div>';
        topDoc.getElementsByTagName("BODY")[0].appendChild(bgdiv);
        if (isIE6) {
            var bgIframeDoc = bgdiv.getElementsByTagName("IFRAME")[0].contentWindow.document;
            bgIframeDoc.open();
            bgIframeDoc.write("<body style='background-color:#333' oncontextmenu='return false;'></body>");
            bgIframeDoc.close();
			bgIframeDoc=null;
        }
    }
    LDialog.bgDiv = bgdiv;
	bgdiv=null;
    return LDialog.bgDiv;
};
LDialog.prototype.getLDialogDiv = function () {
	var LDialogDiv=topWin.$id("_LDialogDiv_" + this.ID)
	if(!LDialogDiv)alert("获取弹出层页面对象出错！");
	try{
		return LDialogDiv;
	}finally{
		LDialogDiv = null;
	}
};
LDialog.onKeyDown = function (event) {
    if (event.shiftKey && event.keyCode == 9) { //shift键
        if (topWin.LDialog._Array.length > 0) {
            stopEvent(event);
            return false;
        }
    }
    if (event.keyCode == 27) { //ESC键
        LDialog.close();
    }
};
LDialog.close = function (id) {
    if (topWin.LDialog._Array.length > 0) {
        var diag = topWin.LDialog._Array[topWin.LDialog._Array.length - 1];
        diag.cancelButton.onclick.apply(diag.cancelButton, []);
    }
};
LDialog.alert = function (msg, func, w, h) {
    var w = w || 300,
        h = h || 110;
    var diag = new LDialog({
        Width: w,
        Height: h
    });
    diag.ShowButtonRow = true;
    diag.Title = "系统提示";
    diag.CancelEvent = function () {
        diag.close();
        if (func) func();
    };
    diag.InnerHtml = '<table height="100%" border="0" align="center" cellpadding="10" cellspacing="0">\
		<tr><td align="right"><img id="Icon_' + this.ID + '" src="' + IMAGESPATH + 'icon_alert.gif" width="34" height="34" align="absmiddle"></td>\
			<td align="left" id="Message_' + this.ID + '" style="font-size:9pt">' + msg + '</td></tr>\
	</table>';
    diag.show();
    diag.okButton.parentNode.style.textAlign = "center";
    diag.okButton.style.display = "none";
    diag.cancelButton.value = "确 定";
    diag.cancelButton.focus();
};
LDialog.confirm = function (msg, funcOK, funcCal, w, h) {
    var w = w || 300,
        h = h || 110;
    var diag = new LDialog({
        Width: w,
        Height: h
    });
    diag.ShowButtonRow = true;
    diag.Title = "信息确认";
    diag.CancelEvent = function () {
        diag.close();
        if (funcCal) {
            funcCal();
        }
    };
    diag.OKEvent = function () {
        diag.close();
        if (funcOK) {
            funcOK();
        }
    };
    diag.InnerHtml = '<table height="100%" border="0" align="center" cellpadding="10" cellspacing="0">\
		<tr><td align="right"><img id="Icon_' + this.ID + '" src="' + IMAGESPATH + 'icon_query.gif" width="34" height="34" align="absmiddle"></td>\
			<td align="left" id="Message_' + this.ID + '" style="font-size:9pt">' + msg + '</td></tr>\
	</table>';
    diag.show();
    diag.okButton.parentNode.style.textAlign = "center";
    diag.okButton.focus();
};
LDialog.open = function (arg) {
    var diag = new LDialog(arg);
    diag.show();
    return diag;
};
if (isIE) {
    window.attachEvent("onload", LDialog.attachBehaviors);
} else {
    window.addEventListener("load", LDialog.attachBehaviors, false);
}