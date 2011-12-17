<<<<<<< HEAD
function callreorder(tblid, handleclass, url, showDragHandle, dragClass, putContent) {
$(document).ready(function() {
    $("#"+tblid).tableDnD({
		onDragClass:dragClass,
		onDrop: function(table, row) {
			$.post(url+$.tableDnD.serialize(), function(res) {
				if (typeof(putContent)=="string") {
					$("#"+putContent).html(res); 
				}
			});
       	},
		dragHandle : handleclass
	});
	$("#"+tblid+" tr").hover(function() {
		var cel=$(this.cells[0]);
			if(cel.hasClass(handleclass)){
				$(this.cells[0]).addClass(showDragHandle);
			}else{
				return false;
			}
    	}, function() {
			$(this.cells[0]).removeClass(showDragHandle);
    });
});
}
=======
function callreorder(tblid, handleclass, url, showDragHandle, dragClass, putContent) {
$(document).ready(function() {
    $("#"+tblid).tableDnD({
		onDragClass:dragClass,
		onDrop: function(table, row) {
			$.post(url+$.tableDnD.serialize(), function(res) {
				if (typeof(putContent)=="string") {
					$("#"+putContent).html(res); 
				}
			});
       	},
		dragHandle : handleclass
	});
	$("#"+tblid+" tr").hover(function() {
		var cel=$(this.cells[0]);
			if(cel.hasClass(handleclass)){
				$(this.cells[0]).addClass(showDragHandle);
			}else{
				return false;
			}
    	}, function() {
			$(this.cells[0]).removeClass(showDragHandle);
    });
});
}
>>>>>>> 92a34e21bcd0e6ce28c090bc9e39740372d54833
