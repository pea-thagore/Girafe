<?php
define("DB_HOST", "localhost");
define("DB_BASE", "cloud");
define("DB_USER", "girafon");
define("DB_PSWD", "zCqJ58wx7kD7BQCRRfHGRfSmhos");
define("STORAGE_ROOT", "/media/voyager/girafe");

$DB = new PDO("mysql:dbname=".DB_BASE.";host=".DB_HOST, DB_USER, DB_PSWD);
