<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>
  <body>
  <div style='position:fixed;left:30px;top:50px;'>
    <a href='index.html'><button class='btn btn-dark' style='background: #000000 !important;color: #ffffff' type='button'>Voltar</button></a><br><br>
  </div>
<?php
  header('Content-Type: text/html; charset=utf-8');
  try {
    include 'config.php';

    $sql = "SELECT numMeio,nomeEntidade FROM meioSocorro NATURAL JOIN acciona NATURAL JOIN eventoEmergencia;";
    $result = $db->prepare($sql);
    $result->execute();

    if ($mode == "get") {
      if ($type == "morada") {
        $result = $db->prepare("SELECT numMeio,nomeEntidade FROM meioSocorro NATURAL JOIN acciona NATURAL JOIN eventoEmergencia WHERE moradaLocal= :morada;");
        $result->bindParam(':morada', $_REQUEST['moradaLocal']);
        $result->execute();?>

        <br><br><br>
        <p align="CENTER"><strong>Meios de Socorro</p>
        <table border="1" align="CENTER">
        <tr><td><strong>N&uacute;mero dos Meios:</td><td><strong>Nome das Entidades:</td></tr>

  <?php
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
    echo("<div align='center'><br><p>ERROR: {$e->getMessage()}</p>");
    echo("<a href='f.php'><button class='btn btn-dark' style='background: #000000 !important;color: #ffffff' type='button'>Tente outra vez</button></a></div>");
  }
?>
  <div style="text-align:center">
  <br><br>
  <form action='f.php' method='post'>
    <h3>Escreve a morada local</h3>

    <p><input type='hidden' name='mode' value='get'/></p>
    <p><input type='hidden' name='type' value='morada'/></p>
    <p>morada: <input type='text' name='morada'/></p>
    <button class='btn btn-info' type='get' value='get'>Submit</button>
    </form>
  </div>
  </body>

</html>
