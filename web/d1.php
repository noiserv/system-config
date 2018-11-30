<html>
  <head>
    <meta http-equiv="content-type" content="text/html" charset="utf-8"/> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>
  <body>

<?php
  try {
    include 'config.php';

    /**
     * requests processing
     **/
    $mode = isset($_REQUEST['mode']) ? $_REQUEST['mode'] : '';

    if ($mode == "add") {
      /*echo($_REQUEST['numProcessoSocorro']);
      echo($_REQUEST['nomeEntidade']);
      echo($_REQUEST['numMeio']);*/
      $result = $db->prepare("INSERT INTO acciona VALUES(:numMeio, :nomeEntidade, :numProcessoSocorro);");
      $result->bindParam(':numProcessoSocorro', $_REQUEST['numProcessoSocorro']);
      $result->bindParam(':nomeEntidade', $_REQUEST['nomeEntidade']);
      $result->bindParam(':numMeio', $_REQUEST['numMeio']);
      $result->execute();
    }?>


  <?php
    // associacoes atuais entre meios e processos de socorro
    $sql = "SELECT numMeio,nomeEntidade,numProcessoSocorro FROM acciona;";
    $result = $db->prepare($sql);
    $result->execute();
  ?>
    <br><br><br>
    <h1 align='center'><strong>Associa&ccedil;&otilde;es Atuais</h1>
    <h3 align='center'><strong>Meios <-> Processos de Socorro</h3>
    <table border=\"1\" align='center'>
    <tr><td><strong>N&uacute;mero dos Meios:</td><td><strong>Nome das Entidades:</td><td><strong>N&uacute;mero dos Processos:</td></tr>

  <?php
    foreach($result as $row)
    {
      echo("<tr><td align='center'>");
      echo($row['nummeio']);
      echo("</td><td align='center'>");
      echo($row['nomeentidade']);
      echo("</td><td align='center'>");
      echo($row['numprocessosocorro']);
      echo("</td></tr>");
    }
  ?>
    </table>
    <br><br>

  <?php
    // processos de socorro
    $sql = "SELECT numProcessoSocorro FROM processoSocorro;";
    $result = $db->prepare($sql);
    $result->execute();
  ?>

    <h1 align='center'><strong>Processos de Socorro</h1>
    <table border='1' align='center'>
    <tr><td><strong>N&uacute;mero dos Processos de Socorro:</td></tr>

  <?php
    foreach($result as $row)
    {
        echo("<tr><td align='center'>");
        echo($row['numprocessosocorro']);
        echo("</td></tr>");
    }
    echo("</table>");

    // meios disponíveis
    $sql = "SELECT numMeio, nomeMeio, nomeEntidade FROM meio;";
    $result = $db->prepare($sql);
    $result->execute();
  ?>

    <br><br><br>
    <h1 align='center'><strong>Meios</h1>
    <table border='1' align='center'>
    <tr><td><strong>N&uacute;mero dos Meios:</td><td><strong>Nome dos Meios:</td><td><strong>Nome das Entidades:</td></tr>

  <?php
    foreach($result as $row)
    {
        echo("<tr><td align=\"center\">");
        echo($row['nummeio']);
        echo("</td><td align=\"center\">");
        echo($row['nomemeio']);
        echo("</td><td align=\"center\">");
        echo($row['nomeentidade']);
        echo("</td></tr>");
    }
  ?>
    </table>
      <div style='position:fixed;left:30px;top:10px;'>
      <br><br>
        <a href="d.html"><button class='btn btn-dark' style='background: #000000 !important;color: #ffffff' type='button'>Voltar</button></a><br><br>
      <form action='d1.php' method='post'>
      <h3>Adicionar associa&ccedil;&atilde;o:<br><br> Meio <-> Processo Socorro<br></h3>
      <p><input type='hidden' name='mode' value='add'/></p>


    <!-- drop-down num of processes -->
    <p>numprocesso: <select name='numProcessoSocorro'/></p>");

  <?php
    $sql = "SELECT numProcessoSocorro FROM processoSocorro;";
    $result = $db->prepare($sql);
    $result->execute();

    foreach($result as $row) {
      echo("<option value=".$row['numprocessosocorro'].">".$row['numprocessosocorro']."</option>");
    }
  ?>

    </select></p>

    <!-- nome da entidade -->
    <p>nomeEntidade: <input type='text' name='nomeEntidade'/></p>

    <!-- drop-down num of processes-->
    <p>numMeio: <select name='numMeio'/></p>

  <?php
    $sql = "SELECT numMeio FROM meio;";
    $result = $db->prepare($sql);
    $result->execute();
    foreach($result as $row) {
      echo("<option value=".$row['nummeio'].">".$row['nummeio']."</option>");
    }
    echo("<br><br>")
  ?>
    </select></p>

    <br><button class='btn btn-info' type='submit' value='submit'>Submit</button>
    </form>

  </div>

<?php
    $db = null;

  } catch (PDOException $e) {
    echo("<div align='center'><br><p>ERROR: {$e->getMessage()}</p>");
   echo("<a href='d1.php'><button class='btn btn-dark' style='background: #000000 !important;color: #ffffff' type='button'>Tente outra vez</button></a></div>");
 }

?>
      <br><br>


    </div>
  </body>
</html>
