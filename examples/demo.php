<?php
require_once __DIR__."/../vendor/autoload.php";
use phpbrowscap\Browscap;
use phpcaniuse\CanIUse
$bc = new Browscap('/tmp');
$browser = $bc->getBrowser();
$can = new phpcaniuse\CanIUse($browser,file_get_contents("../data.json"));
