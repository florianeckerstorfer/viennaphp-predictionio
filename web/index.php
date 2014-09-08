<?php

// web/index.php
require_once __DIR__.'/../vendor/autoload.php';

use PredictionIO\PredictionIOClient;
use Symfony\Component\HttpFoundation\Request;

$client = PredictionIOClient::factory([
    'apiurl' => 'http://192.168.33.20:8000',
    'appkey' => 'fXcxZlrBYZUxzd6wgeZhIQruai8OfUuUDaQGQyZVeigdfn4gQv48A3Q4Dml5Jfpq'
]);

$app = new Silex\Application();
$app['debug'] = true;

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));

$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html.twig', []);
});

$app->post('/user', function (Request $request) use ($app, $client) {
    $command = $client->getCommand('create_user', ['pio_uid' => $request->get('user')]);
    $response = $client->execute($command);

    return $app->json([
        'message' => sprintf('Created user "%s".', $request->get('user'))
    ]);
});

$app->post('/show', function (Request $request) use ($app, $client) {
    $command = $client->getCommand('create_item', ['pio_iid' => $request->get('show'), 'pio_itypes' => 1]);
    $response = $client->execute($command);

    $client->identify($request->get('user'));
    $command = $client->getCommand(
        'record_action_on_item',
        ['pio_action' => 'like', 'pio_iid' => $request->get('show')
    ]);
    $client->execute($command);

    return $app->json([
        'message' => sprintf('You liked %s', $request->get('show'))
    ]);
});

$app->post('/recommend', function (Request $request) use ($app, $client) {
    try {
        $client->identify($request->get('user'));
        $command = $client->getCommand('itemrec_get_top_n', ['pio_engine' => 'itemrec', 'pio_n' => 5]);
        $rec = $client->execute($command);

        return $app->json($rec['pio_iids']);
    } catch (Exception $e) {
        return $app->json(['message' => $e->getMessage()]);
    }
});

$app->run();
