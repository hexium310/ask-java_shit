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
try {
    $target = getenv('JAVASHIT_ACCOUNT');
    $client->post('statuses/update', [
        'status' => "@{$target} 👉👉👉 {$words}🤔 👈👈👈 この英語教えて〜〜〜 🙏🐷🦂💖😀",
    ]);
} catch (\RuntimeException $e) {
    error_log($e->getMessage());
}
