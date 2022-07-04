<?php   
 include 'conexao.php';  
 if (isset($_GET['id_motorista'])) {  
      $id = $_GET['id_motorista'];  

      $query = "DELETE FROM tab_motorista WHERE id_motorista = '$id'";  
      $run = mysqli_query($mysqli,$query);  
      if ($run) {  
           header('location:listarmotorista.php');  
      }else{  
           echo "Error: ".mysqli_error($mysqli);  
      }  
 }  
 
 ?>  
