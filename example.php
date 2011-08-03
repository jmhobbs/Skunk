<?php

	require_once 'skunk.php';

	$s = new Skunk();

	// Example of hook injection
	// Check your headers in firebug/inspector!
	$s->hook(
		'send_head', 
		function ( &$s ) { 
			$s->header( 'X-Stinky-By', 'Skunk' );
		}
	);

	$s->get(
		'/hi(/<name>)',
		function ( &$s, $name = null ) {
			$s->body = 'Hello' . ( ( is_null( $name ) ) ? '' : " $name" ) . '!';
		}
	);

	$s->run();

