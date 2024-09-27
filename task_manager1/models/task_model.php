<?php
require_once '../db/db.php';

function getTasks($status = null) {
    global $pdo;
    $query = "SELECT * FROM tasks";
    if ($status) {
        $query .= " WHERE status = :status";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['status' => $status]);
    } else {
        $stmt = $pdo->query($query);
    }
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function createTask($title, $description, $due_date, $user_id, $sprint_id = null) {
    global $pdo;
    $sql = "INSERT INTO tasks (title, description, due_date, user_id, sprint_id) VALUES (:title, :description, :due_date, :user_id, :sprint_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['title' => $title, 'description' => $description, 'due_date' => $due_date, 'user_id' => $user_id, 'sprint_id' => $sprint_id]);
}

function updateTaskStatus($task_id, $status) {
    global $pdo;
    $sql = "UPDATE tasks SET status = :status WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['status' => $status, 'id' => $task_id]);
}

function deleteTask($task_id) {
    global $pdo;  
    $sql = "DELETE FROM tasks WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $task_id]);
}

function addTask($title, $description, $status) {
    global $pdo;  // Asegúrate de que la conexión a la base de datos esté disponible
    $sql = "INSERT INTO tasks (title, description, status) VALUES (:title, :description, :status)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'title' => $title,
        'description' => $description,
        'status' => $status
    ]);
}

?>
