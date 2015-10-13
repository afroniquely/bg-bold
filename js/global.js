jQuery(function( $ ){

	$(".nav-primary .genesis-nav-menu").addClass("responsive-menu").before('<div class="responsive-menu-icon"></div>');

	$(".responsive-menu-icon").click(function(){
		$(this).next(".nav-primary .genesis-nav-menu").slideToggle();
	});

	$(window).resize(function(){
		if(window.innerWidth > 768) {
			$(".nav-primary .genesis-nav-menu").removeAttr("style");
			$(".responsive-menu > .menu-item").removeClass("menu-open");
		}
	});

var placeholder = $( '.site-header .search-form input[type="search"]' ).attr('placeholder');

	$( '.site-header .search-form input[type="search"]' ).on( 'focusin', function() {
		$(this).attr('placeholder', '');
	});

	$( '.site-header .search-form input[type="search"]' ).on( 'focusout', function() {
		$(this).attr('placeholder', placeholder);
	});

});
