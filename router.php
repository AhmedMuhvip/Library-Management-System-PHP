<?php

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];


$routes = [
        '/'               => 'views/login_view.php',
        '/signup'         => 'views/signup_view.php',
        '/home'           => 'views/home_view.php',
        '/bookmangement'  => 'views/bookmangement_view.php',
        '/createbook'     => 'views/createbook_view.php',
        '/addbook'        => 'controllers/createbook_contr.php',
        '/delete'         => 'controllers/deletbook_contr.php',
        '/books'          => 'views/books_view.php',
        '/tr'             => 'controllers/signup_contr.php',
        '/borrow'         => 'controllers/borrow_contr.php',
        '/me'             => 'views/myprofile_view.php',
        '/dashboard'      => 'views/dashboard_view.php',
        '/borrowshistory' => 'views/borrowshistory_view.php',

];


function route($uri, $routes)
{
    if (array_key_exists($uri, $routes)) {
        require $routes[$uri];
    } else {
        abort();
    }
}

function abort($code = 404)
{
    http_response_code($code);
    require "views/{$code}.php";
    die();
}

route($uri, $routes);
