
var aPoint = [
		'<area shape="poly" id="kt" coords="133,93,235,200,203,232,260,290,300,258,415,364,508,269,423,195,484,139,441,102,396,136,249,4,131,92,127,96,127,95" href="#"  info="客厅" />',
		'<area shape="poly" coords="483,142,576,214,508,267,420,195" href="#" info="厨房"/>',
		'<area shape="poly" coords="199,231,115,297,172,363,261,289,200,233" href="#"  info="卫生间" />',
		'<area shape="poly" coords="299,262,172,366,290,478,412,363,299,263" href="#"  info="次卧" />',
		'<area shape="poly" coords="121,97,92,75,23,120,50,150,6,177,117,295,235,198,125,94" href="#"  info="主卧" />'
];

( function( $, window )
{
	oMap = {};
	
	//des : 实例化对象
	//return : 返回MAP对象 
	oMap.making = function( o )
	{
		return new this.init( o );
	};
	//des : 初始化对象
	oMap.init = function( obj )
	{
		this.shape = null;
		this.def = obj.def || null;
		this.stop = obj.stop || false;
		this.img = document.getElementById( ( obj.img || "AMAP") );
		this.mapID = this.img.getAttribute( "usemap" ).substring( 1 ) || "#AMAP";
		this.width = obj.imgWidth || 500;
		this.height = obj.imgHeight || 500;
		this.display = "inline-block";
		this.lteIE_8 = this.browser();
		this.fillOpacity = obj.fillOpacity || 0.5;
		this.fill = obj.fill || "#f00";
		this.strokeFill = obj.strokeFill || "#000";
		this.strokeWidth = obj.strokeWidth || 1; 
		this.event = obj.event;
		this.info = this.pointObject( obj.points );
		//初始化结构
		this.wrap = this.createStructure();
		
		//创建热点
		this.area = this.createArea( obj.points );
		
		//创建画布
		this.createCanvas( this.lteIE_8 );
		
		//绑定事件
		this.bindEvent( this.area, this.lteIE_8 );
		this.showbgs(this.area );

	};
	
	oMap.init.prototype = {
		
		// 获取坐标对象
		pointObject : function( array )
		{
			var newArray = [];
			var currPoint = null;
			var currIndex = null;
			
			for( var i = 0, len = array.length; i < len; i += 1 )
			{
				var sName = array[ i ].match( /info\=\".+?\"/g )[0].match( /[^(info)\=\"\']+/g )[0];
				
				var sPoint = array[ i ].match( /coords\=\".+?\"/g )[0].match( /[^(coords)\=\"\']+/g )[0];
				
				if( sName === this.def )
				{
					currPoint = sPoint;
					currIndex = i;
				};
				
				newArray.push({ "name" : sName, "point" : sPoint } );
			};

			return {
				data : newArray,
				curr : {
					index : currIndex,
					point : currPoint
				}
			}
		},
		
		//des : 检测兼容性
		browser : function()
		{
			var str = window.navigator.userAgent.toLowerCase().match( /msie\s+\d+/g );

			return str ? str[0].match(/\d+/g )[0] <= 8 ? true : false  : false; 
		},
		
		//des :  创建结构
		//return : 外层结构
		createStructure : function()
		{
			var wrapStr = "<div id=\"" + this.mapID +
						  "-wraper\" style=\"position:relative;left:0;top:0;overflow:hidden;height:" + 
						  this.height +
						  "px;width:" + 
						  this.width +
						  "px;display:" + 
						  this.display +
						  ";background:url(" + this.img.src + ") no-repeat;\"></div>"; 
			
			$( this.img ).css({ "position" : "relative" , "z-index" : 1 , "opacity" : 0 }).wrap( wrapStr );
			
			return this.img.parentNode;
		},
		
		//des : 创建热点( 热点集合 )
		//return : 所有热点对象
		createArea : function( point )
		{
			var oMap = document.createElement("map");
			
			oMap.name = oMap.id = this.mapID;
			
			oMap.style.position = "absolute";
			oMap.style.left = 0;
			oMap.style.top = 0;
			
			oMap.innerHTML = point.join("");
			
			this.wrap.appendChild( oMap );

			return oMap.getElementsByTagName( "area" );
		},
		
		//des : 创建svg
		createCanvas : function( bool )
		{
			if( bool )
			{
				// 创建VML对象
				document.namespaces.add( "rvml", "urn:schemas-microsoft-com:vml" );

				document.createStyleSheet().addRule(".rvml", "behavior:url(#default#VML)");
				document.createStyleSheet().addRule(".rvml", "position:absolute;");
				
				var oDiv = document.createElement("div");
				var oFrag = document.createDocumentFragment();
				
				oDiv.id = this.mapID + "-canvas";

				oDiv.style.position = "absolute";
				oDiv.style.left = 0;
				oDiv.style.top = 0;
				oDiv.style.width = "100%";
				oDiv.style.height = "100%";

				for( var i = 0, len = this.area.length; i < len; i += 1 )
				{
					var sPoint = this.area[ i ].getAttribute("coords");

					var polylineStr = "<rvml:polyline id=\"shape"+ i +"\" class=\"rvml\" filled=\"true\" strokecolor=\"" + this.strokeFill +
									  "\" stroked=\"true\" strokeweight=\"" + this.strokeWidth +
									  "\" fillcolor=\"" + this.fill + 
									  "\" points=\""+ sPoint +
									  "\" style=\"filter:alpha(opacity=" +( this.info.curr.index === i ? this.fillOpacity*100 : 0 ) +");\" />";
									  
					var opolyLine = document.createElement( polylineStr );
					
   					oFrag.appendChild( opolyLine );
				};

				oDiv.appendChild( oFrag );
				
				this.wrap.appendChild( oDiv );
			}
			else
			{
				/* 创建svg对象 */
				var sHttp = "http://www.w3.org/2000/svg";
				
				var oSvg = document.createElementNS( sHttp ,"svg"); 
				
				oSvg.setAttribute( "height", "100%" ); 
				oSvg.setAttribute( "width", "100%" );
				
				oSvg.style.position = "absolute";
				oSvg.style.left = 0;
				oSvg.style.top = 0;
				
				this.shape = document.createElementNS( sHttp , "polygon" ); 
				
				this.shape.setAttribute( "stroke", this.strokeFill ); 
				this.shape.setAttribute( "fill", this.fill ); 
				this.shape.setAttribute( "opacity", this.fillOpacity ); 
				this.shape.setAttribute( "stroke-width", this.strokeWidth ); 
				
				this.shape.setAttribute( "points" , this.info.curr.point );
				
				oSvg.appendChild( this.shape ); 
				
				this.wrap.appendChild( oSvg ); 
			};
		},

		fx : function( obj, attr, iTarget, fn )
		{
			var getStyle = function( obj, attr )
			{
				return obj.currentStyle ? attr === "opacity" ? obj.currentStyle[ "filter" ] === "" ? "1" : ( Number( obj.currentStyle[ "filter" ].match(/\d+/g)[0] )/100 ).toString() : obj.currentStyle[ attr ] : getComputedStyle( obj, false )[ attr ];
			};

			iTarget = parseInt(iTarget);
			clearInterval(obj.timer);
			obj.timer = setInterval(function(){
				
				var val =  getStyle( obj, attr ),
					iCurr = ( attr == "opacity" ) ? parseInt(parseFloat(val)*100) : parseInt( val=="auto"?0:val ),
					Buffer = ( iTarget - iCurr )/4,
					iSpeed = Buffer>0?Math.ceil(Buffer):Math.floor(Buffer);
					
				if( iTarget == iCurr ){
					clearInterval(obj.timer);
					
					if(fn) fn();
				} else if( attr == "opacity" ){ 
						var repair = iTarget - iCurr>iSpeed?1:0;
						//console.log(iCurr + iSpeed + repair)
						obj.style.filter = "alpha(opacity:"+ ( iCurr + iSpeed + repair ) +")";
						obj.style.opacity = ( iCurr + iSpeed + repair )/100;
				} else {
					obj.style[ attr ] = iCurr + iSpeed + "px";
				};
			},30);
			
		},
//
		showbgs : function( area )
		{
			area[0].onmouseover();
		},

		showbg : function( area, i, bool )
		{

			area[ i ].self = this;

			area[ i ][ "on" + this.event ] = function()
			{
				$(".scNz1InfoM").hide();
				$("#fd"+$( this ).index()).show();
				if( bool )
				{
					var _this = document.getElementById( "shape" + $( this ).index() );
					
					//_this.style.display = "block";
					
					$( _this ).show().siblings().hide();
					
					this.self.fx( _this, "opacity", this.self.fillOpacity*100 );
				}
				else
				{
					this.self.shape.setAttribute( "points" , this.getAttribute("coords") );
				};
				
			};
		},
		//des : 热点绑定事件( 热点集合 )
		bindEvent : function( area, bool )
		{
			if( this.stop )
			{
				this.wrap.self = this;
				
				$( this.wrap ).mouseout( function()
				{
					if( bool )
					{
						$( document.getElementById( this.self.mapID + "-canvas" ).children ).hide();
					}
					else
					{
						this.self.shape.removeAttribute( "points" );
					};
				});
			};
			//

			//
			for( var i = 0, aLen = area.length; i < aLen; i += 1 )
			{
				this.showbg(area,i,bool);
				
			};
			
		}
	};
		
	window.AMAP = oMap;
})( jQuery, window );