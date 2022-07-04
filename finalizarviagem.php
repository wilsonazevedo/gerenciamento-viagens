<?php

include_once './conexao.php';
include('verifica_login.php');



    $id_viagens = $_GET['id_viagens'];


    
      $query = "SELECT * FROM tab_viagens via
      LEFT JOIN tab_motorista AS moto ON moto.id_motorista=via.tab_motorista_id_motorista
      LEFT JOIN tab_veiculo AS vei ON vei.id_veiculo=via.tab_veiculo_id_veiculo
      WHERE id_viagens = $id_viagens";


        
        $statement = $mysqli->prepare($query);

       $statement->bind_param("i",$id_viagens);
         

       $statement->execute();


       $result = $statement->get_result();

       $pessoaArray = $result->fetch_assoc(); 

      
      
       //print_r($pessoaArray);




      

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
    <center><h3>Finalizar viagem</h3><center>
    
    
        
    <?php
    if(count($_POST) > 0) {
        //pegar os valores do formulario
        $id_viagens = $_POST["id_viagens"];
        $data_saida = $_POST["data_saida"];
        $hora_saida = $_POST["hora_saida"];
        $data_chegada = $_POST["data_chegada"];
        $hora_chegada = $_POST["hora_chegada"];
        
        
        try {
              
    
          //echo "Conexão realizada com sucesso!";
          $motorista= $pessoaArray['tab_motorista_id_motorista'];
          $veiculo= $pessoaArray['tab_veiculo_id_veiculo'];


          $sql = "UPDATE tab_viagens via
          INNER JOIN tab_motorista AS moto ON moto.id_motorista=via.tab_motorista_id_motorista
          INNER JOIN tab_veiculo AS vei ON vei.id_veiculo=via.tab_veiculo_id_veiculo
          SET data_chegada='$data_chegada', hora_chegada='$hora_chegada'
          WHERE id_viagens=$id_viagens";
          
          if ($mysqli->query($sql) === TRUE) {
            echo "<p style='color: green';>Viagem finalizada com sucesso!</p><br>";
            

          } else {
            echo "<p style='color: #ff0000';>Erro: A viagem não foi atualizada!</p><br>";
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
        <form name="CadViagem" action="" method="POST" class="row g-3">

            <input type="hidden" name="id_viagens" value="<?= $pessoaArray['id_viagens'] ?>">

            <div class="col-md-6">
            <label for="idsaida" class="form-label">Data de saída</label>
            <input type="date" id="idsaida" class="form-control" name="data_saida" value="<?= $pessoaArray['data_saida'] ?>" required>
            </div>

            <div class="col-md-6">
            <label for="idhsaida" class="form-label">Hora de saída</label>
            <input type="time" id="idhsaida" class="form-control" name="hora_saida" value="<?= $pessoaArray['hora_saida'] ?>" required>
            </div>

            <div class="col-md-6">
            <label for="idchegada" class="form-label">Data de chegada</label>
            <input type="date" id="idchegada" class="form-control" name="data_chegada" value="<?= $pessoaArray['data_chegada'] ?>" required>
            </div>

            <div class="col-md-6">
            <label for="idhchegada" class="form-label">Hora de chegada</label>
            <input type="time" id="idhchegada" class="form-control" name="hora_chegada" value="<?= $pessoaArray['hora_chegada'] ?>" required>
            </div>


            <div class="col-md-6">
            <label for="idmotorista" class="form-label">Motorista </label>
              <select class="form-select" id="idmotorista" name="tab_motorista_id_motorista">
              <option selected><?= $pessoaArray['nome'] ?></option>
              <?php
                $query_cad_viagem = "SELECT * FROM tab_motorista ORDER BY nome";
                $resultado_cad_viagem = mysqli_query($conexao, $query_cad_viagem);
                while ($valor_registro=mysqli_fetch_row($resultado_cad_viagem)){
                  $valor_id_motorista=$valor_registro[0];
                  $valor_nome_motorista=$valor_registro[1];
                  echo "<option value=$valor_id_motorista>$valor_nome_motorista</option>";
                  } 
                  
              ?>
                
              </select>
            </div>

            <div class="col-md-6">
            <label for="idveiculo" class="form-label">Veículo </label>
              <select class="form-select" id="idveiculo" name="tab_veiculo_id_veiculo">
              <option selected><?= $pessoaArray['placa'] ?></option>
              <?php
                $query_cad_veiculo = "SELECT * FROM tab_veiculo ORDER BY placa";
                $resultado_cad_veiculo = mysqli_query($conexao, $query_cad_veiculo);
                while ($valor_registro=mysqli_fetch_row($resultado_cad_veiculo)){
                  $sql_veiculo=$valor_registro[0];
                  $valor_id_veiculo=$valor_registro[0];
                  $valor_placa_veiculo=$valor_registro[4];
                  echo "<option value=$valor_id_veiculo>$valor_placa_veiculo</option>";} 
              ?>
                
              </select>
            </div>

            

            <div class="col-12">
                <button type="submit" value="Finalizar" name="CadViagem" class="btn btn-primary">Finalizar viagem</button>

            </div>
        </form>
        </div>



    </body>

    
</html>