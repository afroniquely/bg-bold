<?php

//* Add signup blurb after entry
add_action( 'genesis_entry_content', 'bg_signup_blurb', 10 );
function bg_signup_blurb() {

	genesis_widget_area( 'newsletter-signup', array(
		'before' => '<div class="newsletter-signup">',
		'after'  => '</div>',
	) );
}

//* Run the Genesis loop
genesis();
