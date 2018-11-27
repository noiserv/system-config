<html>
  <head>
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
      echo($_REQUEST['numProcessoSocorro']);
      echo($_REQUEST['nomeEntidade']);
      echo($_REQUEST['numMeio']);
      $result = $db->prepare("INSERT INTO acciona VALUES(:numMeio, :nomeEntidade, :numProcessoSocorro);");
      $result->bindParam(':numProcessoSocorro', $_REQUEST['numProcessoSocorro']);
      $result->bindParam(':nomeEntidade', $_REQUEST['nomeEntidade']);
      $result->bindParam(':numMeio', $_REQUEST['numMeio']);
      $result->execute();
    }



    // associacoes atuais entre meios e processos de socorro
    $sql = "SELECT numMeio,nomeEntidade,numProcessoSocorro FROM acciona;";
    $result = $db->prepare($sql);
    $result->execute();
    echo("<br><br><br>");
    echo("<h1 align='center'><strong>Associacoes atuais</h1>\n");
    echo("<p align='center'><strong>Processos de Socorro <-> Meios</p>\n");
    echo("<table border=\"1\" align='center'>\n");
    echo("<tr><td><strong>N&uacutemero dos Meios:</td><td><strong>Nome das Entidades:</td><td><strong>N&uacutemero dos Processos:</td></tr>\n");

    foreach($result as $row)
    {
      echo("<tr><td align='center'>");
      echo($row['nummeio']);
      echo("</td><td align='center'>");
      echo($row['nomeentidade']);
      echo("</td><td align='center'>");
      echo($row['numprocessosocorro']);
      echo("</td></tr>\n");
    }

    echo("</table>\n");

    echo("<br><br>");

    // processos de socorro
    $sql = "SELECT numProcessoSocorro FROM processoSocorro;";
    $result = $db->prepare($sql);
    $result->execute();

    echo("<h1 align='center'><strong>Processos de Socorro</h1>");
    echo("<table border='1' align='center'>");
    echo("<tr><td><strong>Número dos Processos de Socorro:</td></tr>");

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

    echo("<br><br><br>");
    echo("<h1 align='center'><strong>Meios</h1>");
    echo("<table border='1' align='center'>");
    echo("<tr><td><strong>Numero dos Meios:</td><td><strong>Nome dos Meios:</td><td><strong>Nome das Entidades:</td></tr>");

    foreach($result as $row)
    {
        echo("<tr><td align=\"center\">");
        echo($row['nummeio']);
        echo("</td><td align=\"center\">");
        echo($row['nomemeio']);
        echo("</td><td align=\"center\">");
        echo($row['nomeentidade']);
        echo("</td></tr>\n");
    }
    echo("</table>\n");

    echo("<div style='text-align:center'>");
    echo("  <br><br>");
    echo("  <form action='d1.php' method='post'>");
    echo("  <h3>adicionar associacao: meio - processo socorro</h3>");
    echo("  <p><input type='hidden' name='mode' value='add'/></p>");

    // drop-down num of processes
    echo("  <p>numprocesso: <select name='numProcessoSocorro'/></p>");
    $sql = "SELECT numProcessoSocorro FROM processoSocorro;";
    $result = $db->prepare($sql);
    $result->execute();
    foreach($result as $row) {
      echo("<option value=".$row['numprocessosocorro'].">".$row['numprocessosocorro']."</option>");
    }
    echo("  </select></p>");

    // nome da entidade
    echo("  <p>nomeEntidade: <input type='text' name='nomeEntidade'/></p>");

    // drop-down num of processes
    echo("  <p>numMeio: <select name='numMeio'/></p>");
    $sql = "SELECT numMeio FROM acciona GROUP BY numMeio ORDER BY numMeio";
    $result = $db->prepare($sql);
    $result->execute();
    foreach($result as $row) {
      echo("<option value=".$row['nummeio'].">".$row['nummeio']."</option>");
    }
    echo("  </select></p>");

    echo("  <button class='btn btn-info' type='submit' value='submit'>Submit</button>");
    echo("  </form>");

    $db = null;

  } catch (PDOException $e) {
    echo("<p>ERROR: {$e->getMessage()}</p>");
  }
?>
      <br><br>

      <form action='d1.php' method='post'>
        <a href="http://web.tecnico.ulisboa.pt/ist186474/testing/d.html"><buttom class="btn btn-info" type='buttom'>Voltar</buttom></a>
      </form>
    </div>
  </body>
</html>
