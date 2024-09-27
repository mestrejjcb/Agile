<?php
require_once '../models/task_model.php';

if (isset($_POST['add_task'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    
    // Llama a la función para agregar la tarea
    addTask($title, $description, $status);  
    
    // Redirige a la vista principal después de agregar
    header('Location: ../views/index.php');  
    exit();  // Asegúrate de terminar el script después de redirigir
}

if (isset($_POST['delete_task'])) {
    $task_id = $_POST['task_id'];
    deleteTask($task_id);  // Llama a la función para eliminar la tarea
    header('Location: ../views/index.php');  // Redirige a la vista principal después de la eliminación
    exit();  // Asegúrate de terminar el script después de redirigir
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['create_task'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $due_date = $_POST['due_date'];
        $user_id = 1; // Suponiendo que el usuario está logueado y tiene ID 1
        createTask($title, $description, $due_date, $user_id);
        header('Location: ../views/index.php');
    }

    if (isset($_POST['update_status'])) {
        $task_id = $_POST['task_id'];
        $status = $_POST['status'];
        updateTaskStatus($task_id, $status);
        header('Location: ../views/index.php');
    }    
}

?>
