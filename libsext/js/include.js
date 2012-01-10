function autoclick(obj){
	if(obj.checked){
		getdiv();
	}else{
	
		getdivhide();
	}
}
function hideajaxdiv(div1, div2) {
	document.getElementById(div1).style.display="none";
	document.getElementById(div2).style.display="";
}
function service_div(obj){
	if(obj.checked){
		servicediv();
	}else{
		servicedivhide();
	}
}
function autoresponse(obj){
	if(obj.checked){
		getresponsediv();
	}else{
		getresponsedivhide();
	}
}
function noresponse(obj){
	if(obj.checked){
		gethideresponse();
	}else{
		getresponse();
	}
}

function acknowledgement(obj){
	if(obj.checked){
		getacknowledgement();
	}else{
		getacknowledgementhide();
	}
}
function closed(obj){
	obj1=document.getElementById('closed_div');
	obj1.style.display = 'block';
}
	

function myinbound(obj){
	obj3 = document.getElementById('inboundresponse');
	obj1 = document.getElementById('inbound1');
	obj2 = document.getElementById('inbound2');
	obj1.style.display = 'none';
	obj2.style.display = 'none';
	obj3.style.display = 'block';
	document.getElementById('bound').value = obj.name;
	if(obj.name=='outbound'){
		obj1 = document.getElementById('response_sent_status');
		obj2 = document.getElementById('receive_status');
		obj3 = document.getElementById('response_sent');
		obj4 = document.getElementById('guest_name');
		obj1.style.display = 'block';
		obj2.style.display = 'none';
		obj3.style.display = 'block';
		obj4.style.display = 'none';
	} else {
		obj1 = document.getElementById('response_sent_status');
		obj2 = document.getElementById('receive_status');
		obj3 = document.getElementById('response_sent');
		obj4 = document.getElementById('guest_name');
		obj1.style.display = 'none';
		obj3.style.display = 'none';
		obj2.style.display = 'block';
		obj4.style.display = 'block';
	}
}
function boundhide(obj){
	obj1 = document.getElementById('closed_div');
	obj3 = document.getElementById('inboundresponse');
	obj2=document.getElementById('inbound1');
	obj4=document.getElementById('inbound2');
	obj4.style.display = 'block';
	obj1.style.display = 'none';
	obj3.style.display = 'none';
	obj2.style.display = 'block';

}
function reason(obj){
	if(obj.checked){
		reasonhidediv1();
		reasondiv();
	} else {
		reasondivhide();
		reasondiv1();
	}
}
function reasondiv(){
	obj2 = document.getElementById('reason');
	obj2.style.display = 'block';
}
function reasondivhide(){
	obj2 = document.getElementById('reason');
	obj2.style.display = 'none';
}
function reasondiv1(){
	obj2 = document.getElementById('divreason');
	obj2.style.display = 'block';
}
function reasonhidediv1(){
	obj2 = document.getElementById('divreason');
	obj2.style.display = 'none';
}
function getacknowledgementhide(obj){
	obj3 = document.getElementById('div4');
	obj3.style.display = 'none';
}
function getacknowledgement(obj){
	obj3 = document.getElementById('div4');
	obj3.style.display = 'block';
}

function gethideresponse(obj){
	obj3 = document.getElementById('div3');
	obj3.style.display = 'none';
}
function getdivhide(){
	obj3 = document.getElementById('div1');
	obj3.style.display = 'none';
}
function getresponsedivhide(obj){
	obj3 = document.getElementById('div2');
	obj3.style.display = 'none';
}
function getdiv(){
	obj2 = document.getElementById('div1');
	obj2.style.display = 'block';
}
function servicediv(obj){
	obj2 = document.getElementById('service');
	obj2.style.display = 'block';
}
function servicedivhide(obj){
	obj2 = document.getElementById('service');
	obj2.style.display = 'none';
}

function getresponsediv(obj){
	obj3 = document.getElementById('div2');
	obj3.style.display = 'block';
}
function getresponse(obj){
	obj3 = document.getElementById('div3');
	obj3.style.display = 'block';
}
function validateform(obj){
	flag =  checkEmpty(obj.gname,'Enter Guest name');
	if(flag)
   		flag = checkEmail(obj.emailid,'Enter your email-id properly');
	if(flag)
		flag =  checkEmpty(obj.recdate,'pls Enter your Received date');
	if(flag)
   		flag = selectoption(obj.recd,'pls Enter record at',obj.recd.value);	
    if(flag)
   		flag = checkEmpty(obj.sline,'pls Enter Subject line');
	if(flag)
		flag = checkEmpty(document.getElementById('clsid'),'Onward class can not be blank');
	if(flag)
   		flag = check_reason();	
	if(flag)
   		flag = selectbox(obj);
	if(flag)
   		flag = checkEmpty(obj.Incoming_mail,'pls Enter Data in Body of incoming email');	
	if(flag)
   		flag = checkblank(obj.fdept1,obj.fdate1,obj.cdate1,obj.status_resp1,'Your first dept, date or status field is blank');
	if(flag)
   		flag = checkblank(obj.fdept2,obj.fdate2,obj.cdate2,obj.status_resp2,'Your second dept , date or status field is blank');
	if(flag)
   		flag = checkblank(obj.fdept3,obj.fdate3,obj.cdate3,obj.status_resp3,'Your third dept , date or status field is blank');
	if(flag)
   		flag = checkblank(obj.fdept4,obj.fdate4,obj.cdate4,obj.status_resp4,'Your fourth dept , date or status field is blank');
	if(flag)
   		flag = checkblank(obj.fdept5,obj.fdate5,obj.cdate5,obj.status_resp5,'Your fifth dept , date or status field is blank');		
  
if(flag)	
		flag = checkdate(obj.ackdate,obj.recdate,'Ack date always greater than or equal to flight date ');	
		
	if(flag)		
	flag = checkdate(obj.fdate1,obj.recdate,'first forward date always greater than  receive date ');
if(flag)	
	flag = checkdate(obj.fdate2,obj.recdate,'second forward date always greater than  receive date ');
if(flag)	
	flag = checkdate(obj.fdate3,obj.recdate,'Third forward date always greater than  receive date ');
if(flag)	
		flag = checkdate(obj.fdate4,obj.recdate,'Fourth forward date always greater than  receive date ');
	if(flag)	
		flag = checkdate(obj.fdate5,obj.recdate,'Fifth forward date always greater than  receive date ');		
if(flag)	
	flag = checkdate(obj.cdate1,obj.fdate1,'First REV date always greater than first forward date ');
if(flag)	
	flag = checkdate(obj.cdate2,obj.fdate2,'Second REV  date always greater than  secondforward date  ');
if(flag)	
	flag = checkdate(obj.cdate3,obj.fdate3,'Third REV date always greater than  Third forward date   ');
	if(flag)	
			flag = checkdate(obj.cdate4,obj.fdate4,'Fourth REV date always greater than  forward date ');
	if(flag)	
		flag = checkdate(obj.cdate5,obj.fdate5,'Fifth REV date always greater than   forward date ');
return flag;
}
function checkEmpty(obj,message){
        if(obj.value == ""){
                if(message){
                        alert(message);
                        obj.focus();
                }
                return false;
        }
        return true;
}
function  check_reason(){
	$reason=document.getElementById('check_reason').value;
	if($reason==''){
		alert("Plese Select Reason");
		document.getElementById('check_reason').focus();
		return false;
	} 
	return true;
}
function checkblank(obj,obj1,obj2,obj3,message){
	if (obj3[0].checked || obj3[1].checked) {
		obj3val = 1;
	} else {
		obj3val = 0;
	}
	if((obj.value == "" && obj1.value != "")|| (obj.value != ""&& obj1.value == "")||(obj1.value == ""&& obj2.value != "")||(obj.value == "" && obj3val == 1)||(obj.value != "" && obj3val == 0)){
		alert(message);
		return false ;
	} else {    
		return true;
	}
}
function checkdate(obj,obj1,message){
     var date1 = obj.value;
	 var date2=obj1.value;
	 var dt1 = date1.split("-");
	 var dt2 = date2.split("-");
	 var laterdate = new Date(dt1[2]  , dt1[1]-1, dt1[0]);   
     var earlierdate = new Date(dt2[2] ,  dt2[1]-1, dt2[0]);
	 var laterdate = new Date(laterdate);   
     var earlierdate = new Date(earlierdate);
  if (earlierdate > laterdate){
     alert(message);
	 return false ;
	     } else {  
        return true;
	}
}
function selectbox(obj){
if ( !obj.selectcheckbox0.checked && 
     !obj.selectcheckbox1.checked && 
     !obj.selectcheckbox2.checked && 
	  !obj.selectcheckbox3.checked && 
	 !obj.selectcheckbox4.checked	 ) 
{
 	alert("Pleaseselect the checkbox."); 
	return false;
}
        
        return true;
}

function checkEmail(obj,message){
	if(obj.value.search(/^\w+([\-.]\w+)*@\w+([\-.]\w+)*\./) == -1){
		if(message){
			alert(message);
			obj.focus();
		}
		return false;
	} 
	return true;
}

function selectoption(obj,message,value){
	if(value==0 && obj.selectedIndex==0) {
		alert(message);
		obj.focus();
		return false;
	}
	return true;
}

function check_length(my_form){
	maxLen = 2048; 
	if (my_form.Incoming_mail.value.length >= maxLen) {
		var msg = "You have reached your maximum limit of characters allowed";
		alert(msg);
		my_form.incoming_mail.value = my_form.Incoming_mail.value.substring(0, maxLen);
	} else { 
		my_form.Incoming_num.value = maxLen - my_form.Incoming_mail.value.length;
		}
}
function check_length_mail(my_form){
	maxLen = 2048; 
	if (my_form.Comeback_mail.value.length >= maxLen) {
		var msg = "You have reached your maximum limit of characters allowed";
		alert(msg);
		my_form.Comeback_mail.value = my_form.Comeback_mail.value.substring(0, maxLen);
	} else { 
		my_form.Comeback_num.value = maxLen - my_form.Comeback_mail.value.length;
		}
}

function xx(obj) {
	document.getElementById('reporttype').value="";
	var si = obj.selectedIndex;
	if(obj.options[si].text=='Feedback Form') {
		obj3 = document.getElementById('feedbackforms');
		obj3.style.display = 'block';
		document.getElementById('reporttype').value="reportby2";
	} else {
		obj3 = document.getElementById('feedbackforms');
		obj3.style.display = 'none';
	}
	if(obj.options[si].text=='Incident Report') {
		obj3 = document.getElementById('incident');
		obj3.style.display = 'block';
		document.getElementById('reporttype').value="reportby";
		return false;
	} else {
		obj3 = document.getElementById('incident');
		obj3.style.display = 'none';
		return true;
	}
}	
function cc(obj) {
	var si = obj.selectedIndex;
	if(obj.options[si].text=='Call Centre-ITS') {
		obj3 = document.getElementById('call_center');
		obj3.style.display = 'block';
		document.getElementById('reporttype').value="reportby1";
		return false;
	} else {
		obj3 = document.getElementById('call_center');
		obj3.style.display = 'none';
		return true;
	}
}
function changestatus(obj) {
	obj3 = document.getElementById('field');
	if(obj.value=='comeback'){
		obj3.style.display = 'block';
	} else {
		obj3.style.display = 'none';
	}
}
function updateform(obj){

   		flag = checkblank(obj.fdept1,obj.fdate1,obj.cdate1,obj.status_resp1,'Your first dept, date or status field is blank');
	if(flag)	
		flag = checkdate(obj.ackdate,obj.edit_rec,'Ack date always greater than or equal to flight date ');		
	if(flag)
   		flag = checkblank(obj.fdept2,obj.fdate2,obj.cdate2,obj.status_resp2,'Your second dept , date or status field is blank');
	if(flag)
   		flag = checkblank(obj.fdept3,obj.fdate3,obj.cdate3,obj.status_resp3,'Your third dept , date or status field is blank');
	if(flag)
   		flag = checkblank(obj.fdept4,obj.fdate4,obj.cdate4,obj.status_resp4,'Your Fourth dept , date or status field is blank');
	if(flag)
   		flag = checkblank(obj.fdept5,obj.fdate5,obj.cdate5,obj.status_resp5,'Your Fifth dept , date or status field is blank');	
	if(flag)		
	flag = checkdate(obj.fdate1,obj.edit_rec,'first forward date always greater than  receive date ');
if(flag)	
	flag = checkdate(obj.fdate2,obj.edit_rec,'second forward date always greater than  receive date ');
if(flag)	
	flag = checkdate(obj.fdate3,obj.edit_rec,'Third forward date always greater than  receive date ');
if(flag)	
		flag = checkdate(obj.fdate4,obj.edit_rec,'Fourth forward date always greater than  receive date ');
	if(flag)	
		flag = checkdate(obj.fdate5,obj.edit_rec,'Fifth forward date always greater than  receive date ');	

if(flag)
	if(obj.fwddate1.value!="00-00-0000"){	
		flag = checkdate(obj.cdate1,obj.fwddate1,'First REV date always greater than  forward date ');
	} else {
		flag = checkdate(obj.cdate1,obj.fdate1,'First REV date always greater than  forward date ');
	}	
	
if(flag)
  if(obj.fwddate2.value!="00-00-0000"){
  	flag = checkdate(obj.cdate2,obj.fwddate2,'Second REV  date always greater than  forward date ');
} else {
	 flag = checkdate(obj.cdate2,obj.fdate2,'Second REV  date always greater than  forward date ');
}	
if(flag)
	if(obj.fwddate3.value!="00-00-0000"){
		flag = checkdate(obj.cdate3,obj.fwddate3,'Third REV date always greater than  forward date ');
	} else {
		flag = checkdate(obj.cdate3,obj.fdate3,'Third REV date always greater than  forward date ');
	}	
	if(flag)
		if(obj.fwddate4.value!="00-00-0000"){
			flag = checkdate(obj.cdate4,obj.fwddate4,'Fourth REV date always greater than  forward date ');
		} else {
			flag = checkdate(obj.cdate4,obj.fdate4,'Fourth REV date always greater than  forward date ');
		}
	if(flag)
	if(obj.fwddate5.value!="00-00-0000"){
		flag = checkdate(obj.cdate5,obj.fwddate5,'Fifth REV date always greater than  forward date ');
	} else {
		flag = checkdate(obj.cdate5,obj.fdate5,'Fifth REV date always greater than  forward date ');
	}

	return flag;	
}
function validate(obj){
 	flag = checkdate(obj.responsedate,obj.responsedate_dup,'Reponse date always greater than or equal to Email received date ');
	if(flag)
 		flag = selectoption(obj.mode,'pls Enter your mode',obj.mode.value);
	if(obj.boundfield.value=='inbound')	{
		if(flag)
			flag = checkradiobutton(obj.status_resp[0],obj.status_resp[1],'you have to choose a Status');
	}	
return flag;
}	
function test(){
document.guest.guest_dup.value = document.guest.gname.value ;
}
////////////////////////////////////////////////////////////////////////////////////////////
function  checkradiobutton(obj,obj1,message){
	if (!obj.checked && !obj1.checked){ 
			alert(message);
			return false;
	}
	return true;
} 

function validateclose(obj){
	 var date2 = document.close_response.hidden_close_date.value;
	 var date1= document.close_response.close_date.value;
	 var dt1 = date1.split("-");
	 var dt2 = date2.split("-");
	 var laterdate = new Date(dt1[2]  , dt1[1]-1 , dt1[0]);   
     var earlierdate = new Date(dt2[2] ,  dt2[1]-1, dt2[0]);
	 var laterdate = new Date(laterdate);   
     var earlierdate = new Date(earlierdate);
	 
if(laterdate<=earlierdate){
	alert("Date should be greater than Email receive date");
	return false;
	} else {
	return true;
	} 
}	
//function showack() {
//	if (document.getElementById('ack_date').value=="") {
//		alert("Please enter the Acknoledgement Date");
//		document.getElementById('ack_date').focus();
//		return false;
//	}
//}

///////////////////////////////////////////////////////////////////////////////////////////
function copyToList(from,to){
	
  fromList = document.getElementById(from);
  toList = document.getElementById(to);
  var sel = false;
  for (i=0;i<fromList.options.length;i++)
  {
    var current = fromList.options[i];
    if (current.selected)
    {
      sel = true;
      toList.options[toList.length] = new Option(current.text,current.value);
      fromList.options[i] = null;
      i--;
    }
  }
  if (!sel) alert ('You haven\'t selected any options!');
}
function allSelect()
{
	List = document.getElementById('check_reason');
	//if(List.length<1) {
//		alert("You have nt selected any option");
//		return false;
//	}
	for (i=0;i<List.length;i++)
	{
		List.options[i].selected = true;
	}
}
