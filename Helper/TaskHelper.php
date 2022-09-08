<?php

namespace CRUD\Helper;

use CRUD\Model\Task;

class TaskHelper
{
    public function insertTask(Task $task)
    {
        /** @var DBConnector $dbHelper */
        $dbHelper = new DBConnector();
        $dbHelper->connect();
        $sql = "INSERT INTO task (id, task_title, task_description, task_status) VALUES ('" . $task->getId() . "', '" . $task->getTitle() . "', '" . $task->getDescription() . "', '" . $task->getStatus() . "')";
        if ($dbHelper->execQuery($sql)) {
            echo "Record added successfully";
        } else {
            echo "An Error Occurred";
        }
    }

    public function fetchTask(int $id)
    {
        $task = new Task();
        /** @var DBConnector $dbHelper */
        $dbHelper = new DBConnector();
        $dbHelper->connect();
        $result = $dbHelper->execQuery("SELECT * FROM task WHERE id =" . $id);
        $row = $result->fetch_all(MYSQLI_ASSOC);
        $task->setId($row[0]['id']);
        $task->setTitle($row[0]['task_title']);
        $task->setDescription($row[0]['task_description']);
        $task->setStatus($row[0]['task_status']);

        return $task;
    }

    public function fetchAll()
    {
        $task = [];
        /** @var DBConnector $dbHelper */
        $dbHelper = new DBConnector();
        $dbHelper->connect();
        $result = $dbHelper->execQuery("SELECT * FROM task ORDER BY id");
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        foreach ($rows as $row) {
            $task = new Task();
            $task->setId($row['id']);
            $task->setTitle($row['task_title']);
            $task->setDescription($row['task_description']);
            $task->setStatus($row['task_status']);
            $tasks[] = $task;
        }
        return $tasks;
    }

    public function updateTask(Task $task)
    {
        /** @var DBConnector $dbHelper */
        $dbHelper = new DBConnector();
        $dbHelper->connect();
        $sql = "UPDATE task SET task_title = '" . $task->getTitle() . "', task_description = '" . $task->getDescription() . "', task_status = '" . $task->getStatus() . "' WHERE id = '" . $task->getId() . "'";
        if ($dbHelper->execQuery($sql)) {
            echo "Record updated successfully";
        } else {
            echo "An Error Occurred";
        }
    }

    public function delete($id)
    {
        /** @var DBConnector $dbHelper */
        $dbHelper = new DBConnector();
        $dbHelper->connect();
        $sql = "DELETE FROM task WHERE id = '" . $id . "'";
        if ($dbHelper->execQuery($sql)) {
            echo "Record deleted successfully";
        } else {
            echo "An Error Occurred";
        }
    }
}
