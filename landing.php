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
    <title>landing</title>
</head>
<body>
   <h1>La descrizione</h1>
    <p><?php echo $description ?></p>
    <!-- mio script js -->
</body>
</html>