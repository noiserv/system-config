<html>
  <body>
<?php
  header('Content-Type: text/html; charset=utf-8');
  try {
    $host = "db.ist.utl.pt";
    $user ="ist186414";
    $password = "hlaa6040";
    $dbname = $user;

    $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
    <p>morada: <input type='text' name='moradaLocal'/></p>
    <button type='get' value='get'>Submit</button>
    <a href="index.html"><buttom type='buttom'>Voltar</buttom></a>

    </form>
  </div>
  </body>

</html>
