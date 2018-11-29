<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <meta http-equiv="content-type" content="text/html" charset="utf-8"/>
  </head>
  <body>
  <div style='position:fixed;left:30px;top:50px;'>
  <a href='a.html'><button class='btn btn-dark' style='background: #000000 !important;color: #ffffff' type='button'>Voltar</button></a><br><br>
    <form action='a1.php' method='post'>
      <h3>Nova Zona:<br></h3>
      <input type='hidden' name='mode' value='add'/>
      <input type='hidden' name='type' value='zona'/>
      <input type='text' name='morada' placeholder='Morada'/><br><br>
      <button class='btn btn-info' type='submit' value='submit'>Submit</button>
    </form><br>
    <form action='a1.php' method='post'>
      <h3>Novo Evento de Emergência:<br></h3>
      <input type='hidden' name='mode' value='add'/>
      <input type='hidden' name='type' value='eventoEmergencia'/>
      <input type='text' name='nome'placeholder='Nome'/><br><br>
      <input type='text' name='morada' placeholder='Morada'/><br><br>
      <input type='number' name='numprocesso' placeholder='N&uacute;mero de processo'/><br><br>
      <input type='text' name='telefone' placeholder='Telefone'/><br><br>
      <input type='text' name='chamada' placeholder='2018-11-18 10:00:00'/><br><br>
      <button class='btn btn-info' type='submit' value='submit'>Submit</button>
    </form><br>
      <form action='a1.php' method='post'>
      <h3>Novo Processo de Socorro:<br></h3>
      <input type='hidden' name='mode' value='add'/>
      <input type='hidden' name='type' value='processoSocorro'/>
      <input type='number' name='numprocesso' placeholder='N&uacute;mero de processo'/><br><br>
      <button class='btn btn-info' type='submit' value='submit'>Submit</button><br><br>
    </form>
  </div>

<?php
  try  {
    include 'config.php';
    /* ADICIONA*/
    if ($mode == "add") {
      if($type=='zona'){
        $result = $db->prepare("INSERT INTO zona VALUES(:moradaLocal);");
        $result->bindParam(':moradaLocal', $_REQUEST['morada']);
        $result->execute();
      }
      elseif($type == "eventoEmergencia"){
        $result = $db->prepare("SELECT COUNT(*) AS total FROM zona WHERE moradaLocal = :morada;");
        $result->bindParam(':morada', $_REQUEST['morada']);
        $result->execute();  
        foreach($result as $row){
          if($row['total']<1){
            $result = $db->prepare("INSERT INTO zona VALUES(:moradaLocal);");
            $result->bindParam(':moradaLocal', $_REQUEST['morada']);
            $result->execute();
          }
        }
        $result = $db->prepare("SELECT COUNT(*) AS total FROM processoSocorro WHERE numProcessoSocorro = :numprocesso;");
        $result->bindParam(':numprocesso', $_REQUEST['numprocesso']);
        $result->execute();  
        foreach($result as $row){
          if($row['total']<1){
            $result = $db->prepare("INSERT INTO processoSocorro VALUES(:numProcessoSocorro);");
            $result->bindParam(':numProcessoSocorro', $_REQUEST['numprocesso']);
            $result->execute();
          }
        } 
        $result = $db->prepare("INSERT INTO eventoEmergencia VALUES(:nomePessoa, :moradaLocal, :numProcessoSocorro, :numTelefone, :instanteChamada);");
        $result->bindParam(':nomePessoa', $_REQUEST['nome']);
        $result->bindParam(':moradaLocal', $_REQUEST['morada']);
        $result->bindParam(':numProcessoSocorro', $_REQUEST['numprocesso']);
        $result->bindParam(':numTelefone', $_REQUEST['telefone']);
        $result->bindParam(':instanteChamada', $_REQUEST['chamada']);
        $result->execute();
      }elseif($type=='processoSocorro'){
        $result = $db->prepare("INSERT INTO processoSocorro VALUES(:numProcessoSocorro);");
        $result->bindParam(':numProcessoSocorro', $_REQUEST['numprocesso']);
        $result->execute();
      }
   }
    /* APAGA*/
    elseif ($mode == "delete") {
      if ($type == "zona") {
        $prep = $db->prepare("DELETE FROM zona WHERE moradaLocal = :morada;");
        $prep->bindParam(':morada', $_REQUEST['morada']);
        $prep->execute();
      } elseif ($type == "eventoEmergencia" or $type == "processoSocorro") {
        $result = $db->prepare("SELECT COUNT(*) AS total FROM eventoEmergencia WHERE numProcessoSocorro = :numprocesso;");
        $result->bindParam(':numprocesso', $_REQUEST['numprocesso']);
        $result->execute();  
        foreach($result as $row){
          if($row['total']<=1 or $type == "processoSocorro"){
            $prep = $db->prepare("DELETE FROM processoSocorro WHERE numProcessoSocorro = :numprocesso;");
            $prep->bindParam(':numprocesso', $_REQUEST['numprocesso']);
            $prep->execute();
          }
          else{
            $prep = $db->prepare("DELETE FROM eventoEmergencia WHERE numTelefone = :telefone;");
            $prep->bindParam(':telefone', $_REQUEST['telefone']);
            $prep->execute();
          }
      }
    }
  }
    /* ZONA */
    $prep = $db->prepare("SELECT moradaLocal FROM zona;");
    $prep->execute();
    $result = $prep->fetchAll();

    echo("<div style='margin-left:50px'><br><br><h1 align='center'><strong>Zonas</h1>\n");
    echo("<table border=\"2\" align='center'>");
    echo("<tr><td><b><strong>Moradas:</b></td><td></td></tr>");

    foreach($result as $row) {
      echo("<tr><td align='center'>");
      echo($row['moradalocal']);
      echo("</td><td><a href=\"a1.php?mode=delete&type=zona&morada={$row['moradalocal']}\">Delete</a></td></tr>\n");
    }
    echo("</table><br><br>");

    /* EVENTO EMERGENCIA*/
    $prep = $db->prepare("SELECT moradaLocal, numProcessoSocorro, nomePessoa, numTelefone, instanteChamada FROM eventoEmergencia;");
    $prep->execute();
    $result = $prep->fetchAll();

    echo("<h1 align='center'><strong>Eventos de Emerg&ecirc;ncia</h1>\n");
    echo("<table border=\"2\" align='center'>");
    echo("<tr><td><b><strong>N&uacute;mero de Processo:</b></td><td><b><strong>Moradas:</b></td><td><b><strong>Nome da Pessoa:</b></td><td><b><strong>N&uacute;mero de Telefone:</b></td><td><b><strong>Instante Chamada:</b></td><td></td></tr>\n");

    foreach($result as $row)
    {
        echo("<tr><td align='center'>");
        echo($row['numprocessosocorro']);
        echo("</td><td align='center'>");
        echo($row['moradalocal']);
        echo("</td><td align='center'>");
        echo($row['nomepessoa']);
        echo("</td><td align='center'>");
        echo($row['numtelefone']);
        echo("</td><td align='center'>");
        echo($row['instantechamada']);
        echo("</td><td><a href=\"a1.php?mode=delete&type=eventoEmergencia&numprocesso={$row['numprocessosocorro']}&morada={$row['moradalocal']}&nome={$row['nomepessoa']}&telefone={$row['numtelefone']}&chamada={$row['instantechamada']}\">Delete</a></td></tr>\n");
    }
    echo("</table><br><br>");

    /* PROCESSO SOCORRO */
    $prep = $db->prepare("SELECT numProcessoSocorro FROM processoSocorro;");
    $prep->execute();
    $result = $prep->fetchAll();

    echo("<br><br>");
    echo("<h1 align='center'><strong>Processos de Socorro</h1>\n");
    echo("<table border=\"2\" align='center'>");
    echo("<tr><td><b><strong>Números:</b></td><td></td></tr>");

    foreach($result as $row)
    {
      echo("<tr><td align='center'>");
      echo($row['numprocessosocorro']);
      echo("</td><td><a href=\"a1.php?mode=delete&type=processoSocorro&numprocesso={$row['numprocessosocorro']}\">Delete</a></td></tr>\n");
    }
    echo("</table></div><br><br>");

    $result = null;
    $db = null;
} catch (PDOException $e) {
  echo("<div align='center'><br><p>ERROR: {$e->getMessage()}</p>");
  echo("<a href='a1.php'><button class='btn btn-dark' style='background: #000000 !important;color: #ffffff' type='button'>Tente outra vez</button></a></div>");
}
?>
  </body>
</html>
