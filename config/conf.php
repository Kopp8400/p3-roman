<?php

class Conf{

    static $debug = 1;

    static $databases = array(
            	'default' => array(
	             'host' => 'localhost',
	            'database' => 'jeanpfas_php-mvc',
	            'login' => 'jeanpfas_php-mvc',
	            'password' => 'J8H3n8NpZjNZ'
        	)
    );
}

Router::prefix('jforte','admin');
Router::connect('','posts/index');
Router::connect('jforte','jforte/posts/index');
Router::connect('roman/:slug-:id','posts/view/id:([0-9]+)/slug:([a-z0-9\-]+)');
Router::connect('roman/:slug-:id/signalement','posts/view/id:([0-9]+)/slug:([a-z0-9\-]+)/signal');
Router::connect('roman/*','posts/*');
