<?php
require_once '../models/task_model.php';
$tasks_todo = getTasks('To Do');
$tasks_in_progress = getTasks('In Progress');
$tasks_done = getTasks('Done');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Task Manager</title>
</head>
<body>
    <h1>Gestión de Tareas</h1>

    <section>
        <h2>To Do</h2>
        <?php foreach ($tasks_todo as $task): ?>
            <div>
                <h3><?= $task['title']; ?></h3>
                <p><?= $task['description']; ?></p>
                <form method="POST" action="../controllers/task_controller.php">
                    <input type="hidden" name="task_id" value="<?= $task['id']; ?>">
                    <select name="status">
                        <option value="To Do">To Do</option>
                        <option value="In Progress">In Progress</option>
                        <option value="Done">Done</option>
                    </select>
                    <button type="submit" name="update_status">Actualizar</button>
                </form>
            </div>
        <?php endforeach; ?>
    </section>

    
    <section>
    <h2>In Progress</h2>
    <?php foreach ($tasks_in_progress as $task): ?>
        <div>
            <h3><?= $task['title']; ?></h3>
            <p><?= $task['description']; ?></p>
            <form method="POST" action="../controllers/task_controller.php">
                <input type="hidden" name="task_id" value="<?= $task['id']; ?>">
                <select name="status">
                    <option value="To Do" <?= $task['status'] == 'To Do' ? 'selected' : '' ?>>To Do</option>
                    <option value="In Progress" <?= $task['status'] == 'In Progress' ? 'selected' : '' ?>>In Progress</option>
                    <option value="Done" <?= $task['status'] == 'Done' ? 'selected' : '' ?>>Done</option>
                </select>
                <button type="submit" name="update_status">Actualizar</button>
            </form>
        </div>
    <?php endforeach; ?>
</section>
   

    <section>
    <h2>Done</h2>
    <?php if (!empty($tasks_done)): ?>
        <?php foreach ($tasks_done as $task): ?>
            <div>
                <h3><?= $task['title']; ?></h3>
                <p><?= $task['description']; ?></p>
                <!-- Si no necesitas actualizar el estado, puedes omitir el formulario -->
                <form method="POST" action="../controllers/task_controller.php">
                    <input type="hidden" name="task_id" value="<?= $task['id']; ?>">
                    <select name="status">
                        <option value="To Do" <?= $task['status'] == 'To Do' ? 'selected' : '' ?>>To Do</option>
                        <option value="In Progress" <?= $task['status'] == 'In Progress' ? 'selected' : '' ?>>In Progress</option>
                        <option value="Done" <?= $task['status'] == 'Done' ? 'selected' : '' ?>>Done</option>
                    </select>
                    <button type="submit" name="update_status">Actualizar</button>
                </form>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No hay tareas completadas.</p>
    <?php endif; ?>
</section>

    <section>
        <h2>Crear Tarea</h2>
        <form method="POST" action="../controllers/task_controller.php">
            <input type="text" name="title" placeholder="Título" required>
            <textarea name="description" placeholder="Descripción"></textarea>
            <input type="date" name="due_date" required>
            <button type="submit" name="create_task">Crear Tarea</button>
        </form>
    </section>
</body>
</html>
