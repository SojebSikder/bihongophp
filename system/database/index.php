<?php 
//namespace DB;
//use DB;
include "MySQLAdapter.php";
include "Dbase.php";

    $mysql = new MySQLAdapter();
    $db = new Dbase($mysql);

    $query = "SELECT * FROM users";
    $data = $db->select($query)->fetch_assoc();

    if(isset($_POST['sql'])){
        $dt = $_POST['dt'];
        $db->insert("INSERT INTO post_category(cat_name, cat_status) VALUES('$dt', 'Publish')");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DB Testing</title>
</head>
<body>
    <h1>Hello, <?php echo $data['user_name'];?></h1>

    <form method="post">
        <input type="text" name="dt">
        <input type="submit" name="sql" value="Submit">
    </form>
    
</body>
</html>