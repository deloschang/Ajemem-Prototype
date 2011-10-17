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
				//alert(url+$.tableDnD.serialize());
				$("tr:odd").removeClass();
				$("tr:even").removeClass(); 
				$("tr:odd").addClass('odd list_menu'); 
				$("tr:even").addClass('even list_menu');
			},
			dragHandle : handleclass
		});
		$("#"+tblid+" td").hover(function() {
			var cel=$(this);
			if(cel.hasClass(handleclass)){
				$(this).addClass(showDragHandle);
			}else{
				return false;
			}
	 	}, function(){
			$(this).removeClass(showDragHandle);
		});
	});
}
