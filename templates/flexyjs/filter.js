<<<<<<< HEAD
$(document).ready(function() {
	$('div.each_record').hover(function(){
	  $(this).addClass('hovered');
	}, function(){
	  $(this).removeClass('hovered');
	});
	//default each row to visible
	$('div.each_record').addClass('visible');
	
	//overrides CSS display:none property
	//so only users w/ JS will see the
	//filter box
	$('#search').show();
	
	$('#filter').keyup(function(event) {
		//if esc is pressed or nothing is entered
		if (event.keyCode == 27 || $(this).val() == '') {
			//if esc is pressed we want to clear the value of search box
			$(this).val('');

			//we want each row to be visible because if nothing
			//is entered then all rows are matched.
			$('div.each_record').removeClass('visible').show().addClass('visible');
		}

		//if there is text, lets filter
		else {
			filter('div.each_record', $(this).val());
		}

		//reapply zebra rows
/*		$('.visible td').removeClass('odd');
		zebraRows('.visible:even td', 'odd');
*/
	});

});
//filter results based on query
function filter(selector, query) {
	query	=	$.trim(query); //trim white space
	query = query.replace(/ /gi, '|'); //add OR for regex
	//alert(query);
	$(selector).each(function() {
		//alert($(this).text());
		//alert($(this).text().search(new RegExp(query, "i")));
		($(this).find(".filt_txt").text().search(new RegExp(query, "i")) < 0) ? $(this).hide().removeClass('visible') : $(this).show().addClass('visible');
	});
}
=======
$(document).ready(function() {
	$('div.each_record').hover(function(){
	  $(this).addClass('hovered');
	}, function(){
	  $(this).removeClass('hovered');
	});
	//default each row to visible
	$('div.each_record').addClass('visible');
	
	//overrides CSS display:none property
	//so only users w/ JS will see the
	//filter box
	$('#search').show();
	
	$('#filter').keyup(function(event) {
		//if esc is pressed or nothing is entered
		if (event.keyCode == 27 || $(this).val() == '') {
			//if esc is pressed we want to clear the value of search box
			$(this).val('');

			//we want each row to be visible because if nothing
			//is entered then all rows are matched.
			$('div.each_record').removeClass('visible').show().addClass('visible');
		}

		//if there is text, lets filter
		else {
			filter('div.each_record', $(this).val());
		}

		//reapply zebra rows
/*		$('.visible td').removeClass('odd');
		zebraRows('.visible:even td', 'odd');
*/
	});

});
//filter results based on query
function filter(selector, query) {
	query	=	$.trim(query); //trim white space
	query = query.replace(/ /gi, '|'); //add OR for regex
	//alert(query);
	$(selector).each(function() {
		//alert($(this).text());
		//alert($(this).text().search(new RegExp(query, "i")));
		($(this).find(".filt_txt").text().search(new RegExp(query, "i")) < 0) ? $(this).hide().removeClass('visible') : $(this).show().addClass('visible');
	});
}
>>>>>>> 92a34e21bcd0e6ce28c090bc9e39740372d54833
