<?php

	class Skunk {

		public $body = '';

		protected $headers = array();

		protected $get = array();
		protected $post = array();

		public function get ( $route, $fn ) {
			$this->get[$route] = $fn;
		}

		public function post ( $route, $fn ) {
			$this->post[$route] = $fn;
		}

		public function run () {

			if( ! isset( $_REQUEST['uri'] ) ) {
				$this->HTTP_404();
			}
			else {
				if( isset( $_POST ) ) {
					$this->match_route( $this->get, $_REQUEST['uri'] );
				}
				else {
					$this->match_route( $this->post, $_REQUEST['uri'] );
				}
			}

			$this->send_head();
			$this->send_body();
			exit();
		}

		// TODO: More HTTP codes

		public function HTTP_404 ( $error = 'Not Found' ) {
			$this->header( "HTTP/1.0",  "404 $error" );
			$this->header( "Status", "404 $error" );
			$this->body = $this->template( $this->_html, array( 'title' => "404 - $error", 'body' => $error ) );
		}

		/**
			TODO: Even better than this. is_callable, arrays, etc.  Embed mustache?
		**/
		public function template ( $template, $params ) {
			foreach( $params as $param => $value ) {
				$template = str_replace( "{{{$param}}}", $value, $template );
			}

			return $template;
		}

		// TODO: This route system sucks.
		protected function match_route ( $routes, $uri ) {

			foreach( $routes as $route => $fn ) {
				if( false != preg_match( "#$route#", $uri, $matches ) ) {
					// We can't use call_user_func_array because it doesn't respect call by ref.
					switch( count( $matches ) ) {
						case 1:
							call_user_func( $fn, &$this );
							break;
						case 2:
							call_user_func( $fn, &$this, $matches[1] );
							break;
						case 3:
							call_user_func( $fn, &$this, $matches[1], $matches[2] );
							break;
						case 4:
							call_user_func( $fn, &$this, $matches[1], $matches[2], $matches[3] );
							break;
						case 5:
							call_user_func( $fn, &$this, $matches[1], $matches[2], $matches[3], $matches[4] );
							break;
						case 6:
							call_user_func( $fn, &$this, $matches[1], $matches[2], $matches[3], $matches[4], $matches[5] );
							break;
						case 7:
							call_user_func( $fn, &$this, $matches[1], $matches[2], $matches[3], $matches[4], $matches[5], $matches[6] );
							break;
						default:
							// We can only do so much...
					}
				}
			}

		}

		protected function header ( $key, $value ) {
			$this->headers[$key] = $value;
		}

		protected function send_head () {
			foreach( $this->headers as $key => $value ) {
				header( "$key: $value" );
			}
		}

		protected function send_body () {
			die( $this->body );
		}

		protected $_html = <<<EOF
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head profile="http://purl.org/NET/erdf/profile">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>Skunk - {{title}}</title>
		<style type="text/css" media="all">
		</style>
	</head>
	<body>
		<h1>{{title}}</h1>
		{{body}}
	</body>
</html>
EOF;

	}