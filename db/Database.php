<?php
    class Database{

        public function __construct()
        {
            $this->dbConnect();
        }

        public function dbConnect(){
            $pdo = new PDO('sqlite:db/projects.db');

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "CREATE TABLE IF NOT EXISTS projects(id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
            name VARCHAR(50), 
            description VARCHAR(1000), 
            image VARCHAR(1000))";

            $pdo->exec($query);
        }   
        
        public function insert($query){
            $pdo = new PDO('sqlite:db/projects.db');
            $result = $pdo->query($query);
            return $result;
        }

        public function select($query){
            $pdo = new PDO('sqlite:db/projects.db');
            $result = $pdo->query($query);
            return $result;
        }

        public function update($query){
            $pdo = new PDO('sqlite:db/projects.db');
            $result = $pdo->query($query);
            return $result;
        }

        public function delete($query){
            $pdo = new PDO('sqlite:db/projects.db');
            $result = $pdo->query($query);
            return $result;
        }
    }

?>