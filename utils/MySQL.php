<?php
class MySQL{

    public function addRow(string $login, string $password, string $f_name, string $s_name, string $father, string $birthday, string $hometown){
        $link = mysqli_connect("localhost", "root", "", "users");
        mysqli_query($link, "SET NAMES 'utf8'");
        mysqli_set_charset($link, "utf8");

        $query = "INSERT INTO `users`(`login`, `password`, `firstname`, `secondname`, `father` ,`birthday`, `hometown`) VALUES ('".$login."', '".$password."', '".$f_name."', '".$s_name."', '".$father."','".$birthday."', '".$hometown."')";
        mysqli_query($link, $query);
        
    }

    public function readRowLogin(string $login){
        $link = mysqli_connect("localhost", "root", "", "users");
        mysqli_query($link, "SET NAMES 'utf8'");

        $sql = 'SELECT id, login, password FROM users';
        $result = mysqli_query($link, $sql);

        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

        foreach ($rows as $row){
            if ($row['login'] == $login){
                return $row;
            }
        }
        return null;
    }

    public function readRowId(int $id){
        $link = mysqli_connect("localhost", "root", "", "users");
        mysqli_query($link, "SET NAMES 'utf8'");

        $sql = 'SELECT * FROM users';
        $result = mysqli_query($link, $sql);

        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

        foreach ($rows as $row){
            if ($row['id'] == $id){
                return $row;
            }
        }
        return null;
    }

    public function readLast(){
        $link = mysqli_connect("localhost", "root", "", "users");
        mysqli_query($link, "SET NAMES 'utf8'");
     
        $sql = 'SELECT * FROM users';
        $result = mysqli_query($link, $sql);

        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $rows[count($rows) - 1];
    }

    public function hasLogin($login){
        $link = mysqli_connect("localhost", "root", "", "users");
        mysqli_query($link, "SET NAMES 'utf8'");
     
        $sql = 'SELECT login FROM users';
        $result = mysqli_query($link, $sql);

        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

        foreach ($rows as $row) {
            if ($row['login'] == $login) {
                return true;
            }
        }
        return false;
    }

    public function deleteRow($id){
        $link = mysqli_connect("localhost", "root", "", "users");
        mysqli_query($link, "SET NAMES 'utf8'");

        $sql = "DELETE FROM `users` WHERE id=$id";
        mysqli_query($link, $sql);
    }

    public function updateRow($id, string $login, string $password, string $f_name, string $s_name, string $father, string $birthday, string $hometown){
        $link = mysqli_connect("localhost", "root", "", "users");
        mysqli_query($link, "SET NAMES 'utf8'");

        $query = "UPDATE `users` SET `login`='".$login."', `password`='".$password."', `firstname`='".$f_name."', `secondname`='".$s_name."',  `father`='".$father."',`birthday`='".$birthday."', `hometown`='".$hometown."' WHERE `id`='".$id."'";
        
        mysqli_query($link, $query);
    }
}

?>