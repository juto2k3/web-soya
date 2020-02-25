<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
   $dbhost = 'localhost:3306';
   $dbuser = 'root';
   $dbpass = '123456';
   $conn = mysql_connect($dbhost, $dbuser, $dbpass);
   if(! $conn )
   {
     die('Khong the ket noi: ' . mysql_error());
   }
   echo 'Ket noi thanh cong';
   mysql_close($conn);
?>
</body>
</html>