<?php 
var_dump($_POST);
$name = $_POST['name'];
$desc = $_POST['desc'];

$pdo = new PDO('sqlite:../db.sqlite');
$query = "INSERT INTO cat (name, desc) VALUES (:name, :desc)";
$params = [
   'name' => $name,
   'desc' => $desc,


];
$stmt = $pdo->prepare($query);
$stmt->execute($params);

header('Location: ../index.php');
?>