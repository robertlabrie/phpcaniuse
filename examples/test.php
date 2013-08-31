<?php
require_once __DIR__."/../vendor/autoload.php";
require_once("./Browscap.php");

use phpbrowscap\Browscap;
$bc = new Browscap('/tmp');
$browser = $bc->getBrowser();
echo "<textarea rows=25 cols=80>" . var_export($browser,true) . "</textarea>";

$can = new phpcaniuse\CanIUse($browser,file_get_contents("../data.json"));
echo "<br><pre>" . var_export($can->getInfo(),true) . "</pre><br>";
echo "<br><textarea rows=25 cols=80>" . var_export($can->browserCan(),true) . "</textarea><br>";
echo "<br><textarea rows=25 cols=80>" . var_export($can->featureList(),true) . "</textarea><br>";
echo "<textarea rows=25 cols=80>" . var_export($can->data,true) . "</textarea>";
echo "\n<br>fin<br>\n";