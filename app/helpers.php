<?php
require __DIR__.'/../vendor/autoload.php';

if(! function_exists('image_url')) {
    function image_url(string $path): string
    {
        return sprintf('http://%s:%s/storage/images/%s',
        env('TEST_DOMAIN', 'localhost'),
        env('TEST_PORT', 8000),
        $path);
    }
}
