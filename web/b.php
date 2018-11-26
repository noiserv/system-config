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


    if ($mode == "add") {
      if ($type == "combate") {
          $result = $db->prepare("INSERT INTO meioCombate VALUES(:nMeio,:nEntidade);");
          $result->bindParam(':nMeio', $_REQUEST['nummeio']);
          $result->bindParam(':nEntidade', $_REQUEST['nomeentidade']);
          $result->execute();

        }
        elseif ($type == "apoio") {
            $result = $db->prepare("INSERT INTO meioApoio VALUES(:nMeio,:nEntidade);");
            $result->bindParam(':nMeio', $_REQUEST['nummeio']);
            $result->bindParam(':nEntidade', $_REQUEST['nomeentidade']);
            $result->execute();
          }
        elseif ($type == "socorro") {
              $result = $db->prepare("INSERT INTO meioCombate VALUES(:nMeio,:nEntidade);");
              $result->bindParam(':nMeio', $_REQUEST['nummeio']);
              $result->bindParam(':nEntidade', $_REQUEST['nomeentidade']);
              $result->execute();
            }
      }


    elseif ($mode == "delete") {
      if ($type == "combate"){// or $type == "entidade") {
        $prep = $db->prepare("DELETE FROM meioCombate WHERE nomeEntidade = :nomeentidade AND numMeio =:nummeio;");
        $prep->bindParam(':nummeio', $_REQUEST['id']);
        $prep->bindParam(':nomeentidade', $_REQUEST['id2']);
        $prep->execute();
      }
      elseif ($type == "apoio"){// or $type == "entidade") {
        $prep = $db->prepare("DELETE FROM meioApoio WHERE nomeEntidade = :nomeentidade AND numMeio =:nummeio;");
        $prep->bindParam(':nummeio', $_REQUEST['id']);
        $prep->bindParam(':nomeentidade', $_REQUEST['id2']);
        $prep->execute();
      }
      elseif ($type == "socorro"){// or $type == "entidade") {
        $prep = $db->prepare("DELETE FROM meioCombate WHERE nomeEntidade = :nomeentidade AND numMeio =:nummeio;");
        $prep->bindParam(':nummeio', $_REQUEST['id']);
        $prep->bindParam(':nomeentidade', $_REQUEST['id2']);
        $prep->execute();
      }
    } elseif ($mode == "edit") {
        if ($type == "combate"){// or $type == "entidade") {
          $prep = $db->prepare("DELETE FROM meioCombate WHERE nomeEntidade = :nomeentidade AND numMeio =:nummeio;");
          $prep->bindParam(':nummeio', $_REQUEST['nummeioa']);
          $prep->bindParam(':nomeentidade', $_REQUEST['nomeentidadea']);
          $prep->execute();
          $result = $db->prepare("INSERT INTO meioCombate VALUES(:nmeio,:nentidade);");
          $result->bindParam(':nmeio', $_REQUEST['nummeion']);
          $result->bindParam(':nentidade', $_REQUEST['nomeentidaden']);
          $result->execute();

        }
      }



    $prep = $db->prepare("SELECT numMeio,nomeMeio,nomeEntidade FROM meio;");
    $prep->execute();
    $result = $prep->fetchAll();

    echo("<br><br>");
    echo("<h1 align='center'><strong>Usar os valores da tabela Meios ao criar os novos meios.</h1>");
    echo("<h2 align='center'><strong>Meios:</h2>");
    echo("<table border=\"1\" align=\"CENTER\">\n");
    echo("<tr><td><strong>N&uacute;mero dos Meios:</td><td><strong>Nome dos Meios:</td><td><strong>Nome das Entidades:</td></tr>\n");

    foreach($result as $row) {
      echo("<tr><td align=\"CENTER\">");
      echo($row['nummeio']);
      echo("</td><td align=\"CENTER\">");
      echo($row['nomemeio']);
      echo("</td><td align=\"CENTER\">");
      echo($row['nomeentidade']);
      echo("</td></tr>\n");
    }
    echo("</table>\n");

    $prep = $db->prepare("SELECT numMeio,nomeEntidade FROM meioCombate;");
    $prep->execute();
    $result = $prep->fetchAll();

    echo("<br><br>");
    echo("<h1 align='center'><strong>Meios de Combate</h1>");
    echo("<table border=\"2\" align=\"CENTER\">\n");
    echo("<tr><td><strong>N&uacute;mero dos Meios:</td><td><strong>Nome das Entidades:</td></tr>\n");

    foreach($result as $row) {
      echo("<tr><td align=\"CENTER\">");
      echo($row['nummeio']);
      echo("</td><td align=\"CENTER\">");
      echo($row['nomeentidade']);
      echo("</td><td><a href=\"b.php?mode=delete&type=combate&id={$row['nummeio']}&id2={$row['nomeentidade']}\">delete</a></td></tr>\n");
      echo("</td></tr>\n");
    }
    echo("</table>\n");
    echo("<br><br><br>");
    echo("<form align='center' action='b.php' method='post'>");
    echo("<input type='hidden' name='mode' value='add'/>");
    echo("<input type='hidden' name='type' value='combate'/>");
    echo("<input type='text' name='nummeio' placeholder='N&uacute;mero do Meio'/><br><br>");
    echo("<input type='text' name='nomeentidade' placeholder='Nome da Entidade'/><br><br>");
    echo("<button class='btn btn-info' type='submit' value='submit'>Add</button>");
    echo("<br><br>");
    echo("</form>");
    echo("<form align='center' action='b.php' method='post'>");
    echo("<input type='hidden' name='mode' value='edit'/>");
    echo("<input type='hidden' name='type' value='combate'/>");
    echo("<div><input type='text' name='nummeioa' placeholder='N&uacute;mero do Meio Atual'/><input type='text' name='nummeion' placeholder='Novo N&uacute;mero do Meio'/></div><br><br>");
    echo("<div><input type='text' name='nomeentidadea' placeholder='Nome da Entidade Atual'/><input type='text' name='nomeentidaden' placeholder='Novo Nome da Entidade'/></div><br><br>");
    echo("<button class='btn btn-info' type='edit' value='edit'>Edit</button>");
    echo("</form>");


    $prep = $db->prepare("SELECT numMeio,nomeEntidade FROM meioApoio;");
    $prep->execute();
    $result = $prep->fetchAll();

    echo("<br><br>");
    echo("<h1 align='center'><strong>Meios de Apoio</h1>");
    echo("<table border=\"2\" align=\"CENTER\">\n");
    echo("<tr><td><strong>N&uacutemero dos Meios:</td><td><strong>Nome das Entidades:</td></tr>\n");

    foreach($result as $row) {
      echo("<tr><td align=\"CENTER\">");
      echo($row['nummeio']);
      echo("</td><td align=\"CENTER\">");
      echo($row['nomeentidade']);
      echo("</td><td><a href=\"b.php?mode=delete&type=apoio&id={$row['nummeio']}&id2={$row['nomeentidade']}\">delete</a></td></tr>\n");
      echo("</td></tr>\n");
    }
    echo("</table>\n");
    echo("<br><br><br>");
    echo("<form align='center' action='b.php' method='post'>");
    echo("<input type='hidden' name='mode' value='add'/>");
    echo("<input type='hidden' name='type' value='apoio'/>");
    echo("<input type='text' name='nummeio' placeholder='N&uacute;mero do Meio'/><br><br>");
    echo("<input type='text' name='nomeentidade' placeholder='Nome da Entidade'/><br><br>");
    echo("<button class='btn btn-info' type='submit' value='submit'>Add</button>");
    echo("</form>");

    $prep = $db->prepare("SELECT  numMeio,nomeEntidade FROM meioSocorro;");
    $prep->execute();
    $result = $prep->fetchAll();

    echo("<br><br>");
    echo("<h1 align='center'><strong>Meios de Socorro</h1>");
    echo("<table border=\"2\" align=\"CENTER\">\n");
    echo("<tr><td><strong>N&uacutemero dos Meios:</td><td><strong>Nome das Entidades:</td></tr>\n");

    foreach($result as $row) {
      echo("<tr><td align=\"CENTER\">");
      echo($row['nummeio']);
      echo("</td><td align=\"CENTER\">");
      echo($row['nomeentidade']);
      echo("</td><td><a href=\"b.php?mode=delete&type=socorro&id={$row['nummeio']}&id2={$row['nomeentidade']}\">delete</a></td></tr>\n");
      echo("</td></tr>\n");
    }
    echo("</table>\n");
    echo("<br><br><br>");
    echo("<form align='center' action='b.php' method='post'>");
    echo("<input type='hidden' name='mode' value='add'/>");
    echo("<input type='hidden' name='type' value='socorro'/>");
    echo("<input type='text' name='nummeio' placeholder='N&uacute;mero do Meio'/><br><br>");
    echo("<input type='text' name='nomeentidade' placeholder='Nome da Entidade'/><br><br>");
    echo("<button class='btn btn-info' type='submit' value='submit'>Add</button>");
    echo("</form>");
    echo("<br><br>");

    echo("<a href='http://web.tecnico.ulisboa.pt/ist186474/testing/index.html'><div style='text-align:center'><button  class='btn btn-info' type='submit' value='Again'>Voltar</button></div></a>");

    $result = null;
    $db = null;

} catch (PDOException $e) {
  echo("<p>VALORES INV&Aacute;LIDOS: {$e->getMessage()}</p>");
  echo("<a href='http://web.tecnico.ulisboa.pt/ist186474/testing/b.php'> <button  class='btn btn-info' type='submit' value='Again'>Again</button></a>");
}
?>
      <div style="text-align:center">
        <br><br>




      </div>
  </body>
</html>
