<?php

require __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;
use Gettext\Translations;
use Gettext\Translator;
use mpyw\Cowitter\Client;

$locale = getenv('LANGUAGE') ?: getenv('LC_ALL') ?: getenv('LC_MESSAGES') ?: getenv('LANG');
$locale = file_exists(__DIR__ . "/locale/{$locale}/LC_MESSAGES/messages.po") ? $locale : 'en_US';
$translator = new Translator();
$translator->loadTranslations(Translations::fromPoFile(__DIR__ . "/locale/{$locale}/LC_MESSAGES/messages.po"))->register();

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
    die("The application has crashed.\n");
}

try {
    $target = getenv('JAVASHIT_ACCOUNT');
    $client->post('statuses/update', [
        'status' => __('Teach me this English', $target, $words),
    ]);
} catch (\RuntimeException $e) {
    error_log($e->getMessage());
}
