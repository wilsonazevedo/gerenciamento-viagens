<?php

include_once './conexao.php';
include('verifica_login.php');



    $id_motorista = $_GET['id_motorista'];


    
      $query = "SELECT * FROM tab_motorista WHERE id_motorista = $id_motorista";


        
        $statement = $mysqli->prepare($query);

       $statement->bind_param("i",$id_motorista);
         

       $statement->execute();


       $result = $statement->get_result();

       $pessoaArray = $result->fetch_assoc(); 

      
      // print_r($pessoaArray);




      

?>
<!DOCTYPE html>

<html lang="pt-br">
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
      <script>
         $(function () {
            $("#header").load("header.php");
            $("#footer").load("footer.html");
         });

         
      </script>
        <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.1.0/mdb.min.css" rel="stylesheet" />
  <!-- MDB -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.1.0/mdb.min.js"></script>

        <title>GERENCIAMENTO DE FROTAS</title>
        <meta charset="utf-8">
        
    </head>
    <body>
        <script type="text/javascript">
            function direcionar(){
            window.location.replace ( 'http://gerenciamento.especialista.shop/editarmotorista.php?id_motorista=5');
            }</script>

    <div id="header"></div>
    <br><br>
    <center><h3>Editar informações do motorista cadastrado</h3><center>
    
    
        
    <?php
    if(count($_POST) > 0) {
        // 1. pegar os valores do formulario
        $id_motorista = $_POST["id_motorista"];
        $nome = $_POST["nome"];
        $cpf = $_POST["cpf"];
        $tipo_cnh = $_POST["tipo_cnh"];
        $validade_cnh = $_POST["validade_cnh"];
    
        try {
              
    
          //echo "Conexão realizada com sucesso!";
    
              $sql = "UPDATE tab_motorista SET nome='$nome', cpf='$cpf', tipo_cnh='$tipo_cnh', validade_cnh='$validade_cnh' WHERE id_motorista='$id_motorista'";
            
            if ($mysqli->query($sql) === TRUE) {
              echo "<p style='color: green';>Motorista atualizado com sucesso!</p><br>";
              

            } else {
              echo "<p style='color: #ff0000';>Erro: motorista não foi atualizado!</p><br>";
            }
            
    
            //include_once './editarmotorista.php?id_motorista=$id_motorista';
    
    
           } catch(PDOException $e) {
              $resultado["msg"] = "Inserção no banco de dados falhou!" . $e->getMessage();
            $resultado["cod"] = 0;
            $resultado["style"] = "alert-danger";
          }
        $conn=null;
    
    }
    ?>




        <div class="container">
                <form name="EditarMotorista" action="" method="POST" class="row g-3">

                    <input type="hidden" name="id_motorista" value="<?= $pessoaArray['id_motorista'] ?>">

                    <div class="col-md-6">
                    <label for="idnome" class="form-label">Nome </label>
                    <input type="text" id="idnome" class="form-control" name="nome" value="<?= $pessoaArray['nome'] ?>" required>
                    </div>

                    <div class="col-md-6">
                    <label for="idcpf" class="form-label">CPF </label>
                    <input type="text" id="idcpf" class="form-control" name="cpf" value="<?= $pessoaArray['cpf'] ?>" required>
                    </div>

                    <div class="col-md-6">
                    <label for="idtipocnh" class="form-label">Categoria CNH </label>
                    <select class="form-select" id="idtipocnh" name="tipo_cnh" required>
                        <option selected><?= $pessoaArray['tipo_cnh'] ?></option>
                        <option value="A">A</option>
                        <option value="A/B">A/B</option>
                        <option value="A/C">A/C</option>
                        <option value="A/D">A/D</option>
                        <option value="A/E">A/E</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="E">E</option>
                        
                    </select>
                    </div>

                    <div class="col-md-6">
                    <label for="idvalidadecnh" class="form-label">Validade CNH </label>
                    <input type="date" id="idvalidadecnh" class="form-control" name="validade_cnh" value="<?= $pessoaArray['validade_cnh'] ?>" required>
                    </div>

                    

                    <div class="col-12">
                    <button  type="submit" value="Atualizar" name="EditarMotorista" class="btn btn-primary" onclick="direcionar">Atualizar</button>

                    </div>
                </form>
                </div>



     

        





    </body>

    
</html>
