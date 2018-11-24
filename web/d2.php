<html>
    <body>
<?php
  try {
    $host = "db.ist.utl.pt";
    $user ="ist186414";
    $password = "hlaa6040";
    $dbname = $user;

    $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT numTelefone,instanteChamada,numProcessoSocorro FROM eventoEmergencia;";


    $result = $db->prepare($sql);
    $result->execute();
    echo("<br><br><br>");
    echo("<p align=\"CENTER\"><strong>Eventos e os Processos</p>\n");
    echo("<table border=\"1\" align=\"CENTER\">\n");
    echo("<tr><td><strong>N&uacutemero dos Meios:</td><td><strong>Instante de Chamada:</td><td><strong>N&uacutemero do Processo:</td></tr>\n");

    foreach($result as $row)
    {
        echo("<tr><td align=\"CENTER\">");
        echo($row['numtelefone']);
        echo("</td><td align=\"CENTER\">");
        echo($row['instantechamada']);
        echo("</td><td align=\"CENTER\">");
        echo($row['numprocessosocorro']);
        echo("</td></tr>\n");
      }

      echo("</table>\n");
      $db = null;

  } catch (PDOException $e) {
    echo("<p>ERROR: {$e->getMessage()}</p>");
  }
?>
    <div style="text-align:center">
      <br><br>
      <form action='d2.php' method='post'>
        <a href="index.html">
          <buttom type='buttom'>Voltar</buttom>
        </a>
      </form>
    </div>
  </body>
</html>
