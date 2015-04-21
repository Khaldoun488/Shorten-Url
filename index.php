<?php

require_once('vendor/autoload.php');
require_once('config.php');

use Core\Container\ContainerBuilder;

use Symfony\Component\HttpFoundation\Request;
use Whoops\Run;

//init smarty
$smarty = new Smarty();

//handle errors
$run     = new Run();

$run->pushHandler(function($e)
{
    global $smarty;
    $smarty->display('error.tpl');
});

$run->register();

//build container
$containerBuilder = new ContainerBuilder($parameters);
$container        = $containerBuilder->init();

//Request
$request = Request::createFromGlobals();
$input   = $request->query->get('long_url', null);

$shortUrl = null;

//call the service
if ($input !== null) {
    $shortenUrlService = $container['shorten_url_service'];
    $shortUrl          = $shortenUrlService->shorten($input);

    $smarty->assign("long_url", $input);
}

//assign result
if ($shortUrl !== null) {
    $smarty->assign("short_url", $shortUrl);
}

//render
$smarty->display('view.tpl');

