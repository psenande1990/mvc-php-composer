<?php
    namespace App\Models;

    require_once '../app/core/db.php';
    use Core\DB;
    
    class User
    {
        private $db;

        public function __construct()
        {
            $this->db = DB::connect();
        }

        public function all()
        {
            // select all users and change the date format use carbon format and day month year
            $query = $this->db->query("SELECT id, name, email, updated_at FROM users");
            $users = $query->fetchAll();
            return $users;
        }

        public function find($id)
        {
            $query = $this->db->prepare("SELECT * FROM users WHERE id = :id");
            $query->execute(['id' => $id]);
            return $query->fetch();
        }

        public function create($data)
        {
            $query = $this->db->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
            $query->execute($data);
            return $this->db->lastInsertId();
        }

        public function update($data)
        {
            $query = $this->db->prepare("UPDATE users SET name = :name, email = :email, password = :password WHERE id = :id");
            $query->execute($data);
            return $query->rowCount();
        }

        public function delete($id)
        {
            $query = $this->db->prepare("DELETE FROM users WHERE id = :id");
            $query->execute(['id' => $id]);
            return $query->rowCount();
        }
    }
