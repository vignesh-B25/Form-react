<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');
$connection=mysqli_connect('localhost','root','','form_db');
if(!$connection)
{
    die(" Connection error". mysqli_connect_error());
}
$query= "SELECT * FROM form";
$result= mysqli_query($connection,$query);
if($result){
    $data=mysqli_fetch_all($result,MYSQLI_ASSOC);
    echo json_encode($data);
}
else {
    echo json_encode(['message' => 'No data found']);
}
mysqli_close($connection);

?>