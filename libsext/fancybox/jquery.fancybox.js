/* File generated by shrinker.ch - DateTime: 2012-06-17, 09:08:10 */
(function(v,q,e){var m=e(v),s=e(q),a=e.fancybox=function(){a.open.apply(this,arguments)},t=false,u=typeof q.createTouch!=="undefined";e.extend(a,{version:"2.0.5",defaults:{padding:15,margin:20,width:800,height:600,minWidth:100,minHeight:100,maxWidth:9999,maxHeight:9999,autoSize:true,autoResize:!u,autoCenter:!u,fitToView:true,aspectRatio:false,topRatio:0.5,fixed:!(e.browser.msie&&e.browser.version<=6)&&!u,scrolling:"auto",wrapCSS:"fancybox-default",arrows:true,closeBtn:true,closeClick:false,nextClick:false,
mouseWheel:true,autoPlay:false,playSpeed:3E3,preload:3,modal:false,loop:true,ajax:{dataType:"html",headers:{"X-fancyBox":true}},keys:{next:[13,32,34,39,40],prev:[8,33,37,38],close:[27]},index:0,type:null,href:null,content:null,title:null,tpl:{wrap:'<div class="fancybox-wrap"><div class="fancybox-outer"><div class="fancybox-inner"></div></div></div>',image:'<img class="fancybox-image" src="{href}" alt="" />',iframe:'<iframe class="fancybox-iframe" name="fancybox-frame{rnd}" frameborder="0" hspace="0"'+
(e.browser.msie?' allowtransparency="true"':"")+"></iframe>",swf:'<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="100%" height="100%"><param name="wmode" value="transparent" /><param name="allowfullscreen" value="true" /><param name="allowscriptaccess" value="always" /><param name="movie" value="{href}" /><embed src="{href}" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="100%" height="100%" wmode="transparent"></embed></object>',error:'<p class="fancybox-error">The requested content cannot be loaded.<br/>Please try again later.</p>',
closeBtn:'<div title="Close" class="fancybox-item fancybox-close"></div>',next:'<a title="Next" class="fancybox-nav fancybox-next"><span></span></a>',prev:'<a title="Previous" class="fancybox-nav fancybox-prev"><span></span></a>'},openEffect:"fade",openSpeed:250,openEasing:"swing",openOpacity:true,openMethod:"zoomIn",closeEffect:"fade",closeSpeed:250,closeEasing:"swing",closeOpacity:true,closeMethod:"zoomOut",nextEffect:"elastic",nextSpeed:300,nextEasing:"swing",nextMethod:"changeIn",prevEffect:"elastic",
prevSpeed:300,prevEasing:"swing",prevMethod:"changeOut",helpers:{overlay:{speedIn:0,speedOut:300,opacity:0.8,css:{cursor:"pointer"},closeClick:true},title:{type:"float"}},onCancel:e.noop,beforeLoad:e.noop,afterLoad:e.noop,beforeShow:e.noop,afterShow:e.noop,beforeClose:e.noop,afterClose:e.noop},group:{},opts:{},coming:null,current:null,isOpen:false,isOpened:false,wrap:null,outer:null,inner:null,player:{timer:null,isActive:false},ajaxLoad:null,imgPreload:null,transitions:{},helpers:{},open:function(b,
c){a.close(true);if(b&&!e.isArray(b))b=b instanceof e?e(b).get():[b];a.isActive=true;a.opts=e.extend(true,{},a.defaults,c);if(e.isPlainObject(c)&&typeof c.keys!=="undefined")a.opts.keys=c.keys?e.extend({},a.defaults.keys,c.keys):false;a.group=b;a._start(a.opts.index||0)},cancel:function(){if(!(a.coming&&false===a.trigger("onCancel"))){a.coming=null;a.hideLoading();a.ajaxLoad&&a.ajaxLoad.abort();a.ajaxLoad=null;if(a.imgPreload)a.imgPreload.onload=a.imgPreload.onabort=a.imgPreload.onerror=null}},close:function(b){a.cancel();
if(!(!a.current||false===a.trigger("beforeClose"))){a.unbindEvents();if(!a.isOpen||b&&b[0]===true){e(".fancybox-wrap").stop().trigger("onReset").remove();a._afterZoomOut()}else{a.isOpen=a.isOpened=false;e(".fancybox-item, .fancybox-nav").remove();a.wrap.stop(true).removeClass("fancybox-opened");a.inner.css("overflow","hidden");a.transitions[a.current.closeMethod]()}}},play:function(b){var c=function(){clearTimeout(a.player.timer)},d=function(){c();if(a.current&&a.player.isActive)a.player.timer=setTimeout(a.next,
a.current.playSpeed)},f=function(){c();e("body").unbind(".player");a.player.isActive=false;a.trigger("onPlayEnd")};if(a.player.isActive||b&&b[0]===false)f();else if(a.current&&(a.current.loop||a.current.index<a.group.length-1)){a.player.isActive=true;e("body").bind({"afterShow.player onUpdate.player":d,"onCancel.player beforeClose.player":f,"beforeLoad.player":c});d();a.trigger("onPlayStart")}},next:function(){a.current&&a.jumpto(a.current.index+1)},prev:function(){a.current&&a.jumpto(a.current.index-
1)},jumpto:function(b){if(a.current){b=parseInt(b,10);if(a.group.length>1&&a.current.loop)if(b>=a.group.length)b=0;else if(b<0)b=a.group.length-1;if(typeof a.group[b]!=="undefined"){a.cancel();a._start(b)}}},reposition:function(b){a.isOpen&&a.wrap.css(a._getPosition(b))},update:function(b){if(a.isOpen){t||setTimeout(function(){var c=a.current;if(t){t=false;if(c){if(c.autoResize||b&&b.type==="orientationchange"){if(c.autoSize){a.inner.height("auto");c.height=a.inner.height()}a._setDimension();c.canGrow&&
a.inner.height("auto")}c.autoCenter&&a.reposition();a.trigger("onUpdate")}}},100);t=true}},toggle:function(){if(a.isOpen){a.current.fitToView=!a.current.fitToView;a.update()}},hideLoading:function(){e("#fancybox-loading").remove()},showLoading:function(){a.hideLoading();e('<div id="fancybox-loading"><div></div></div>').click(a.cancel).appendTo("body")},getViewport:function(){return{x:m.scrollLeft(),y:m.scrollTop(),w:m.width(),h:m.height()}},unbindEvents:function(){a.wrap&&a.wrap.unbind(".fb");s.unbind(".fb");
m.unbind(".fb")},bindEvents:function(){var b=a.current,c=b.keys;if(b){m.bind("resize.fb, orientationchange.fb",a.update);c&&s.bind("keydown.fb",function(d){var f;if(!d.ctrlKey&&!d.altKey&&!d.shiftKey&&!d.metaKey&&e.inArray(d.target.tagName.toLowerCase(),["input","textarea","select","button"])<0){f=d.keyCode;if(e.inArray(f,c.close)>-1){a.close();d.preventDefault()}else if(e.inArray(f,c.next)>-1){a.next();d.preventDefault()}else if(e.inArray(f,c.prev)>-1){a.prev();d.preventDefault()}}});e.fn.mousewheel&&
b.mouseWheel&&a.group.length>1&&a.wrap.bind("mousewheel.fb",function(d,f){var g=e(d.target).get(0);if(g.clientHeight===0||g.scrollHeight===g.clientHeight&&g.scrollWidth===g.clientWidth){d.preventDefault();a[f>0?"prev":"next"]()}})}},trigger:function(b){var c,d=a[e.inArray(b,["onCancel","beforeLoad","afterLoad"])>-1?"coming":"current"];if(d){if(e.isFunction(d[b]))c=d[b].apply(d,Array.prototype.slice.call(arguments,1));if(c===false)return false;d.helpers&&e.each(d.helpers,function(f,g){if(g&&typeof a.helpers[f]!==
"undefined"&&e.isFunction(a.helpers[f][b]))a.helpers[f][b](g,d)});e.event.trigger(b+".fb")}},isImage:function(b){return b&&b.match(/\.(jpg|gif|png|bmp|jpeg)(.*)?$/i)},isSWF:function(b){return b&&b.match(/\.(swf)(.*)?$/i)},_start:function(b){var c={},d=a.group[b]||null,f,g,j;if(d&&(d.nodeType||d instanceof e)){f=true;if(e.metadata)c=e(d).metadata()}c=e.extend(true,{},a.opts,{index:b,element:d},e.isPlainObject(d)?d:c);e.each(["href","title","content","type"],function(h,i){c[i]=a.opts[i]||f&&e(d).attr(i)||
c[i]||null});if(typeof c.margin==="number")c.margin=[c.margin,c.margin,c.margin,c.margin];c.modal&&e.extend(true,c,{closeBtn:false,closeClick:false,nextClick:false,arrows:false,mouseWheel:false,keys:null,helpers:{overlay:{css:{cursor:"auto"},closeClick:false}}});a.coming=c;if(false===a.trigger("beforeLoad"))a.coming=null;else{g=c.type;b=c.href||d;if(!g){if(f){j=e(d).data("fancybox-type");if(!j&&d.className)g=(j=d.className.match(/fancybox\.(\w+)/))?j[1]:null}if(!g&&e.type(b)==="string")if(a.isImage(b))g=
"image";else if(a.isSWF(b))g="swf";else if(b.match(/^#/))g="inline";g||(g=f?"inline":"html");c.type=g}if(g==="inline"||g==="html"){if(!c.content)c.content=g==="inline"?e(e.type(b)==="string"?b.replace(/.*(?=#[^\s]+$)/,""):b):d;if(!c.content||!c.content.length)g=null}else b||(g=null);c.group=a.group;c.isDom=f;c.href=b;if(g==="image")a._loadImage();else if(g==="ajax")a._loadAjax();else g?a._afterLoad():a._error("type")}},_error:function(b){a.hideLoading();e.extend(a.coming,{type:"html",autoSize:true,
minHeight:0,hasError:b,content:a.coming.tpl.error});a._afterLoad()},_loadImage:function(){a.imgPreload=new Image;a.imgPreload.onload=function(){this.onload=this.onerror=null;a.coming.width=this.width;a.coming.height=this.height;a._afterLoad()};a.imgPreload.onerror=function(){this.onload=this.onerror=null;a._error("image")};a.imgPreload.src=a.coming.href;a.imgPreload.width||a.showLoading()},_loadAjax:function(){a.showLoading();a.ajaxLoad=e.ajax(e.extend({},a.coming.ajax,{url:a.coming.href,error:function(b,
c){c!=="abort"?a._error("ajax",b):a.hideLoading()},success:function(b,c){if(c==="success"){a.coming.content=b;a._afterLoad()}}}))},_preloadImages:function(){var b=a.group,c=a.current,d=b.length,f;if(!(!c.preload||b.length<2))for(var g=1;g<=Math.min(c.preload,d-1);g++){f=b[(c.index+g)%d];if(f=e(f).attr("href")||f)(new Image).src=f}},_afterLoad:function(){a.hideLoading();if(!a.coming||false===a.trigger("afterLoad",a.current))a.coming=false;else{if(a.isOpened){e(".fancybox-item").remove();a.wrap.stop(true).removeClass("fancybox-opened");
a.inner.css("overflow","hidden");a.transitions[a.current.prevMethod]()}else{e(".fancybox-wrap").stop().trigger("onReset").remove();a.trigger("afterClose")}a.unbindEvents();a.isOpen=false;a.current=a.coming;a.wrap=e(a.current.tpl.wrap).addClass("fancybox-"+(u?"mobile":"desktop")+" fancybox-tmp "+a.current.wrapCSS).appendTo("body");a.outer=e(".fancybox-outer",a.wrap).css("padding",a.current.padding+"px");a.inner=e(".fancybox-inner",a.wrap);a._setContent()}},_setContent:function(){var b,c,d=a.current,
f=d.type;switch(f){case "inline":case "ajax":case "html":b=d.content;if(b instanceof e){b=b.show().detach();b.parent().hasClass("fancybox-inner")&&b.parents(".fancybox-wrap").trigger("onReset").remove();e(a.wrap).bind("onReset",function(){b.appendTo("body").hide()})}if(d.autoSize){c=e('<div class="fancybox-tmp '+a.current.wrapCSS+'"></div>').appendTo("body").append(b);d.width=c.width();d.height=c.height();c.width(a.current.width);if(c.height()>d.height){c.width(d.width+1);d.width=c.width();d.height=
c.height()}b=c.contents().detach();c.remove()}break;case "image":b=d.tpl.image.replace("{href}",d.href);d.aspectRatio=true;break;case "swf":b=d.tpl.swf.replace(/\{width\}/g,d.width).replace(/\{height\}/g,d.height).replace(/\{href\}/g,d.href)}if(f==="iframe"){b=e(d.tpl.iframe.replace("{rnd}",(new Date).getTime())).attr("scrolling",d.scrolling);d.scrolling="auto";if(d.autoSize){b.width(d.width);a.showLoading();b.data("ready",false).appendTo(a.inner).bind({onCancel:function(){e(this).unbind();a._afterZoomOut()},
load:function(){var g=e(this),j;try{if(this.contentWindow.document.location){j=g.contents().find("body").height()+12;g.height(j)}}catch(h){d.autoSize=false}if(g.data("ready")===false){a.hideLoading();if(j)a.current.height=j;a._beforeShow();g.data("ready",true)}else j&&a.update()}}).attr("src",d.href);return}else b.attr("src",d.href)}else if(f==="image"||f==="swf"){d.autoSize=false;d.scrolling="visible"}a.inner.append(b);a._beforeShow()},_beforeShow:function(){a.coming=null;a.trigger("beforeShow");
a._setDimension();a.wrap.hide().removeClass("fancybox-tmp");a.bindEvents();a._preloadImages();a.transitions[a.isOpened?a.current.nextMethod:a.current.openMethod]()},_setDimension:function(){var b=a.wrap,c=a.outer,d=a.inner,f=a.current,g=a.getViewport(),j=f.margin,h=f.padding*2,i=f.width,k=f.height,l=f.maxWidth,n=f.maxHeight,p=f.minWidth,r=f.minHeight,o;g.w-=j[1]+j[3];g.h-=j[0]+j[2];if(i.toString().indexOf("%")>-1)i=(g.w-h)*parseFloat(i)/100;if(k.toString().indexOf("%")>-1)k=(g.h-h)*parseFloat(k)/
100;j=i/k;i+=h;k+=h;if(f.fitToView){l=Math.min(g.w,l);n=Math.min(g.h,n)}if(f.aspectRatio){if(i>l){i=l;k=(i-h)/j+h}if(k>n){k=n;i=(k-h)*j+h}if(i<p){i=p;k=(i-h)/j+h}if(k<r){k=r;i=(k-h)*j+h}}else{i=Math.max(p,Math.min(i,l));k=Math.max(r,Math.min(k,n))}i=Math.round(i);k=Math.round(k);e(b.add(c).add(d)).width("auto").height("auto");d.width(i-h).height(k-h);b.width(i);o=b.height();if(i>l||o>n)for(;(i>l||o>n)&&i>p&&o>r;){k-=10;if(f.aspectRatio){i=Math.round((k-h)*j+h);if(i<p){i=p;k=(i-h)/j+h}}else i-=10;
d.width(i-h).height(k-h);b.width(i);o=b.height()}f.dim={width:i,height:o};f.canGrow=f.autoSize&&k>r&&k<n;f.canShrink=false;f.canExpand=false;if(i-h<f.width||k-h<f.height)f.canExpand=true;else if((i>g.w||o>g.h)&&i>p&&k>r)f.canShrink=true;b=o-h;a.innerSpace=b-d.height();a.outerSpace=b-c.height()},_getPosition:function(b){var c=a.current,d=a.getViewport(),f=c.margin,g=a.wrap.width()+f[1]+f[3],j=a.wrap.height()+f[0]+f[2],h={position:"absolute",top:f[0]+d.y,left:f[3]+d.x};if(c.fixed&&(!b||b[0]===false)&&
j<=d.h&&g<=d.w)h={position:"fixed",top:f[0],left:f[3]};h.top=Math.ceil(Math.max(h.top,h.top+(d.h-j)*c.topRatio))+"px";h.left=Math.ceil(Math.max(h.left,h.left+(d.w-g)*0.5))+"px";return h},_afterZoomIn:function(){var b=a.current,c=b.scrolling;a.isOpen=a.isOpened=true;a.wrap.addClass("fancybox-opened").css("overflow","visible");a.update();a.inner.css("overflow",c==="yes"?"scroll":c==="no"?"hidden":c);if(b.closeClick||b.nextClick)a.inner.css("cursor","pointer").bind("click.fb",b.nextClick?a.next:a.close);
b.closeBtn&&e(b.tpl.closeBtn).appendTo(a.outer).bind("click.fb",a.close);if(b.arrows&&a.group.length>1){if(b.loop||b.index>0)e(b.tpl.prev).appendTo(a.inner).bind("click.fb",a.prev);if(b.loop||b.index<a.group.length-1)e(b.tpl.next).appendTo(a.inner).bind("click.fb",a.next)}a.trigger("afterShow");if(a.opts.autoPlay&&!a.player.isActive){a.opts.autoPlay=false;a.play()}},_afterZoomOut:function(){a.trigger("afterClose");a.wrap.trigger("onReset").remove();e.extend(a,{group:{},opts:{},current:null,isActive:false,
isOpened:false,isOpen:false,wrap:null,outer:null,inner:null})}});a.transitions={getOrigPosition:function(){var b=a.current,c=b.element,d=b.padding,f=e(b.orig),g={},j=50,h=50;if(!f.length&&b.isDom&&e(c).is(":visible")){f=e(c).find("img:first");f.length||(f=e(c))}if(f.length){g=f.offset();if(f.is("img")){j=f.outerWidth();h=f.outerHeight()}}else{b=a.getViewport();g.top=b.y+(b.h-h)*0.5;g.left=b.x+(b.w-j)*0.5}return{top:Math.ceil(g.top-d)+"px",left:Math.ceil(g.left-d)+"px",width:Math.ceil(j+d*2)+"px",
height:Math.ceil(h+d*2)+"px"}},step:function(b,c){var d,f,g;if(c.prop==="width"||c.prop==="height"){f=g=Math.ceil(b-a.current.padding*2);if(c.prop==="height"){d=(b-c.start)/(c.end-c.start);if(c.start>c.end)d=1-d;f-=a.innerSpace*d;g-=a.outerSpace*d}a.inner[c.prop](f);a.outer[c.prop](g)}},zoomIn:function(){var b=a.wrap,c=a.current,d,f;d=c.dim;if(c.openEffect==="elastic"){f=e.extend({},d,a._getPosition(true));delete f.position;d=this.getOrigPosition();if(c.openOpacity){d.opacity=0;f.opacity=1}a.outer.add(a.inner).width("auto").height("auto");
b.css(d).show();b.animate(f,{duration:c.openSpeed,easing:c.openEasing,step:this.step,complete:a._afterZoomIn})}else{b.css(e.extend({},d,a._getPosition()));if(c.openEffect==="fade")b.fadeIn(c.openSpeed,a._afterZoomIn);else{b.show();a._afterZoomIn()}}},zoomOut:function(){var b=a.wrap,c=a.current,d;if(c.closeEffect==="elastic"){b.css("position")==="fixed"&&b.css(a._getPosition(true));d=this.getOrigPosition();if(c.closeOpacity)d.opacity=0;b.animate(d,{duration:c.closeSpeed,easing:c.closeEasing,step:this.step,
complete:a._afterZoomOut})}else b.fadeOut(c.closeEffect==="fade"?c.closeSpeed:0,a._afterZoomOut)},changeIn:function(){var b=a.wrap,c=a.current,d;if(c.nextEffect==="elastic"){d=a._getPosition(true);d.opacity=0;d.top=parseInt(d.top,10)-200+"px";b.css(d).show().animate({opacity:1,top:"+=200px"},{duration:c.nextSpeed,easing:c.nextEasing,complete:a._afterZoomIn})}else{b.css(a._getPosition());if(c.nextEffect==="fade")b.hide().fadeIn(c.nextSpeed,a._afterZoomIn);else{b.show();a._afterZoomIn()}}},changeOut:function(){var b=
a.wrap,c=a.current,d=function(){e(this).trigger("onReset").remove()};b.removeClass("fancybox-opened");c.prevEffect==="elastic"?b.animate({opacity:0,top:"+=200px"},{duration:c.prevSpeed,easing:c.prevEasing,complete:d}):b.fadeOut(c.prevEffect==="fade"?c.prevSpeed:0,d)}};a.helpers.overlay={overlay:null,update:function(){var b,c;this.overlay.width(0).height(0);if(e.browser.msie){b=Math.max(q.documentElement.scrollWidth,q.body.scrollWidth);c=Math.max(q.documentElement.offsetWidth,q.body.offsetWidth);b=
b<c?m.width():b}else b=s.width();this.overlay.width(b).height(s.height())},beforeShow:function(b){if(!this.overlay){b=e.extend(true,{speedIn:"fast",closeClick:true,opacity:1,css:{background:"black"}},b);this.overlay=e('<div id="fancybox-overlay"></div>').css(b.css).appendTo("body");this.update();b.closeClick&&this.overlay.bind("click.fb",a.close);m.bind("resize.fb",e.proxy(this.update,this));this.overlay.fadeTo(b.speedIn,b.opacity)}},onUpdate:function(){this.update()},afterClose:function(b){if(this.overlay)this.overlay.fadeOut(b.speedOut||
0,function(){e(this).remove()});this.overlay=null}};a.helpers.title={beforeShow:function(b){var c;if(c=a.current.title){c=e('<div class="fancybox-title fancybox-title-'+b.type+'-wrap">'+c+"</div>").appendTo("body");if(b.type==="float"){c.width(c.width());c.wrapInner('<span class="child"></span>');a.current.margin[2]+=Math.abs(parseInt(c.css("margin-bottom"),10))}c.appendTo(b.type==="over"?a.inner:b.type==="outside"?a.wrap:a.outer)}}};e.fn.fancybox=function(b){var c=e(this),d=this.selector||"",f,g=
function(j){var h=this,i="rel",k=h[i],l=f;if(!(j.ctrlKey||j.altKey||j.shiftKey||j.metaKey)){j.preventDefault();if(!k){i="data-fancybox-group";k=e(h).attr("data-fancybox-group")}if(k&&k!==""&&k!=="nofollow"){h=d.length?e(d):c;h=h.filter("["+i+'="'+k+'"]');l=h.index(this)}b.index=l;a.open(h,b)}};b=b||{};f=b.index||0;d?s.undelegate(d,"click.fb-start").delegate(d,"click.fb-start",g):c.unbind("click.fb-start").bind("click.fb-start",g);return this}})(window,document,jQuery);
