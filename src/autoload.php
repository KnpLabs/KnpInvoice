<?php

require_once __DIR__.'/../vendor/symfony-class-loader/UniversalClassLoader.php';

use Symfony\Component\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();
$loader->registerNamespaces(array(
    'Knp\Invoice' => __DIR__.'/../src/',
    'Knp\Snappy'  => __DIR__.'/../vendor/',
));

$loader->registerPrefixes(array(
    'Twig_'       => __DIR__.'/../vendor/twig/lib'
));

$loader->register();