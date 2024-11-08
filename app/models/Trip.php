<?php

namespace App\Models;

use App\Config\Databases;

class Trip {

    public function save($name, $start_date, $end_date, $location, $id) {
        $db = new Databases(); 
        $db = $db->getConnection();
        if ($id) {
            $stmt = $db->prepare("UPDATE trips SET name = ?, start_date = ?, end_date = ?, location = ? WHERE id = ?");
            $stmt->execute([$name, $start_date, $end_date, $location, $id]);
        } else {
            $stmt = $db->prepare("INSERT INTO trips (name, start_date, end_date, location) VALUES (?, ?, ?, ?)");
            $stmt->execute([$name, $start_date, $end_date, $location]);
        }
    }

    public static function findById($id) {
        $db = new Databases(); 
        $db = $db->getConnection();
        $stmt = $db->prepare("SELECT * FROM trips WHERE id = ?");
        $stmt->execute([$id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Trip');
        return $stmt->fetch();
    }

    public static function findAll() {
        $db = new Databases(); 
        $db = $db->getConnection();
        $stmt = $db->query("SELECT * FROM trips");
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Trip');
    }

    public function delete() {
        $db = new Databases(); 
        $db = $db->getConnection();
        $stmt = $db->prepare("DELETE FROM trips WHERE id = ?");
        $stmt->execute([$this->id]);
    }
}