<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <meta http-equiv="content-type" content="text/html" charset="utf-8"/>
  </head>
  <body>
  <div style='position:fixed;left:30px;top:50px'>
  <a href='index.html'><button class='btn btn-dark' style='background: #000000 !important;color: #ffffff' type='button'>Voltar</button></a><br><br>
  </div>
<?php
  try {
    include 'config.php';

    $sql = "SELECT numProcessoSocorro FROM processoSocorro;";
    $result = $db->prepare($sql);
    $result->execute();

    echo("<br><br>");
    echo("<h1 align='center'><strong>Processos de Socorro</h1>");
    echo("<table border=\"2\" align='center'>\n");
    echo("<tr><td><strong>N&uacute;mero dos Processos de Socorro:</td></tr>\n");

    foreach($result as $row)
    {
        echo("<tr><td align=\"CENTER\">");
        echo($row['numprocessosocorro']);
        echo("</td></tr>\n");
    }
    echo("</table></div><br><br>");

    $sql = "SELECT numMeio, nomeMeio, nomeEntidade FROM meio;";
    $result = $db->prepare($sql);
    $result->execute();

    echo("<br><br>");
    echo("<h1 align='center'><strong>Meios</h1>");
    echo("<table border=\"2\" align='center'>\n");
    echo("<tr><td><strong>N&uacute;mero dos Meios:</td><td><strong>Nome dos Meios:</td><td><strong>Nome das Entidades:</td></tr>\n");

    foreach($result as $row)
    {
        echo("<tr><td align='center'>");
        echo($row['nummeio']);
        echo("</td><td align='center'>");
        echo($row['nomemeio']);
        echo("</td><td align='center'>");
        echo($row['nomeentidade']);
        echo("</td></tr>\n");
    }
    echo("</table>\n");

    $db = null;
    
    } catch (PDOException $e) {
      echo("<div align='center'><br><p>ERROR: {$e->getMessage()}</p>");
      echo("<a href='a2.php'><button class='btn btn-dark' style='background: #000000 !important;color: #ffffff' type='button'>Tente outra vez</button></a></div>");
    }
?>
    </body>
</html>
