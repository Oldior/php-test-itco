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
            if (!empty($file_ext)){
            $upload_image = "upload/".$unique_image;
            }else {$upload_image ="";}

            if (empty($name) || empty($description)){
                $msg = "Название и описание должны быть заполнены";
                return $msg;
            }elseif((!empty($file_ext)) && (in_array($file_ext, $permitted) == false)){
                $msg = "Можно загружать только изображения формата: ".implode(', ', $permitted);
                return $msg;
            }else {
                move_uploaded_file($file_temp, $upload_image);

                $query = "INSERT INTO projects(name, description, image) VALUES ('$name', '$description', '$upload_image')";

                $result = $this->db->query($query);

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
            $result = $this->db->query($query);
            return $result;
        }

        public function getProjectById($id){
            $query = "SELECT * FROM projects WHERE id = '$id'";
            $result =$this->db->query($query);
            return $result;
        }

        public function deleteProject($extract_id){
            $query = "SELECT * FROM projects WHERE id IN($extract_id)";
            $result=$this->db->query($query);
            if($result) {
                while ($row = $result->fetch()) {
                    $image =$row['image'];
                    if (!empty($image)){
                    unlink($image);
                    }
                }
            }
            $del_query = "DELETE FROM projects WHERE id IN($extract_id)";
            $del = $this->db->query($del_query);
        }

        public function updateProject($data, $file, $id){
            $name = $data['name'];
            $description = $data['description'];

            $permitted = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $file['image']['name'];
            $file_temp = $file['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()),0,10).'.'.$file_ext;
            if (!empty($file_ext)){
            $upload_image = "upload/".$unique_image;
            }else {$upload_image ="";}

            if (empty($name) || empty($description)){
                $msg = "Поля должны быть заполнены";
                return $msg;
            }if (!empty($file_name)) {
                if((!empty($file_ext)) && (in_array($file_ext, $permitted) == false)){
                $msg = "Можно загружать только изображения формата: ".implode(', ', $permitted);
                return $msg;
                }else {

                    $img_query = "SELECT * FROM projects WHERE id = '$id'";
                    $img_res = $this->db->query($img_query);
                    if ($img_res) {
                        while ($row = $img_res->fetch()){
                            $image = $row['image'];
                            if (!empty($image)){
                            unlink($image);
                            }
                        }
                    }
                

                    move_uploaded_file($file_temp, $upload_image);

                    $query = "UPDATE projects SET name='$name', description='$description', image='$upload_image' WHERE id = '$id'";

                    $result = $this->db->query($query);

                    if ($result) {
                       $msg = "Редактирование успешно";
                      return $msg;
                    }else {
                        $msg = "Ошибка редактирования";
                        return $msg;
                    }
                }
            }else {
                $query = "UPDATE projects SET name='$name', description='$description' WHERE id = '$id'";

                $result = $this->db->query($query);

                if ($result) {
                    $msg = "Редактирование успешно";
                    return $msg;
                }else{
                    $msg = "Ошибка редактирования";
                    return $msg;
                }
            }

        }

        public function deleteImage($id){

            $query = "SELECT * FROM projects WHERE id=$id";
            $result=$this->db->query($query);
            if($result) {
                while ($row = $result->fetch()) {
                    $image =$row['image'];
                    if (!empty($image)){
                    unlink($image);
                    }
                }
            }
            $del_query = "UPDATE projects SET image='' WHERE id='$id'";
            $del = $this->db->query($del_query);
        }

    }

?>