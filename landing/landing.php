<?php 
session_start();
if(isset($_SESSION['description'])){
    $description = $_SESSION['description'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- fontawesome -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
     <!-- mio css -->
    <link href="landingStyle.css" rel="stylesheet">
    <title>landing</title>
</head>
<body>
    <div class="container">

        <!-- title -->
        <h1>Descrizione <i class="fa-solid fa-pen-to-square"></i></h1>
        <!-- descrizione -->
         <div class="card">
             <p><?php echo $description ?></p>
         </div>
         <!-- back button -->
         <a class="back-btn" href="../index.php"><i class="fa-solid fa-arrow-turn-down fa-rotate-90"></i> Back</a>
    </div>
</body>
</html>