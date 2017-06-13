<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8"); 

$servername = "localhost";
$username = "root";
$password = "71305477a";
$dbname = "candide"; 

try {

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if (isset ($_GET['id_users'])) {

   $category = $_GET['id_users'];

    $stmt = $conn->prepare("SELECT id,nom,email,ville,description from users where id='$category' ");

}else{

     $stmt = $conn->prepare("SELECT id,nom,email,ville,description from users");
}
   
    $stmt->execute();

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();
    $outp="";
foreach ($result as $key => $info) {

      if ($outp != "") {$outp .= ",";}

    $outp .= '{"nom":"'  . $info["nom"] . '",';
    $outp .= '"ville":"'   . $info["ville"]        . '",';
    $outp .= '"id":"'   . $info["id"]        . '",';
    $outp .= '"email":"'. $info["email"]     . '"}';
    }
    $outp ='{"records":['.$outp.']}';
    echo $outp;
    }

    
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>
