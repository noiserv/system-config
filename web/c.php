<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <meta http-equiv="content-type" content="text/html" charset="utf-8"/>
  </head>
  <body>
<?php
  try {
    $host = "db.ist.utl.pt";
    $user ="ist186414";
    $password = "hlaa6040";
    $dbname = $user;

    $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT numProcessoSocorro FROM processoSocorro;";
    $result = $db->prepare($sql);
    $result->execute();

    echo("<br><br>");
    echo("<h1 align=\"CENTER\"><strong>Processos de Socorro</h1>\n");
    echo("<table border=\"1\" align=\"CENTER\">\n");
    echo("<tr><td><strong>Número dos Processos de Socorro:</td></tr>\n");

    foreach($result as $row)
    {
        echo("<tr><td align=\"CENTER\">");
        echo($row['numprocessosocorro']);
        echo("</td></tr>\n");
    }

    echo("</table>\n");

    $sql = "SELECT numMeio, nomeMeio, nomeEntidade FROM meio;";
    $result = $db->prepare($sql);
    $result->execute();

    echo("<br><br><br>");
    echo("<h1 align=\"CENTER\"><strong>Meios</h1>\n");
    echo("<table border=\"1\" align=\"CENTER\">\n");
    echo("<tr><td><strong>Número dos Meios:</td><td><strong>Nome dos Meios:</td><td><strong>Nome das Entidades:</td></tr>\n");

    foreach($result as $row)
    {
        echo("<tr><td>");
        echo($row['nummeio']);
        echo("</td><td>");
        echo($row['nomemeio']);
        echo("</td><td>");
        echo($row['nomeentidade']);
        echo("</td></tr>\n");
    }
    echo("</table>\n");


    $db = null;
    }
    catch (PDOException $e) {
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
?>
    </body>
</html>
