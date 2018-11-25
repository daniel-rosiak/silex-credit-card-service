<?php

use Silex\Application;
use Silex\Provider\HttpCacheServiceProvider;
use Silex\Provider\MonologServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\SerializerServiceProvider;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\ServicesLoader;
use App\RoutesLoader;
use Carbon\Carbon;
use App\Utils\CheckFormatUtil;

date_default_timezone_set('Europe/Warsaw');

$app->before(function (Request $request, Application $app) {

    if (0 === strpos($request->headers->get('Accept'), 'application/json')) {
        $app['var.requestFormat'] = 'json';
    }
    elseif (0 === strpos($request->headers->get('Accept'), 'text/xml') || 0 === strpos($request->headers->get('Accept'), 'application/xml')) {
        $app['var.requestFormat'] = 'xml';
    }

    if($request->getContentType() == 'json' && CheckFormatUtil::isJson($request->getContent())) {
        $data = $app['serializer']->decode($request->getContent(), 'json');
        $request->request->replace(is_array($data) ? $data : array());
        $app['var.requestFormat'] = !isset($app['var.requestFormat']) || empty($app['var.requestFormat'])  ? 'json' : $app['var.requestFormat'];
    }
    elseif($request->getContentType() == 'xml' && CheckFormatUtil::isXml($request->getContent())) {
        $data = $app['serializer']->decode($request->getContent(), 'xml');
        $request->request->replace(is_array($data) ? $data : array());
        $app['var.requestFormat'] = !isset($app['var.requestFormat']) || empty($app['var.requestFormat'])  ? 'xml' : $app['var.requestFormat'];
    }

    //default format = json
    $app['var.requestFormat'] = !isset($app['var.requestFormat']) || empty($app['var.requestFormat'])  ? 'json' : $app['var.requestFormat'];
});

$app->register(new \Euskadi31\Silex\Provider\CorsServiceProvider);

$app->register(new Silex\Provider\SerializerServiceProvider());

$app->register(new ServiceControllerServiceProvider());

$app->register(new HttpCacheServiceProvider(), array("http_cache.cache_dir" => ROOT_PATH . "/storage/cache",));

$app->register(new MonologServiceProvider(), array(
    "monolog.logfile" => ROOT_PATH . "/storage/logs/" . Carbon::now('Europe/Warsaw')->format("Y-m-d") . ".log",
    "monolog.level" => $app["log.level"],
    "monolog.name" => "application"
));

//load services
$servicesLoader = new App\ServicesLoader($app);
$servicesLoader->bindServicesIntoContainer();

//load routes
$routesLoader = new App\RoutesLoader($app);
$routesLoader->bindRoutesToControllers();

$app->error(function (\Exception $e, Request $request, $code) use ($app) {
    $app['monolog']->addError($e->getMessage());
    $app['monolog']->addError($e->getTraceAsString());

    $format = $request->getContentType() ? $request->getContentType() : 'json';

    return new Response(
        $app['serializer']->serialize([], $format),
        $code,
        array(
            "Content-Type" => $request->getMimeType($format)
        )
    );
});

return $app;