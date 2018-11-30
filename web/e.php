<html>
  <head>
    <meta http-equiv="content-type" content="text/html" charset="utf-8"/>
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

    $sql = "SELECT numMeio,nomeEntidade FROM acciona;";
    $result = $db->prepare($sql);
    $result->execute();

    if ($mode == "find") {
      if ($type == "numprocesso") {
        $result = $db->prepare("SELECT numMeio,nomeEntidade FROM acciona WHERE numProcessoSocorro= :num;");
        $result->bindParam(':num', $_REQUEST['numProcc']);
        $result->execute();
      ?>
        <br><br><br>
        <p align="CENTER"><strong>Meios</p>
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
      }
    }

    $result = null;
    $db = null;
  } catch (PDOException $e) {
    echo("<div align='center'><br><p>ERROR: {$e->getMessage()}</p>");
    echo("<a href='e.php'><button class='btn btn-dark' style='background: #000000 !important;color: #ffffff' type='button'>Tente outra vez</button></a></div>");
    
  }
?>
  <div style="text-align:center">
    <br><br>
    <form action='e.php' method='post'>
      <h3>Escreve o num do processo de socorro</h3>
      <p><input type='hidden' name='mode' value='find'/></p>
      <p><input type='hidden' name='type' value='numprocesso'/></p>
      <p>numProcesso: <input type='text' name='numProcc'/></p>
      <button class='btn btn-info' type='find' value='find'>Submit</button>
    </form>
  </div>
  </body>
</html>
