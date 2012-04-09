$(':text').focus(function() {
	$(this).css('background-color', 'yellow' );
});

$(':text').blur(function() {
	$(this).css('background-color', 'white' );
});