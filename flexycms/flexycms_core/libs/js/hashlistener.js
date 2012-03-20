
var hashListener = {
	ie:		/MSIE/.test(navigator.userAgent),
	ieSupportBack:	true,
	hash:	document.location.hash,
	check:	function () {
		var h = document.location.hash;
		if (h != this.hash) {
			this.hash = h;
			this.onHashChanged();
		}
	},
	init:	function () {
		// for IE we need the iframe state trick
		if (this.ie && this.ieSupportBack) {
			var frame = document.createElement("iframe");
			frame.id = "state-frame";
			frame.style.display = "none";
			document.body.appendChild(frame);
			this.writeFrame("");
		}
		var self = this;
		// IE
		if ("onpropertychange" in document && "attachEvent" in document) {
			document.attachEvent("onpropertychange", function () {
				if (event.propertyName == "location") {
					self.check();
				}
			});
		}
		// poll for changes of the hash
		window.setInterval(function () { self.check() }, 50);
	},
	setHash: function (s) {
		// Mozilla always adds an entry to the history
		if (this.ie && this.ieSupportBack) {
			this.writeFrame(s);
		}
		document.location.hash = s;
	},
	getHash: function () {
		return document.location.hash;
	},
	writeFrame:	function (s) {
		var f = document.getElementById("state-frame");
		var d = f.contentDocument || f.contentWindow.document;
		d.open();
		d.write("<script>window._hash = '" + s + "'; window.onload = parent.hashListener.syncHash;<\/script>");
		d.close();
	},
	syncHash:	function () {
		var s = this._hash;
		if (s != document.location.hash) {
			document.location.hash = s;
		}
	},
	onHashChanged:	function () {},

	print: function (s) {
		s=s.substring(1);
		if(s){
			eval(s);
		}
	}

};

hashListener.init();
