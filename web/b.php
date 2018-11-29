<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <meta http-equiv="content-type" content="text/html" charset="utf-8"/>
  </head>
  <body>

  <form id='input' style="display:none;text-align:center" action='b.php' method='post'>
    <br><h3>Novo Meio:<br></h3>
    <input type='hidden' name='mode' value='add'/>
    <input type='hidden' name='type' value='meio'/>
    <input type='number' name='nummeio' placeholder='N&uacute;mero meio'/><br><br>
    <input type='text' name='nomemeio' placeholder='Nome meio'/><br><br>
    <input type='text' name='nomeentidade' placeholder='Nome entidade'/><br><br>
    <button class='btn btn-info' type='submit' value='submit'>Sumit</button><br>
  </form>


  <div style='position:fixed;left:30px;top:50px'>
  <a href='index.html'><button class='btn btn-dark' style='background: #000000 !important;color: #ffffff' type='button'>Voltar</button></a><br><br>
    <form action='b.php' method='post'>
      <h3>Novo Meio de Combate:<br></h3>
      <input type='hidden' name='mode' value='add'/>
      <input type='hidden' name='type' value='combate'/>
      <input type='text' name='nummeio' placeholder='N&uacute;mero do Meio'/><br><br>
      <input type='text' name='nomeentidade' placeholder='Nome da Entidade'/><br><br>
      <button class='btn btn-info' type='submit' value='submit'>Submit</button>
    </form><br>
    <form action='b.php' method='post'>
      <h3>Novo Meio de Apoio:<br></h3>
      <input type='hidden' name='mode' value='add'/>
      <input type='hidden' name='type' value='apoio'/>
      <input type='text' name='nummeio' placeholder='N&uacute;mero do Meio'/><br><br>
      <input type='text' name='nomeentidade' placeholder='Nome da Entidade'/><br><br>
      <button class='btn btn-info' type='submit' value='submit'>Submit</button>
    </form><br>
    <form action='b.php' method='post'>
      <h3>Novo Meio de Socorro:<br></h3>
      <input type='hidden' name='mode' value='add'/>
      <input type='hidden' name='type' value='socorro'/>
      <input type='text' name='nummeio' placeholder='N&uacute;mero do Meio'/><br><br>
      <input type='text' name='nomeentidade' placeholder='Nome da Entidade'/><br><br>
      <button class='btn btn-info' type='submit' value='submit'>Submit</button>
    </form>
  </div>

<?php
  try  {
    include 'config.php';
    /* ADICIONA*/
    if ($mode == "add") {
      if ($type == "combate") {
        $prep = $db->prepare("SELECT COUNT(*) AS total FROM meio WHERE numMeio = :nMeio AND nomeEntidade = :nEntidade;");
        $prep->bindParam(':nMeio', $_REQUEST['nummeio']);
        $prep->bindParam(':nEntidade', $_REQUEST['nomeentidade']);
        $prep->execute(); 
        foreach($prep as $row){
          if($row[total]<1){
            echo("<script type='text/javascript'>alert('ERRO: meio não existe. Insira-o!');</script>");
            ?>
            <script>
            document.getElementById("input").style.display = 'block';
            </script>
            <?php
            }
          else{
            $result = $db->prepare("INSERT INTO meioCombate VALUES(:nMeio,:nEntidade);");
            $result->bindParam(':nMeio', $_REQUEST['nummeio']);
            $result->bindParam(':nEntidade', $_REQUEST['nomeentidade']);
            $result->execute(); 
          }
        }
      }
      elseif($type=='meio'){include 'meio.php';}
      elseif ($type == "apoio") {
        $prep = $db->prepare("SELECT COUNT(*) AS total FROM meio WHERE numMeio = :nMeio AND nomeEntidade = :nEntidade;");
        $prep->bindParam(':nMeio', $_REQUEST['nummeio']);
        $prep->bindParam(':nEntidade', $_REQUEST['nomeentidade']);
        $prep->execute(); 
        foreach($prep as $row){
          if($row[total]<1){
            echo("<script type='text/javascript'>alert('ERRO: meio não existe. Insira-o!');</script>");
            }
          else{
            $result = $db->prepare("INSERT INTO meioApoio VALUES(:nMeio,:nEntidade);");
            $result->bindParam(':nMeio', $_REQUEST['nummeio']);
            $result->bindParam(':nEntidade', $_REQUEST['nomeentidade']);
            $result->execute(); 
          }
        }
      }
      elseif ($type == "socorro") {
        $prep = $db->prepare("SELECT COUNT(*) AS total FROM meio WHERE numMeio = :nMeio AND nomeEntidade = :nEntidade;");
        $prep->bindParam(':nMeio', $_REQUEST['nummeio']);
        $prep->bindParam(':nEntidade', $_REQUEST['nomeentidade']);
        $prep->execute(); 
        foreach($prep as $row){
          if($row[total]<1){
            echo "<script type='text/javascript'>alert('ERRO: meio não existe. Insira-o!');</script>";
            }
          else{
            $result = $db->prepare("INSERT INTO meioSocorro VALUES(:nMeio,:nEntidade);");
            $result->bindParam(':nMeio', $_REQUEST['nummeio']);
            $result->bindParam(':nEntidade', $_REQUEST['nomeentidade']);
            $result->execute(); 
          }
        }
      }
    }
  /* APAGA*/
  elseif ($mode == "delete") {
      if ($type == "combate"){
        $prep = $db->prepare("SELECT COUNT(*) AS total FROM meioCombate WHERE numMeio = :nMeio AND nomeEntidade = :nEntidade;");
        $prep->bindParam(':nMeio', $_REQUEST['nummeio']);
        $prep->bindParam(':nEntidade', $_REQUEST['nomeentidade']);
        $prep->execute(); 
        foreach($prep as $row){
          if($row['total']<=1){
            $prep = $db->prepare("DELETE FROM meio WHERE nomeEntidade = :nomeentidade AND numMeio =:nummeio;");
            $prep->bindParam(':nummeio', $_REQUEST['id']);
            $prep->bindParam(':nomeentidade', $_REQUEST['id2']);
            $prep->execute();
          }else{
            $prep = $db->prepare("DELETE FROM meioCombate WHERE nomeEntidade = :nomeentidade AND numMeio =:nummeio;");
            $prep->bindParam(':nummeio', $_REQUEST['id']);
            $prep->bindParam(':nomeentidade', $_REQUEST['id2']);
            $prep->execute();
          }
        }
      }
      elseif ($type == "apoio"){
        $prep = $db->prepare("SELECT COUNT(*) AS total FROM meioApoio WHERE numMeio = :nMeio AND nomeEntidade = :nEntidade;");
        $prep->bindParam(':nMeio', $_REQUEST['nummeio']);
        $prep->bindParam(':nEntidade', $_REQUEST['nomeentidade']);
        $prep->execute(); 
        foreach($prep as $row){
          if($row['total']<=1){
            $prep = $db->prepare("DELETE FROM meio WHERE nomeEntidade = :nomeentidade AND numMeio =:nummeio;");
            $prep->bindParam(':nummeio', $_REQUEST['id']);
            $prep->bindParam(':nomeentidade', $_REQUEST['id2']);
            $prep->execute();
          }else{
            $prep = $db->prepare("DELETE FROM meioApoio WHERE nomeEntidade = :nomeentidade AND numMeio =:nummeio;");
            $prep->bindParam(':nummeio', $_REQUEST['id']);
            $prep->bindParam(':nomeentidade', $_REQUEST['id2']);
            $prep->execute();
          }
        }
      }
      elseif ($type == "socorro"){
        $prep = $db->prepare("SELECT COUNT(*) AS total FROM meioSocorro WHERE numMeio = :nMeio AND nomeEntidade = :nEntidade;");
        $prep->bindParam(':nMeio', $_REQUEST['nummeio']);
        $prep->bindParam(':nEntidade', $_REQUEST['nomeentidade']);
        $prep->execute(); 
        foreach($prep as $row){
          if($row['total']<=1){
            $prep = $db->prepare("DELETE FROM meio WHERE nomeEntidade = :nomeentidade AND numMeio =:nummeio;");
            $prep->bindParam(':nummeio', $_REQUEST['id']);
            $prep->bindParam(':nomeentidade', $_REQUEST['id2']);
            $prep->execute();
          }else{
            $prep = $db->prepare("DELETE FROM meioSocorro WHERE nomeEntidade = :nomeentidade AND numMeio =:nummeio;");
            $prep->bindParam(':nummeio', $_REQUEST['id']);
            $prep->bindParam(':nomeentidade', $_REQUEST['id2']);
            $prep->execute();
          }
        }
      }
    }
    /*  MEIO */
    $prep = $db->prepare("SELECT numMeio,nomeMeio,nomeEntidade FROM meio;");
    $prep->execute();
    $result = $prep->fetchAll();

    echo("<div style='margin-left:50px'><h1 align='center'><strong>Meios:</h1>");
    echo("<table border=\"2\" align='center'>\n");
    echo("<tr><td><strong>N&uacute;mero dos Meios:</td><td><strong>Nome dos Meios:</td><td><strong>Nome das Entidades:</td></tr>\n");

    foreach($result as $row) {
      echo("<tr><td align='center'>");
      echo($row['nummeio']);
      echo("</td><td align='center'>");
      echo($row['nomemeio']);
      echo("</td><td align='center'>");
      echo($row['nomeentidade']);
      echo("</td></tr>\n");
    }
    echo("</table><br><br>");

    /* MEIOCOMBATE */
    $prep = $db->prepare("SELECT numMeio,nomeEntidade FROM meioCombate;");
    $prep->execute();
    $result = $prep->fetchAll();

    echo("<br><br>");
    echo("<h1 align='center'><strong>Meios de Combate</h1>");
    echo("<table border=\"2\" align='center'>\n");
    echo("<tr><td><strong>N&uacute;mero dos Meios:</td><td><strong>Nome das Entidades:</td><td></td><td></td></tr>\n");

    foreach($result as $row) {
      echo("<tr><td align='center'>");
      echo($row['nummeio']);
      echo("</td><td align='center'>");
      echo($row['nomeentidade']);
      echo("<td><a href=\"bchange.php?mode=edit&type=combate&num_meio={$row['nummeio']}&nome_entidade={$row['nomeentidade']}\">Editar meio</a></td>\n");
      echo("</td><td><a href=\"b.php?mode=delete&type=combate&id={$row['nummeio']}&id2={$row['nomeentidade']}\">Delete</a></td>\n");
      echo("</tr>\n");
    }
    echo("</table>\n");
    echo("<br><br>");

    /* MEIOAPOIO */
    $prep = $db->prepare("SELECT numMeio,nomeEntidade FROM meioApoio;");
    $prep->execute();
    $result = $prep->fetchAll();

    echo("<br><br>");
    echo("<h1 align='center'><strong>Meios de Apoio</h1>");
    echo("<table border=\"2\" align='center'>\n");
    echo("<tr><td><strong>N&uacute;mero dos Meios:</td><td><strong>Nome das Entidades:</td><td></td><td></td></tr>\n");

    foreach($result as $row) {
      echo("<tr><td align='center'>");
      echo($row['nummeio']);
      echo("</td><td align='center'>");
      echo($row['nomeentidade']);
      echo("<td><a href=\"bchange.php?mode=edit&type=apoio&num_meio={$row['nummeio']}&nome_entidade={$row['nomeentidade']}\">Editar meio</a></td>\n");
      echo("</td><td><a href=\"b.php?mode=delete&type=apoio&id={$row['nummeio']}&id2={$row['nomeentidade']}\">Delete</a></td>\n");
      echo("</tr>\n");
    }

    echo("</table>");
    echo("<br><br>");

    /* MEIOSOCORRO */
    $prep = $db->prepare("SELECT numMeio,nomeEntidade FROM meioSocorro;");
    $prep->execute();
    $result = $prep->fetchAll();

    echo("<br><br>");
    echo("<h1 align='center'><strong>Meios de Socorro</h1>");
    echo("<table border=\"2\" align='center'>\n");
    echo("<tr><td><strong>N&uacute;mero dos Meios:</td><td><strong>Nome das Entidades:</td><td></td><td></td></tr>\n");

    foreach($result as $row) {
      echo("<tr><td align='center'>");
      echo($row['nummeio']);
      echo("</td><td align='center'>");
      echo($row['nomeentidade']);
      echo("<td><a href=\"bchange.php?num_meio={$row['nummeio']}&nome_entidade={$row['nomeentidade']}\">Editar meio</a></td>\n");
      echo("</td><td><a href=\"b.php?mode=delete&type=socorro&id={$row['nummeio']}&id2={$row['nomeentidade']}\">Delete</a></td>\n");
      echo("</tr>\n");
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
