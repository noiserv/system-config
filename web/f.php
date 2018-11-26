<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>
  <body>
<?php
  header('Content-Type: text/html; charset=utf-8');
  try {
    include 'config.php';

    $sql = "SELECT numMeio,nomeEntidade FROM meioSocorro NATURAL JOIN acciona NATURAL JOIN eventoEmergencia;";
    $result = $db->prepare($sql);
    $result->execute();

    $mode = isset($_REQUEST['mode']) ? $_REQUEST['mode'] : '';
    $type = isset($_REQUEST['type']) ? $_REQUEST['type'] : '';

    if ($mode == "get") {
      if ($type == "morada") {
        $result = $db->prepare("SELECT numMeio,nomeEntidade FROM meioSocorro NATURAL JOIN acciona NATURAL JOIN eventoEmergencia WHERE moradaLocal= :morada;");
        $result->bindParam(':morada', $_REQUEST['moradaLocal']);
        $result->execute();
        echo("<br><br><br>");
        echo("<p align=\"CENTER\"><strong>Meios de Socorro</p>\n");
        echo("<table border=\"1\" align=\"CENTER\">\n");
        echo("<tr><td><strong>N&uacute;mero dos Meios:</td><td><strong>Nome das Entidades:</td></tr>\n");

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
  <form action='f.php' method='post'>
    <h3>Escreve a morada local</h3>

    <p><input type='hidden' name='mode' value='get'/></p>
    <p><input type='hidden' name='type' value='morada'/></p>
    <p>morada: <input type='text' name='morada'/></p>
    <button type='get' value='get'>Submit</button>
    <a href="index.html"><button type='buttom'>Voltar</button></a>

    </form>
  </div>
  </body>

</html>
