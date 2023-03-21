<?php

    $con = new PDO('mysql:host=localhost; dbname=tarefas','root','');
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(isset($_POST['tarefa'])){
        $tarefa = filter_input(INPUT_POST, 'tarefa');
        $query = "INSERT INTO tarefas (descricao_tarefa, concluida_tarefa) VALUES (:descricao_tarefa,0)";
        $stm = $con->prepare($query);
        $stm->bindParam('descricao_tarefa',$tarefa);
        $stm->execute();
    }

    $query = "SELECT * FROM tarefas";
    $lista = $con->query($query)->fetchAll();
    var_dump($lista);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/estilo.css">
    <title>Lista de Tarefas</title>
</head>
<body>
    <form method="post">
        <label for="">Nova tarefa:</label>
        <input type="text" name="tarefa" id="" placeholder="Incluir nova tarefa">
        <input type="submit" value="incluir">
    </form>
    <div class="lista">
        <ul>
            <li>
                
            </li>
        </ul>
    </div>
</body>
</html>