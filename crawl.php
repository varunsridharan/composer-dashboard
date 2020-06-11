<?php
$start = microtime( true );

define( 'APP_PATH', __DIR__ . '/' );

define( 'GITHUB_ACCESS_TOKEN', $argv[1] );

require_once APP_PATH . 'vendor/autoload.php';

require_once APP_PATH . '/app/class-handler.php';

require_once APP_PATH . '/app/class-repo.php';

require_once APP_PATH . '/app/setup.php';

Handler::setup_libs_to_check();

Handler::setup_repos_to_check();

$time_took = number_format( $start - microtime( true ), 4 );

echo <<<HTML
<pre> Time Took : ${time_took} </pre>
HTML;

