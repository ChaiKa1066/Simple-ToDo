<?php 
$db = "db.sqlite"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>todo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<div class = "container-xl main">

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Добавить задачу</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Добавить категорию</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
<div class="row align-items-center">
<div class ="col-12 col-sm-6 row ">
    <h4>Добавить задачу</h4>
<form method="post" action="/actions/newTask.php">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Название</label>
    <input type="text" class="form-control" name="name" required>
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Описание</label>
    <input type="text" class="form-control" name="desc" required>
  </div>

  <div class="mb-3">
  <select class="form-select" id="floatingSelect" name="category">
    <option value="Главное">Главное</option>

    <?php 
        try{
            $pdo = new PDO('sqlite:'.$db);
    
            $sql = "SELECT * FROM cat";
            $result = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row):  ?>
       <option value="<?=$row['name'] ?>"><?=$row['name'] ?></option>
            <?php
            endforeach;
            }catch(PDOException $e){
              echo $e;
            }

?>

  </select>
  </div>

  <button type="submit" class="btn btn-primary">Записать</button>
</form>

</div>
<div class =" col-12 col-sm-6 row ">
    <h4>Добавить категорию</h4>
<form method="post" action="/actions/newcat.php">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Название</label>
    <input type="text" class="form-control" name="name" required>
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Описание</label>
    <input type="text" class="form-control" name="desc" required>
  </div>

  <div class="mb-3">
  <select class="form-select" id="floatingSelect" name="category" disabled>
    <option value="Главное">Категория</option>

  </select>
  </div>

  <button type="submit" class="btn btn-primary">Записать</button>
</form>

</div>
</div>
<hr >
</div>

<div class="container">
<table class="table">
  <thead>
    <tr>
      <th colspan="5"><h2>Main</h2></th>
    </tr>
    <tr>
    <th scope="col" class="tableF"></th>
    <th scope="col"></th>
      <th scope="col">Дата</th>
      <th scope="col">Название</th>
      <th scope="col">Описание</th>
     
    
     
    </tr>
  </thead>



  <?php
        try{
        $pdo = new PDO('sqlite:'.$db);

        $sql = "SELECT * FROM tasks where category = 'Главное' and status = 'live'";
        $result = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row):  ?>

<tbody>
    <tr>
    <td class="tableF">
      <input class="form-check-input ch" type="checkbox" value="" id="flexCheckDefault" onclick="location.href='actions/del.php?id=<?=$row['id']?>';">

      </td>
      <td><a href="#"><img class="icon" src="pen-square.svg" alt="icon"></a></td>
      <td><?=$row['date'] ?></td>
      <td><?=$row['name'] ?></td>
      <td ><?=$row['desc'] ?></td>
     
    
  
    </tr>
  </tbody>



        <?php
        endforeach;
        }catch(PDOException $e){
          echo $e;
        }

        ?>


<?php 
  try{
    $pdo = new PDO('sqlite:'.$db);

    $sql = "SELECT * FROM cat";
    $result = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row): 
      ?>

      <thead>
      <tr>
      <th colspan="5"><h2><?= $row['name'] ?></h2></th>
    </tr>
        <tr>
        <th class="tableF" scope="col"></th>
        <th scope="col" ></th>
          <th scope="col">Дата</th>
          <th scope="col">Название</th>
          <th scope="col">Описание</th>
        
        </tr>
      </thead>
      <?php
////


        try {
            $pdo = new PDO('sqlite:'.$db);
            $sql ="Select * from tasks where category = '".$row['name']."' and status = 'live'";
            $res = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        
            foreach ($res as $cas):
           ?>
           <tbody>
                <tr>
                <td class="tableF">
                <input class="form-check-input ch" type="checkbox" value="" id="flexCheckDefault" onclick="location.href='actions/del.php?id=<?=$cas['id']?>';">
          
                </td>
                <td><a href="#"><img class="icon" src="pen-square.svg" alt="icon"></a></td>
                <td><?=$cas['date'] ?></td>
                <td><?=$cas['name'] ?></td>
                <td ><?=$cas['desc'] ?></td>
               
               
              
              </tr>
              </tbody>
                <?php
                    endforeach;
        } catch (PDOException $e) {
            echo $e;
        }  
 
    ////

    endforeach;
    }catch(PDOException $e){
      echo $e;
    }

    ?>
      </table>








</div>

</div>   
<link href="style.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>