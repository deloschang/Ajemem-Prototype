jQuery(document).ready(function() { 

	$('#mainftp').uploadify({
  	'uploader'	: 'js/uploadify/uploadify.swf',
  	'script'    : 'js/uploadify/uploadify.php',
  	'multi'			: true,
  	'auto'			: true,
  	'height'		:	'32', //height of your browse button file
  	'width'			:	'250', //width of your browse button file
  	'sizeLimit'	:	'512000',  //remove this to set no limit on upload size
  	'simUploadLimit' : '3', //remove this to set no limit on simultaneous uploads
  	'buttonImg' : 'img/browse.png',
  	'cancelImg' : 'img/cancel.png',
		'folder'    : 'source_folder/', //folder to save uploads to
		onProgress: function() {
		  $('#loader').show();
		},
		onAllComplete: function() {
		  $('#loader').hide();
		  $('#allfiles').load(location.href+" #allfiles>*","");
		  //location.reload(); //uncomment this line if youw ant to refresh the whole page instead of just the #allfiles div
		}	
	});
	
	$('ul li:odd').addClass('odd');
 
 
}); 
