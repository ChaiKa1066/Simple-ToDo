<?php 
var_dump($_POST);
$name = $_POST['name'];
$desc = $_POST['desc'];
$cat = $_POST['category'];
$date =  date("d.m.Y") ;
$pdo = new PDO('sqlite:../db.sqlite');
$query = "INSERT INTO tasks (name, desc, date,status,category) VALUES (:name, :desc, :date,'live',:cat)";
$params = [
   'name' => $name,
   'desc' => $desc,
   'date' => $date ,
   'cat' => $cat


];
$stmt = $pdo->prepare($query);
$stmt->execute($params);

header('Location: ../index.php');
?>