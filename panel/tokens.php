<?php
include("../config.php");

if (!empty($_GET['del']) && is_numeric($_GET['del'])) {
	$DB->query("DELETE * FROM `TokenAPI` WHERE `ID`=".$_GET['del'].";");

	header("Location: ?");
	die();
}


if (isset($_GET['add'])) {
	
	if (!empty($_POST['AppName']) && !empty($_POST['Redirect'])) {
		include("../common-funcs.php");


		$q = $DB->prepare("INSERT INTO `TokenAPI` (`AppName`, `Redirect`, `TokenAPI`) VALUES (?, ?, ?);");
		$q->execute(array(
			$_POST['AppName'],
			$_POST['Redirect'],
			generateTokenAPI($_POST['AppName'])
		));

		header("Location: ?");
		die();
	}
}

$tokensAPI = $DB->query("SELECT * FROM `TokenAPI`;");

?><!DOCTYPE html>
<html>
<head>
	<title>Cloud Panel - TokensAPI</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<style type="text/css">
		
* { box-sizing: border-box; }
table th, table td {
	border: 1px solid #000;
	padding: 5px 15px;
}

table {
	border-collapse: collapse;
}

form {
	width: 400px;
	border: 1px solid #000;
	padding: 20px;
	margin: 50px;
}

form h3 {
	margin: 0;
}

form input {
	width: 100%;
	display: block;
	margin: 5px 0;
}

	</style>
</head>
<body>
	<form action="?add" method="POST">
		<h3>Add Token API</h3>
		<input type="text" name="AppName" required placeholder="Application Name">
		<input type="url" name="Redirect" required placeholder="Redirect URL">
		<input type="submit" name="" value="Add App" onclick="document.getElementById('error').remove()">
	</form>

	<table>
		<tr>
			<th>Action</th>
			<th>App name</th>
			<th>TokenAPI</th>
			<th>Redirect URL</th>
			<th>Last used</th>
		</tr>

<?php
if ($tokensAPI) {

	foreach ($tokensAPI as $r) {
		echo "<tr>
	<td>
		<button onclick=\"delToken(".$r['ID'].")\">Delete</button>
		<button onclick=\"resetToken(".$r['ID'].")\">Reset token</button>
	</td>

	<td>".$r['AppName']."</td>
	<td><button onclick=\"showToken(this, '".$r['TokenAPI']."')\">Show</button></td>
	<td>".$r['Redirect']."</td>
	<td>".$r['LastUsed']."</td>
</tr>
";
	}
} else
	echo "<tr><td colspan=\"5\">Error in SQL query !</td></tr>";


		?>
	</table>


<script type="text/javascript">
	function delToken(id) {
		if (!confirm("Are you sure ?"))
			return;

		document.location = "?del="+id;
	}

	function showToken(elem, token) {
		elem.parentElement.innerText = token;
		elem.remove();
	}

</script>
</body>
</html>