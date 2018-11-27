<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <meta http-equiv="content-type" content="text/html" charset="utf-8"/>
  </head>
  <body>

<?php
  try  {
    include 'config.php';
    $mode = isset($_REQUEST['mode']) ? $_REQUEST['mode'] : '';
    $type = isset($_REQUEST['type']) ? $_REQUEST['type'] : '';
    $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
    $id2 = isset($_REQUEST['id2']) ? $_REQUEST['id2'] : '';
    $id3 = isset($_REQUEST['id3']) ? $_REQUEST['id3'] : '';
    $id4 = isset($_REQUEST['id4']) ? $_REQUEST['id4'] : '';
    $id5 = isset($_REQUEST['id5']) ? $_REQUEST['id5'] : '';

    /* ADICIONA*/
    if ($mode == "add") {
     if ($type == "meio") {
        $result = $db->prepare("INSERT INTO meio VALUES(:numMeio, :nomeMeio, :nomeEntidade);");
        $result->bindParam(':numMeio', $_REQUEST['nummeio']);
        $result->bindParam(':nomeMeio', $_REQUEST['nomemeio']);
        $result->bindParam(':nomeEntidade', $_REQUEST['nomeentidade']);
        $result->execute();
      } elseif ($type == "entidade") {
        $result = $db->prepare("INSERT INTO entidadeMeio VALUES(:nomeEntidade);");
        $result->bindParam(':nomeEntidade', $_REQUEST['nomeentidade']);
        $result->execute();
      }
    }
    /* APAGA*/
    if ($mode == "delete") {
      if ($type == "meio"){
        $result = $db->prepare("DELETE FROM meio WHERE numMeio = :nummeio AND nomeMeio = :nomemeio AND nomeEntidade = :nomeentidade;");
        $result->bindParam(':nummeio', $_REQUEST['id']);
        $result->bindParam(':nomemeio', $_REQUEST['id2']);
        $result->bindParam(':nomeentidade', $_REQUEST['id3']);
        $result->execute();
      }elseif ($type == "entidade"){
        $prep = $db->prepare("DELETE FROM entidadeMeio WHERE nomeEntidade = :nomeentidade;");
        $prep->bindParam(':nomeentidade', $_REQUEST['id']);
        $prep->execute();
      }
    }
    
    echo("<a href='a.html' style='position:fixed;left:30px;top:50px'><button class='btn btn-dark' style='background: #000000 !important;color: #ffffff' type='button'>Voltar</button></a><br><br>");
    /* MEIO */
    $prep = $db->prepare("SELECT numMeio, nomeMeio, nomeEntidade FROM meio;");
    $prep->execute();
    $result = $prep->fetchAll();

    echo("<br><br>");
    echo("<h1 align='center'><strong>Meios</h1>");
    echo("<table border=\"2\" border-style= 'double' align='center'>");
    echo("<tr><td align='center'><b><strong>N&uacute;mero dos Meios:</b></td><td align='center'><b><strong>Nome dos Meios:</b></td><td align='center'><b><strong>Nome das entidades:</b></td><td></td></tr>");

    foreach($result as $row)
    {
        echo("<tr><td align='center'>");
        echo($row['nummeio']);
        echo("</td><td align='center'>");
        echo($row['nomemeio']);
        echo("</td><td align='center'>");
        echo($row['nomeentidade']);
        echo("</td><td><a href=\"a2.php?mode=delete&type=meio&id={$row['nummeio']}&id2={$row['nomemeio']}&id3={$row['nomeentidade']}\">delete</a></td></tr>\n");
    }
    echo("</table><br><br>");
    echo("<form align='center' action='a2.php' method='post'>");
    echo("<input type='hidden' name='mode' value='add'/>");
    echo("<input type='hidden' name='type' value='meio'/>");
    echo("<input type='number' name='nummeio' placeholder='N&uacute;mero meio'/><br><br>");
    echo("<input type='text' name='nomemeio' placeholder='Nome meio'/><br><br>");
    echo("<input type='text' name='nomeentidade' placeholder='Nome entidade'/><br><br>");
    echo("<button class='btn btn-info' type='submit' value='submit'>Sumit</button>");
    echo("</form>");

    /* ENTIDADE MEIO*/
    $prep = $db->prepare("SELECT nomeEntidade FROM entidadeMeio;");
    $prep->execute();
    $result = $prep->fetchAll();

    echo("<br><br>");
    echo("<h1 align='center'><strong>Entidades</h1>");
    echo("<table border=\"2\" border-style= 'double' align='center'>");
    echo("<tr><td><b><strong>Nomes:</b></td><td></td></tr>");

    foreach($result as $row) {
      echo("<tr><td align='center'>");
      echo($row['nomeentidade']);
      echo("</td><td><a href=\"a2.php?mode=delete&type=entidade&id={$row['nomeentidade']}\">delete</a></td></tr>\n");
    }
    echo("</table>");
    echo("<br><br>");
    echo("<form align='center' action='a2.php' method='post'>");
    echo("<input type='hidden' name='mode' value='add'/>");
    echo("<input type='hidden' name='type' value='entidade'/>");
    echo("<input type='text' name='nomeentidade' placeholder='Nome entidade'/><br><br>");
    echo("<button class='btn btn-info' type='submit' value='submit'>Sumit</button>");
    echo("</form><br><br>");

    $result = null;
    $db = null;
} catch (PDOException $e) {
  echo("<p>ERROR: {$e->getMessage()}</p>");
}
?>
  </body>
</html>
