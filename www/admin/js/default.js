$(function() {
	$('html').removeClass('no-js');
	
	$('input, textarea, select').bind('change keypress', function() {
		$(this).closest('form')
			.find('input[type=submit]')
			.addClass('changed');
	});
	$('form').bind('submit', function() {
		$('<div id="overlay"></div>').hide().appendTo('body').fadeIn('fast');
		$(this).find('input[type=submit]')
			.removeClass('changed')
			.addClass('loading')
			.attr('disabled', 'disabled')
			.css({ 
				position:	'relative', 
				zIndex:		parseInt($('#overlay').css('zIndex'))+1
			});
	});	
});