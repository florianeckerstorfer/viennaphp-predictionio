<?php

// web/index.php
require_once __DIR__.'/vendor/autoload.php';

use PredictionIO\PredictionIOClient;

$client = PredictionIOClient::factory([
    'apiurl' => 'http://192.168.33.20:8000',
    'appkey' => 'fXcxZlrBYZUxzd6wgeZhIQruai8OfUuUDaQGQyZVeigdfn4gQv48A3Q4Dml5Jfpq'
]);

$fixtures = json_decode(file_get_contents('fixtures.json'), true);

foreach ($fixtures as $user => $shows) {
    $command = $client->getCommand('create_user', ['pio_uid' => $user]);
    $response = $client->execute($command);

    foreach ($shows as $show) {
        $command = $client->getCommand('create_item', ['pio_iid' => $show, 'pio_itypes' => 1]);
        $response = $client->execute($command);

        $client->identify($user);
        $command = $client->getCommand('record_action_on_item', ['pio_action' => 'view', 'pio_iid' => $show]);
        $client->execute($command);
    }
}

echo "import complete.\n";
