<?php

include_once './conexao.php';
include('verifica_login.php');



    $id_veiculo = $_GET['id_veiculo'];


    
      $query = "SELECT * FROM tab_veiculo WHERE id_veiculo = $id_veiculo";


        
        $statement = $mysqli->prepare($query);

       $statement->bind_param("i",$id_veiculo);
         

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
    <center><h3>Editar informações do veiculo cadastrado</h3><center>
    
    
        
    <?php
    if(count($_POST) > 0) {
        // 1. pegar os valores do formulario
        $id_motorista = $_POST["id_veiculo"];
        $marca = $_POST["marca"];
        $modelo = $_POST["modelo"];
        $ano = $_POST["ano"];
        $placa = $_POST["placa"];
        $chassi = $_POST["chassi"];
        $estado = $_POST["estado"];
    
        try {
              
    
          //echo "Conexão realizada com sucesso!";
    
          $sql = "UPDATE tab_veiculo SET marca='$marca', modelo='$modelo', ano='$ano', placa='$placa', chassi='$chassi', estado='$estado' WHERE id_veiculo='$id_veiculo'";
            
          if ($mysqli->query($sql) === TRUE) {
            echo "<p style='color: green';>Veiculo atualizado com sucesso!</p><br>";
            

          } else {
            echo "<p style='color: #ff0000';>Erro: veiculo não foi atualizado!</p><br>";
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
        <form name="EditarVeiculo" action="" method="POST" class="row g-3">

            <input type="hidden" name="id_veiculo" value="<?= $pessoaArray['id_veiculo'] ?>">

            <div class="col-md-6">
            <label for="idmarca" class="form-label">Marca</label>
            <input type="text" id="idmarca" class="form-control" name="marca" value="<?= $pessoaArray['marca'] ?>" required>
            </div>

            <div class="col-md-6">
            <label for="idmodelo" class="form-label">Modelo</label>
            <input type="text" id="idmodelo" class="form-control" name="modelo" value="<?= $pessoaArray['modelo'] ?>" required>
            </div>

            <div class="col-md-6">
            <label for="idano" class="form-label">Ano</label>
            <input type="number" id="idano" class="form-control" name="ano" value="<?= $pessoaArray['ano'] ?>" required>
            </div>

            <div class="col-md-6">
            <label for="idplaca" class="form-label">Placa</label>
            <input type="text" id="idplaca" class="form-control" name="placa" value="<?= $pessoaArray['placa'] ?>" required>
            </div>

            <div class="col-md-6">
            <label for="idchassi" class="form-label">Chassi</label>
            <input type="text" id="idchassi" class="form-control" name="chassi" value="<?= $pessoaArray['chassi'] ?>" required>
            </div>

            <div class="col-md-6">
            <label for="idestado" class="form-label">Estado do veiculo</label>
              <select class="form-select" id="idestado" name="estado" arial-label="Selecione o estado">
                <option selected><?= $pessoaArray['estado'] ?></option>
                <option value="OPERANDO NORMALMENTE">OPERANDO NORMALMENTE</option>
                <option value="INOPERANTE">INOPERANTE</option>
                
                
              </select>
            </div>

                     

            <div class="col-12">
                <button type="submit" value="Atualizar" name="EditarVeiculo" class="btn btn-primary">Atualizar</button>

            </div>
        </form>
        </div>



    </body>

    
</html>