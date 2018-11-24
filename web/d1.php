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

    $sql = "SELECT numMeio,nomeEntidade,numProcessoSocorro FROM acciona;";


    $result = $db->prepare($sql);
    $result->execute();
    echo("<br><br><br>");
    echo("<p align=\"CENTER\"><strong>Meios</p>\n");
    echo("<table border=\"1\" align=\"CENTER\">\n");
    echo("<tr><td><strong>N&uacutemero dos Meios:</td><td><strong>Nome das Entidades:</td><td><strong>N&uacutemero dos Processos:</td></tr>\n");

    foreach($result as $row)
    {
      echo("<tr><td align=\"CENTER\">");
      echo($row['nummeio']);
      echo("</td><td align=\"CENTER\">");
      echo($row['nomeentidade']);
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
    <form action='d1.php' method='post'>
      <a href="http://web.tecnico.ulisboa.pt/ist186474/d.html"><buttom type='buttom'>Voltar</buttom></a>
    </form>
  </div>
  </body>
</html>
