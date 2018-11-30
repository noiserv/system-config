<?php
if($type == "meio"){
$result = $db->prepare("SELECT COUNT(*) AS total FROM entidadeMeio WHERE nomeEntidade = :nomeentidade;");
$result->bindParam(':nomeentidade', $_REQUEST['nomeentidade']);
$result->execute();
$db->beginTransaction();
foreach($result as $row){
    if($row['total']<1){
    $result = $db->prepare("INSERT INTO entidadeMeio VALUES(:nomeEntidade);");
    $result->bindParam(':nomeEntidade', $_REQUEST['nomeentidade']);
    if (!($result->execute())) {
        $db->rollback();
  }
    }
}
    $result = $db->prepare("INSERT INTO meio VALUES(:numMeio, :nomeMeio, :nomeEntidade);");
    $result->bindParam(':numMeio', $_REQUEST['nummeio']);
    $result->bindParam(':nomeMeio', $_REQUEST['nomemeio']);
    $result->bindParam(':nomeEntidade', $_REQUEST['nomeentidade']);
    if (!($result->execute())) {
        $db->rollback();
  }else{
    $db->commit();
  }
}
elseif($type=='entidade'){
    if ( $_REQUEST['nomeentidade'] != ''){
    $result = $db->prepare("INSERT INTO entidadeMeio VALUES(:nomeEntidade);");
    $result->bindParam(':nomeEntidade', $_REQUEST['nomeentidade']);
    $result->execute();
  }else{
    echo("Nome de entidade nao pode ser vazio");
  }
}
?>
