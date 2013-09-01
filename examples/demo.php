<html>
<head>
</head>
<body style="font-family:sans-serif">
<?php
require_once __DIR__."/../vendor/autoload.php";
use phpbrowscap\Browscap;
use phpcaniuse\CanIUse;

//get the temp dir
$tmp = sys_get_temp_dir();

//initialize the browscap object
$bc = new Browscap($tmp);
$browser = $bc->getBrowser();

//if we don't have json data, then get it
if (!file_exists("$tmp/data.json"))
{
	file_put_contents("$tmp/data.json",file_get_contents("http://raw.github.com/Fyrd/caniuse/master/data.json"));
}

//now initialize the canIUse object
$can = new phpcaniuse\CanIUse($browser,file_get_contents("$tmp/data.json"));


//now start building output
?>
<table>
<tr>
<td><a href="#browscapproperties">Browscap Properties</a></td>
<td><a href="#caniusefeaturelist">CanIUse Feature list</a></td>
<td><a href="#browsersupportedfeatures">Browser Supported Features</a></td>

</tr>
</table>
<?php
//browscap
$browserArray = get_object_vars( $browser );
echo "<h1><a name='browscapproperties'>Browscap properties</a></h1>";
echo "<table><tr><th>Property</th><th>Value</th></tr>" . array_to_table($browserArray) . "</table>";

//features
echo "<h1><a name='caniusefeaturelist'>CanIUse Feature list</a></h1>";
echo "<table><tr><th>Key</th><th>Description</th></tr>" . array_to_table($can->featureList()) . "</table>";

//browser supported features
echo "<h1><a name='browsersupportedfeatures'>Browser Supported Features</a></h1>";
echo "<table><tr><th>Feature</th><th>Status</th></tr>" . array_to_table($can->browserCan()) . "</table>";

?>

</body>
</html>

<?php
function array_to_table($arr)
{
	$out = "";
	foreach ($arr as $key=>$value)
	{
		$out .= "<tr><td>$key</td><td>$value</td></tr>";
	}
	return $out;
}
?>