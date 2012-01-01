/*
PVII Equal CSS Columns
------------------------------------------------
*/
function P7_colH(){ //v1.5 by PVII-www.projectseven.com
 var i,oh,hh,h=0,dA=document.p7eqc,an=document.p7eqa;if(dA&&dA.length){
 for(i=0;i<dA.length;i++){dA[i].style.height='auto';}for(i=0;i<dA.length;i++){
 oh=dA[i].offsetHeight;h=(oh>h)?oh:h;}for(i=0;i<dA.length;i++){if(an){
 dA[i].style.height=h+'px';}else{P7_eqA(dA[i].id,dA[i].offsetHeight,h);}}if(an){
 for(i=0;i<dA.length;i++){hh=dA[i].offsetHeight;if(hh>h){
 dA[i].style.height=(h-(hh-h))+'px';}}}else{document.p7eqa=1;}
 document.p7eqth=document.body.offsetHeight;
 document.p7eqtw=document.body.offsetWidth;}
}
function P7_eqT(){ //v1.5 by PVII-www.projectseven.com
 if(document.p7eqth!=document.body.offsetHeight||document.p7eqtw!=document.body.offsetWidth){
 P7_colH();}
}
function P7_equalCols(){ //v1.5 by PVII-www.projectseven.com
 if(document.getElementById){document.p7eqc=new Array;for(i=0;i<arguments.length;i++){
 document.p7eqc[i]=document.getElementById(arguments[i]);}setInterval("P7_eqT()",10);}
}
function P7_eqA(el,h,ht){ //v1.5 by PVII-www.projectseven.com; change inc=20 to inc=1200 - eliminates animation
 var sp=10,inc=1200,nh=h,g=document.getElementById(el),oh=g.offsetHeight,ch=parseInt(g.style.height);
 ch=(ch)?ch:h;var ad=oh-ch,adT=ht-ad;nh+=inc;nh=(nh>adT)?adT:nh;g.style.height=nh+'px';
 oh=g.offsetHeight;if(oh>ht){nh=(ht-(oh-ht));g.style.height=nh+'px';}
 if(nh<adT){setTimeout("P7_eqA('"+el+"',"+nh+","+ht+")",sp);}
}