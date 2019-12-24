<?php

class Response {
	private $_ok;
	private $_data;


	public function __construct($ok, $data = null) {
		if (is_bool($ok)) {
			$this->_ok = $ok;
			$this->_data = $data;
		} else {
			$this->_ok = true;
			$this->_data = $ok;
		}
	}

	public function json() {
		if (is_null($this->_data))
			return "{\"success\": ".($this->_ok?"true":"false")."}";

		else
			return json_encode(
				array("success"=>$this->_ok, "data"=>$this->_data));
	}
}

$classFile = "./" . $_GET['class'] . ".class.php";
if (!file_exists($classFile)) {
	http_response_code(404);
	die ((new Response(false, "Class not found"))->json());
}

include ($classFile);

if (!method_exists($_GET['class'], $_GET['method'])) {
	http_response_code(418);
	die ((new Response(false, "Method not found"))->json());
}





/*
 * TODO : gérer les arguments
 * exemple : /api/a/file/rename/AzErQO/Coucouille
 *                  |       |    |>arg1   |> arg2
 *                  |>class |> method      
 *
 */




$r = call_user_func(array(
	 $_GET['class'],
	 $_GET['method']
));

if (is_null($r))
	$r = new Response(true);

if (is_bool($r))
	$r = new Response($r);

if (!($r instanceof Response))
	$r = new Response(true, $r);


header("Content-Type: application/json");
die($r->json());