var SITE_IMAGE_PATH='../../spad/site_image/';
var CURSOR_PATH='../../spad/cursor/';
var SAVE_IMG_PATH= "../../spad/save.php";
var SET_OFFLEFT=8;
var SET_OFFTOP=158;
var SET_EDITOR_HEIGHT=23;
var preloadImage=last_comic;

var newimgid = 1;
var newtextid = 1;
var img_rotate = [];
var settings = {
    'width': 380,
    'height': 380,
    'offsetLeft': 0,
    'offsetTop': SET_OFFTOP,
    'borderWidth': 1,
    'borderColor': '#ccc',
    'lineWidth': 1,
    'lineColor': 'rgb(0,0,0)',
    'mainColor': 'rgb(0,0,0)',
    'type':'line',
    'panel':2
};

(function ($) {
    $.fn.scratchpad = function (options) {
        
        if (options) {
            $.extend(settings, options);
        }
        var supports_canvas = function () {
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
        var undoPoints = [];
        var undoheight = [];
        var undowidth = [];
        var redoPoints = [];
        var redoheight = [];
        var redowidth = [];
        
        $(this).mouseup(function (e) {
            endX = e.pageX - this.offsetLeft - settings.offsetLeft;
            endY = e.pageY - this.offsetTop - settings.offsetTop;
            if (settings.type=='text'){
            //                context.fillText($("#imgtext").val(),endX,endY);
            }
            jitter = shapestarted = draw = 0;
            context.restore();
        });
        $(this).mouseleave(function () {
            if (draw == 1) {
                jitter = draw = 0;
            }
        });
        
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
            $('#line_size').val('Size -'+mysize);
            settings.lineWidth = mysize;
            cc = CURSOR_PATH+settings.lineWidth+".png";
            canvasElem.css({
                "cursor":'url('+cc+'), none'
            });
            $( "#vs" ).slider( "option", "value", mysize );
        }
        if (supports_canvas() == true) {
            var canvasElem = $('<canvas>').attr({
                'width': settings.width.toString(),
                'height': settings.height.toString(),
                'id': "mycid"
            }).css({
                'border': settings.borderWidth.toString() + 'px solid ' + settings.borderColor,
                'background-color': settings.backgroundColor,
                'cursor': 'pointer'
            });
            $(this).append(canvasElem);
            var mycanvas = $('canvas')[0];
            var context = mycanvas.getContext('2d');
            
            if (preloadImage!="") {
                var oImg = new Image();
                oImg.onload = function() {
                    context.drawImage(oImg,0,0);
                }
                oImg.src = preloadImage;
            }
            
            
            
            context.save();
            context.fillStyle = '#fff';
            context.fillRect(0, 0, context.canvas.width, context.canvas.height);
            context.restore();
            //drawpanellines(settings.panel);
            $(this).mousedown(function (e) {
                if (settings.type=='square' || settings.type=='circle' || settings.type=='fcircle' || settings.type=='fsquare' || settings.type=='DLine'){
                    createdummycanvas();
                }
                saveRestorePoint();
                context.save();
                jitter = draw = 1;
                startX = e.pageX - this.offsetLeft - settings.offsetLeft;
                startY = e.pageY - this.offsetTop - settings.offsetTop;
                context.lineWidth = settings.lineWidth;
                if (settings.type=="erase") {
                    settings.lineColor = "rgb(255, 255, 255)";
                } else {
                    settings.lineColor = settings.mainColor;
                }
                context.fillStyle = context.strokeStyle = settings.lineColor;
                context.font = settings.lineWidth+"pt "+$("#font").val();
                context.lineCap = "round";
                context.beginPath();
                if (settings.type=="spray" || settings.type=="line") {
                } else {
                    context.moveTo(startX, startY);
                }
            });
            function createdummycanvas() {
                var cdummy = $('<canvas>').attr({
                    'width': settings.width.toString(),
                    'height': mycanvas.height.toString(),
                    'id': "dummy"
                }).css({
                    'border': settings.borderWidth.toString() + 'px solid ' + settings.borderColor
                });
                cdummy.appendTo("body");
                var x = $('#mycid').offset();
                $('#dummy').css({
                    position:"absolute", 
                    top:x.top+"px", 
                    left:(x.left+7)+"px"
                });
                cc = CURSOR_PATH+settings.lineWidth+".png";
                cdummy.css({
                    "cursor":'url('+cc+'), none'
                });
                var iddummy = document.getElementById('dummy');
                var dummyc = iddummy.getContext('2d');
                dummyc.fillStyle = "rgba(0, 0, 200, 0.5)";
                stopdraw=1;
                $(iddummy).mousemove(function (e) {
                    if (startX=="undefined") {
                        startX=e.pageX;
                        startY=e.pageY;
                        showdebug('goes here');
                    }
                    if (stopdraw==1) {
                        endX = e.pageX - this.offsetLeft + (settings.lineWidth/2);
                        endY = e.pageY - this.offsetTop + (settings.lineWidth/2);
                        var centerX =  startX + ((endX-startX)/2);
                        var centerY = startY + ((endY-startY)/2);
                        var radius = Math.pow((Math.pow(endY-startY, 2)+Math.pow(endX-startX, 2)),.5)/2;

                        dummyc.clearRect ( 0, 0, context.canvas.width, context.canvas.height );
                        dummyc.lineWidth = settings.lineWidth;
                        dummyc.fillStyle = dummyc.strokeStyle = dummyc.lineWidth = settings.lineColor;
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
                                context.moveTo(startX, startY);
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
                    context.drawImage(oImg,0,0);
                }
                oImg.src = iddummy.toDataURL("image/png");
                $(iddummy).remove();
            }

            $(this).mousemove(function (e) {
                if (draw == 1) {
                    switch (settings.type) {
                        case 'erase':
                        case 'line':
                            if (jitter % 3 == 1) {
                                startX = e.pageX - this.offsetLeft - settings.offsetLeft + (settings.lineWidth/2);
                                startY = e.pageY - this.offsetTop - settings.offsetTop + (settings.lineWidth/2);
                                context.lineTo(startX, startY);
                                context.stroke();
                            }
                            ++jitter;
                            break;
                        case 'spray':
                            startX = e.pageX - this.offsetLeft - settings.offsetLeft + (settings.lineWidth/2);
                            startY = e.pageY - this.offsetTop - settings.offsetTop + (settings.lineWidth/2);
                            for (i = 0; i < settings.lineWidth*20; i++) {
                                var offset = getRandomOffset();
                                var x = startX + offset.x, y = startY + offset.y;
                                context.fillRect(x, y, 1, 1);
                            }
                            break;
                    }
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
            $('canvas').droppable({
                //activeClass: "ui-state-default",
                //hoverClass: "ui-state-hover",
                //accept: ":not(.ui-sortable-helper)",
                drop: function( event, ui ) {
                    saveRestorePoint();
                    var cElem = ui.draggable.html();
                    if (!cElem.match('memejeTextContainer')) {
                        if (!cElem.match('resizable')) {
                            sReg = /<IMG.+?src\s*=\s*([\"']?)(.+?[\.jpg|\.gif\|\.png])([\"']).*?>/i;
                            matchArr = cElem.match(sReg);
                        
                            img_rotate[newimgid] = new Array();
                            img_rotate[newimgid]['rotate'] = 0;
                            img_rotate[newimgid]['x'] = 1;
                            img_rotate[newimgid]['y'] = 1;
                        
                            if (matchArr!=null) {
                                var img=new Image();
                                img.src=matchArr[2];
                                /* Extra Added */	
                                var str=matchArr[2];
                                $("#edited_img").val(str.substr(str.lastIndexOf('/')+1));
                                /* End */
                                var div = $("<div id='"+newimgid+"' class='newdd'>").html("<img id='image"+newimgid+"' src='"+matchArr[2]+"' />").css({
                                    'top':event.pageY,
                                    'left':event.pageX,
                                    'height':img.height,
                                    'width':img.width,
                                    'z-index':1
                                }).hover(
                                    function () {
                                        var mydivid = this.id;
                                        showdebug("Orig:"+mydivid);
                                        newh = $(this).height() + SET_EDITOR_HEIGHT;
                                        newhtml = "<div style='position:relative;' class='tobdel'><span style='top:-"+newh+"px;' class='icon_div'>";
                                        newhtml += "<input type='button' title='Remove' style='background:url(\""+SITE_IMAGE_PATH+"delete.png\") no-repeat;' onclick='removeimg(this)'>";
                                        newhtml += "<input type='button' title='Put in Canvas' style='background:url(\""+SITE_IMAGE_PATH+"shape_move_backwards.png\") no-repeat;' onclick='putincanvas(this)'>";
                                        newhtml += "<input type='button' title='Rotate Left' style='background:url(\""+SITE_IMAGE_PATH+"shape_rotate_anticlockwise.png\") no-repeat;' class='rleft'>";
                                        newhtml += "<input type='button' title='Rotate Right' style='background:url(\""+SITE_IMAGE_PATH+"shape_rotate_clockwise.png\") no-repeat;' class='rright'>";
                                        newhtml += "<input type='button' title='Horizontal Flip' style='background:url(\""+SITE_IMAGE_PATH+"shape_flip_horizontal.png\") no-repeat;' onclick='hflip(this)'>";
                                        newhtml += "<input type='button' title='Vertical Flip' style='background:url(\""+SITE_IMAGE_PATH+"shape_flip_vertical.png\") no-repeat;' onclick='vflip(this)'>";
                                        newhtml += "<input type='button' title='Clone' style='background:url(\""+SITE_IMAGE_PATH+"shape_clone.png\") no-repeat;' onclick='cloneme(this)' class='clone'>";
                                        newhtml += "</span></div>";
                                    
                                        $(this).append($(newhtml));
                                        $('input[class=clone]').click(function (event) {
                                            mydivid = $(this).parents("div.newdd").attr("id");
                                            img_rotate[newimgid] = [];
                                            img_rotate[newimgid]['rotate'] = img_rotate[mydivid]['rotate'];
                                            newimgid++;
                                        });
                                        rleft();
                                        rright();
                                    }, 
                                    function () {
                                        $(this).find("span:last").remove();
                                        $('.tobdel').each(function(){
                                            if($(this).html()=='')
                                                $(this).remove();
                                        });
                                    }
                                    );
                                $("body").prepend(div);
                                $(".newdd").draggable().resizable({
                                    resize : function(){
                                        $(this).find("span:last").remove();
                                    },
                                    aspectRatio: 1
                                });
                                ++newimgid;
                            }
                        }
                    }
                }
            });
            
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
                context.globalAlpha = this.value;
            });
            $('input[class=clear]').click(function () {
                context.clearRect(0, 0, context.canvas.width, context.canvas.height);
                drawpanellines(settings.panel);
            });
            $('input[class=canvastop]').click(function () {
                $('.newdd').css({
                    'opacity':'.2'
                });
            });
            $('input[class=canvasbuttom]').click(function () {
                $('.newdd').css({
                    'opacity':'1'
                });
            });
            $('input[class=mirror]').click(function () {
                saveRestorePoint();
                context.save();
                context.translate(mycanvas.width, mycanvas.height);
                context.rotate(Math.PI);
                context.drawImage(mycanvas, 0, 0, mycanvas.width, mycanvas.height);
                context.restore();
            });
            $('input[class=invert]').click(function () {
                saveRestorePoint();
                var imageData = context.getImageData(0, 0, mycanvas.width, mycanvas.height);
                var data = imageData.data;
                for (var i = 0, n = data.length; i < n; i += 4) {
                    data[i] = 255 - data[i];
                    data[i + 1] = 255 - data[i + 1];
                    data[i + 2] = 255 - data[i + 2];
                }
                context.putImageData(imageData, 0, 0);
            });

            $('img[class=addpanel]').click(function () {
                saveRestorePoint();
                addRow(1);
            });
            $('img[class=removepanel]').click(function () {
                //saveRestorePoint();
                removeRow();
            });
            function addRow(number){
                settings.panel+=number;
                resizeCanvasSize();
                drawpanellines(number);
            }
            function drawpanellines(number){
                var panelHeight=context.canvas.height/settings.panel;
                context.save();
                context.strokeStyle='#000';
                context.lineWidth=1;
                context.beginPath();
                for(var i=0;i<=number;i++){
                    var y=((settings.panel-number+i)*panelHeight);
                    y==0?y=1:y-=1;
                    context.moveTo(0,y);
                    context.lineTo(context.canvas.width,y);
                }
                context.moveTo(1,(settings.panel-number)*panelHeight);
                context.lineTo(1,context.canvas.height);
                context.moveTo(context.canvas.width-1,(settings.panel-number)*panelHeight);
                context.lineTo(context.canvas.width-1,context.canvas.height);
                context.moveTo(context.canvas.width/2,(settings.panel-number)*panelHeight);
                context.lineTo(context.canvas.width/2,context.canvas.height);
                context.closePath();
                context.stroke();
                context.restore();
            }
            function removeRow(){
                if(settings.panel>1){
                    settings.panel-=1;
                    resizeCanvasSize();
                }
            }
            function resizeCanvasSize(){
                saveRestorePoint();
                var panelWidth=mycanvas.width/2;
                var panelHeight=panelWidth/1.3333;
                mycanvas.height = panelHeight*settings.panel;
                mycanvas.width = panelWidth*2;
                
                var oImg = new Image();
                oImg.onload = function() {
                    context.drawImage(oImg,0,0);
                }
                oImg.src = undoPoints.pop();
                undoheight.pop();
                undowidth.pop();
            }
            function saveRestorePoint(){
                undoheight.push(mycanvas.height);
                undowidth.push(mycanvas.width);
                var imgSrc = mycanvas.toDataURL("image/png");
                //var imgSrc=Canvas2Image.saveAsPNG(mycanvas,true);
                undoPoints.push(imgSrc);
                redoheight = redowidth = redoPoints = [];
                showundocount();
                showredocount();
            }
            function showundocount() {
                $(".undo").attr("title","undo "+undoPoints.length);
            }
            function showredocount(){
                $(".redo").attr("title","redo "+redoPoints.length);
            }
            function redoimage(){
                if (redoPoints.length > 0) {
                    var imgSrc = mycanvas.toDataURL("image/png");
                    undoPoints.push(imgSrc);
                    oh = redoheight.pop();
                    ow = redowidth.pop();
                    undoheight.push(mycanvas.height);
                    undowidth.push(mycanvas.width);
                    mycanvas.height = ow;
                    mycanvas.width = oh;
                    var oImg = new Image();
                    oImg.onload = function() {
                        context.drawImage(oImg,0,0);
                    }
                    oImg.src = redoPoints.pop();
                    showundocount();
                    showredocount();
                }
            }
            function undoimage(){
                if (undoPoints.length > 0) {
                    var imgSrc = mycanvas.toDataURL("image/png");
                    redoPoints.push(imgSrc);
                    oh = undoheight.pop();
                    ow = undowidth.pop();
                    redoheight.push(mycanvas.height);
                    redowidth.push(mycanvas.width);
                    mycanvas.height = oh;
                    mycanvas.width = ow;
                    var oImg = new Image();
                    oImg.onload = function() {
                        context.drawImage(oImg,0,0);
                    }
                    oImg.src = undoPoints.pop();
                    showundocount();
                    showredocount();
                }
            }
            $('img[class=undo]').click(function () {
                undoimage();
            });
            $('img[class=redo]').click(function () {
                redoimage();
            });
            $('input[class=save]').click(function () {
                window.open(mycanvas.toDataURL());
            });
            $('input[class=savedisk]').click(function () {
                var wm=$("#memejimark");
                var paddings=3;
                //		mycanvas.height = mycanvas.height+wm.height()+(paddings*2);
                var x=mycanvas.width-wm.width()-paddings;
                var y=mycanvas.height-wm.height()-paddings;
                context.drawImage(wm[0],x,y,wm.width(),wm.height());
                var canvasData = mycanvas.toDataURL("image/png");
                var url = SAVE_IMG_PATH+'?id_user='+$("#iduser").val(); // extra added
                $.ajax({
                    type: 'POST',
                    url: url,
                    contentType: 'application/upload;', 
                    cache: false,
                    data: canvasData,
                    success: function(html){
                        alert(html);
                    },
                    error: function(xhr, errorMessage, thrownError) {
                        alert(xhr.statusText+" error occured while saving the image");
                    }
                });
            });
            $('img[class=size]').click(function () {
                settings.type = $(this).attr('id');
                endX = endY = 0;
            });
            $(document).keyup(function(e){
                //if(e.which == 27 && settings.type=='DLine'){
                //    settings.type='line';
                //}
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
            //                showdebug(e.which);
            });
            canvasElem.css({
                "cursor":'url('+CURSOR_PATH+'1.png), none'
            });
            setleftmargin();

            drawpanellines(settings.panel);
        } else {
            $(this).html("<p style='text-align:center;'>Requires HTML 5 Enabled Web Browser.</p>");
        }
    };
})(jQuery);

function removeimg(e) {
    if (e && typeof e == 'string') {
        id = e;
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
    $(newele).find(".tobdel").css("display","none");
    $(newele).find('.ui-resizable-handle').remove();
    newele.appendTo("body");

    rleft();
    rright();


    img_rotate[newimgid] = [];
    img_rotate[newimgid]['rotate'] = img_rotate[mydivid]['rotate'];
    img_rotate[newimgid]['x'] = img_rotate[mydivid]['x'];
    img_rotate[newimgid]['y'] = img_rotate[mydivid]['y'];
    ++newimgid;
    $(newele).draggable().resizable({
        resize : function(){
            $(newele).find(".tobdel").css("display","none");
        },
        aspectRatio: 1
    });
    $(newele).hover(
        function() {
            $(newele).find(".tobdel").css("display","block");
            var newh = $(this).height() + SET_EDITOR_HEIGHT;
            $(newele).find(".tobdel .icon_div").css('top',-newh+'px');
            showdebug("Cloned :"+this.id);
        },
        function () {
            $(newele).find(".tobdel").css("display","none");
        }
        );
}
function create_Textbox(){
    //$(".text_div").show();
    var textId="text"+newtextid;
    newtextid++;

    var html = "<div class='newtextdd' id='"+textId+"'  style='position:relative;padding-top:18px'>"+
    "<div class='memejeTextContainer' style='position:absolute; top:-0px; min-width:120px' >"+
    "<img title='Remove' src='"+SITE_IMAGE_PATH+"delete.png' onclick='removeimg(this)' />"+
    "<img title='Put in Canvas' src='"+SITE_IMAGE_PATH+"shape_move_backwards.png' onclick='puttextincanvas(this)' />"+
    "<img title='Decrease size' src='"+SITE_IMAGE_PATH+"decrease_font.png' onclick='changeTextSize(this, -3)' />"+
    "<img title='Increase size' src='"+SITE_IMAGE_PATH+"increase_font.png' onclick='changeTextSize(this, 3)' />"+
    "<img title='Toggle Bold' src='"+SITE_IMAGE_PATH+"bold.png' onclick='toggleTextBoldStyle(this)' />"+
    "<img title='Toggle Italic' src='"+SITE_IMAGE_PATH+"italic.png' onclick='toggleTextItalicStyle(this)' />"+
    "<img title='Clone text' src='"+SITE_IMAGE_PATH+"shape_clone.png' onclick='clonetext(this)' />"+
    "</div>"+
    "<textarea style='font-size: 12px' spellcheck='false' id='TextBox"+textId+"'></textarea>"+
    "</div>";
    $("body").prepend(html)
    change_attr_of_text(textId);
}
function clonetext(e) {
    mydivid = $(e).parents("div.newtextdd").attr("id");
    var newele = $("#"+mydivid).clone(false,false);
    $(newele).children('textarea').attr('id', "TextBoxtext"+newtextid);
    $(newele).attr("id","text"+newtextid);
    $(newele).find('.ui-resizable-handle').remove();
    newele.appendTo("body");
	
    //$("#TextBox"+mydivid).val(newtextid);
    change_attr_of_text("text"+newtextid);
    newtextid++;
}
function change_attr_of_text(textId) {
    $("#"+textId).mouseover(function(e){
        $("#"+textId+" > div.memejeTextContainer").show();
        showdebug("My Id :"+this.id);
    });
    $("#"+textId).mouseout(function(e){
        $("#"+textId+" > div.memejeTextContainer").hide();
    });
    $("#"+textId).draggable({                    
        cursor:'pointer'
    }).css({
        'position':'absolute',
        'top':200,
        'left':500,
        'z-index':1
    });
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
    if(fontWeight=='bold')
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

function puttextincanvas(e){
    id = $(e).parents("div.newtextdd").attr("id");
    showdebug("put :"+id);
    /*               var mycanvas = $('canvas')[0];
	var context = mycanvas.getContext('2d');
	e = document.getElementById(id);
	var x = e.offsetLeft-settings.offsetLeft;
	var y = e.offsetTop-settings.offsetTop;
	context.fillText($("#TextBox"+id).val(),x,y);
	$(e).remove();*/

    var mycanvas = $('canvas')[0];
    var context = mycanvas.getContext('2d');
    var canvasPos=$('#mycid').offset();
	
    var textBoxTmp=$("#TextBox"+id);
    var textBoxTmpSizePx=parseInt(textBoxTmp.css('font-size').replace("px",""));
    var boldness=textBoxTmp.css('font-weight')=='700' || textBoxTmp.css('font-weight')=='bold'?"bold ":"";
    var italic=textBoxTmp.css('font-style')=='italic'?"italic ":"";
    var textFont=textBoxTmp.css('font-family');
    context.textBaseline="top";
    context.fillStyle=textBoxTmp.css('color');
    context.font=boldness+italic+textBoxTmpSizePx+"px "+textFont;
    var textBoxTmpSplit=textBoxTmp.val().split('\n');
    var curPos=$(textBoxTmp).offset();

    curPos.left-=(canvasPos.left);
    curPos.top-=(canvasPos.top);
    curPos.left+=SET_OFFLEFT;
    curPos.top+=SET_OFFTOP;
    for(var cnt=0;cnt<textBoxTmpSplit.length;cnt++){
        context.fillText(textBoxTmpSplit[cnt],curPos.left,curPos.top+cnt*textBoxTmpSizePx);
    }
    $("#"+id).remove();

}
function rotateme(mydivid, degrees){
    x = img_rotate[mydivid]['rotate'] += degrees;
    newX = img_rotate[mydivid]['x'];
    newY = img_rotate[mydivid]['y'];
    showdebug(newX+"______"+newY+"  of "+mydivid);
    $("#image"+mydivid).css("transform","rotate("+ x +"deg) scale("+newX+","+newY+")");
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
    $('input[class=rleft]').mousehold(3000, function () {
        rotateme($(this).parents("div.newdd").attr("id"), -10);
    });
}
function rright() {
    $('input[class=rright]').mousehold(30, function () {
        rotateme($(this).parents("div.newdd").attr("id"), 10);
    });
}
function create_Imagebox(clicked_img) {
    img_rotate[newimgid] = new Array();
    img_rotate[newimgid]['rotate'] = 0;
    img_rotate[newimgid]['x'] = 1;
    img_rotate[newimgid]['y'] = 1;

    var img=new Image();
    img.src=clicked_img;
        
    var str=clicked_img;
    $("#edited_img").val(str.substr(str.lastIndexOf('/')+1));
    var div = $("<div id='"+newimgid+"' class='newdd'>").html("<img id='image"+newimgid+"' src='"+clicked_img+"' />").css({
        'top':130,
        'left':660,
        'height':img.height,
        'width':img.width,
        'z-index':1
    }).hover(
        function () {
            var mydivid = this.id;
            showdebug("Orig:"+mydivid);
            newh = $(this).height() + SET_EDITOR_HEIGHT;
            newhtml = "<div style='position:relative;' class='tobdel'><span style='top:-"+newh+"px;' class='icon_div'>";
            newhtml += "<input type='button' title='Remove' style='background:url(\""+SITE_IMAGE_PATH+"delete.png\") no-repeat;' onclick='removeimg(this)'>";
            newhtml += "<input type='button' title='Put in Canvas' style='background:url(\""+SITE_IMAGE_PATH+"shape_move_backwards.png\") no-repeat;' onclick='putincanvas(this)'>";
            newhtml += "<input type='button' title='Rotate Left' style='background:url(\""+SITE_IMAGE_PATH+"shape_rotate_anticlockwise.png\") no-repeat;' class='rleft'>";
            newhtml += "<input type='button' title='Rotate Right' style='background:url(\""+SITE_IMAGE_PATH+"shape_rotate_clockwise.png\") no-repeat;' class='rright'>";
            newhtml += "<input type='button' title='Horizontal Flip' style='background:url(\""+SITE_IMAGE_PATH+"shape_flip_horizontal.png\") no-repeat;' onclick='hflip(this)'>";
            newhtml += "<input type='button' title='Vertical Flip' style='background:url(\""+SITE_IMAGE_PATH+"shape_flip_vertical.png\") no-repeat;' onclick='vflip(this)'>";
            newhtml += "<input type='button' title='Clone' style='background:url(\""+SITE_IMAGE_PATH+"shape_clone.png\") no-repeat;' onclick='cloneme(this)' class='clone'>";
            newhtml += "</span></div>";

            $(this).append($(newhtml));
            $('input[class=clone]').click(function (event) {
                mydivid = $(this).parents("div.newdd").attr("id");
                img_rotate[newimgid] = [];
                img_rotate[newimgid]['rotate'] = img_rotate[mydivid]['rotate'];
                newimgid++;
            });
            rleft();
            rright();
        }, 
        function () {
            $(this).find("span:last").remove();
            $('.tobdel').each(function(){
                if($(this).html()=='')
                    $(this).remove();
            });
        }
        );
    $("body").prepend(div);
    $(".newdd").draggable().resizable({
        resize : function(){
            $(this).find("span:last").remove();
        },
        aspectRatio: 1
    });
    ++newimgid;
}
function putincanvas(e) {
    var mycanvas = $('canvas')[0];
    var context = mycanvas.getContext('2d');
    context.save();
    mydivid = $(e).parents("div.newdd").attr("id");
    e = document.getElementById(mydivid);
    var x = e.offsetLeft-settings.offsetLeft;
    var y = e.offsetTop-settings.offsetTop;
    if (img_rotate[mydivid]['x']==-1) {
        context.scale(-1, 1);
        x=(x*-1)-document.getElementById("image"+mydivid).width;
    }
    if (img_rotate[mydivid]['y']==-1) {
        context.scale(1, -1);
        y=(y*-1)-document.getElementById("image"+mydivid).height;
    }
    if (img_rotate[mydivid]['rotate']!=0) {
        if(img_rotate[mydivid]['rotate']<0)
            img_rotate[mydivid]['rotate']=360+img_rotate[mydivid]['rotate'];
        imgW = document.getElementById("image"+mydivid).width;
        imgH = document.getElementById("image"+mydivid).height;
        showdebug("image rotated :" + img_rotate[mydivid]['rotate'] + " : " + imgW + "     " + imgH);
        //context.translate(e.offsetLeft+(imgW/2),e.offsetTop+(imgH/2));
        p = x - 7;
        q = y + 6;
        context.translate(p, q);
        context.rotate(img_rotate[mydivid]['rotate'] * (Math.PI / 180));
        context.drawImage(document.getElementById("image"+mydivid), 0, 0, e.offsetWidth, e.offsetHeight);
    //  context.drawImage(document.getElementById("image"+mydivid), 0, 0, e.scrollWidth-2, e.scrollHeight-2, (-1*imgW)/2,(-1*imgH)/2,imgW,imgH);
    } else {
        context.drawImage(document.getElementById("image"+mydivid), x, y, e.offsetWidth-2, e.offsetHeight-2);
    }
    $(e).remove();
    context.restore();
}
function drawFaceOnCanvas(face){
    var canvasPos=$('#drawingCanvas').offset();
    var oImg=face.find('.faceImage')[0];
    var imgPosition=getImageUnrotatedOffset(oImg);
    imgPosition.left-=canvasPos.left;
    imgPosition.top-=canvasPos.top;
    var imgW=$(oImg).width();
    var imgH=$(oImg).height();
    var rotationDegrees=getRotationDegrees($(oImg).css('transform'));
    var isHorizontallyFlipped=$(oImg).css('transform').indexOf('scaleX')>=0;
    canvasPainter.context.translate(imgPosition.left+(imgW/2),imgPosition.top+(imgH/2));
    canvasPainter.context.rotate(rotationDegrees*(Math.PI/180));
    canvasPainter.context.drawImage(oImg,0,0,getOriginalWidthOfImg(oImg),getOriginalHeightOfImg(oImg),(-1*imgW)/2,(-1*imgH)/2,imgW,imgH);
}
