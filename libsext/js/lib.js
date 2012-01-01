// This contains Java Script functions other than those used for data validation in the generated common.js file 



/*
* This function can be called on a button to redirect to the same file with changed arguments 
* or to a different file but in the same directory with some arguments .
*
*
*/

function go_to_url(args,url){

if(!url){
	window.document.location.search=""
	window.document.location.search = args
	//alert(window.document.location.search)
}else{
	window.location.href= url+'?'+args
}


}

function show_id(id){
	var obj = document.getElementById(id)
	if(obj.style.display)
		obj.style.display='';
	else
		obj.style.display='none';
}



function setradiobutton(frm_name, fld,value){
	var control_str = "document.forms["+frm_name+"]['"+fld+"'] ";
		//alert (control_str)
	var control = eval(control_str)
		//alert(control)
	for(var i = 0 ; i < control.length ; i++){
		//alert(control[i].value)
		if(control[i].value == value) {
			control[i].checked = true
			break;
		}
}
}



function getradiobuttonvalue(frm_name,fld){
	var control_str = "document.forms['"+frm_name+"']['"+fld+"'] ";
		//alert (control_str)
	var control = eval(control_str)
		//alert(control)
	for(var i = 0 ; i < control.length ; i++){
		//alert(control[i].value)
		if(control[i].checked == true) {
			return control[i].value
			break;
		}
}
}

function getradiobuttonobject(frm_name,fld){
	var control_str = "document.forms['"+frm_name+"']['"+fld+"'] ";
		//alert (control_str)
	var control = eval(control_str)
		//alert(control)
	for(var i = 0 ; i < control.length ; i++){
		//alert(control[i].value)
		if(control[i].checked == true) {
			return control[i] ;
			break;
		}
}
}


function link_list_mgr(frmName,prefix){
	this.frmName = frmName
	this.prefix = prefix
	this.fields_processed = new Array()
	this.fields = new Array()
	this.resetlist = link_list_mgr_resetlist
	this.setlist = link_list_mgr_setlist
	this.add_fields = link_list_mgr_add_fields
	this.update = link_list_mgr_update
	this.setselected = link_list_mgr_setselected
	this.simple_reset = simple_reset
}


/*

Updates the next filed in the list . Depends on the order in which the fields have been added .
And then call the same function with next field name and truncated list of fields to propagate the change
across all the downstream variables.


*/

function link_list_mgr_update(fld){
// get the current value 
var cur_select_str = "document."+this.frmName+"['"+this.prefix+"["+fld+"]']" 
var cur_select = eval(cur_select_str)
var cur_value = cur_select.value
//alert(" Come to update "+fld )
//strip the current field from the list 
var fld_list = new Array()
var set_list = new Array()
var add_fld = false
for(var i in this.fields){
	if(this.fields[i] == fld){
			add_fld = true; 
			
	}
	if(this.fields[i] != fld){
	if(add_fld){
			fld_list[fld_list.length] = this.fields[i]
		}else{
			set_list[set_list.length] = this.fields[i]
		}
		}
}
//alert(" have to filter and set down stream "+fld_list)
//alert(" have to filter and  set up stream "+set_list)

var parent_fld = fld
if(fld_list.length>0){
	for(var j in fld_list){
		//alert(fld_list[j])
		if(!cur_value){this.resetlist(fld_list[j]); continue;}
		var cur_map_str = parent_fld+"['"+cur_value+"']['"+fld_list[j]+"']"  
		//alert(cur_map_str)
		var cur_map = eval(cur_map_str)
		//alert(cur_map)
		cur_value = this.setlist(fld_list[j], cur_map)
		parent_fld = fld_list[j]
	}

 }
if(set_list.length > 0 ){
for(var k = set_list.length-1 ; k >=0 ; k--){
	//alert(set_list[k]+ "kjhahas")
}

}
}







/*
Sets up the new list of values for the given field fld , while 
ensuring that the earlier selected value stays selected 



*/

function link_list_mgr_setlist(fld,values,cur_value){
	if(!cur_value){
		var cur_select_str = "document."+this.frmName+"['"+this.prefix+"["+fld+"]']" 
		var cur_select = eval(cur_select_str)
		cur_value= cur_select.value
	}
	//alert("Setting values for "+fld + " Cur value is " + cur_value)

	//alert(cur_select.options.length )
	for(var i = 0 , len=cur_select.options.length; i < len  ; i++){
		cur_select.options[0] = null;
	}
	listvals = eval(fld)
	//alert(listvals)
	if(values.length != 1){
		cur_select.options.add(new Option("Select ",''));
	}
	
	for(i in values ){
	    var selected_str = (cur_value == values[i]) ? true : false  
		cur_select.options.add(new Option(listvals[values[i]],values[i],'',selected_str))
	}
	if(values.length == 1){
		cur_value = cur_select.options[0].value
		cur_select.options[0].selected = true
		cur_select.onchange()

	}

	return cur_value;

}

/*
rests the values of the cur_fld if given or else all the fields to the full set of legal values for that field


*/



function link_list_mgr_resetlist(cur_fld){
	var fld_list,listvals  ;
	if(cur_fld){
		for(var i=0 ; i < this.fields.length ;i++){
			if(this.fields[i] == cur_fld ){
				fld_list = new Array(this.fields[i]);
				break
			}
		}
		
	}else{
		fld_list = this.fields
	}
	for( i=0 ; i < fld_list.length ;i++){
		var cur_select_str = "document."+this.frmName+"['"+this.prefix+"["+fld_list[i]+"]']" 
		//alert(cur_select_str)
		var cur_select = eval(cur_select_str)
			for(var j = 0 , len=cur_select.options.length; j < len  ; j++){
			cur_select.options[0] = null;
		}
		//alert(fld_list[i])
		listvals = eval(fld_list[i])
		//alert(listvals)
		cur_select.options.add(new Option("Select ",''));

		for(var k in listvals ){
			cur_select.options.add(new Option(listvals[k],k));
		}
	}
}

function link_list_mgr_add_fields(fld,listvar){
	this.fields[this.fields.length] = fld
}


function link_list_mgr_setselected(fld,value){
		var cur_select_str = "document."+this.frmName+"['"+this.prefix+"["+fld+"]']" 
	//	alert(cur_select_str)	
		var cur_select = eval(cur_select_str)

		for(var j = 0 , len=cur_select.options.length; j < len  ; j++){
			if(cur_select.options[j].value == value){
				cur_select.options[j].selected = true;
				break
			}
		}


}



function simple_reset(fld){
		var cur_select_str = "document."+this.frmName+"['"+this.prefix+"["+fld+"]']" 
		var cur_select = eval(cur_select_str)
			for(var j = 0 , len=cur_select.options.length; j < len  ; j++){
			cur_select.options[0] = null;
		}
		//alert(fld_list[i])
		listvals = eval(fld)
		//alert(listvals)
		cur_select.options.add(new Option("Select ",''));

		for(var k in listvals ){
			cur_select.options.add(new Option(listvals[k],k));
		}


}


/* 
Functions to set checkboxes needs to be refined a whole lot more :-(

*/

function set_id_tags(variable, control){
var values_str = variable+"["+control.value+"]['id_tags']"
var values = eval(values_str);
setcheckboxes('add_new[id_tags][]',values)

}


function set_id_template(variable, control){
var values_str = variable+"["+control.value+"]['id_template']"
var values = eval(values_str);
setselectoptions('add_new[id_template]',values)

}

function setselectoptions(control_fld,values){
	var control_str = "document.forms[0]['"+control_fld+"']"
	//alert(control_str)
	var control = eval(control_str)
	for(var i = 0 ; i < control.options.length; i++){
			control.options[i].selected = false;
		 }
	for(var i = 0 ; i < control.options.length; i++){
		for(var j in values){
			 if(control.options[i].value == values[j]){
				control.options[i].selected = true;
				break;
			}
		}
	}


}

function setcheckboxes(control_fld,values){
	var control_str = "document.forms[0]['"+control_fld+"']"
	//alert(control_str)
	var control = eval(control_str)
	//alert(control)
	for(var i = 0 ; i < control.length; i++){
			control[i].checked = false;
		 }
	for(var i = 0 ; i < control.length; i++){
		for(var j in values){
			 if(control[i].value == values[j]){
				control[i].checked = true;
				break;
			}
		}
	}

}


function setradiobutton(fld,value){
	var control_str = "document.forms[0]['"+fld+"'] ";
		//alert (control_str)
	var control = eval(control_str)
		//alert(control)
	for(var i = 0 ; i < control.length ; i++){
		//alert(control[i].value)
		if(control[i].value == value) {
			control[i].checked = true
			break;
		}
}
}

// Function to toggle the switching of check boxes 
// Usage onclick=check(this.form.elements['add_new[attachments][main][]'],'main')
// The first argument has to evaluate to a valid from element or nodelist . The second argument is optional
// Requred if the same function is being called more than one in the same form and should be a unique identifier for that set of check boxes

var check_flag_global_arr = new Array

function check(field,tag) {
		if(tag == undefined) tag = "GENERIC"
		if(check_flag_global_arr[tag] == undefined){
			check_flag_global_arr[tag] = false
		}
		checkflag = check_flag_global_arr[tag]
	if (checkflag == false) {
		if(field.length){
			for (i = 0; i < field.length; i++) {
				field[i].checked = true;
			}
		}else{
			field.checked = true;
		}
		check_flag_global_arr[tag] = true;
		return "Uncheck All"; 
	}else{
		if(field.length){
			for (i = 0; i < field.length; i++) {
				field[i].checked = false; 
			}	
		}else{
			field.checked = false;
		}
		check_flag_global_arr[tag] = false;
		return "Check All"; }
}

//var checkflag = "false";
//
//function check(field) {
//	alert("Hello");
//	if (checkflag == "false") {
//		if(field.length){
//			for (i = 0; i < field.length; i++) {
//				field[i].checked = true;
//			}
//		}else{
//			field.checked = true;
//		}
//		checkflag = "true";
//		return "Uncheck All"; 
//	}else{
//		if(field.length){
//			for (i = 0; i < field.length; i++) {
//				field[i].checked = false; 
//			}	
//		}else{
//			field.checked = false;
//		}
//		checkflag = "false";
//		return "Check All"; }
//}


function submitform(ch,val){	
	document.forms[0].eval(ch).value=val;
	document.forms[0].submit();
}
