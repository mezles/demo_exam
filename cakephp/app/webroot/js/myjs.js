(function($) {
	'use strict';
	
	$(function() {
		
		$('a#log_out').click(function() {
			if (confirm('Are you sure?')) {
				$('form#frmlogout').submit();
			} else {
				return false;
			}
			
		});
		
		$('input#change_pass').click(function() {
			if ($(this).is(':checked')) {
				$('div.pass-wrapper').show();
			} else {
				$('div.pass-wrapper').hide();
			}
		});
		
		/**
		 * Change user lists when changing user type
		 */
		$('select[name=usertype]').change(function() {
			$.ajax({
				url: ajax_url,
				type: 'POST',
				dataType: 'json',
				data: {
					'id' : parseInt( $(this).val() ),
					'action' : 'change_userlist'
				},
				beforeSend: function() {
				
				},
				success: function( response ) {
					var _user_list = '';
					$.each(response.users, function( index, value ) {
						_user_list += '<option value="' + value.id + '">' + value.username + '</option>';
					});
					
					$('select#username').html( _user_list );
				}
				
			});
		});
		
		
	});
})(jQuery);