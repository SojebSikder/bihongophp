<?php
/**
 * Load Database
 */
require $system_path."/database/drivers/AdapterInterface.php";
require $system_path."/database/drivers/MySQLAdapter.php";
require $system_path."/database/drivers/SQLiteAdapter.php";
require $system_path."/database/drivers/PostgreSQLAdapter.php";

require $system_path."/database/Dbase.php";
require $system_path."/core/Database.php";

require $system_path."/core/Database/Builder.php";
require $system_path."/core/Database/Schema.php";