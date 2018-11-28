<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <meta http-equiv="content-type" content="text/html" charset="utf-8"/>
  </head>
  <body>

<?php
  try  {
    include 'config.php';
    /* ADICIONA*/
    if ($mode == "add") {
      if ($type == "meio" or $type == "entidade") {
        $result = $db->prepare("SELECT COUNT(*) AS total FROM entidadeMeio WHERE nomeEntidade = :nomeentidade;");
        $result->bindParam(':nomeentidade', $_REQUEST['nomeentidade']);
        $result->execute();  
        foreach($result as $row){
          if($row['total']<1){
            $result = $db->prepare("INSERT INTO entidadeMeio VALUES(:nomeEntidade);");
            $result->bindParam(':nomeEntidade', $_REQUEST['nomeentidade']);
            $result->execute();
          }
        }
        if($type == "meio"){
          $result = $db->prepare("INSERT INTO meio VALUES(:numMeio, :nomeMeio, :nomeEntidade);");
          $result->bindParam(':numMeio', $_REQUEST['nummeio']);
          $result->bindParam(':nomeMeio', $_REQUEST['nomemeio']);
          $result->bindParam(':nomeEntidade', $_REQUEST['nomeentidade']);
          $result->execute();
        }
      }
    }
    /* APAGA*/
    if ($mode == "delete") {
      $result = $db->prepare("SELECT COUNT(*) AS total FROM meio WHERE nomeEntidade = :nomeentidade;");
      $result->bindParam(':nomeentidade', $_REQUEST['nomeentidade']);
      $result->execute();  
      foreach($result as $row){
        if($row['total']<=1 or $type == "entidade"){
          $prep = $db->prepare("DELETE FROM entidadeMeio WHERE nomeEntidade = :nomeentidade;");
          $prep->bindParam(':nomeentidade', $_REQUEST['nomeentidade']);
          $prep->execute();
        }else{
          $result = $db->prepare("DELETE FROM meio WHERE numMeio = :nummeio AND nomeMeio = :nomemeio AND nomeEntidade = :nomeentidade;");
          $result->bindParam(':nummeio', $_REQUEST['nummeio']);
          $result->bindParam(':nomemeio', $_REQUEST['nomemeio']);
          $result->bindParam(':nomeentidade', $_REQUEST['nomeentidade']);
          $result->execute();
        }
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
        echo("</td><td><a href=\"a2.php?mode=delete&type=meio&nummeio={$row['nummeio']}&nomemeio={$row['nomemeio']}&nomeentidade={$row['nomeentidade']}\">delete</a></td></tr>\n");
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
      echo("</td><td><a href=\"a2.php?mode=delete&type=entidade&nomeentidade={$row['nomeentidade']}\">delete</a></td></tr>\n");
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
