<?php   
 include 'conexao.php';  
 if (isset($_GET['id_veiculo'])) {  
      $id = $_GET['id_veiculo'];  

      $query = "DELETE FROM tab_veiculo WHERE id_veiculo = '$id'";  
      $run = mysqli_query($mysqli,$query);  
      if ($run) {  
           header('location:listarveiculo.php');  
      }else{  
           echo "Error: ".mysqli_error($mysqli);  
      }  
 }  
 
 ?>  