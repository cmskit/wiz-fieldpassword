// show Error-Message
(function( $ ){
	$.fn.fieldpassword = function(){
		message('"'+this.attr('name')+'" must be an external Wizard!',1);
	};
})( jQuery );
