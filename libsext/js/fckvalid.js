/** FCKEditor Validation for jQuery
*
* Validates FCKEditor Instances when a form is submitted, and on-the-fly to monitor changes if the form submission fails i.e. an FCKEditor is missing
* content.  It's a basic plugin, and has a few quirks:
* - IE issue with OnSelectionChange event doesn't always fire, this is down to FCKEditor
* - On-the-fly field monitoring not available until the form is submitted
* 
* @package fckEditorValidate
* @author Tim Carr
* @version 1.0
* 
*/
jQuery.fn.fckEditorValidate = function(settings,formId) {
	settings = 	jQuery.extend(
				{
					instanceName: 'content',
					preventFormSubmit: true,
					showValidationError: true,
					showValidationErrorBeforeFCKEditor: false,
					validationErrorClass: 'fckValidateError',
					validationErrorMessage: 'Please complete this field'
				}, 
				settings);
	
	// Check every form we submit
	
	var thisFormElement;
	if(typeof(formId)=='undefined'){
		var formId = 'form';
	}else{
		var formId = '#'+formId;
	}
	$(formId).bind("submit", function(e) {
		thisFormElement = $(this);
		// Check it's a valid instance of the FCKEditor
		if (typeof(FCKeditorAPI) != 'undefined') {
			if (typeof FCKeditorAPI.GetInstance(settings.instanceName) == 'object') {
				// Attach event	
				FCKeditorAPI.GetInstance(settings.instanceName).Events.AttachEvent( 'OnSelectionChange', CheckFCKEditor ) ;
				
				// Submit check	
				if (FCKeditorAPI.GetInstance(settings.instanceName).GetXHTML() == "") {
					// Show Error
					if (settings.showValidationError) {
						if ($("#"+settings.instanceName+"_error").length == 0) {
							if (settings.showValidationErrorBeforeFCKEditor) {
							
								// Show validation error message before the FCKEditor iframe
								$("#"+settings.instanceName+"___Frame", this).before("<label id=\""+settings.instanceName+"_error\" for=\""+settings.instanceName+"\" class=\""+settings.validationErrorClass+"\" style=\"display: block;\">"+settings.validationErrorMessage+"</label>");	
							} else {
								// Show validation error message after the FCKEditor iframe
								$("#"+settings.instanceName+"___Frame", this).after("<label id=\""+settings.instanceName+"_error\" for=\""+settings.instanceName+"\" class=\""+settings.validationErrorClass+"\" style=\"display: block;\">"+settings.validationErrorMessage+"</label>");	
							}
						}
					}					
					
					// Prevent the form from submitting
					if (settings.preventFormSubmit) {
						return false;
					}
				}
			} // Close Instance Check
		} // Close null Check
	});
	
	function CheckFCKEditor(editorInstance) {
		var contentHTML = editorInstance.GetXHTML();
		if (settings.showValidationError) {
			if (contentHTML == "") {
				// No content exists - show error message
				if ($("#"+settings.instanceName+"_error").length == 0) {
					if (settings.showValidationErrorBeforeFCKEditor) {
						// Show validation error message before the FCKEditor iframe
						$("#"+settings.instanceName+"___Frame", thisFormElement).before("<label id=\""+settings.instanceName+"_error\" for=\""+settings.instanceName+"\" class=\""+settings.validationErrorClass+"\" style=\"display: block;\">"+settings.validationErrorMessage+"</label>");
					} else {
						// Show validation error message after the FCKEditor iframe
						$(" #"+settings.instanceName+"___Frame", thisFormElement).after("<label id=\""+settings.instanceName+"_error\" for=\""+settings.instanceName+"\" class=\""+settings.validationErrorClass+"\" style=\"display: block;\">"+settings.validationErrorMessage+"</label>");
					}
				}
			} else {
				// Content exists - remove error message
				if ($("#"+settings.instanceName+"_error").length > 0) {					  
					$("#"+settings.instanceName+"_error").remove();
				}
			}
		}
	}
};
