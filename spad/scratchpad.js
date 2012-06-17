/*
   Muaz-
   This is the main Memeja Editor, we have most of the functionalities in here.
   This is called in addmeme.tpl which contains the html/php for this stuff
   I am commenting every little thing...
*/
var putCanvasCounter = 0;

// Location of all the images for the tools, very easy to change the look of the toolbox
var SITE_IMAGE_PATH=LBL_SITE_URL+'spad/site_image/';

// Cursor has the sizes for the brushes (from 1-25)
var CURSOR_PATH=LBL_SITE_URL+'spad/cursor/';
var SAVE_IMG_PATH=LBL_SITE_URL+"meme/save_meme/ce/0";
var SET_OFFLEFT=8;
var SET_OFFTOP=158;
var SET_EDITOR_HEIGHT=23;
var DEGREE_ROTATE=2;

// The var last_comic comes from addmeme.tpl and refers to the last comic the user was working on
var preloadImage=last_comic;

// Keeps track of the new images added
var newimgid = 1;
var newtextid = 1;

// Hash of "unsaved" meme boxes in canvas
var myHashMemeBoxes = {};

// Keeps track of if there should be gridlines or not.
var grid = true;

// Stacks which hold the actions done
var img_rotate = [];
var undoPoints = [];
var undoheight = [];
var undowidth = [];
var redoPoints = [];
var redoheight = [];
var redowidth = [];

// Stacks to hold actions specific to panel problem
var undoPanel = [];
var undoPanelHeight = [];
var undoPanelWidth = [];

// Stack that holds all the Image boxes created
var images =[];
var numImages = 0;

// Canvas objects
var mycanvas, cntx;

// Keeps track of # of saves
var lastimgdrawn = 1;

// Default settings for the Memeja Editor, called in the jQuery Plugin
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

/*
   This is a Jquery Plugin that Pati's Team wrote for our Memeja Editor.
   This Plugin detects the user's window settings and adjusts the above (var settings) accordingly.
   It also detects events and changes setting accordingly.
*/
(function ($) {
    //Code below just provides several options for the settings of this plugin.
    $.fn.scratchpad = function (options) {
        if (options) {
            $.extend(settings, options);
        }
		// Check to see if a 2D canvas is supported by user.
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
		//If user is drawing on the editor (draw !=0)
        var draw = 0;
		//Detects if the user is drawing on the canvas (jitter!=0)
        var jitter = 0;

		// Variables for canvas start and end
        var startX, startY, endX, endY;

        $(window).resize(function() {
            setleftmargin();
        });

		// Detects browser settings and set the left margin for the window
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

		// Adjusts the size of the cursor from 1-25
        function adjustfontsize(mysize) {
            $('#fontsize').val(mysize);
            $('#line_size').text('Size-'+mysize);
            settings.lineWidth = mysize;
            cc = CURSOR_PATH+settings.lineWidth+".png";
			mycanvas.style.cursor = 'url('+cc+'), none';
            $( "#vs" ).slider( "option", "value", mysize );
        }

		/*
		   Checks to see if HTML 5 is enabled, else it gives an error message.
		   Main bulk of the plugin
		*/
        if (supports_canvas() == true) {

		// The code below was commented out by Pati

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

			//mycanvas.width = 500;
			//mycanvas.height = 500;

			mycanvas.style.border = settings.borderWidth + 'px solid ' + settings.borderColor;
//            mycanvas.style.background-color = settings.backgroundColor;
            mycanvas.style.cursor = 'pointer';

			// If the User doesn't have a preloaded image saved in workspace it creates a new Image for them

            /*  Get's kind of annoying, let's try (ctrl+s)
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
			*/

			// Fills the rest of the Memeja Editor with white color
            cntx.save();
            cntx.fillStyle = '#fff';
            cntx.fillRect(0, 0, cntx.canvas.width, cntx.canvas.height);
            cntx.restore();

			/*
			   The following code will change the canvas based on events inside the canvas
			*/

			//Adjusts coordinates after a mouseup event. Then sets the canvas context back to original state.
            $(document).mouseup(function (e) {
                endX = e.pageX - this.offsetLeft - settings.offsetLeft;
                endY = e.pageY - this.offsetTop - settings.offsetTop;
                jitter = draw = 0;
				// Why the restore is necessary - http://html5.litten.com/understanding-save-and-restore-for-the-canvas-context/
                cntx.restore();
            });


			// Detects if the user is within the canvas area
            $(this).mouseenter(function () {
                if (jitter > 0) {
                    draw = 1;
                }
            });

			// If the user leaves the canvas area we set draw = 0
            $(this).mouseleave(function () {
                if (draw == 1) {
                    draw = 0;
                }
            });

			// When the user clicks on the canvas we start drawing
            $(this).mousedown(function (e) {
			    // Anything other than a default line goes into a new "dummy canvas"
                if (settings.type=='square' || settings.type=='circle' || settings.type=='fcircle' || settings.type=='fsquare' || settings.type=='DLine'||settings.type=='ftriangle'||settings.type=='triangle'){
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
				// Create a new dummycanvas and add it to the body
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
							case 'ftriangle':
                                drawTri(dummyc, startX,startY,endX,endY,true);
                                break;
							case 'triangle':
                                drawTri(dummyc, startX, startY, endX, endY, false);
                                break;
                            case 'square':
                                dummyc.strokeRect(startX,startY,endX-startX,endY-startY);
                                break;
                            case 'fcircle':
                                drawOvals(dummyc, centerX, centerY, endX-startX, endY-startY, true);
                                break;
                            case 'circle':
                                drawOvals(dummyc, centerX, centerY, endX-startX, endY-startY, false);
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
            });
            $('#fontsize').blur(function(){
                adjustfontsize($(this).val());
            });
            $('img[class=erase]').click(function () {
                settings.type = "erase";
            });
			$('img[class=grid]').click(function () {
                if(grid==true)
				{
				  grid = false;
				/*
				  if(undoPoints.length==0){
				   clear_canvas();
				  }
				 */
				  drawpanellines(settings.panel);
				  drawpanellines(settings.panel);
				}else
			    {
				  grid = true;
				}
				drawpanellines(settings.panel);
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
			$('img[class=uparrow]').click(function () {
			    moveUp();
			})
			$('img[class=clear]').click(function () {
			    clear_canvas();
			})
			$('img[class=downarrow]').click(function () {
			    moveDown();
			})
			$('img[class=paintbucket]').click(function () {
			    paintbucket();
			})
            $('input[class=save]').click(function () {
                window.open(getcanvasimage("mycid"));
            });
            $('img[class=size]').click(function () {
                settings.type = $(this).attr('id');
                endX = endY = 0;
            });
            $(document).keyup(function(e){
                if(e.which == 90){
                    if(typeof(b_titlefocus) == 'undefined' || b_titlefocus == false) {
                        undoimage();
                    }
                }
                if(e.which == 89){
                    if(typeof(b_titlefocus) == 'undefined' || b_titlefocus===false) {
                        redoimage();
                    }
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

// Removes the Meme Imagebox that is specified
function removeMemeid(e, text) {
	putCanvasCounter--;
    if (text && typeof text == 'string') {
        id = $(e).parents("div.newtextdd").attr("id");;
    } else {
		id = $(e).parents("div.newdd").attr("id");
		//alert(putCanvasCounter);
	}
    $("#"+id).remove();

    if(myHashMemeBoxes[id.toString()]) {
        delete myHashMemeBoxes[id.toString()];
    }


}

// Clones the Meme Face and it's settings
function cloneme(e)
{
	putCanvasCounter++;
	//alert(putCanvasCounter);
    mydivid  = $(e).parents("div.newdd").attr("id");
    var newele = $("#"+mydivid).clone(false,false);
    $(newele).children('img').attr('id', "image"+newimgid);
    $(newele).attr("id",newimgid);
    $(newele).find(".memejeImageContainer").css("display","none");
    $(newele).find('.ui-resizable-handle').remove();
	memeTop = 250;
    if(window.pageYOffset > 250) {
        memeTop = window.pageYOffset;
    }
	if(newimgid % 3 == 1)
	   memeTop+=50;
    if(newimgid % 3 == 2)
	   memeTop+=75;
    if(newimgid % 6 == 3)
	   memeTop+=100;
    if(newimgid % 6 == 4)
	   memeTop+=125;
    if(newimgid % 6 == 5)
	   memeTop+=150;
	$(newele).css("top", memeTop+"px");

    newele.appendTo("body");
    rleft();
    rright();
    img_rotate[newimgid] = [];
    img_rotate[newimgid]['rotate'] = img_rotate[mydivid]['rotate'];
    img_rotate[newimgid]['x'] = img_rotate[mydivid]['x'];
    img_rotate[newimgid]['y'] = img_rotate[mydivid]['y'];
    img_rotate[newimgid]['src'] = img_rotate[mydivid]['src'];

    // Add meme box to unsaved hash list when cloning
    var myObj = new Object();    // empty for now
    addMemeBox(newimgid.toString(), myObj);

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
            $(newele).find(".memejeImageContainer .icon_div").css('top',-newh+5+'px');
            showdebug("Cloned :"+this.id);
        },
        function () {
            $(newele).find(".memejeImageContainer").css("display","none");
        }
        );
}


function change_attr_of_text(textId, top, left)
{
    if(!top)
    {
        top = 200;
    }
    if(!left)
    {
        left = 500;
    }
    else if(left > 750)
    {
        left = 350;
    }

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
        'top':top,
        'left':left,
        'z-index':1
    });
}

// Places the text into the canvas at the appropriate spot.
function getLines(ctx,phrase,maxPxLength) {
    var wa=phrase.split(" "), phraseArray=[], measureofword=0, measureofphrase=0, phaseArrayIndex=0, startofline=true;
    for(var i=0; i<wa.length; i++) {
       if(startofline == true) {
           measureofword = ctx.measureText(wa[i]).width;
           if(measureofword > maxPxLength) {
              phraseArray[phaseArrayIndex] = wa[i];
              phaseArrayIndex += 1;
              continue;
           }
       }
       else {
           measureofword = ctx.measureText(" " + wa[i]).width;
       }
       if(measureofphrase + measureofword < maxPxLength)
       {
           if(measureofphrase == 0)
           {
               phraseArray[phaseArrayIndex] = wa[i];
      //console.log("Measure of word \"" + wa[i] + "\" is:" + measureofword + "; Add to phraseArray");
           }
           else {
               startofline = false;
               phraseArray[phaseArrayIndex] = phraseArray[phaseArrayIndex] + " " + wa[i];
      //console.log("Measure of phrase \"" + phraseArray[phaseArrayIndex] + "\" is:" + measureofphrase + "; Add to phraseArray");
           }
           measureofphrase += measureofword;
       }
       else {
     //console.log("Measure of \"" + phraseArray[phaseArrayIndex] + "\" is:" + measureofphrase);
           if(i > 0) { i -= 1; }

           phaseArrayIndex += 1;
           startofline = true;
           measureofphrase = 0;
       }
    }
    return phraseArray;
}
// Places the text into the canvas at the appropriate spot.
function puttextincanvas(e){
putCanvasCounter--;
saveRestorePoint();
lastimgdrawn = 1;
   id = $(e).parents("div.newtextdd").attr("id");

   if(myHashMemeBoxes[id]) {
       delete myHashMemeBoxes[id];
   }
    var textBoxAttr=$("#TextBox"+id);
    var textBoxAttrSizePx=parseInt(textBoxAttr.css('font-size').replace("px",""));
    var boldness=textBoxAttr.css('font-weight')=='700' || textBoxAttr.css('font-weight')=='bold'?"bold ":"";
    var italic=textBoxAttr.css('font-style')=='italic'?"italic ":"";
    var textFont=textBoxAttr.css('font-family');
	var textAreaWidth = parseInt(textBoxAttr.css('width').replace("px",""));

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
    //var mylines = getLines(cntx, textBoxAttrSplit[0], textAreaWidth);
    //console.log("MYLINES = "+mylines.join( "; "));
    for(var cnt=0;cnt<textBoxAttrSplit.length;cnt++){
        var mylines = getLines(cntx, textBoxAttrSplit[cnt], textAreaWidth);
        for(var cnt2=0;cnt2<mylines.length;cnt2++){
            cntx.fillText(mylines[cnt2],curPos.left,(curPos.top+((cnt+cnt2)*textBoxAttrSizePx)));
        }
    }
    //for(var cnt=0;cnt<textBoxAttrSplit.length;cnt++){
    //console.log("puttextincanvas: cnt["+cnt+"] = "+textBoxAttrSplit[cnt]+"; textBoxAttrSizePx="+textBoxAttrSizePx + ";textFont="+textFont+";textAreaWidth="+textAreaWidth);
    //    cntx.fillText(textBoxAttrSplit[cnt],curPos.left,(curPos.top+(cnt*textBoxAttrSizePx)), (mycanvas.width-curPos.left));
    //}
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

    var origOffset = $("#"+mydivid).offset();
    console.log("ORIG-OFFSET: top:"+origOffset.top+"; left:"+origOffset.left+"; C-WIDTH"+mycanvas.width+";C-HEIGHT:"+mycanvas.height);

    var newele = $("#"+mydivid).clone(false,false);
    $(newele).children('textarea').attr('id', "TextBoxtext"+newtextid).val($("#TextBox"+mydivid).val());
    $(newele).attr("id","text"+newtextid);
    $(newele).find('.ui-resizable-handle').remove();
    newele.appendTo("body");

    change_attr_of_text("text"+newtextid, origOffset.top+30, origOffset.left+30);

    // Add meme box to unsaved hash list
    var myObj = new Object();    // empty for now
    addMemeBox("text" + newtextid.toString(), myObj);

    newtextid++;
    return false;
}

function getLeftOffsetForTextId(newtextid)
{

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
/* Makes sure the selected meme face is near the top of the canvas
    memeTop = 250;
    if(window.pageYOffset > 250) {
        memeTop = window.pageYOffset;
    }*/
function create_Textbox(){
	putCanvasCounter++;
    var textId="text"+newtextid;

	
	// Makes sure the textbox is near the top of the canvas
    var textTop = 250;
    var textLeft = 500;
    if(window.pageYOffset > 250) {
        textTop = window.pageYOffset;
    }
    // Makes sure the next textbox isn't overlapping the previous one
    if(newtextid % 3 == 1) 
		textTop += 50;
    if(newtextid % 3 == 2) 
		textTop += 75;
    if(newtextid % 6 == 3) 
		textTop += 100;
    if(newtextid % 6 == 4) 
		textTop += 125;
    if(newtextid % 6 == 5) 
		textTop += 150;

    // Add meme box to unsaved hash list
    var myObj = new Object();    // empty for now
    addMemeBox("text" + newtextid.toString(), myObj);

	newtextid++;

    var html = "<div class='newtextdd' id='"+textId+"'  style='position:relative;padding-top:14px;left:150px;'>"+
    "<div class='memejeTextContainer'>"+
    "<img title='Remove' src='"+SITE_IMAGE_PATH+"delete.png' onclick='removeMemeid(this,\"text\")' />"+
    "<img title='Set to the Background' src='"+SITE_IMAGE_PATH+"shape_move_backwards.png' onclick='puttextincanvas(this)' />"+
    "<img title='Decrease size' src='"+SITE_IMAGE_PATH+"decrease_font.png' onclick='changeTextSize(this, -2)' />"+
    "<img title='Increase size' src='"+SITE_IMAGE_PATH+"increase_font.png' onclick='changeTextSize(this, 2)' />"+
    "<img title='Toggle Bold' src='"+SITE_IMAGE_PATH+"bold.png' onclick='toggleTextBoldStyle(this)' />"+

    "<img title='Toggle Italic' src='"+SITE_IMAGE_PATH+"italic.png' onclick='toggleTextItalicStyle(this)' />";
    //"<img title='Clone text' src='"+SITE_IMAGE_PATH+"shape_clone.png' onclick='clonetext(this)' />" ;
    html += "<select onchange='changeFontFamily(this)'><option>Arial</option><option>Courier</option><option>Helvetica</option><option>sans-serif</option><option>Georgia1f</option><option>Impact</option>"+
    "</select><img title='Drag this' src='"+SITE_IMAGE_PATH+"hand.png' />";

    html += "</div><textarea style='font-size: 12px;width:125px;border: 0; spellcheck='true' onfocus='title_focus()' onblur='title_blur()' id='TextBox"+textId+"'>Enter text here</textarea>"+

	"</div>";

    $("body").prepend(html)
    change_attr_of_text(textId, textTop);
}

function create_Imagebox(clicked_img)
{
    // newimgid corresponds to the newest meme face we clicked
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

	// Makes sure the selected meme face is near the top of the canvas
    memeTop = 250;
    if(window.pageYOffset > 250) {
        memeTop = window.pageYOffset;
    }

    // Makes sure the next selected meme face isn't overlapping another one
    if(newimgid % 3 == 1)
	   memeTop+=50;
    if(newimgid % 3 == 2)
	   memeTop+=75;
    if(newimgid % 6 == 3)
	   memeTop+=100;
    if(newimgid % 6 == 4)
	   memeTop+=125;
    if(newimgid % 6 == 5)
	   memeTop+=150;

	// This is the image box created
    var div = $("<div id='"+newimgid+"' class='newdd'>").html("<img id='image"+newimgid+"' src='"+clicked_img+"' />").css({

		// Sets the position at which you see the image box
	    'top': memeTop+"px",
        'left':leftpos+"px",
        'height':img.height+"px",
        'width':img.width+"px",
        'z-index':1
    }).hover(
        function ()
		{
            var mydivid = this.id;
            showdebug("Orig:"+mydivid);
            newh = $(this).height() + SET_EDITOR_HEIGHT;
            newh -=2;
            newhtml = "<div style='position:relative;' class='memejeImageContainer'><span style='top:-"+newh+"px;' class='icon_div' class='nohighlight'>";
            newhtml += "<img title='Remove' src='"+SITE_IMAGE_PATH+"delete.png' onclick='removeMemeid(this)'>";
            newhtml += "<img title='Set to the Background' src='"+SITE_IMAGE_PATH+"shape_move_backwards.png' onclick='putincanvas(this)'>";
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
                img_rotate[newimgid]['src'] = img_rotate[mydivid]['src'];
                newimgid++;
            });
            rleft();
            rright();
        },
        function ()
		{
            $(this).find("span:last").remove();
            $('.memejeImageContainer').each(function()
			{
                if($(this).html()=='')
                    $(this).remove();
            });
        }
        );
			numImages++;
			putCanvasCounter++;
		//	alert(putCanvasCounter);
    $("body").prepend(div);
    $(".newdd").draggable(
	{
        cursor:'pointer',
        containment:"#mycid"
    });
    $(".newdd").resizable(
	{
        resize : function()
		{
            $(this).find("span:last").remove();
        },
        aspectRatio: true
    });

    // Add meme box to unsaved hash list
    var myObj = new Object();    // empty for now
    addMemeBox(newimgid.toString(), myObj);

    ++newimgid;
}

function getRandomKey()
{
    return Math.random().toString(36).substr(2, 5);
}
function addMemeBox(myid, myobj)
{
    console.log("addMemeBox: " + myid);

    myHashMemeBoxes[myid] = myobj;
}

// Save all unsaved meme boxes in canvas
function putAllUnsavedTextBoxessInCanvas()
{
    for(var id in myHashMemeBoxes)
    {
        if(id.indexOf("text") != 0) {
            continue;
        }
        putCanvasCounter--;
        saveRestorePoint();
        lastimgdrawn = 1;
        //id = $(e).parents("div.newtextdd").attr("id");

        var textBoxAttr=$("#TextBox"+id);
        var textBoxAttrSizePx=parseInt(textBoxAttr.css('font-size').replace("px",""));
        var boldness=textBoxAttr.css('font-weight')=='700' || textBoxAttr.css('font-weight')=='bold'?"bold ":"";
        var italic=textBoxAttr.css('font-style')=='italic'?"italic ":"";
        var textFont=textBoxAttr.css('font-family');
        var textAreaWidth = parseInt(textBoxAttr.css('width').replace("px",""));

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
        //var mylines = getLines(cntx, textBoxAttrSplit[0], textAreaWidth);
        //console.log("MYLINES = "+mylines.join( "; "));
        for(var cnt=0;cnt<textBoxAttrSplit.length;cnt++){
            var mylines = getLines(cntx, textBoxAttrSplit[cnt], textAreaWidth);
            for(var cnt2=0;cnt2<mylines.length;cnt2++){
                cntx.fillText(mylines[cnt2],curPos.left,(curPos.top+((cnt+cnt2)*textBoxAttrSizePx)));
            }
        }
        //for(var cnt=0;cnt<textBoxAttrSplit.length;cnt++){
        //console.log("puttextincanvas: cnt["+cnt+"] = "+textBoxAttrSplit[cnt]+"; textBoxAttrSizePx="+textBoxAttrSizePx + ";textFont="+textFont+";textAreaWidth="+textAreaWidth);
        //    cntx.fillText(textBoxAttrSplit[cnt],curPos.left,(curPos.top+(cnt*textBoxAttrSizePx)), (mycanvas.width-curPos.left));
        //}
        $("#"+id).remove();
    }
}
// DSC, 06/09/2012 - save all unsaved meme boxes in canvas
function putAllUnsavedMemesInCanvas()
{
  for(var mydivid in myHashMemeBoxes)
  {
      if(mydivid.indexOf("text") == 0) {
          continue;
      }
  console.log("SAVE UNSAVED MEME ID:" + mydivid);
    saveRestorePoint();
    lastimgdrawn = 1;
    //mydivid = $(e).parents("div.newdd").attr("id");
    cntx.save();

    var canvasPos=$('#mycid').offset();
    var oImg=$("#image"+mydivid);

    var imgPosition=$("#"+mydivid).offset();
    imgPosition.left = Math.round(imgPosition.left - canvasPos.left + 1);
    imgPosition.top = Math.round(imgPosition.top - canvasPos.top + 1);
    var imgW=$(oImg).width();
    var imgH=$(oImg).height();
    if ($.browser.mozilla) {
        imgPosition.left-=1;
        //imgPosition.top-=1;
    }
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
    putCanvasCounter--;
  console.log("putCanvasCounter:" + putCanvasCounter);
    //alert(putCanvasCounter);
    //images[mydivid]
    cntx.restore();
  }

}

function putincanvas(e)
{
//var is_macromeme_checked = document.getElementById('macromeme_checkbox').checked;


	saveRestorePoint();
	lastimgdrawn = 1;
    mydivid = $(e).parents("div.newdd").attr("id");
    cntx.save();

    if(myHashMemeBoxes[mydivid.toString()]) {
        delete myHashMemeBoxes[mydivid.toString()];
    }

    var canvasPos=$('#mycid').offset();
    var oImg=$("#image"+mydivid);

    var imgPosition=$("#"+mydivid).offset();
    imgPosition.left = Math.round(imgPosition.left - canvasPos.left + 1);
    imgPosition.top = Math.round(imgPosition.top - canvasPos.top + 1);
    var imgW=$(oImg).width();
    var imgH=$(oImg).height();
/**    if(is_macromeme_checked == true) {
  console.log("MACROMEME CHECKBOX: imgW:"+ imgW + "; imgH:"+imgH);
        imgPosition.left = 0;
        imgPosition.top = 0;
        mycanvas.width = imgW;
        mycanvas.height = imgH;
        //$('#fontsize').val(40);
    }
	*/
	
    if ($.browser.mozilla) {
        imgPosition.left-=1;
        //imgPosition.top-=1;
    }
    //var imgW=$(oImg).width();
    //var imgH=$(oImg).height();
	
//	var testObj = new Object();
//	var hash = new Object();
//	testObj.firstele = imgPosition.left
//	testObj.secondele = imgPosition.top;
//
//	var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz!@#$%^&*()_+=`:;'/.,<>[]{}\|";
//	var keylen = 5;
//	var randstr = '';
//	for (var i = 0; i < keylen; i++) {
//		var pos = Math.floor(Math.random() * chars.length);
//		randstr += chars.substring(pos,pos+1);
//	}
//
//	hash[randstr] = testObj.firstele;
//	for (var k in hash) {
//		if (hash.hasOwnProperty(k)) {
//			alert('key is: ' + k + ', value is: ' + hash[k]);
//		}
//	}

   	var testObj = new Object();
    var hash = new Object();
    testObj.firstele = imgPosition.left
    testObj.secondele = imgPosition.top;

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
	putCanvasCounter--;
	//alert(putCanvasCounter);
	images[mydivid]
    cntx.restore();

}
function submit_memeje() {

        /*  Commented out the watermark

		var wm=$("#memejimark");
        var paddings=3;
        var x=mycanvas.width-wm.width()-paddings;
        var y=mycanvas.height-wm.height()-paddings;
        cntx.drawImage(wm[0],x,y,wm.width(),wm.height()); */


    putAllUnsavedMemesInCanvas();
    putAllUnsavedTextBoxessInCanvas();
	
		saveindisk(1);
}
function saveindisk(csave)
{
	var canvasData = getcanvasimage("mycid");
    var url = SAVE_IMG_PATH+'/id_user/'+$("#iduser").val(); // extra added
    $.ajax(
	{
        type: 'POST',
        url: url,
        contentType: 'application/upload;',
        cache: false,
        data: canvasData,
        success: function(html)
		{
            if (csave==1 && putCanvasCounter==0)
			{
                document.ques_ans.submit();
            }
			else
			{
			document.ques_ans.submit();
				//alert("Please set all images/textboxes to the canvas (second button above the image)");
			}
        },
        error: function(xhr, errorMessage, thrownError) {
            alert(xhr.statusText+" error occured while saving the image");
        }
    });
	return false;
}

function drawpanellines(number){
	var panelHeight=cntx.canvas.height/settings.panel;
	cntx.save();
	if(grid==true){
	cntx.strokeStyle="rgb(0,0,0)";
	cntx.lineWidth=1;
	}else{
	cntx.strokeStyle="white";
	cntx.lineWidth=3;
	}
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
	//draw outerbounds
	cntx.save();
	cntx.strokeStyle="rgb(0,0,0)";
	cntx.lineWidth=1;
	cntx.beginPath();
	cntx.moveTo(1,1);
	cntx.lineTo(cntx.canvas.width,1);
	cntx.lineTo(cntx.canvas.width,cntx.canvas.height);
	cntx.lineTo(1,cntx.canvas.height);
	cntx.lineTo(1,1);
	cntx.stroke();
	cntx.closePath();
	cntx.restore();
}

// Adds two panels to the bottom
function addRow(number){
	settings.panel+=number;
	resizeCanvasSize();
	drawpanellines(number);
	/* This portion was added to ensure that if you draw in the bottom panel and delete the panels,
	then try to add panels again, your original image will be shown
	*/
	if(undoPanel[0]!= ""){

	if ( $.browser.msie ) {
		mycanvas.innerHTML = undoPanel.pop();
	} else {
		var oImg = new Image();
		oImg.onload = function() {
			cntx.drawImage(oImg,0,0);
		}
		oImg.src = undoPanel.pop();
	}

  }
}

// Removes the bottom two panels
function removeRow(){
	if(settings.panel>2){
        var imgSrc = getcanvasimage("mycid");
        undoPanel.push(imgSrc);
        undoPanelHeight.push(mycanvas.height);
        undoPanelWidth.push(mycanvas.width);
		settings.panel-=1;
		resizeCanvasSize();
	}
}

// Resizes the canvas area
function resizeCanvasSize(){
	lastimgdrawn = 1;
	saveRestorePoint();
	var panelWidth=mycanvas.width/2;
	var panelHeight=panelWidth/1.3333;
	mycanvas.height = panelHeight*settings.panel;
	mycanvas.width = panelWidth*2;
	// Done after saveRestorePoint() called to keep current image
	if ( $.browser.msie ) {
		mycanvas.innerHTML = undoPoints.pop();
	} else {
		var oImg = new Image();
		oImg.onload = function() {
			cntx.drawImage(oImg,0,0);
		}
		oImg.src = undoPoints.pop();
	}
	//Pop the last values off the undo stacks, because the current value has been stored in them since saveRestorePoint() was called
	undoheight.pop();
	undowidth.pop();
}

// Clears the Canvas
function clear_canvas() {
	cntx.clearRect(0, 0, cntx.canvas.width, cntx.canvas.height);
	numImages++;
	putCanvasCounter = 0;
	for(x=0;x<numImages;x++)
	{
    $("#"+x).remove();
	}
	drawpanellines(settings.panel);

    // Clear the hash
    myHashMemeBoxes = {};

	return false;
}

// Adjust attributes of the Undo/Redo buttons. (As seen on hover)
function showdocount() {
	$(".undo").attr("title",undoPoints.length+ " Undo's Left (CTRL+Z)");
    $(".redo").attr("title",redoPoints.length+ " Redo's Left (CTRL+Y)");
}

// Function for the REDO tool (ctrl+y)
function redoimage(){
    if (redoPoints.length > 0) {
        var imgSrc = getcanvasimage("mycid");
        undoPoints.push(imgSrc);
        oh = redoheight.pop();
        ow = redowidth.pop();
        undoheight.push(mycanvas.height);
        undowidth.push(mycanvas.width);
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

/* This function and redoToTop are for toggling the gridlines
function undoToBottom(){
 while(undoPoints.length>0){
  undoimage();
 }
}

function redoToTop(){
  redoPoints.pop();
  redoheight.pop();
  redowidth.pop();
 while(redoPoints.length>0){
  redoimage();
 }
}
*/

// Function for the UNDO tool (ctrl+z)
function undoimage(){
    if (undoPoints.length > 0) {
        var imgSrc = getcanvasimage("mycid");
        redoPoints.push(imgSrc);
        oh = undoheight.pop();
        ow = undowidth.pop();
        redoheight.push(mycanvas.height);
        redowidth.push(mycanvas.width);
        mycanvas.height = oh;
        mycanvas.width = ow;
		// For IE pops last image off of stack and sets it to current canvas
		if ( $.browser.msie ) {
			mycanvas.innerHTML = undoPoints.pop();
		} else {
		    // All other browsers
			var oImg = new Image();
			oImg.onload = function() {
				cntx.drawImage(oImg,0,0);
			}
			oImg.src = undoPoints.pop();
		}
        showdocount();
    }
}

// This function allows for drawing ovals/circles filled or empty
function drawOvals(context, centX, centY, width, height, fill)
        {
            context.beginPath();
            context.moveTo(centX, centY - height/2);
            context.bezierCurveTo(
                centX + width/2, centY - height/2,
                centX + width/2, centY + height/2,
                centX, centY + height/2);
            context.bezierCurveTo(
                centX - width/2, centY + height/2,
                centX - width/2, centY - height/2,
                centX, centY - height/2);
            if(fill !== undefined && fill === true)
            {
                context.fill();
            }
            else
			{
                context.stroke();
            }
            context.closePath();
        }

// Allows for triangles on the Memeja Editor
function drawTri(context,startX, startY, endX, endY, fill)
{
// Right Triangle
context.beginPath();
context.moveTo(startX,startY);
context.lineTo(endX,endY);
if(startX>endX){
context.lineTo(endX-Math.abs(startX-endX), startY);
}else{
context.lineTo(endX+Math.abs(startX-endX), startY);
}
context.lineTo(startX, startY);

/*
Equilateral
var b = Math.abs(startY-endY);
context.beginPath();
context.moveTo(startX,startY);
context.lineTo(startX+ Math.round(Math.sqrt((b*b)/3)), endY);
context.lineTo(startX- Math.round(Math.sqrt((b*b)/3)), endY);
context.lineTo(startX, startY);
*/
if(fill !== undefined && fill === true)
            {
                context.fill();
            }
            else
			{
                context.stroke();
            }
context.closePath();

}

// Saves the current image by pushing vars into stacks
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
/*
Under Construction
*/
function paintbucket()
{

pixelStack = [[startX, startY]];

while(pixelStack.length)
{
  var newPos, x, y, pixelPos, reachLeft, reachRight;
  newPos = pixelStack.pop();
  x = newPos[0];
  y = newPos[1];

  pixelPos = (y*canvasWidth + x) * 4;
  while(y-- >= drawingBoundTop && matchStartColor(pixelPos))
  {
    pixelPos -= canvasWidth * 4;
  }
  pixelPos += canvasWidth * 4;
  ++y;
  reachLeft = false;
  reachRight = false;
  while(y++ < canvasHeight-1 && matchStartColor(pixelPos))
  {
    colorPixel(pixelPos);

    if(x > 0)
    {
      if(matchStartColor(pixelPos - 4))
      {
        if(!reachLeft){
          pixelStack.push([x - 1, y]);
          reachLeft = true;
        }
      }
      else if(reachLeft)
      {
        reachLeft = false;
      }
    }

    if(x < canvasWidth-1)
    {
      if(matchStartColor(pixelPos + 4))
      {
        if(!reachRight)
        {
          pixelStack.push([x + 1, y]);
          reachRight = true;
        }
      }
      else if(reachRight)
      {
        reachRight = false;
      }
    }

    pixelPos += canvasWidth * 4;
  }
}
context.putImageData(colorLayer, 0, 0);
}

function matchStartColor(pixelPos)
{
  var r = colorLayer.data[pixelPos];
  var g = colorLayer.data[pixelPos+1];
  var b = colorLayer.data[pixelPos+2];

  return (r == startR && g == startG && b == startB);
}


function colorPixel(pixelPos)
{
  colorLayer.data[pixelPos] = fillColorR;
  colorLayer.data[pixelPos+1] = fillColorG;
  colorLayer.data[pixelPos+2] = fillColorB;
  colorLayer.data[pixelPos+3] = 255;
}

// Moves the User to the top of the page
function moveUp()
{
  $('html, body').animate({scrollTop:0}, 'slow');
}

// Moves the User to the bottom of the page
function moveDown()
{
  var dh = document.body.scrollHeight
  var ch = document.body.clientHeight
  if(dh>ch){
  var moveme=dh-ch;
  window.scrollTo(0,moveme);
  }
}

// Returns the filepath for the image currently on the canvas
function getcanvasimage(imgid) {
    //Only for IE browsers
	if ( $.browser.msie ) {
		var canvasid = document.getElementById(imgid);
		return canvasid.innerHTML;
	} else {
	// All normal browsers
		var canvasid = $("#"+imgid)[0];
		return canvasid.toDataURL();
	}
}
