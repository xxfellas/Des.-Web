<?php
namespace App\Models;

use App\Config\Databases;

class Expense {
    public function save($description, $value, $status, $id) {
        $db = new Databases(); 
        $db = $db->getConnection();
        if ($id) {
            $stmt = $db->prepare("UPDATE expenses SET id = ?, description = ?, value = ?, status = ? WHERE id = ?");
            $stmt->execute([$description, $value, $status]);
        } else {
            $stmt = $db->prepare("INSERT INTO expenses (description, value, status) VALUES (?, ?, ?)");
            $stmt->execute([$description, $value, $status]);
            $this->id = $db->lastInsertId();
        }
    }

    public static function getById($id) {
        $db = new Databases(); 
        $db = $db->getConnection();
        $stmt = $db->prepare("SELECT * FROM expenses WHERE id = ?");
        $stmt->execute([$id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Expense');
        return $stmt->fetch();
    }

    public static function list() {
        $db = new Databases(); 
        $db = $db->getConnection();
        $stmt = $db->query("SELECT * FROM expenses");
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Expense');
    }

    public function delete() {
        $db = new Databases(); 
        $db = $db->getConnection();
        $stmt = $db->prepare("DELETE FROM expenses WHERE id = ?");
        $stmt->execute([$this->id]);
    }
}