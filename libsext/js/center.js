<<<<<<< HEAD
window.onload = function () 
{
	var r;
	var c;
	var p;
	var o;
	for (r = 1;;r++) {
		p = document.getElementById('row_'+r);
		if (p) {
			for (c = 1;; c++) {
				o = document.getElementById('row_'+r+'_sep_'+c);
				if (o) {
					o.style.height = parseInt(p.offsetHeight * 0.95) + "px";
				} else {
					break;
				}
			}
			for (c = 1;; c++) {
				o = document.getElementById('row_'+r+'_col_'+c);
				if (o) {
					o.style.top = (p.offsetHeight / 2) - (o.offsetHeight / 2) + "px";
				} else {
					break;
				}
			}
		} else {
			break;
		}
	}
}
=======
window.onload = function () 
{
	var r;
	var c;
	var p;
	var o;
	for (r = 1;;r++) {
		p = document.getElementById('row_'+r);
		if (p) {
			for (c = 1;; c++) {
				o = document.getElementById('row_'+r+'_sep_'+c);
				if (o) {
					o.style.height = parseInt(p.offsetHeight * 0.95) + "px";
				} else {
					break;
				}
			}
			for (c = 1;; c++) {
				o = document.getElementById('row_'+r+'_col_'+c);
				if (o) {
					o.style.top = (p.offsetHeight / 2) - (o.offsetHeight / 2) + "px";
				} else {
					break;
				}
			}
		} else {
			break;
		}
	}
}
>>>>>>> 92a34e21bcd0e6ce28c090bc9e39740372d54833
