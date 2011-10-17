var SITE_IMAGE_PATH=LBL_SITE_URL+'spad/site_image/';
var CURSOR_PATH=LBL_SITE_URL+'spad/cursor/';
var SAVE_IMG_PATH=LBL_SITE_URL+"meme/save_meme/ce/0";
var SET_OFFLEFT=8;
var SET_OFFTOP=158;
var SET_EDITOR_HEIGHT=23;
var DEGREE_ROTATE=2;
var preloadImage=last_comic;

var newimgid = 1;
var newtextid = 1;
var img_rotate = [];
var undoPoints = [];
var undoheight = [];
var undowidth = [];
var redoPoints = [];
var redoheight = [];
var redowidth = [];
var mycanvas, cntx;
var lastimgdrawn = 1;
var settings = {
    'width': 380,
    'height': 380,
    'offsetLeft': 0,
    'offsetTop': SET_OFFTOP,
    'borderWidth': 0,
    'borderColor': '#ccc',
    'lineWidth': 1,
    'lineColor': 'rgb(0, 0, 0)',
    'mainColor': 'rgb(0, 0, 0)',
    'type':'line',
    'panel':2
};
(function ($) {
    $.fn.scratchpad = function (options) {
        if (options) {
            $.extend(settings, options);
        }
        var supports_canvas = function () {
            return true;
            var iscompat = false;
            try {
                this.iscompat = !!(document.createElement('canvas').getContext('2d'));
            } catch (e) {
                this.iscompat = !!(document.createElement('canvas').getContext);
            }
            return this.iscompat;
        }
        var draw = 0;
        var jitter = 0;
        var startX, startY, endX, endY;
        
        $(window).resize(function() {
            setleftmargin();
        });
        function setleftmargin() {
            var winW = 630;
            if (document.body && document.body.offsetWidth) {
                winW = document.body.offsetWidth;
            }
            if (document.compatMode=='CSS1Compat' &&
                document.documentElement &&
                document.documentElement.offsetWidth ) {
                winW = document.documentElement.offsetWidth;
            }
            if (window.innerWidth && window.innerHeight) {
                winW = window.innerWidth;
            }
            settings.offsetLeft = (winW/2) - (mycanvas.width/2) - SET_OFFLEFT ;
        }
        function adjustfontsize(mysize) {
            $('#fontsize').val(mysize);
            $('#line_size').text('Size-'+mysize);
            settings.lineWidth = mysize;
            cc = CURSOR_PATH+settings.lineWidth+".png";
			mycanvas.style.cursor = 'url('+cc+'), none';
            $( "#vs" ).slider( "option", "value", mysize );
        }
        if (supports_canvas() == true) {
/*            var canvasElem = $('<canvas>').attr({
                'width': settings.width.toString()+"px",
                'height': settings.height.toString()+"px",
                'id': "mycid"
            }).css({
                'border': settings.borderWidth.toString() + 'px solid ' + settings.borderColor,
                'background-color': settings.backgroundColor,
                'cursor': 'pointer'
            });
            $(this).append(canvasElem);
            mycanvas = $('canvas')[0];*/
			mycanvas = document.getElementById('mycid');
			cntx = mycanvas.getContext("2d");
			mycanvas.width = settings.width;
			mycanvas.height = settings.height;
			mycanvas.style.border = settings.borderWidth + 'px solid ' + settings.borderColor;
//            mycanvas.style.background-color = settings.backgroundColor;
            mycanvas.style.cursor = 'pointer';
            if (preloadImage!="") {
                var oImg = new Image();
                oImg.onload = function() {
                    settings.panel = Math.round(oImg.height / (settings.height / 2));
                    mycanvas.height = oImg.height;
                    mycanvas.width = oImg.width;
                    cntx.drawImage(oImg,0,0);
                }
                oImg.src = preloadImage;
            }
            cntx.save();
            cntx.fillStyle = '#fff';
            cntx.fillRect(0, 0, cntx.canvas.width, cntx.canvas.height);
            cntx.restore();
            $(document).mouseup(function (e) {
                endX = e.pageX - this.offsetLeft - settings.offsetLeft;
                endY = e.pageY - this.offsetTop - settings.offsetTop;
                jitter = draw = 0;
                cntx.restore();
            });
            $(this).mouseenter(function () {
                if (jitter > 0) {
                    draw = 1;
                }
            });
            $(this).mouseleave(function () {
                if (draw == 1) {
                    draw = 0;
                }
            });
            $(this).mousedown(function (e) {
                if (settings.type=='square' || settings.type=='circle' || settings.type=='fcircle' || settings.type=='fsquare' || settings.type=='DLine'){
                    createdummycanvas();
                }
                saveRestorePoint();
                cntx.save();
                jitter = draw = 1;
                x = $('#mycid').offset();
                startX = e.pageX - this.offsetLeft - x.left +  Math.round(settings.lineWidth/2);
                startY = e.pageY - this.offsetTop - x.top + Math.round(settings.lineWidth/2);
                cntx.lineWidth = settings.lineWidth;
                if (settings.type=="erase") {
                    settings.lineColor = "rgb(255, 255, 255)";
                } else {
                    settings.lineColor = settings.mainColor;
                }
                cntx.fillStyle = cntx.strokeStyle = settings.lineColor;
                cntx.font = settings.lineWidth+"pt "+$("#font").val();
                cntx.lineCap = "round";
                cntx.beginPath();
                if (settings.type=="spray") {
                } else {
                    cntx.moveTo(startX, startY);
                }
            });
            function createdummycanvas() {
				if ( $.browser.msie ) {
	                showdebug(mycanvas.width+"----"+mycanvas.height+" : IE");
					return;
				}
                var x = $('#mycid').offset();
				cc = CURSOR_PATH+settings.lineWidth+".png";
                var cdummy = $('<canvas>').attr({
                    'width': mycanvas.width.toString(),
                    'height': mycanvas.height.toString(),
                    'id': "dummy"
                }).css({
                    border:'none',
                    position:"absolute", 
                    top:x.top+"px", 
                    left:x.left+"px",
					cursor:'url('+cc+'), none'
                });
                cdummy.appendTo("body");
				var iddummy = document.getElementById('dummy');
                var dummyc = iddummy.getContext("2d");
//              var x = $('#mycid').offset();
//				iddummy.width = mycanvas.width;
//				iddummy.height = mycanvas.height;
//				iddummy.style.position = "fixed";
//				iddummy.style.border = "1px solid red";
//				iddummy.style.top = x.top+"px";
//				iddummy.style.left = x.left+"px";
//				iddummy.style.display="block";
//				iddummy.style.zIndex=999999;
//				iddummy.style.cursor = 'url('+cc+'), none';
                dummyc.fillStyle = "rgba(0, 0, 200, 0.5)";
                stopdraw=1;
                $(iddummy).mousemove(function (e) {
                    if (startX=="undefined") {
                        startX=e.pageX;
                        startY=e.pageY;
                    }
                    if (stopdraw==1) {
						lastimgdrawn = 1;
                        endX = e.pageX - this.offsetLeft + Math.round(settings.lineWidth/2);
                        endY = e.pageY - this.offsetTop + Math.round(settings.lineWidth/2);
                        var centerX =  startX + ((endX-startX)/2);
                        var centerY = startY + ((endY-startY)/2);
                        var radius = Math.pow((Math.pow(endY-startY, 2)+Math.pow(endX-startX, 2)),.5)/2;

                        dummyc.clearRect (0, 0, cntx.canvas.width, cntx.canvas.height );
                        dummyc.lineWidth = settings.lineWidth;
						dummyc.fillStyle = dummyc.strokeStyle = settings.lineColor;
                        dummyc.font = settings.lineWidth+"pt "+$("#font").val();
                        dummyc.lineCap = "round";
                        switch (settings.type) {
                            case 'fsquare':
                                dummyc.fillRect(startX,startY,endX-startX,endY-startY);
                                break;
                            case 'square':
                                dummyc.strokeRect(startX,startY,endX-startX,endY-startY);
                                break;
                            case 'fcircle':
                                dummyc.beginPath();
                                dummyc.arc(centerX, centerY, radius, 0, 2 * Math.PI, false);
                                dummyc.fill();
                                break;
                            case 'circle':
                                dummyc.beginPath();
                                dummyc.arc(centerX, centerY, radius, 0, 2 * Math.PI, false);
                                dummyc.stroke();
                                break;
                            case 'DLine':
                                dummyc.beginPath();
                                //cntx.moveTo(startX, startY);
                                dummyc.moveTo(endX,endY);
                                dummyc.lineTo(startX, startY);
                                dummyc.stroke();
                                break;
                        }
                    }
                });
                $(iddummy).mouseout(function (e) {
                    stopdraw=0;
                    copytooriginal();
                });
                $(iddummy).mouseup(function (e) {
                    stopdraw=0;
                    copytooriginal();
                });
            }
            function copytooriginal() {
                var iddummy = document.getElementById('dummy');
                var oImg = new Image();
                oImg.onload = function() {
                    cntx.drawImage(oImg,0,0);
                }
                oImg.src = getcanvasimage("dummy");
                $(iddummy).remove();
            }
            $(this).mousemove(function (e) {
                x = $('#mycid').offset();
                startX = e.pageX - this.offsetLeft - x.left +  Math.round(settings.lineWidth/2);
                startY = e.pageY - this.offsetTop - x.top + Math.round(settings.lineWidth/2);
                if (draw == 1) {
					lastimgdrawn = 1;
                    switch (settings.type) {
                        case 'erase':
                        case 'line':
                            //if (jitter % 3 == 1) {
                            cntx.lineTo(startX, startY);
                            cntx.stroke();
                            //}
                            break;
                        case 'spray':
                            for (i = 0; i < settings.lineWidth*20; i++) {
                                var offset = getRandomOffset();
                                var x = startX + offset.x, y = startY + offset.y;
                                cntx.fillRect(x, y, 1, 1);
                            }
                            break;
                    }
                    ++jitter;
                }
            });
            function getRandomOffset() {
                var radius = 20;
                var randomAngle = Math.random() * 360;
                var randomRadius = Math.random() * radius;
                return {
                    x: Math.cos(randomAngle) * randomRadius,
                    y: Math.sin(randomAngle) * randomRadius
                };
            }
            
            $('input[class=ls]').blur(function () {
                settings.lineWidth = $(this).val();
            });
            $( "#vs" ).bind( "slidestop", function(event, ui) {
                adjustfontsize(ui.value);
                $('#vs').slideUp('slow');
            });
            $('#fontsize').blur(function(){
                adjustfontsize($(this).val());
            });
            $('img[class=erase]').click(function () {
                settings.type = "erase";
            });
            $("#color").ColorPicker({
                color: '#0000ff',
                onChange: function (hsb, hex, rgb) {
                    settings.mainColor = "rgb("+rgb['r']+", "+rgb['g']+", "+rgb['b']+")";
                }
            });
            $('input[class=alpha]').blur(function () {
                cntx.globalAlpha = this.value;
            });
            $('img[class=addpanel]').click(function () {
			 	lastimgdrawn = 1;
                saveRestorePoint();
                addRow(1);
            });
            $('img[class=removepanel]').click(function () {
				lastimgdrawn = 1;
                saveRestorePoint();
                removeRow();
            });
            
            $('img[class=undo]').click(function () {
                undoimage();
            });
            $('img[class=redo]').click(function () {
                redoimage();
            });
            $('input[class=save]').click(function () {
                window.open(getcanvasimage("mycid"));
            });
            $('img[class=size]').click(function () {
                settings.type = $(this).attr('id');
                endX = endY = 0;
            });
            $(document).keyup(function(e){
                if(e.which == 90){
                    undoimage();
                }
                if(e.which == 89){
                    redoimage();
                }
            /*if(e.which == 107){
                    var newvalue = Math.min($( "#vs" ).slider( "option", "value" )+1, $( "#vs" ).slider( "option", "max" ));
                    adjustfontsize(newvalue);
                }
                if(e.which == 109){
                    var newvalue = Math.max($( "#vs" ).slider( "option", "value" )-1, $( "#vs" ).slider( "option", "min" ));
                    adjustfontsize(newvalue);
                }
                if(e.which == 69){
                    settings.type = "erase";
                //Eraser (E)
                }
                if(e.which == 66){
                //Brush (B)
                }
                if(e.which == 110){
                //delete
                }
                if(e.which == 68){
                //Duplicate Selected Meme Face (D)
                }
                if(e.which == 80){
                //Pencil (P)
                }
                if(e.which == 84){
                    //Text Tool (T)
                }*/
            });
            mycanvas.style.cursor = 'url('+CURSOR_PATH+'1.png), none';
            setleftmargin();

            drawpanellines(settings.panel);
			$("#line").addClass("active");
        } else {
            document.write("<p style='text-align:center;'>Requires HTML 5 Enabled Web Browser.</p>");
        }
    };
})(jQuery);

function removeMemeid(e, text) {
    if (text && typeof text == 'string') {
        id = $(e).parents("div.newtextdd").attr("id");;
    } else {
        id = $(e).parents("div.newdd").attr("id");
    }
    $("#"+id).remove();
}
function cloneme(e) {
    mydivid  = $(e).parents("div.newdd").attr("id");
    var newele = $("#"+mydivid).clone(false,false);
    $(newele).children('img').attr('id', "image"+newimgid);
    $(newele).attr("id",newimgid);
    $(newele).find(".memejeImageContainer").css("display","none");
    $(newele).find('.ui-resizable-handle').remove();
    newele.appendTo("body");
    rleft();
    rright();
    img_rotate[newimgid] = [];
    img_rotate[newimgid]['rotate'] = img_rotate[mydivid]['rotate'];
    img_rotate[newimgid]['x'] = img_rotate[mydivid]['x'];
    img_rotate[newimgid]['y'] = img_rotate[mydivid]['y'];
    img_rotate[newimgid]['src'] = img_rotate[mydivid]['src'];
    ++newimgid;
    $(newele).draggable({                    
        cursor:'pointer',
        containment:"#mycid"
    }).resizable({
        resize : function(){
            $(newele).find(".memejeImageContainer").css("display","none");
        },
        aspectRatio: true
    });
    $(newele).hover(
        function() {
            $(newele).find(".memejeImageContainer").css("display","block");
            var newh = $(this).height() + SET_EDITOR_HEIGHT;
            $(newele).find(".memejeImageContainer .icon_div").css('top',-newh+'px');
            showdebug("Cloned :"+this.id);
        },
        function () {
            $(newele).find(".memejeImageContainer").css("display","none");
        }
        );
}
function change_attr_of_text(textId) {
    $("#"+textId).mouseover(function(e){
        $("#"+textId+" > div.memejeTextContainer").show();
    });
    $("#"+textId).mouseout(function(e){
        if (e.target.tagName!="SELECT")
            $("#"+textId+" > div.memejeTextContainer").hide();
    });
    $("#"+textId).draggable({                    
        cursor:'pointer',
        containment:"#mycid"
    }).css({
        'position':'absolute',
        'top':200,
        'left':500,
        'z-index':1
    });
}
function puttextincanvas(e){
    saveRestorePoint();
	lastimgdrawn = 1;
    id = $(e).parents("div.newtextdd").attr("id");

    var textBoxAttr=$("#TextBox"+id);
    var textBoxAttrSizePx=parseInt(textBoxAttr.css('font-size').replace("px",""));
    var boldness=textBoxAttr.css('font-weight')=='700' || textBoxAttr.css('font-weight')=='bold'?"bold ":"";
    var italic=textBoxAttr.css('font-style')=='italic'?"italic ":"";
    var textFont=textBoxAttr.css('font-family');

    cntx.textBaseline="top";
    cntx.fillStyle=textBoxAttr.css('color');
    cntx.font=boldness+italic+textBoxAttrSizePx+"px "+textFont;
    var textBoxAttrSplit=textBoxAttr.val().split('\n');
    var curPos=$("#TextBox"+id).offset();
    canvasPos=$('#mycid').offset();

    curPos.left=Math.round(curPos.left - canvasPos.left + 3);
    curPos.top=Math.round(curPos.top - canvasPos.top + 3);
    if ($.browser.mozilla) {
        curPos.top+=2;
        curPos.left-=1;
    }
    for(var cnt=0;cnt<textBoxAttrSplit.length;cnt++){
        cntx.fillText(textBoxAttrSplit[cnt],curPos.left,(curPos.top+(cnt*textBoxAttrSizePx)));
    }
    $("#"+id).remove();
}
function changeFontFamily(e){
    id = $(e).parents("div.newtextdd").attr("id");
    var textAreaControl=$("#TextBox"+id);
    textAreaControl.css('font-family', e.value);
    return false;
}
function clonetext(e) {
    mydivid = $(e).parents("div.newtextdd").attr("id");
    var newele = $("#"+mydivid).clone(false,false);
    $(newele).children('textarea').attr('id', "TextBoxtext"+newtextid).val($("#TextBox"+mydivid).val());
    $(newele).attr("id","text"+newtextid);
    $(newele).find('.ui-resizable-handle').remove();
    newele.appendTo("body");
    change_attr_of_text("text"+newtextid);
    newtextid++;
    return false;
}
function changeTextSize(e,increment){
    id = $(e).parents("div.newtextdd").attr("id");
    var textAreaControl=$("#TextBox"+id);
    var newFontSize=parseInt(textAreaControl.css('font-size').replace('px',''))+increment;
    textAreaControl.css('font-size',""+newFontSize+"px");
    return false;
}
function toggleTextBoldStyle(e){
    id = $(e).parents("div.newtextdd").attr("id");
    var textBox=$("#TextBox"+id);
    var fontWeight=textBox.css('font-weight');
    if(fontWeight=='bold' || fontWeight=='700')
        textBox.css('font-weight','');
    else
        textBox.css('font-weight','bold');
    return false;
}
function toggleTextItalicStyle(e){
    id = $(e).parents("div.newtextdd").attr("id");
    var textBox=$("#TextBox"+id);
    var fontStyle=textBox.css('font-style');
    if(fontStyle=='italic')
        textBox.css('font-style','');
    else
        textBox.css('font-style','italic');
    return false;
}
function rotateme(mydivid, degrees){
	x = img_rotate[mydivid]['rotate'] += degrees;
	newX = img_rotate[mydivid]['x'];
	newY = img_rotate[mydivid]['y'];
	$("#image"+mydivid).css("transform","rotate("+ x +"deg) scale("+newX+","+newY+")");
	$("#image"+mydivid).css("-ms-transform","rotate("+ x +"deg) scale("+newX+","+newY+")");
	$("#image"+mydivid).css("-moz-transform","rotate("+ x +"deg) scale("+newX+","+newY+")");
	$("#image"+mydivid).css("-webkit-transform","rotate("+ x +"deg) scale("+newX+","+newY+")");
	$("#image"+mydivid).css("-o-transform","rotate("+ x +"deg) scale("+newX+","+newY+")");
}
function hflip(e) {
    mydivid = $(e).parents("div.newdd").attr("id");
    img_rotate[mydivid]['x'] = img_rotate[mydivid]['x']*-1;
    rotateme(mydivid, 0);
}
function vflip(e) {
    mydivid = $(e).parents("div.newdd").attr("id");
    img_rotate[mydivid]['y'] = img_rotate[mydivid]['y']*-1;
    rotateme(mydivid, 0);
}
function rleft() {
    $('.rleft').mousehold(30, function () {
        rotateme($(this).parents("div.newdd").attr("id"), DEGREE_ROTATE*-1);
    });
}
function rright() {
    $('.rright').mousehold(30, function () {
        rotateme($(this).parents("div.newdd").attr("id"), DEGREE_ROTATE);
    });
}
function create_Textbox(){
    var textId="text"+newtextid;
    newtextid++;
    var html = "<div class='newtextdd' id='"+textId+"'  style='position:relative;padding-top:14px;'>"+
    "<div class='memejeTextContainer'>"+
    "<img title='Remove' src='"+SITE_IMAGE_PATH+"delete.png' onclick='removeMemeid(this,\"text\")' />"+
    "<img title='Put in Canvas' src='"+SITE_IMAGE_PATH+"shape_move_backwards.png' onclick='puttextincanvas(this)' />"+
    "<img title='Decrease size' src='"+SITE_IMAGE_PATH+"decrease_font.png' onclick='changeTextSize(this, -2)' />"+
    "<img title='Increase size' src='"+SITE_IMAGE_PATH+"increase_font.png' onclick='changeTextSize(this, 2)' />"+
    "<img title='Toggle Bold' src='"+SITE_IMAGE_PATH+"bold.png' onclick='toggleTextBoldStyle(this)' />"+
    "<img title='Toggle Italic' src='"+SITE_IMAGE_PATH+"italic.png' onclick='toggleTextItalicStyle(this)' />"+
    "<img title='Clone text' src='"+SITE_IMAGE_PATH+"shape_clone.png' onclick='clonetext(this)' />" ;
    html += "<select onchange='changeFontFamily(this)'><option>Arial</option><option>Courier</option><option>Helvetica</option><option>sans-serif</option><option>Georgia1f</option>"+
    "</select><img title='Drag this' src='"+SITE_IMAGE_PATH+"hand.png' />";
    html += "</div><textarea style='font-size: 12px;width:228px;' spellcheck='false' id='TextBox"+textId+"'>This is a test Line.</textarea>"+
    "</div>";
    $("body").prepend(html)
    change_attr_of_text(textId);
}
function create_Imagebox(clicked_img) {
    img_rotate[newimgid] = new Array();
    img_rotate[newimgid]['rotate'] = 0;
    img_rotate[newimgid]['x'] = 1;
    img_rotate[newimgid]['y'] = 1;
    img_rotate[newimgid]['src'] = clicked_img;
    
    var img=new Image();
    img.src=clicked_img;
    var str=clicked_img;
    $("#edited_img").val(str.substr(str.lastIndexOf('/')+1));
	
	if (document.body && document.body.offsetWidth) {
		winW = document.body.offsetWidth;
	}
	if (document.compatMode=='CSS1Compat' && document.documentElement && document.documentElement.offsetWidth ) {
		winW = document.documentElement.offsetWidth;
	}
	if (window.innerWidth && window.innerHeight) {
		winW = window.innerWidth;
	}
	leftpos = Math.round((winW-img.width)/2);
    var div = $("<div id='"+newimgid+"' class='newdd'>").html("<img id='image"+newimgid+"' src='"+clicked_img+"' />").css({
        'top':'200px',
        'left':leftpos+"px",
        'height':img.height+"px",
        'width':img.width+"px",
        'z-index':1
    }).hover(
        function () {
            var mydivid = this.id;
            showdebug("Orig:"+mydivid);
            newh = $(this).height() + SET_EDITOR_HEIGHT;
            newh -=2;
            newhtml = "<div style='position:relative;' class='memejeImageContainer'><span style='top:-"+newh+"px;' class='icon_div'>";
            newhtml += "<img title='Remove' src='"+SITE_IMAGE_PATH+"delete.png' onclick='removeMemeid(this)'>";
            newhtml += "<img title='Put in Canvas' src='"+SITE_IMAGE_PATH+"shape_move_backwards.png' onclick='putincanvas(this)'>";
            newhtml += "<img title='Rotate Left' src='"+SITE_IMAGE_PATH+"shape_rotate_anticlockwise.png' class='rleft'>";
            newhtml += "<img title='Rotate Right' src='"+SITE_IMAGE_PATH+"shape_rotate_clockwise.png' class='rright'>";
            newhtml += "<img title='Horizontal Flip' src='"+SITE_IMAGE_PATH+"shape_flip_horizontal.png' onclick='hflip(this)'>";
            newhtml += "<img title='Vertical Flip' src='"+SITE_IMAGE_PATH+"shape_flip_vertical.png' onclick='vflip(this)'>";
            newhtml += "<img title='Clone' src='"+SITE_IMAGE_PATH+"shape_clone.png' onclick='cloneme(this)' class='clone'>";
            newhtml += "</span></div>";

            $(this).append($(newhtml));
            $('input[class=clone]').click(function (event) {
                mydivid = $(this).parents("div.newdd").attr("id");
                img_rotate[newimgid] = [];
                img_rotate[newimgid]['rotate'] = img_rotate[mydivid]['rotate'];
                img_rotate[newimgid]['src'] = img_rotate[mydivid]['src']
                newimgid++;
            });
            rleft();
            rright();
        }, 
        function () {
            $(this).find("span:last").remove();
            $('.memejeImageContainer').each(function(){
                if($(this).html()=='')
                    $(this).remove();
            });
        }
        );
    $("body").prepend(div);
    $(".newdd").draggable({                    
        cursor:'pointer',
        containment:"#mycid"
    });
    $(".newdd").resizable({
        resize : function(){
            $(this).find("span:last").remove();
        },
        aspectRatio: true
    });
    ++newimgid;
}
function putincanvas(e) {
    saveRestorePoint();
	lastimgdrawn = 1;
    mydivid = $(e).parents("div.newdd").attr("id");
    cntx.save();

    var canvasPos=$('#mycid').offset();
    var oImg=$("#image"+mydivid);

    var imgPosition=$("#"+mydivid).offset();
    imgPosition.left = Math.round(imgPosition.left - canvasPos.left + 1);
    imgPosition.top = Math.round(imgPosition.top - canvasPos.top + 1);
    if ($.browser.mozilla) {
        imgPosition.left-=1;
        //imgPosition.top-=1;
    }
    var imgW=$(oImg).width();
    var imgH=$(oImg).height();
    if (img_rotate[mydivid]['rotate']!=0) {
        cntx.translate(imgPosition.left+(imgW/2),imgPosition.top+(imgH/2));
        cntx.rotate(img_rotate[mydivid]['rotate']*(Math.PI/180));
        if (img_rotate[mydivid]['x']==-1) {
            cntx.scale(-1, 1);
        }
        if (img_rotate[mydivid]['y']==-1) {
            cntx.scale(1, -1);
        }
        var t=new Image();
        t.src=img_rotate[mydivid]['src'];
        cntx.drawImage(document.getElementById("image"+mydivid), 0, 0, t.width, t.height, (-1*imgW)/2, (-1*imgH)/2, imgW, imgH);
    } else {
        if (img_rotate[mydivid]['x']==-1) {
            cntx.scale(-1, 1);
            imgPosition.left=(imgPosition.left*-1)-imgW;
        }
        if (img_rotate[mydivid]['y']==-1) {
            cntx.scale(1, -1);
            imgPosition.top=(imgPosition.top*-1)-imgH;
        }
        cntx.drawImage(document.getElementById("image"+mydivid), imgPosition.left, imgPosition.top, imgW, imgH);
    }
    $("#"+mydivid).remove();
    cntx.restore();
}
function submit_memeje() {
        var wm=$("#memejimark");
        var paddings=3;
        var x=mycanvas.width-wm.width()-paddings;
        var y=mycanvas.height-wm.height()-paddings;
        cntx.drawImage(wm[0],x,y,wm.width(),wm.height());
	saveindisk(1);
}
function saveindisk(csave) {
    var canvasData = getcanvasimage("mycid");
    var url = SAVE_IMG_PATH+'/id_user/'+$("#iduser").val(); // extra added
    $.ajax({
        type: 'POST',
        url: url,
        contentType: 'application/upload;', 
        cache: false,
        data: canvasData,
        success: function(html){
            if (csave==1){
                document.ques_ans.submit();                
            } else {
                alert(html);
            }
        },
        error: function(xhr, errorMessage, thrownError) {
            alert(xhr.statusText+" error occured while saving the image");
        }
    });
	return false;
}
function addRow(number){
	settings.panel+=number;
	resizeCanvasSize();
	drawpanellines(number);
}
function drawpanellines(number){
	var panelHeight=cntx.canvas.height/settings.panel;
	cntx.save();
	cntx.strokeStyle=settings.mainColor;
	cntx.lineWidth=1;
	cntx.beginPath();
	for(var i=0;i<=number;i++){
		var y=((settings.panel-number+i)*panelHeight);
		y==0?y=1:y-=1;
		cntx.moveTo(0,y);
		cntx.lineTo(cntx.canvas.width,y);
	}
	cntx.moveTo(1,(settings.panel-number)*panelHeight);
	cntx.lineTo(1,cntx.canvas.height);
	cntx.moveTo(cntx.canvas.width-1,(settings.panel-number)*panelHeight);
	cntx.lineTo(cntx.canvas.width-1,cntx.canvas.height);
	cntx.moveTo(cntx.canvas.width/2,(settings.panel-number)*panelHeight);
	cntx.lineTo(cntx.canvas.width/2,cntx.canvas.height);
	cntx.stroke();
	cntx.closePath();
	cntx.restore();
}
function removeRow(){
	if(settings.panel>1){
		settings.panel-=1;
		resizeCanvasSize();
	}
}
function resizeCanvasSize(){
	lastimgdrawn = 1;
	saveRestorePoint();
	var panelWidth=mycanvas.width/2;
	var panelHeight=panelWidth/1.3333;
	mycanvas.height = panelHeight*settings.panel;
	mycanvas.width = panelWidth*2;
	if ( $.browser.msie ) {
		mycanvas.innerHTML = undoPoints.pop();
	} else {
		var oImg = new Image();
		oImg.onload = function() {
			cntx.drawImage(oImg,0,0);
		}
		oImg.src = undoPoints.pop();
	}
	undoheight.pop();
	undowidth.pop();
}
function clear_canvas() {
	cntx.clearRect(0, 0, cntx.canvas.width, cntx.canvas.height);
	drawpanellines(settings.panel);
	return false;
}
function showdocount() {
	$(".undo").attr("title","undo "+undoPoints.length);
    $(".redo").attr("title","redo "+redoPoints.length);
}
function redoimage(){
    if (redoPoints.length > 0) {
        var imgSrc = getcanvasimage("mycid");
        undoPoints.push(imgSrc);
        oh = redoheight.pop();
        ow = redowidth.pop();
        undoheight.push(oh);
        undowidth.push(ow);
        mycanvas.height = oh;
        mycanvas.width = ow;
		if ( $.browser.msie ) {
			mycanvas.innerHTML = redoPoints.pop();
		} else {
			var oImg = new Image();
			oImg.onload = function() {
				cntx.drawImage(oImg,0,0);
			}
	        oImg.src = redoPoints.pop();
		}
        showdocount();
    }
}
function undoimage(){
    if (undoPoints.length > 0) {
        var imgSrc = getcanvasimage("mycid");
        redoPoints.push(imgSrc);
        oh = undoheight.pop();
        ow = undowidth.pop();
        redoheight.push(oh);
        redowidth.push(ow);
        mycanvas.height = oh;
        mycanvas.width = ow;
		if ( $.browser.msie ) {
			mycanvas.innerHTML = undoPoints.pop();
		} else {
			var oImg = new Image();
			oImg.onload = function() {
				cntx.drawImage(oImg,0,0);
			}
			oImg.src = undoPoints.pop();
		}
        showdocount();
    }
}
function saveRestorePoint(){
	if (lastimgdrawn==1) {
		var imgSrc = getcanvasimage("mycid");
		undoPoints.push(imgSrc);
		undoheight.push(mycanvas.height);
		undowidth.push(mycanvas.width);
		redoPoints = [];
		redoheight = [];
		redowidth = [];
		lastimgdrawn = 0;
		showdocount();
	} else {
		showdebug("nothing to save");
	}
}
function getcanvasimage(imgid) {
	if ( $.browser.msie ) {
		var canvasid = document.getElementById(imgid);
		return canvasid.innerHTML;
	} else {
		var canvasid = $("#"+imgid)[0];
		return canvasid.toDataURL();
	}
}
