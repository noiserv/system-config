<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>
  <body>
<?php
  try {
    include 'config.php';

    $sql = "SELECT numMeio,nomeEntidade FROM acciona;";
    $result = $db->prepare($sql);
    $result->execute();

    $mode = isset($_REQUEST['mode']) ? $_REQUEST['mode'] : '';
    $type = isset($_REQUEST['type']) ? $_REQUEST['type'] : '';

    if ($mode == "find") {
      if ($type == "numprocesso") {
        $result = $db->prepare("SELECT numMeio,nomeEntidade FROM acciona WHERE numProcessoSocorro= :num;");
        $result->bindParam(':num', $_REQUEST['numProcc']);
        $result->execute();
        echo("<br><br><br>");
        echo("<p align=\"CENTER\"><strong>Meios</p>\n");
        echo("<table border=\"1\" align=\"CENTER\">\n");
        echo("<tr><td><strong>N&uacutemero dos Meios:</td><td><strong>Nome das Entidades:</td></tr>\n");

        foreach($result as $row)
        {
          echo("<tr><td align=\"CENTER\">");
          echo($row['nummeio']);
          echo("</td><td align=\"CENTER\">");
          echo($row['nomeentidade']);
          echo("</td></tr>\n");
        }

        echo("</table>\n");
        $db = null;
      }
    }

    $db = null;
  } catch (PDOException $e) {
    echo("<p>ERROR: {$e->getMessage()}</p>");
  }
?>
  <div style="text-align:center">
    <br><br>
    <form action='e.php' method='post'>
      <h3>Escreve o num do processo de socorro</h3>
      <p><input type='hidden' name='mode' value='find'/></p>
      <p><input type='hidden' name='type' value='numprocesso'/></p>
      <p>numProcesso: <input type='text' name='numProcc'/></p>
      <button type='find' value='find'>Submit</button>
      <a href="http://web.tecnico.ulisboa.pt/ist186474/testing/index.html"><buttom type='buttom'>Voltar</buttom></a>
    </form>
  </div>
  </body>
</html>
