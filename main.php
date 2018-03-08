<?php

require __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;
use mpyw\Cowitter\Client;

$dotenv = new Dotenv(__DIR__);
$dotenv->load();

$client = new Client([
    getenv('CONSUMER_KEY'),
    getenv('CONSUMER_SECRET'),
    getenv('ACCESS_TOKEN'),
    getenv('ACCESS_TOKEN_SECRET'),
]);

$words = implode(' ', array_slice($argv, 1));

if (empty($words)) {
    die('This application was crash.');
}

try {
    $client->post('statuses/update', [
        'status' => "@java_shit 👉👉👉 {$words}🤔 👈👈👈 この英語教えて〜〜〜 🙏🐷🦂💖😀",
    ]);
} catch (\RuntimeException $e) {
    error_log($e->getMessage());
}
