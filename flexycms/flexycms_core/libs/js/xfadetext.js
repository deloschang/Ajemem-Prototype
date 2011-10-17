window.addEventListener?window.addEventListener("load",show_init,false):window.attachEvent("onload",show_init);

var d1=document, text = new Array(), tcurrent=0, pause=false;

function show_init() {
	if(!d1.getElementById || !d1.createElement)return;
	css = d1.createElement("link");
	css.setAttribute("href","xfade2.css");
	css.setAttribute("rel","stylesheet");
	css.setAttribute("type","text/css");
	d1.getElementsByTagName("head")[0].appendChild(css);
	text = d1.getElementById("textContainer").getElementsByTagName("span");
	for(i=1;i<text.length;i++) {
		text[i].xOpacity = 0;
	}
	text[0].style.display = "block";
	text[0].xOpacity = .99;
	setTimeout(show_xfade,1000);
}

function show_xfade() {
	text[tcurrent].xOpacity -= .05;
	text[tcurrent].style.opacity = text[tcurrent].xOpacity;
	text[tcurrent].style.MozOpacity = text[tcurrent].xOpacity;
	if(text[tcurrent].xOpacity<=0) {
		text[tcurrent].xOpacity = .99;
		text[tcurrent].style.display = "none";
		tcurrent = text[tcurrent+1]?tcurrent+1:0;
		text[tcurrent].xOpacity = .99;
		text[tcurrent].style.display = "block";
		setTimeout(show_xfade,3000);
	} else {
		setTimeout(show_xfade,50);
	}
}