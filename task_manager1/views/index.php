<?php
require_once '../models/task_model.php';

// Obtener las tareas desde el modelo
$tasks_todo = getTasks('To Do');
$tasks_in_progress = getTasks('In Progress');
$tasks_done = getTasks('Done');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestor de Tareas</title>
</head>
<body>

    <h1>Gestor de Tareas</h1>

    <!-- Formulario para agregar una nueva tarea -->
    <h2>Agregar Nueva Tarea</h2>
    <form method="POST" action="../controllers/task_controller.php">
        <label for="title">Título:</label>
        <input type="text" id="title" name="title" required>

        <label for="description">Descripción:</label>
        <textarea id="description" name="description" required></textarea>

        <label for="status">Estado:</label>
        <select id="status" name="status">
            <option value="To Do">Por Hacer</option>
            <option value="In Progress">En Progreso</option>
            <option value="Done">Hecha</option>
        </select>

        <button type="submit" name="create_task">Agregar Tarea</button>
    </form>

    <h2>Por Hacer</h2>
    <?php foreach ($tasks_todo as $task): ?>
        <div>
            <h3><?= $task['title']; ?></h3>
            <p><?= $task['description']; ?></p>
            <form method="POST" action="../controllers/task_controller.php">
                <input type="hidden" name="task_id" value="<?= $task['id']; ?>">
                <select name="status">
                    <option value="To Do" <?= $task['status'] == 'To Do' ? 'selected' : '' ?>>Por Hacer</option>
                    <option value="In Progress" <?= $task['status'] == 'In Progress' ? 'selected' : '' ?>>En Progreso</option>
                    <option value="Done" <?= $task['status'] == 'Done' ? 'selected' : '' ?>>Hecha</option>
                </select>
                <button type="submit" name="update_status">Actualizar Estado</button>
            </form>
            <form method="POST" action="../controllers/task_controller.php">
                <input type="hidden" name="task_id" value="<?= $task['id']; ?>">
                <button type="submit" name="delete_task">Eliminar</button>
            </form>
        </div>
    <?php endforeach; ?>

    <h2>En Progreso</h2>
    <?php foreach ($tasks_in_progress as $task): ?>
        <div>
            <h3><?= $task['title']; ?></h3>
            <p><?= $task['description']; ?></p>
            <form method="POST" action="../controllers/task_controller.php">
                <input type="hidden" name="task_id" value="<?= $task['id']; ?>">
                <select name="status">
                    <option value="To Do" <?= $task['status'] == 'To Do' ? 'selected' : '' ?>>Por Hacer</option>
                    <option value="In Progress" <?= $task['status'] == 'In Progress' ? 'selected' : '' ?>>En Progreso</option>
                    <option value="Done" <?= $task['status'] == 'Done' ? 'selected' : '' ?>>Hecha</option>
                </select>
                <button type="submit" name="update_status">Actualizar Estado</button>
            </form>
            <form method="POST" action="../controllers/task_controller.php">
                <input type="hidden" name="task_id" value="<?= $task['id']; ?>">
                <button type="submit" name="delete_task">Eliminar</button>
            </form>
        </div>
    <?php endforeach; ?>

    <h2>Hechas</h2>
    <?php foreach ($tasks_done as $task): ?>
        <div>
            <h3><?= $task['title']; ?></h3>
            <p><?= $task['description']; ?></p>
            <form method="POST" action="../controllers/task_controller.php">
                <input type="hidden" name="task_id" value="<?= $task['id']; ?>">
                <button type="submit" name="delete_task">Eliminar</button>
            </form>
        </div>
    <?php endforeach; ?>

</body>
</html>
