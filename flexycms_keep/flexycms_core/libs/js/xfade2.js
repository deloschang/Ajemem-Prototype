/*****

Image Cross Fade Redux
Version 1.0
Last revision: 02.15.2006
steve@slayeroffice.com

Please leave this notice intact. 

Rewrite of old code found here: http://slayeroffice.com/code/imageCrossFade/index.html


*****/

window.addEventListener?window.addEventListener("load",so_init,false):window.attachEvent("onload",so_init);

var d=document, imgs = new Array(), zInterval = null, current=0, pause=false;

function so_init() {
	if(!d.getElementById || !d.createElement)return;
	css = d.createElement("link");
	css.setAttribute("href","xfade2.css");
	css.setAttribute("rel","stylesheet");
	css.setAttribute("type","text/css");
	d.getElementsByTagName("head")[0].appendChild(css);
	imgs = d.getElementById("imageContainer").getElementsByTagName("span");
	for(i=1;i<imgs.length;i++) imgs[i].xOpacity = 0;
	imgs[0].style.display = "block";
	imgs[0].xOpacity = .99;
	setTimeout(so_xfade,1000);
}

function so_xfade() {
	imgs[current].style.display = "block";
	cOpacity = imgs[current].xOpacity;
	nIndex = imgs[current+1]?current+1:0;
	nOpacity = imgs[nIndex].xOpacity;
	
	cOpacity-=.05; 
	nOpacity+=.05;
	
	imgs[nIndex].style.display = "block";
	imgs[current].xOpacity = cOpacity;
	imgs[nIndex].xOpacity = nOpacity;
	imgs[nIndex].style.display = "none";
	
	setOpacity(imgs[current]); 
	imgs[current].style.display = "none";
	imgs[nIndex].style.display = "block";
	setOpacity(imgs[nIndex]);
	
	if(cOpacity<=0) {
		imgs[current].style.display = "none";
		current = nIndex;
		setTimeout(so_xfade,3000);
	} else {
		setTimeout(so_xfade,50);
	}
	
	function setOpacity(obj) {
		if(obj.xOpacity>.99) {
			obj.xOpacity = .99;
			return;
		}
		obj.style.opacity = obj.xOpacity;
		obj.style.MozOpacity = obj.xOpacity;
		obj.style.filter = "alpha(opacity=" + (obj.xOpacity*100) + ")";
	}
}

/*function mohso_xfade() {
	imgs[current].xOpacity -= .05;
	imgs[current].style.opacity = imgs[current].xOpacity;
	imgs[current].style.MozOpacity = imgs[current].xOpacity;
	if(imgs[current].xOpacity<=0) {
		imgs[current].xOpacity = .99;
		imgs[current].style.display = "none";
		current = imgs[current+1]?current+1:0;
		imgs[current].xOpacity = .99;
		imgs[current].style.display = "block";
		setTimeout(so_xfade,3000);
	} else {
		setTimeout(so_xfade,50);
	}
}*/