<?php
    include_once 'db/Database.php';

    class Project{

        public $db;

        public function __construct()
        {
            $this->db = new Database();
        }

        public function addProject($data, $file){
            $name = $data['name'];
            $description = $data['description'];

            $permitted = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $file['image']['name'];
            $file_temp = $file['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()),0,10).'.'.$file_ext;
            $upload_image = "upload/".$unique_image;

            if (empty($name) || empty($description)){
                $msg = "Поля должны быть заполнены";
                return $msg;
            }elseif((!empty($file_ext)) && (in_array($file_ext, $permitted) == false)){
                $msg = "Можно загружать только изображения формата: ".implode(', ', $permitted);
                return $msg;
            }else {
                move_uploaded_file($file_temp, $upload_image);

                $query = "INSERT INTO projects(name, description, image) VALUES ('$name', '$description', '$upload_image')";

                $result = $this->db->insert($query);

                if ($result) {
                    $msg = "Редактирование успешно";
                    return $msg;
                }else{
                    $msg = "Ошибка редактирования";
                    return $msg;
                }
            }
        }

        public function allProject(){
            $query = "SELECT * FROM projects ORDER BY id";
            $result = $this->db->select($query);
            return $result;
        }

        public function getProjectById($id){
            $query = "SELECT * FROM projects WHERE id = '$id'";
            $result =$this->db->select($query);
            return $result;
        }

        public function deleteProject($extract_id){
            $query = "SELECT * FROM projects WHERE id IN($extract_id)";
            $result=$this->db->select($query);
            if($result) {
                while ($row = $result->fetch()) {
                    $image =$row['image'];
                    unlink($image);
                }
            }
            $del_query = "DELETE FROM projects WHERE id IN($extract_id)";
            $del = $this->db->delete($del_query);
        }

    }

?>