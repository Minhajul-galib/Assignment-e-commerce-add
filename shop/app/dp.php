<!-- Data Base connection -->
<?php
$host='localhost';
$user='dina';
$pass='12345'; 
$dp='rahman';

function connect(){
    global $host, $user, $pass, $dp;
    return $connection = new mysqli($host, $user, $pass, $dp);

}
?>