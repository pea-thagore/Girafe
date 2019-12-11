<?php

$classFile = "./" . $_GET['class'] . ".class.php";
if (!file_exists($classFile)) {
	http_response_code(404);
	die("404");
}

include ($classFile);

if (!method_exists($_GET['class'], $_GET['method'])) {
	http_response_code(418);
	die("418");
}


$_GET['class']::$_GET['method']();