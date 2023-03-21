<?php

$conection = new PDO("mysql:host=localhost; dbname=tarefas", "root", "");
$conection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_POST['tarefa'])) {
    $tarefa = filter_input(INPUT_POST, 'tarefa');
    $query = "INSERT INTO tarefas (descricao_tarefa, concluida_tarefa) VALUES (:descricao_tarefa,0)";
    $stm = $conection->prepare($query);
    $stm->bindParam('descricao_tarefa', $tarefa);
    $stm->execute();
    header('Location: http://localhost/lista-de-tarefas/');
}

if (isset($_GET['excluir'])) {
    $id = filter_input(INPUT_GET, 'excluir', FILTER_SANITIZE_NUMBER_INT);
    $query = "DELETE FROM tarefas WHERE id_tarefa=:id_tarefa";
    $stm = $conection->prepare($query);
    $stm->bindParam('id_tarefa', $id);
    $stm->execute();
    header('Location: http://localhost/lista-de-tarefas/');
}

if (isset($_GET['concluir'])) {
    $id = filter_input(INPUT_GET, 'concluir', FILTER_SANITIZE_NUMBER_INT);
    $query = "UPDATE tarefas SET concluida_tarefa = 1 WHERE id_tarefa=:id_tarefa";
    $stm = $conection->prepare($query);
    $stm->bindParam('id_tarefa', $id);
    $stm->execute();
    header('Location: http://localhost/lista-de-tarefas/');
}

if (isset($_GET['reabrir'])) {
    $id = filter_input(INPUT_GET, 'reabrir', FILTER_SANITIZE_NUMBER_INT);
    $query = "UPDATE tarefas SET concluida_tarefa = 0 WHERE id_tarefa=:id_tarefa";
    $stm = $conection->prepare($query);
    $stm->bindParam('id_tarefa', $id);
    $stm->execute();
    header('Location: http://localhost/lista-de-tarefas/');
}


$query = "SELECT * FROM tarefas";
$lista = $conection->query($query)->fetchAll();


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
        <h4>Nova atividade:</h4>
        <input type="text" name="tarefa" id="" placeholder="Nova atividade" required>
        <input type="submit" value="incluir">
    </form>
    <div class="lista">
        <ul>
            <?php foreach ($lista as $item) : ?>
                <li <?= $item['concluida_tarefa']? 'class= "concluida_tarefa"':'' ?>>
                    <?= $item['descricao_tarefa']?>
                    <?php if (!$item['concluida_tarefa']) : ?>
                        <a href="?concluir=<?= $item['id_tarefa'] ?>">Concluir</a>
                    <?php else : ?>
                        <a href="?reabrir=<?= $item['id_tarefa'] ?>">Reabrir</a>
                    <?php endif; ?>
                    <a href="?excluir=<?= $item['id_tarefa'] ?>">Excluir</a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>

</html>