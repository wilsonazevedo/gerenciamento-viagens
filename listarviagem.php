<?php
include_once './con.php';
include_once './conexao.php';
include('verifica_login.php');
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
    <div id="header"></div>
    <br><br>
    <center><h3>Viagens cadastradas</h3><center>
    
    
    <?php
        //id_viagens, data_saida, hora_saida, tab_motorista_id_motorista, tab_veiculo_id_veiculo, tab_usuario_id_usuario	
        $query_viagens = "SELECT viagem.id_viagens, viagem.data_saida, viagem.hora_saida,viagem.data_chegada,viagem.hora_chegada, moto.nome, vei.placa
        FROM tab_viagens viagem
        LEFT JOIN tab_motorista AS moto ON moto.id_motorista=viagem.tab_motorista_id_motorista
        LEFT JOIN tab_veiculo AS vei ON vei.id_veiculo=viagem.tab_veiculo_id_veiculo
        WHERE data_chegada IS NULL";
        $resultado_viagens = $con->prepare($query_viagens);
        $resultado_viagens->execute();  
        

        if (($resultado_viagens) AND ($resultado_viagens->rowCount() != 0)){ ?>
            
            <div class="container">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                    <th>Viagem</th>
                    <th>Ações</th>
                    </tr>
                </thead>
                <tbody>

            <?php

            


            while ($row_viagens = $resultado_viagens->fetch(PDO::FETCH_ASSOC)){
                extract($row_viagens);?>

                    <tr>
                        <td><?php
                
                echo "Motorista: " . $nome . "<br>";
                echo "Veiculo: " . $placa . "<br>";
                echo "Data da Saida: " . date('d/m/Y', strtotime($data_saida)) . "<br>";
                echo "Hora da Saida: " . $hora_saida . "<br>";
                if($data_chegada!=NULL){
                    echo "Data da chegada: " . date('d/m/Y', strtotime($data_chegada)) . "<br>";
                    echo "Hora da chegada: " . $hora_chegada . "<br>";

                }else{
                    
                    echo "<br><a href='finalizarviagem.php?id_viagens=" . $id_viagens . "'><button>Finalizar viagem</button></a><br><br>";
                }
               
                ?>
                        </td>
                        <td><?php
                        
                        //echo "<a href='editarviagem.php?id_viagens=" . $id_viagens . "'><img src='img/editar.svg' width='25' height='25'/></a><br><br>";
                        //echo "<a href='apagarviagem.php?id_viagens=" . $id_viagens . "'><img src='img/excluir.svg' width='25' height='25'/></a><br><br>";
                        
                        
                        if($data_chegada!=NULL){
                            echo "VIAGEM CONCLUIDA!";
        
                        }else{
                            
                            echo "<a href='editarviagem.php?id_viagens=" . $id_viagens . "'><img src='img/editar.svg' width='25' height='25'/> Editar</a><br><br>";
                            echo "<a href='finalizarviagem.php?id_viagens=" . $id_viagens . "'><img src='img/close.svg' width='25' height='25'/> Finalizar</a><br><br>";
                            echo "<a href='apagarviagem.php?id_viagens=" . $id_viagens . "'><img src='img/excluir.svg' width='25' height='25'/> Apagar</a><br><br>";
                            

                        }
                    

                        
                    }
                    ?>
                    </td>

    </tr>
    </tbody>
    </table>
    </div>
        <?php
        }else{
            echo "<p style='color: #ff0000';>Erro: Nenhuma viagem cadastrada!</p><br>";
        }
        
        ?>
        





    </body>
</html>
