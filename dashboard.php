<?php
session_start();
if(!isset($_SESSION["username"])){
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <?php 
    $dataFile="data.json";
    $data=file_exists($dataFile)?json_decode(file_get_contents($dataFile),true):[];
    //add task
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $task=$_POST["task"];
        $data[]=[
            "id"=>uniqid(),
            "task"=>$task
        ];
        file_put_contents($dataFile,json_encode($data,JSON_PRETTY_PRINT));
        echo "Task added";    }
//delete
if(isset($_GET["id"])){
    $id=$_GET["id"];
    $data=array_filter($data,fn($item) =>$item["id"] !=$id);
    file_put_contents($dataFile,json_encode(array_values($data),JSON_PRETTY_PRINT));

}
    ?>
    <h1>Welcome  <?php  echo $_SESSION["username"] ?></h1>

    <h2>Todo List</h2>
    <br>
    <form method="POST" action="dashboard.php">
        <input type="text" placeholder="Enter your task" name="task">
        <button type="submit">Add task</button>
    </form>
    <br>
    <hr>
    <table border="1">
<tr>
    <th>ID</th>
    <th>Task</th>
    <th>Action</th>
</tr>
     <?php
    foreach($data as $item){ ?>
    <tr>
        <td><?php echo $item["id"] ?></td>
        <td><?php echo $item["task"] ?></td>
        <td>
            <a href="?id=<?php echo $item["id"] ?>" onclick=" return confirm('Are your sure?')">Delete</a>
        </td>
    </tr>
       
  <?php  }
    
    ?>
    </table>
   
    <button>
        <a href="logout.php">Logout</a>
    </button>
</body>
</html>