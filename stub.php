<?php

if (!defined('\im\IMPHP_BASE')) {
    echo "Could not find imphp/base"; exit(1);
}

require "static.php";

$loader = \im\ImClassLoader::load();
$loader->addBasePath(__DIR__);
