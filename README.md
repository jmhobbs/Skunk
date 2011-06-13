# What's Skunk?

Skunk is the stinky PHP framework!

It's a silly little framework I put together for fun.  It's targeted to PHP 5.3+, since it's meant to use [lambda functions](http://php.net/manual/en/functions.anonymous.php).

# Usage

    // Initialize
    $s = new Skunk();
    
    // Add a route
    $s->get(
      '/hi(/<name>)',
      function ( &$s, $name = null ) {
        $s->body = 'Hello' . ( ( is_null( $name ) ) ? '' : " $name" ) . '!';
      }
    );
    
    // Run it!
    $s->run();

# Status

It's not done, probably never will be.  It works though!

# License

It's BSD licensed, and it includes code from [Kohana](http://kohanaframework.org/) (the router)

http://opensource.org/licenses/bsd-license.php
