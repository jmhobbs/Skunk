<?php

	require_once 'skunk.php';

	$s = new Skunk();

	$s->get(
		'/hi(/?(.*)?)',
		function ( &$s, $name = null ) {
			if( is_null( $name ) ) {
				$s->body = 'Hello!';
			}
			else {
				$s->body = "Hello " . substr( $name, 1 ) . "!";
			}
		}
	);

	$s->run();