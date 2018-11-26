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
      if ($type == "zona") {
        $result = $db->prepare("INSERT INTO zona VALUES(:moradaLocal);");
        $result->bindParam(':moradaLocal', $_REQUEST['morada']);
        $result->execute();
      } elseif ($type == "eventoEmergencia") {
        $result = $db->prepare("INSERT INTO zona VALUES(:moradaLocal);");
        $result->bindParam(':moradaLocal', $_REQUEST['morada']);
        $result->execute();

        $result = $db->prepare("INSERT INTO processoSocorro VALUES(:numProcessoSocorro);");
        $result->bindParam(':numProcessoSocorro', $_REQUEST['numprocesso']);
        $result->execute();

        $result = $db->prepare("INSERT INTO eventoEmergencia VALUES(:nomePessoa, :moradaLocal, :numProcessoSocorro, :numTelefone, :instanteChamada);");
        $result->bindParam(':nomePessoa', $_REQUEST['nome']);
        $result->bindParam(':moradaLocal', $_REQUEST['morada']);
        $result->bindParam(':numProcessoSocorro', $_REQUEST['numprocesso']);
        $result->bindParam(':numTelefone', $_REQUEST['telefone']);
        $result->bindParam(':instanteChamada', $_REQUEST['chamada']);
        $result->execute();

      } elseif($type == "processoSocorro") {
        $result = $db->prepare("INSERT INTO processoSocorro VALUES(:numProcessoSocorro);");
        $result->bindParam(':numProcessoSocorro', $_REQUEST['numprocesso']);
        $result->execute();
      }
      elseif ($type == "meio") {
        $result = $db->prepare("INSERT INTO entidadeMeio VALUES(:nomeEntidade);");
        $result->bindParam(':nomeEntidade', $_REQUEST['nomeentidade']);
        $result->execute();

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

    if ($mode == "delete") {
      if ($type == "zona") {
        $prep = $db->prepare("DELETE FROM zona WHERE moradaLocal = :morada;");
        $prep->bindParam(':morada', $_REQUEST['id']);
        $prep->execute();
      } elseif ($type == "eventoEmergencia" or $type == "processoSocorro") {
        $prep = $db->prepare("DELETE FROM processoSocorro WHERE numProcessoSocorro = :numprocesso;");
        $prep->bindParam(':numprocesso', $_REQUEST['id2']);
        $prep->execute();
      }elseif ($type == "meio" or $type == "entidade") {
        $prep = $db->prepare("DELETE FROM entidadeMeio WHERE nomeEntidade = :nomeentidade;");
        $prep->bindParam(':nomeentidade', $_REQUEST['id']);
        $prep->execute();
      }
    }

    $prep = $db->prepare("SELECT moradaLocal FROM zona;");
    $prep->execute();
    $result = $prep->fetchAll();

    echo("<br><br>");
    echo("<h1 align=\"CENTER\"><strong>Zonas</h1>\n");
    echo("<table border=\"2\" align=\"CENTER\">\n");
    echo("<tr><td><b><strong>Moradas:</b></td><td></td></tr>\n");

    foreach($result as $row) {
      echo("<tr><td align=\"CENTER\">");
      echo($row['moradalocal']);
      echo("</td><td><a href=\"a.php?mode=delete&type=zona&id={$row['moradalocal']}\">delete</a></td></tr>\n");
    }
    echo("</table>\n");

    $prep = $db->prepare("SELECT moradaLocal, numProcessoSocorro, nomePessoa, numTelefone, instanteChamada FROM eventoEmergencia;");
    $prep->execute();
    $result = $prep->fetchAll();

    echo("<br><br><br><br><br><br>");
    echo("<h1 align=\"CENTER\"><strong>Eventos de Emerg&ecirc;ncia</h1>\n");
    echo("<table border=\"2\" align=\"CENTER\">\n");
    echo("<tr><td><b><strong>Moradas:</b></td><td><b><strong>N&uacute;mero de Processo:</b></td><td><b><strong>Nome da Pessoa:</b></td><td><b><strong>N&uacute;mero de Telefone:</b></td><td><b><strong>Instante Chamada:</b></td><td></td></tr>\n");

    foreach($result as $row)
    {
        echo("<tr><td align=\"CENTER\">");
        echo($row['moradalocal']);
        echo("</td><td>");
        echo($row['numprocessosocorro']);
        echo("</td><td>");
        echo($row['nomepessoa']);
        echo("</td><td>");
        echo($row['numtelefone']);
        echo("</td><td>");
        echo($row['instantechamada']);
        echo("</td><td><a href=\"a.php?mode=delete&type=eventoEmergencia&id={$row['moradalocal']}&id2={$row['numprocessosocorro']}&id3={$row['nomepessoa']}&id4={$row['numtelefone']}&id5={$row['instantechamada']}\">delete</a></td></tr>\n");
    }
    echo("</table>\n");

    $prep = $db->prepare("SELECT numProcessoSocorro FROM processoSocorro;");
    $prep->execute();
    $result = $prep->fetchAll();

    echo("<br><br>");
    echo("<h1 align=\"CENTER\"><strong>Processos de Socorro</h1>\n");
    echo("<table border=\"2\" align=\"CENTER\">\n");
    echo("<tr><td><b><strong>Números:</b></td><td></td></tr>\n");

    foreach($result as $row)
    {
      echo("<tr><td align=\"CENTER\">");
      echo($row['numprocessosocorro']);
      echo("</td><td><a href=\"a.php?mode=delete&type=processoSocorro&id={$row['numprocessosocorro']}\">delete</a></td></tr>\n");
    }
    echo("</table>\n");

    
    $prep = $db->prepare("SELECT numMeio, nomeMeio, nomeEntidade FROM meio;");
    $prep->execute();
    $result = $prep->fetchAll();

    echo("<br><br><br><br><br><br>");
    echo("<h1 align=\"CENTER\"><strong>Meios</h1>\n");
    echo("<table border=\"2\" align=\"CENTER\">\n");
    echo("<tr><td align=\"CENTER\"><b><strong>N&uacute;mero dos Meios:</b></td><td align=\"CENTER\"><b><strong>Nome dos Meios:</b></td><td align=\"CENTER\"><b><strong>Nome das Entidades:</b></td><td></td></tr>\n");

    foreach($result as $row)
    {
        echo("<tr><td align=\"CENTER\">");
        echo($row['nummeio']);
        echo("</td><td align=\"CENTER\">");
        echo($row['nomemeio']);
        echo("</td><td align=\"CENTER\">");
        echo($row['nomeentidade']);
        echo("</td><td><a href=\"a.php?mode=delete&type=eventoEmergencia&id={$row['nummeio']}&id2={$row['nomemeio']}&id3={$row['nomeentidade']}\">delete</a></td></tr>\n");
    }
    echo("</table>\n");

    $prep = $db->prepare("SELECT nomeEntidade FROM entidadeMeio;");
    $prep->execute();
    $result = $prep->fetchAll();

    echo("<br><br>");
    echo("<h1 align=\"CENTER\"><strong>Entidades</h1>\n");
    echo("<table border=\"2\" align=\"CENTER\">\n");
    echo("<tr><td><b><strong>Nomes:</b></td><td></td></tr>\n");

    foreach($result as $row) {
      echo("<tr><td align=\"CENTER\">");
      echo($row['nomeentidade']);
      echo("</td><td><a href=\"a.php?mode=delete&type=entidade&id={$row['nomeentidade']}\">delete</a></td></tr>\n");
    }
    echo("</table>\n");

    $result = null;
    $db = null;
} catch (PDOException $e) {
  echo("<p>ERROR: {$e->getMessage()}</p>");
}
?>
      <div style="text-align:center">
        <br><br>
        <form action='a.php' method='post' style="margin-top:0px">
          <h3>Adicionar nova Zona</h3>
          <p><input type='hidden' name='mode' value='add'/></p>
          <p><input type='hidden' name='type' value='zona'/></p>
          <p>morada: <input type='text' name='morada'/></p>
          <button class="btn btn-info" type='submit' value='submit'>Submit</button>
        </form>
        <br><br>
        <form action='a.php' method='post' style="margin-top:180px">
          <h3>Adicionar novo Evento de Emerg&ecirc;ncia</h3>
          <p><input type='hidden' name='mode' value='add'/></p>
          <p><input type='hidden' name='type' value='eventoEmergencia'/></p>
          <p>nome: <input type='text' name='nome'/></p>
          <p>morada: <input type='text' name='morada'/></p>
          <p>numprocesso: <input type='number' name='numprocesso'/></p>
          <p>telefone: <input type='text' name='telefone'/></p>
          <p>chamada: <input id="chamada" type='text' name='chamada' placeholder="2018-11-18 10:00:00"/></p>
          <button class="btn btn-info" type='submit' value='submit'>Submit</button>
        </form>
        <form action='a.php' method='post'>
          <h3>Adicionar novo Processo de Socorro</h3>
          <p><input type='hidden' name='mode' value='add'/></p>
          <p><input type='hidden' name='type' value='processoSocorro'/></p>
          <p>numprocesso: <input type='number' name='numprocesso'/></p>
          <button class="btn btn-info" type='submit' value='submit'>Submit</button>
        </form>

        <form action='a.php' method='post'>
          <h3>Adicionar novo Meio</h3>
          <p><input type='hidden' name='mode' value='add'/></p>
          <p><input type='hidden' name='type' value='meio'/></p>
          <p>numMeio: <input type='number' name='nummeio'/></p>
          <p>nomeMeio: <input type='text' name='nomemeio'/></p>
          <p>nomeEntidade: <input type='text' name='nomeentidade'/></p>
          <button class="btn btn-info" type='submit' value='submit'>Sumit</button>
        </form>

        <form action='a.php' method='post'>
          <h3>Adicionar novo Meio</h3>
          <p><input type='hidden' name='mode' value='add'/></p>
          <p><input type='hidden' name='type' value='meio'/></p>
          <p>numMeio: <input type='number' name='nummeio'/></p>
          <p>nomeMeio: <input type='text' name='nomemeio'/></p>
          <p>nomeEntidade: <input type='text' name='nomeentidade'/></p>
          <button class="btn btn-info" type='submit' value='submit'>Sumit</button>
        </form>

        <form action='a.php' method='post'>
          <h3>Adicionar nova Entidade</h3>
          <p><input type='hidden' name='mode' value='add'/></p>
          <p><input type='hidden' name='type' value='entidade'/></p>
          <p>nomeEntidade: <input type='text' name='nomeentidade'/></p>
          <button class="btn btn-info" type='submit' value='submit'>Sumit</button>
        </form>


      </div>
  </body>
</html>
