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
