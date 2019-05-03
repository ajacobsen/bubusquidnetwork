<?php

require_once '../vendor/autoload.php';

// $loader = new Twig_Loader_Filesystem('../src/templates');
// $twig = new Twig_Environment($loader);

use App\Controller\IndexController;
use App\Controller\ShowController;
use App\Controller\GameController;
use App\Controller\EpisodeController;
use App\Controller\EpisodesController;
use App\Controller\ShowsEpisodeController;
use App\Controller\LiveController;

opcache_reset();

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
	$r->addRoute('GET', '/', IndexController::class);
    $r->addRoute('GET', '/shows/{name}', ShowController::class);
    $r->addRoute('GET', '/games/{name}', GameController::class);
    $r->addRoute('GET', '/episodes', ShowsEpisodeController::class);
    $r->addRoute('GET', '/episodes/{name}', EpisodesController::class);
    $r->addRoute('GET', '/episodes/{name}/{episode}', EpisodeController::class);
    $r->addRoute('GET', '/live', LiveController::class);
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);


$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo "404";
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        echo "405";
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        $h = new $handler;
        $h->handleRequest($vars);
        break;
}
