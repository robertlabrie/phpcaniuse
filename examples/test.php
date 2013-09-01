<?php
require_once __DIR__."/../vendor/autoload.php";
require_once("./Browscap.php");

use phpbrowscap\Browscap;
$bc = new Browscap('/tmp');
$browser = $bc->getBrowser();
$can = new phpcaniuse\CanIUse($browser,file_get_contents("../data.json"));

echo "supported:" . $can->check(array('fontface','video')) . "<br>";
echo "browser<br><textarea rows=25 cols=80>" . var_export($browser,true) . "</textarea>";

echo "<br>getInfo<br><textarea rows=10 cols=80>" . var_export($can->getInfo(),true) . "</textarea><br>";
echo "<br>browserCan<br><textarea rows=25 cols=80>" . var_export($can->browserCan(),true) . "</textarea><br>";
echo "<br>featureList<br><textarea rows=25 cols=80>" . var_export($can->featureList(),true) . "</textarea><br>";
echo "<br>raw data<br><textarea rows=25 cols=80>" . var_export($can->data,true) . "</textarea>";
echo "\n<br>fin<br>\n";