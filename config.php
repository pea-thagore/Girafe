<?php
define("DB_HOST", "localhost");
define("DB_BASE", "cloud");
define("DB_USER", "");
define("DB_PSWD", "");
define("STORAGE_ROOT", "/media/voyager/girafe");

$DB = new PDO("mysql:dbname=".DB_BASE.";host=".DB_HOST, DB_USER, DB_PSWD);
