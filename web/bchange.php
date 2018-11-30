<html>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <meta http-equiv="content-type" content="text/html" charset="utf-8"/>
    <body>
    <div style='position:fixed;left:30px;top:50px;'>
      <a href='b.php'><button class='btn btn-dark' style='background: #000000 !important;color: #ffffff' type='button'>Voltar</button></a><br><br>
    </div>

      <?php
      try{
          include 'config.php';
          if($mode=='change'){

            $sql1 = "UPDATE meio SET nomeMeio = :nmeio1 WHERE numMeio = :nummeio1 AND nomeEntidade = :nomeentidade1;";
            $result1 = $db->prepare($sql1);
            $result1->bindParam(':nmeio1', $_REQUEST['nmeio']);
            $result1->bindParam(':nummeio1', $_REQUEST['num_meio']);
            $result1->bindParam(':nomeentidade1', $_REQUEST['nome_entidade']);

            $result1->execute();
            echo("<script type='text/javascript'>alert('Submetido com sucesso!');window.location.href='b.php'</script>");
          }

          $result1 = null;
          $db = null;
        } catch (PDOException $e) {
          echo("<div align='center'><br><p>ERROR: {$e->getMessage()}</p>");
          echo("<a href='e.php'><button class='btn btn-dark' style='background: #000000 !important;color: #ffffff' type='button'>Tente outra vez</button></a></div>");
          
        }

      ?>
      <div style='text-align: center'><h3>Editar meio:</h3>
      <br><form action="bchange.php" method="post">
        <p><input type='hidden' name='mode' value='change'/></p>
        <p><input type="hidden" name="num_meio" value="<?=$_REQUEST['num_meio']?>"/></p>
        <p><input type="hidden" name="nome_entidade" value="<?=$_REQUEST['nome_entidade']?>"/></p>
        <p>Novo Nome do Meio: <input type="text" name="nmeio"/></p>
        <p><button class='btn btn-info' type='submit' value='Submit'>Submit</button> </p>
      </form>
      </div>

    </body>
</html>
