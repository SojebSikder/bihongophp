<?php
/**
 * Load Database
 */
include $system_path."/database/drivers/AdapterInterface.php";
include $system_path."/database/drivers/MySQLAdapter.php";
include $system_path."/database/drivers/SQLiteAdapter.php";

include $system_path."/database/Dbase.php";
include $system_path."/core/Database.php";

include $system_path."/core/Database/Builder.php";
include $system_path."/core/Database/Schema.php";