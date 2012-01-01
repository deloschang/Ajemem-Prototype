/* 

The function validate expects 2 arguments . The first if frm => The form object which is to be validated 
The second is an array validate_data_arr : 
Each element of the array validate_data_arr is an array of the form 
'name_of_input_typ_in_form , 'name_of_js_library_function_to_be_called' , 'error_message_if_called_function-fails' , 'Optionally any munber of additional arguments expected the the function bein caled can be passed '' 

Eg.	var validate_data_arr=new Array(); 
validate_data_arr[validate_data_arr.length]= new Array("table[name]", "isEmpty","Please fill in your  user name"); 
validate_data_arr[validate_data_arr.length]= new Array("table[name]", "checkLength","Username should be between of 4 & 16 characters ",4,16); 
TBD : Can be Enhanced such that all the messages of one field can be clubbed together and shown. 
*/ 

// This function used the array validata to validate fields in the form frm "\n"

function validate(form,validate_data_arr){
var errs = new Array(); 
var focusobj;
var frm = 'document.'+form.name;
for(var i =0 ; i < validate_data_arr.length ; i++){
	var cur_validation = validate_data_arr[i]; 
	var obj = eval(frm+"['"+cur_validation[0]+"']"); 

	if ((obj == undefined ))continue;
	var additional_args = "";
	for(var j = 3 ; j < cur_validation.length;j++){ 
		additional_args += ","+cur_validation[j]; 
	} 
	additional_args +=")"; 
	var func_to_invoke = cur_validation[1]+'(obj'+additional_args; 
	var result =  eval(func_to_invoke);
	if(!result){ 
		if(errs.length==0) focusobj =obj; 
		errs +=cur_validation[2]+"\n"; 
	}
//	alert(result);
}
if(errs.length > 0){ 
	alert(errs); 
	if(focusobj.tab){
		showTab(focusobj['tab'])
	}
	if(focusobj && focusobj.type != undefined){ 
		focusobj.focus(); 
	}else if(focusobj.type == undefined) 
		focusobj[0].focus();
	return false; 
} 
return true; 
}


function myvalidate(frm){
	var val = validate(frm,validdata);
	return val;
}


function showTab (show) {
	if (! document.getElementById) { return true; }
	if (typeof(vartabs) != "undefined"){
		for(var i in vartabs){
			var div = document.getElementById(vartabs[i]);
			if(div) {
				div.style.display = ((vartabs[i] == show ) ? "block"  : "none" );
			}
		}
	}
	return true;
}


function isEmpty(obj){	//This function checks to see if value has been provided 
//	alert("in function isEmpty Name "+obj.name + "len  "+obj.length + "value   "+obj.value)
	if(!obj.value)	{ // This will trap most controls 
			// check if is a field with multiple controls ie  a radio button  or a check box 
			if(obj.length){ // Yes it is 
				for(var i = 0 ; i < obj.length ;i++){
					if(obj[i].checked) return true;
				}
			}
			return false;
	}
	return true;
}

function checkValidemail(obj){
	if(!obj.value){
		return true;
	}else{
	if(obj.value.search(/^\w+(\.\w+)*@\w+(\.\w+)*\.\w{2,3}$/) == -1) return false;
	return true;
	}
}

function checkEmail(obj){
	if(obj.value.search(/^\w+(\.\w+)*@\w+(\.\w+)*\.\w{2,3}$/) == -1) return false;
	return true;
}

function isDigit(obj){
	if(isNaN(obj.value) || !obj.value) return false;
	return true;
}

function song_count(obj){
	if(obj.value > 2 ) return false;
	return true;
}

function checkQuotes(obj){
	if(obj.value.search(/.*[\'\"]+.*/) == -1) return false;
	return true;
}




function checkLength(obj,min,max){ // This function checks that the length of the obj is between min and max 
	if(obj.value.length<min){return false;}
	else if(obj.value.length>max){	return false;	}
	else{    return true; }
}

function isAlphaNumeric(obj){
	if(obj.value.search(/$[a-zA-Z0-9]+/) != -1) return false;
	return true;
}

function isAlpha(obj){
	if(obj.value.search(/\w+/) == -1) return false;
	return true;
}

function isAlphaSpace(obj){
	if(obj.value.search(/$[a-zA-Z]+(\s+[a-zA-Z]*)*/) != -1) return false;
	return true;
}

function isChecked(obj){
	lflag=false;
	if(obj.length >1){
		for(i=0;i<obj.length;i++){
			if(obj[i].checked){
				lflag=true;
				break;
			}
		}
	}else{
		if(obj.checked){
			lflag = true;
		}
	}
	return lflag;
}

// JAVA Script Picked up from Web Calendar to hid and display divs
// The following code is used to support the small popups that
// give the full description of an event when the user move the
// mouse over it.
// Thanks to Klaus Knopper (www.knoppix.com) for this script.
// It has been modified to work with the existing WebCalendar
// architecture on 02/25/2005
//
// 03/05/2005 Prevent popup from going off screen by setting
// maximum width, which is cnfigurable
//
// Bubblehelp infoboxes, (C) 2002 Klaus Knopper <infobox@knopper.net>
// You can copy/modify and distribute this code under the conditions
// of the GNU GENERAL PUBLIC LICENSE Version 2.
//
var ns4            // Are we using Netscape4?
var ie4            // Are we using Internet Explorer Version 4?
var ie5            // Are we using Internet Explorer Version 5 and up?
var kon            // Are we using KDE Konqueror?
var x,y,winW,winH  // Current help position and main window size
var idiv=null      // Pointer to infodiv container
var px="px"        // position suffix with "px" in some cases
var popupW         // width of popup
var popupH         // height of popup
var xoffset = 8    // popup distance from cursor x coordinate
var yoffset = 12   // popup distance from cursor y coordinate
var followMe = 1   // allow popup to follow cursor...turn off for better performance
var maxwidth = 300 // maximum width of popup window

function nsfix(){setTimeout("window.onresize = rebrowse", 2000);}

function rebrowse(){window.location.reload();}

function infoinit(){
  ns4=(document.layers)?true:false, ie4=(document.all)?true:false;
  ie5=((ie4)&&((navigator.userAgent.indexOf('MSIE 5')>0)||(navigator.userAgent.indexOf('MSIE 6')>0)))?true:false;
  kon=(navigator.userAgent.indexOf('konqueror')>0)?true:false;
  x=0;y=0;winW=800;winH=600;
  idiv=null;
  if (followMe) {
    document.onmousemove = mousemove;
    if(ns4&&document.captureEvents) document.captureEvents(Event.MOUSEMOVE);
  }
  // Workaround for just another netscape bug: Fix browser confusion on resize
  // obviously conqueror has a similar problem :-(
  if(ns4||kon){ nsfix() }
  if(ns4) { px=""; }
}

function hide(name){
  idiv.visibility=ns4?"hide":"hidden";
  idiv=null;
}

function gettip(name){return (document.layers&&document.layers[name])?document.layers[name]:(document.all&&document.all[name]&&document.all[name].style)?document.all[name].style:document[name]?document[name]:(document.getElementById(name)?document.getElementById(name).style:0);}

function show(evt, name){
  if(idiv) hide(name);
  idiv=gettip(name);
  if(idiv){
   scrollX =0; scrollY=0;
   winW=(window.innerWidth)? window.innerWidth+window.pageXOffset-16:document.body.offsetWidth-20;
   winH=(window.innerHeight)?window.innerHeight+window.pageYOffset  :document.body.offsetHeight;
   scrollX=(typeof window.pageXOffset == "number")? window.pageXOffset:(document.documentElement && document.documentElement.scrollLeft)?document.documentElement.scrollLeft:(document.body && document.body.scrollLeft)?document.body.scrollLeft:window.scrollX;
   scrollY=(typeof window.pageYOffset == "number")? window.pageYOffset:(document.documentElement && document.documentElement.scrollTop)?document.documentElement.scrollTop:(document.body && document.body.scrollTop)?document.body.scrollTop:window.scrollY;
   popupW = document.getElementById(name).offsetWidth;
   popupH = document.getElementById(name).offsetHeight;

   showtip(evt);
  }
}

function showtip(e){
  e = e? e: window.event;
  if(idiv) {
    if(e)   {
      x=e.pageX?e.pageX:e.clientX?e.clientX + scrollX:0;
      y=e.pageY?e.pageY:e.clientY?e.clientY + scrollY:0;
    }
    else {
      x=0; y=0;
    }
    // MAke sure we don't go off screen
    if ( popupW > maxwidth ) {
      popupW = maxwidth;
      idiv.width = maxwidth + px;
    }
    idiv.left=(((x + popupW + xoffset)>winW)?x - popupW - xoffset:x + xoffset)+px;
    if ((popupH + yoffset)>winH) {
      idiv.top= yoffset + px;
    } else {
      idiv.top=(((y + popupH + yoffset)>winH)?winH - popupH - yoffset:y + yoffset)+px;
    }
    idiv.visibility=ns4?"show":"visible";
    }

}

function mousemove(e){
  showtip(e);
}
// Initialize after loading the page
window.onload=infoinit;

function show_div(item)
{
item=document.getElementById(item);
if (!item)
{
return;
}
if(item.style.display != "none"){
        item.style.display = "none";
        }else{
        item.style.display = ""
        }
}
function showthisTab(tab){

//		tab = document.getElementById(tab);
		for(i=1;i<4;i++){
			obj = document.getElementById(i);
			if(obj.style.display == 'block'){
				obj.style.display = 'none';
				break;
			}
		}
		obj = document.getElementById(tab);
		obj.style.display = 'block';
	
}

/*============================================================================*/

/*

This routine checks the credit card number. The following checks are made:

1. A number has been provided
2. The number is a right length for the card
3. The number has an appropriate prefix for the card
4. The number has a valid modulus 10 number check digit if required

If the validation fails an error is reported.

The structure of credit card formats was gleaned from a variety of sources on 
the web.

Parameters:
            cardnumber           number on the card
            cardname             name of card as defined in the card list below

Author:     John Gardner
Date:       1st November 2003
Updated:    26th Feb. 2005      Additional cards added by request

*/

/*
   If a credit card number is invalid, an error reason is loaded into the 
   global ccErrorNo variable. This can be be used to index into the global error  
   string array to report the reason to the user if required:
   
   e.g. if (!checkCreditCard (number, name) alert (ccErrors(ccErrorNo);
*/

var ccErrorNo = 0;
var ccErrors = new Array ()

ccErrors [0] = "Unknown card type";
ccErrors [1] = "No card number provided";
ccErrors [2] = "Credit card number is in invalid format";
ccErrors [3] = "Credit card number is invalid";
ccErrors [4] = "Credit card number has an inappropriate number of digits";

function checkCreditCard (cardnumber, cardname) {

     
  // Array to hold the permitted card characteristics
  var cards = new Array();

  // Define the cards we support. You may add addtional card types.
  
  //  Name:      As in the selection box of the form - must be same as user's
  //  Length:    List of possible valid lengths of the card number for the card
  //  prefixes:  List of possible prefixes for the card
  //  checkdigit Boolean to say whether there is a check digit
  
  cards [0] = {name: "Visa", 
               length: "13,16", 
               prefixes: "4",
               checkdigit: true};
  cards [1] = {name: "MasterCard", 
               length: "16", 
               prefixes: "51,52,53,54,55",
               checkdigit: true};
  cards [2] = {name: "DinersClub", 
               length: "14,", 
               prefixes: "300,301,302,303,304,305,36,38",
               checkdigit: true};
  cards [3] = {name: "CarteBlanche", 
               length: "14", 
               prefixes: "300,301,302,303,304,305,36,38",
               checkdigit: true};
  cards [4] = {name: "AmEx", 
               length: "15", 
               prefixes: "34,37",
               checkdigit: true};
  cards [5] = {name: "Discover", 
               length: "16", 
               prefixes: "6011",
               checkdigit: true};
  cards [6] = {name: "JCB", 
               length: "15,16", 
               prefixes: "3,1800,2131",
               checkdigit: true};
  cards [7] = {name: "Enroute", 
               length: "15", 
               prefixes: "2014,2149",
               checkdigit: true};
               
  // Establish card type
  var cardType = -1;
  for (var i=0; i<cards.length; i++) {

    // See if it is this card (ignoring the case of the string)
    if (cardname.toLowerCase () == cards[i].name.toLowerCase()) {
      cardType = i;
      break;
    }
  }
  
  // If card type not found, report an error
  if (cardType == -1) {
     ccErrorNo = 0;
     return false; 
  }
   
  // Ensure that the user has provided a credit card number
  if (cardnumber.length == 0)  {
     ccErrorNo = 1;
     return false; 
  }
  
  // Check that the number is numeric, although we do permit a space to occur  
  // every four digits. 
  var cardNo = cardnumber
  var cardexp = /^([0-9]{4})\s?([0-9]{4})\s?([0-9]{4})\s?([0-9]{1,4})$/;
  if (!cardexp.exec(cardNo))  {
     ccErrorNo = 2;
     return false; 
  }
    
  // Now remove any spaces from the credit card number
  cardexp.exec(cardNo);
  cardNo = RegExp.$1 + RegExp.$2 + RegExp.$3 + RegExp.$4;
       
  // Now check the modulus 10 check digit - if required
  if (cards[cardType].checkdigit) {
    var checksum = 0;                                  // running checksum total
    var mychar = "";                                   // next char to process
    var j = 1;                                         // takes value of 1 or 2
  
    // Process each digit one by one starting at the right
    var calc;
    for (i = cardNo.length - 1; i >= 0; i--) {
    
      // Extract the next digit and multiply by 1 or 2 on alternative digits.
      calc = Number(cardNo.charAt(i)) * j;
    
      // If the result is in two digits add 1 to the checksum total
      if (calc > 9) {
        checksum = checksum + 1;
        calc = calc - 10;
      }
    
      // Add the units element to the checksum total
      checksum = checksum + calc;
    
      // Switch the value of j
      if (j ==1) {j = 2} else {j = 1};
    } 
  
    // All done - if checksum is divisible by 10, it is a valid modulus 10.
    // If not, report an error.
    if (checksum % 10 != 0)  {
     ccErrorNo = 3;
     return false; 
    }
  }  

  // The following are the card-specific checks we undertake.
  var LengthValid = false;
  var PrefixValid = false; 
  var undefined; 

  // We use these for holding the valid lengths and prefixes of a card type
  var prefix = new Array ();
  var lengths = new Array ();
    
  // Load an array with the valid prefixes for this card
  prefix = cards[cardType].prefixes.split(",");
      
  // Now see if any of them match what we have in the card number
  for (i=0; i<prefix.length; i++) {
    var exp = new RegExp ("^" + prefix[i]);
    if (exp.test (cardNo)) PrefixValid = true;
  }
      
  // If it isn't a valid prefix there's no point at looking at the length
  if (!PrefixValid) {
     ccErrorNo = 3;
     return false; 
  }
    
  // See if the length is valid for this card
  lengths = cards[cardType].length.split(",");
  for (j=0; j<lengths.length; j++) {
    if (cardNo.length == lengths[j]) LengthValid = true;
  }
  
  // See if all is OK by seeing if the length was valid. We only check the 
  // length if all else was hunky dory.
  if (!LengthValid) {
     ccErrorNo = 4;
     return false; 
  };   
  
  // The credit card is in the required format.
  return true;
}


/*-----Following are functions to be used to implement RPC using javascript. ---------------------*/
/*-----Rather including such a big file to implement RPC, one can copy paste this. -----*/
function set_html(id,pid){
	obj = document.getElementById(id);
	if(pid == undefined) pid = id;
	pobj = parent.document.getElementById(pid);
	obj.innerHTML = pobj.innerHTML;
}



/*============================================================================*/

/*function getCookie(c_name)
{
if (document.cookie.length>0)
{ 
c_start=document.cookie.indexOf(c_name + "=");
if (c_start!=-1)
{ 
c_start=c_start + c_name.length+1 ;
c_end=document.cookie.indexOf(";",c_start);
if (c_end==-1) c_end=document.cookie.length
return unescape(document.cookie.substring(c_start,c_end));
} 
}
return null;
}

function setCookie(c_name,value,expiredays)
{
var exdate=new Date()
exdate.setDate(expiredays)
document.cookie=c_name+ "=" +value+
((expiredays==null) ? "" : "; expires="+exdate)
}
*/
