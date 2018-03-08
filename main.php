<?php

require __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;
use mpyw\Cowitter\Client;

$dotenv = new Dotenv(__DIR__);
$dotenv->load();

$client = new Client([
    $_ENV['CONSUMER_KEY'],
    $_ENV['CONSUMER_SECRET'],
    $_ENV['ACCESS_TOKEN'],
    $_ENV['ACCESS_TOKEN_SECRET'],
]);

$words = implode(' ', array_slice($argv, 1));
$client->post ('statuses/update', [
    'status' => "@java_shit 👉👉👉 {$words}🤔 👈👈👈 この英語教えて〜〜〜 🙏🐷🦂💖😀",
]);
