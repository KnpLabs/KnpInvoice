#!/usr/bin/env php
<?php

set_time_limit(0);

$vendorDir = __DIR__;
$deps = array(
    array('symfony-class-loader', 'http://github.com/symfony/ClassLoader.git', 'origin/master'),
    array('twig', 'http://github.com/fabpot/Twig.git', 'origin/master'),
    array('knp/snappy', 'http://github.com/KnpLabs/snappy.git', 'origin/master'),
    
);

foreach ($deps as $dep) {
    list($name, $url, $rev) = $dep;

    echo "> Installing/Updating $name\n";

    $installDir = $vendorDir.'/'.$name;
    if (!is_dir($installDir)) {
        system(sprintf('git clone -q %s %s', escapeshellarg($url), escapeshellarg($installDir)));
    }

    system(sprintf('cd %s && git fetch -q origin && git reset --hard %s', escapeshellarg($installDir), escapeshellarg($rev)));
}
