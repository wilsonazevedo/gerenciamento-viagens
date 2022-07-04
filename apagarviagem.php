<?php   
 include 'conexao.php';  
 if (isset($_GET['id_viagens'])) {  
      $id = $_GET['id_viagens'];  

      $query = "DELETE FROM tab_viagens WHERE id_viagens = '$id'";  
      $run = mysqli_query($mysqli,$query);  
      if ($run) {  
           header('location:listarviagem.php');  
      }else{  
           echo "Error: ".mysqli_error($mysqli);  
      }  
 }  
 
 ?>  