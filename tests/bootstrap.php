<?php

if (is_dir(__DIR__ . '/../vendor')) {
    require_once __DIR__ . '/../vendor/.composer/autoload.php';
} elseif (is_file(__DIR__ . '/../../../.composer/autoload.php')) {
    require_once __DIR__ . '/../../../.composer/autoload.php';
} elseif (is_file(__DIR__ . '/../.composer/autoload.php')) {
    require_once __DIR__ . '/../.composer/autoload.php';
} else {
    die('You must set up the project dependencies, run the following commands:'.PHP_EOL.
        'curl -s http://getcomposer.org/installer | php'.PHP_EOL.
        'php composer.phar install'.PHP_EOL);
}

$loader->add('Invoice\Test', __DIR__);