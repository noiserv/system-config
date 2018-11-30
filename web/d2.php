<html>
  <head>
    <meta http-equiv="content-type" content="text/html" charset="utf-8"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>
  <body>
    <div style='position:fixed;left:30px;top:50px;'>
    <a href='d.html'><button class='btn btn-dark' style='background: #000000 !important;color: #ffffff' type='button'>Voltar</button></a><br><br>
  </div>

<?php
  try {
    include 'config.php';

    /**
     * requests processing
     **/
    $mode = isset($_REQUEST['mode']) ? $_REQUEST['mode'] : '';

    if ($mode == "add") {
      /* Debugging
      echo($_REQUEST['numProcessoSocorro']."\n");
      echo($_REQUEST['numtelefone']."\n");
      echo($_REQUEST['instantechamada']."\n");*/
      $result = $db->prepare("UPDATE eventoEmergencia SET numProcessoSocorro = :numProcessoSocorro WHERE numTelefone = :numTelefone AND instanteChamada = :instanteChamada;");
      $result->bindParam(':numProcessoSocorro', $_REQUEST['numProcessoSocorro']);
      $result->bindParam(':numTelefone', $_REQUEST['numtelefone']);
      $result->bindParam(':instanteChamada', $_REQUEST['instantechamada']);
      $result->execute();

    }



    // eventos de emergencia com respetivos processos de socorro
    // IMPORTANTE numProcessoSocorro pode ser NULL
    $sql = "SELECT numTelefone, moradaLocal,nomePessoa, instanteChamada, numProcessoSocorro FROM eventoEmergencia;";
    $result = $db->prepare($sql);
    $result->execute();
  ?>
    <div style='margin-left:300px;text-align:center; max-width:800px'>
    <h1 align='center'><strong>Associa&ccedil;&otilde;es Atuais</h1>
    <table border='1' align='center'>
    <tr><td align='center'><strong>N&uacute;mero de Telefone</td><td align='center'><strong>Morada</td><td align='center'><strong>Nome</td><td align='center'><strong>Instante chamada</td><td align='center'><strong>N&uacute;mero do Processo</td><td align='center'><strong> Novo N&uacute;mero do Processo</td></tr>

  <?php
    foreach($result as $row)
    {
      echo("<tr><td align='center'>");
      echo($row['numtelefone']);
      echo("</td><td align='center'>");
      echo($row['moradalocal']);
      echo("</td><td align='center'>");
      echo($row['nomepessoa']);
      echo("</td><td align='center'>");
      echo($row['instantechamada']);
      echo("</td><td align='center'>");
      echo($row['numprocessosocorro']);
      echo("</td><td align='center'>");
      $sql = "SELECT numProcessoSocorro FROM processoSocorro;";
      $result_soc = $db->prepare($sql);
      $result_soc->execute();
      echo("<form action='d2.php' method='post'>");
      echo("<input type='hidden' name='mode' value='add'/>");

      // hidden values of the other fields
      echo("<input type='hidden' name='numtelefone' value='".$row['numtelefone']."'/>");
      echo("<input type='hidden' name='instantechamada' value='".$row['instantechamada']."'/>");

      echo("<br><input type='hidden' name='mode' value='add'/>");
      echo("<select name='numProcessoSocorro'/>");
      foreach($result_soc as $row_soc) {
        echo("<option value=".$row_soc['numprocessosocorro'].">".$row_soc['numprocessosocorro']."</option>");
      }
      echo("</select>");
      echo("<br><br><button class='btn btn-info' type='submit' value='submit'>Submit</button>");
      echo("</form>");
      echo("</td></tr>\n");
    }
    echo("</table>\n");

    $db = null;

  } catch (PDOException $e) {
    echo("<div align='center'><br><p>ERROR: {$e->getMessage()}</p></div>");
  }
?>
      <br><br>


    </div>
  </body>
</html>
