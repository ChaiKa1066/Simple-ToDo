<?php 
var_dump($_GET);

$id=$_GET['id'];
try{
$pdo = new PDO('sqlite:../db.sqlite');
$query = "UPDATE tasks set status='w' where id = :id";
$params = [
    'id' =>$id
];
$stmt = $pdo->prepare($query);
$stmt->execute($params);
}catch(PDOException $e){
var_dump($e);
}

header('Location: ../index.php');
?>