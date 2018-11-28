<html>
    <body>
      <h3>Editar meio:</h3>
      <form action="bchange.php" method="post">
        <p><input type="hidden" name="num_meio" value="<?=$_REQUEST['num_meio']?>"/></p>
        <p><input type="hidden" name="nome_entidade" value="<?=$_REQUEST['nome_entidade']?>"/></p>
        <p>Novo Nome do Meio: <input type="text" name="nmeio"/></p>
        <p><button type='submit' value='Submit'></button> </p>
      </form>
    
      <?php
      include 'config.php';

        #  $num_meio = isset($_REQUEST['num_meio']) ? $_REQUEST['num_meio'] : '';
        #  $nome_entidade = isset($_REQUEST['nome_entidade']) ? $_REQUEST['nome_entidade'] : '';
        #  $nmeio = isset($_REQUEST['nmeio']) ? $_REQUEST['nmeio'] : '';
        #  $nentidade = isset($_REQUEST['nentidade']) ? $_REQUEST['nentidade'] : '';
          $sql1 = "UPDATE meio SET nomeMeio = :nmeio1 WHERE numMeio = :nummeio1 AND nomeEntidade = :nomeentidade1;";
          #echo("<p>$sql1</p>");
          #echo("UPDATE meioCombate SET numMeio = {$_REQUEST['nmeio']},nomeEntidade = {$_REQUEST['nentidade']} WHERE numMeio = {$_REQUEST['num_meio']} AND nomeEntidade = {$_REQUEST['nome_entidade']};");
          $result1 = $db->prepare($sql1);
          $result1->bindParam(':nmeio1', $_REQUEST['nmeio']);
          $result1->bindParam(':nummeio1', $_REQUEST['num_meio']);
          $result1->bindParam(':nomeentidade1', $_REQUEST['nome_entidade']);
      /*    $prep->execute();*/
        #  $result = $db->prepare($sql);
        /*  $result->bindParam(':nummeio', $num_meio);
          $result->bindParam(':nomeentidade', $nome_entidade);
          $result->bindParam(':nentidade', $nentidade);
          $result->bindParam(':nmeio', $nmeio);*/
          $result1->execute();//,':nomeentidade'  =>  $nomeentidade);

        #  header('Location: http://web.tecnico.ulisboa.pt/ist186474/testing/b3.php');

      ?>

    </body>
</html>
