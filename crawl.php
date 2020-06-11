<?php
$key   = ( isset( $argv[1] ) ) ? $argv[1] : false;
$start = microtime( true );

date_default_timezone_set( 'Asia/Kolkata' );

define( 'APP_PATH', __DIR__ . '/' );

define( 'GITHUB_ACCESS_TOKEN', $key );

require_once APP_PATH . 'vendor/autoload.php';
require_once APP_PATH . '/app/class-handler.php';
require_once APP_PATH . '/app/class-repo.php';
require_once APP_PATH . '/app/class-lib-html.php';
require_once APP_PATH . '/app/class-table-html.php';
require_once APP_PATH . '/app/setup.php';

Handler::setup_libs_to_check();
$lib_html = Lib_HTML::run();

ob_start();
include APP_PATH . '/template/main.php';
$html = ob_get_clean();

$time_took = number_format( microtime( true ) - $start, 4 );

echo <<<HTML
<pre> Time Took : ${time_took} </pre>
HTML;

