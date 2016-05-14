<?php
/**
 * Created by PhpStorm.
 * User: FRESHIELD
 * Date: 2016/5/13
 * Time: 22:47
 */

define('XML_URL','http://www.yangyufresh.com/test.xml');

$xml = simplexml_load_file(XML_URL);
var_dump($xml);

echo "<br>here<br>";
$attr = $xml->channel->description;
var_dump($attr);
echo $attr;

?>