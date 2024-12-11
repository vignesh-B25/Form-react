<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}
$connection=mysqli_connect('localhost','root','','form_db');
//  $db=mysqli_select_db($connection,'form_db');
 if(!$connection){
    die('connection failed'. mysqli_connect_error());
 }
if($_SERVER['REQUEST_METHOD']==='POST'){
             $fname=$_POST['fname']??"";
             $lname=$_POST['lname']?? "";
             $num=$_POST['num']?? "";
             $email=$_POST['email']?? "";
             
             if (empty($fname) || empty($lname) || empty($num) || empty($email)) {
                echo json_encode(['message' => 'Error: Please fill in all fields!']);
                exit;
            }
        
            
            $stmt = $connection->prepare("INSERT INTO form (fname, lname, number, email) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssis", $fname, $lname, $num, $email);
        
          
            if ($stmt->execute()) {
                echo json_encode(['message' => 'Data successfully stored in the database!']);
            } else {
                echo json_encode(['message' => 'Error: ' . $connection->error]);
            }
        
            
            $stmt->close();
        } else {
            echo json_encode(['message' => 'Invalid request method.']);
       
        }
        
       
        $connection->close();
 ?>