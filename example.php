<?php

	require_once 'skunk.php';

	$s = new Skunk();

	$s->get(
		'/hi(/<name>)',
		function ( &$s, $name = null ) {
			$s->body = 'Hello' . ( ( is_null( $name ) ) ? '' : " $name" ) . '!';
		}
	);

	$s->run();

