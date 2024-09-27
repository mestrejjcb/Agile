<?php
require_once('../models/task_model.php');

// Obtener todas las tareas por estado
$tasks_todo = getTasks('To Do');
$tasks_in_progress = getTasks('In Progress');
$tasks_done = getTasks('Done');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Tareas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            background-color: #f4f4f4;
        }
        h1, h2 {
            text-align: center;
            color: #333;
        }
        .container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .task-column {
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            margin: 0 10px;
            flex: 1;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .task {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        button {
            background-color: #5cb85c;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background-color: #4cae4c;
        }
        select {
            padding: 5px;
            margin-top: 10px;
        }
        .delete-button {
            background-color: #d9534f;
        }
        .delete-button:hover {
            background-color: #c9302c;
        }
        .add-task-form {
            margin-bottom: 20px;
            padding: 20px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 10px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input, .form-group textarea, .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>Gestor de Tareas</h1>

    <!-- Formulario para agregar una nueva tarea -->
    <div class="add-task-form">
        <h2>Agregar Nueva Tarea</h2>
        <form method="POST" action="../controllers/task_controller.php">
            <div class="form-group">
                <label for="title">Título:</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="description">Descripción:</label>
                <textarea id="description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="status">Estado:</label>
                <select id="status" name="status">
                    <option value="To Do">Por Hacer</option>
                    <option value="In Progress">En Progreso</option>
                    <option value="Done">Hecha</option>
                </select>
            </div>
            <button type="submit" name="add_task">Agregar Tarea</button>
        </form>
    </div>

    <div class="container">
        <!-- Por Hacer -->
        <div class="task-column">
            <h2>Por Hacer</h2>
            <?php foreach ($tasks_todo as $task): ?>
                <div class="task">
                    <h3><?= $task['title']; ?></h3>
                    <p><?= $task['description']; ?></p>
                    <form method="POST" action="../controllers/task_controller.php">
                        <input type="hidden" name="task_id" value="<?= $task['id']; ?>">
                        <select name="status">
                            <option value="To Do" <?= $task['status'] == 'To Do' ? 'selected' : '' ?>>Por Hacer</option>
                            <option value="In Progress" <?= $task['status'] == 'In Progress' ? 'selected' : '' ?>>En Progreso</option>
                            <option value="Done" <?= $task['status'] == 'Done' ? 'selected' : '' ?>>Hecha</option>
                        </select>
                        <button type="submit" name="update_status">Actualizar</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- En Progreso -->
        <div class="task-column">
            <h2>En Progreso</h2>
            <?php foreach ($tasks_in_progress as $task): ?>
                <div class="task">
                    <h3><?= $task['title']; ?></h3>
                    <p><?= $task['description']; ?></p>
                    <form method="POST" action="../controllers/task_controller.php">
                        <input type="hidden" name="task_id" value="<?= $task['id']; ?>">
                        <select name="status">
                            <option value="To Do" <?= $task['status'] == 'To Do' ? 'selected' : '' ?>>Por Hacer</option>
                            <option value="In Progress" <?= $task['status'] == 'In Progress' ? 'selected' : '' ?>>En Progreso</option>
                            <option value="Done" <?= $task['status'] == 'Done' ? 'selected' : '' ?>>Hecha</option>
                        </select>
                        <button type="submit" name="update_status">Actualizar</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Hechas -->
        <div class="task-column">
            <h2>Hechas</h2>
            <?php if (!empty($tasks_done)): ?>
                <?php foreach ($tasks_done as $task): ?>
                    <div class="task">
                        <h3><?= $task['title']; ?></h3>
                        <p><?= $task['description']; ?></p>
                        <form method="POST" action="../controllers/task_controller.php" style="display: inline;">
                            <input type="hidden" name="task_id" value="<?= $task['id']; ?>">
                            <button type="submit" name="delete_task" class="delete-button" onclick="return confirm('¿Estás seguro de que deseas eliminar esta tarea?');">Eliminar</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No hay tareas completadas.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
