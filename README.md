# What's Skunk?

Skunk is the stinky PHP (micro)framework!

It's a silly little framework I put together for fun.  It's targeted to PHP 5.3+, since it's meant to use [lambda functions](http://php.net/manual/en/functions.anonymous.php).  (You can sneak by on older versions by using [create_function](http://php.net/create_function) but that is _really_ stinky!)

Sort of insipred by [Sinatra](http://www.sinatrarb.com/), [Bottle](http://bottlepy.org/docs/dev/), etc.

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

Ever evolving (and bug fixing) but it works.

# In use?

Yes! It is in use on [Number Laundry](http://numberlaundry.whatcheer.com) which is also [open source](http://github.com/WhatCheer/Number-Laundry).

# Okay, but what about...

## Database?

Might I recommend [idiorm](https://github.com/j4mie/idiorm)?

## ORM?

Might I recommend [paris](https://github.com/j4mie/paris)?

## Templates?

Might I recommend [mustache.php](https://github.com/bobthecow/mustache.php)?

## Other Stuff?

Might I recommend writing it and sending a pull request?

# License

It's BSD licensed, and it includes code from [Kohana](http://kohanaframework.org/) (the router)

http://opensource.org/licenses/bsd-license.php
