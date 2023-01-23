<?php 
require_once('./utils/ErrorCollection.php');
require_once('./utils/MySQL.php');


$errors = new ErrorCollection();
$sql = new MySQL();
$id = $_GET['id'];
$adress = "http://localhost/lab5/index.php?id=$id";

$row = $sql->readRowId($id);
$password = $row['password'];
$f_name = $row['firstname'];
$oldLogin = $row['login'];
$s_name = $row['secondname'];
$father = $row['father'];
$birthday = $row['birthday'];
$hometown = $row['hometown'];

if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['submit'])){
    if (empty($_POST["login"])) {
        $errors->addError("Введите логин");
    }
    else{
        $login = $_POST["login"];
    }

    if (empty($_POST["password"]) and !empty($_POST["c_password"])) {
        $errors->addError("Введите старый пароль");
    }
    elseif ($_POST["password"] != $password and !empty($_POST["password"])){
        $errors->addError("Вы ввели неверный пароль");
    }

    if (empty($_POST["password_new"]) and !empty($_POST["password"])){
        $errors->addError("Введите новый пароль");  
    } elseif(!empty($_POST["password"])) {
        $password = $_POST["password_new"];
    }


    if (empty($_POST["first-name"])) {
        $errors->addError("Нужно напсать имя пользователя");
    }
    else{
        $f_name = $_POST["first-name"];
    }

    if (empty($_POST["second-name"])) {
        $errors->addError("Нужно написать фамилию");
    }
    else{
        $s_name = $_POST["second-name"];
    }

    $father = $_POST["fathers-name"];

    if (empty($_POST["birthday"])) {
        $errors->addError("Нужно написать дату рождения");
    }
    else{
        $birthday = $_POST["birthday"];
    }

    if (empty($_POST["hometown"])) {
        $errors->addError("Нужно написать место жительства");
    }
    else{
        $hometown = $_POST["hometown"];
    }

    if ($oldLogin != $login){
        if ($sql->hasLogin($login)){
            
            $errors->addError("Такой логин уже существует");
            
        }
    }
    if (!$errors->hasErrors()){
        $sql->updateRow($id, $login, $password, $f_name, $s_name, $father, $birthday, $hometown);
    }
}
if (isset($_POST['back'])){
    header("Location: $adress");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/update.css">
    <title>Редактирование</title>
</head>
<body>  
    <div class="flex container">
        <form class="flex block" method="POST" action="">
            <div class="top">Редактирование</div>
                <label>Логин:</label>
                <input type="text" name="login" value="<?php echo($oldLogin);?>"><br>
                <?php
                $changePas = false;

                if (!isset($_POST['changePassword'])) {
                    echo ('<div class="btn">'); 
                    echo('<input type="submit" value="Изменить пароль" name="changePassword">');
                    echo ('</div>');
                }
                else{
                    $changePas = true;
                }

                if ($changePas){
                    echo ('<div class="info">');
                    echo('<label>Старый пароль:</label>');
                    echo('<input type="password" name="password"><br>');
                    echo ('</div>');
                    echo ('<div class="info">');
                    echo('<label>Новый пароль:</label>');
                    echo('<input type="password" name="password_new"><br><br>');
                    echo ('</div>');
                }        
                ?>
            <label>Имя</label>
            <input class="first-name" type="text" name="first-name">
            <label>Фамилия</label>
            <input class="second-name" type="text" name="second-name">  
            <label>Отчество</label>
            <input class="fathers-name" type="text" name="fathers-name">  
            <label>Дата рождения</label>
            <input class="birthday" type="date" name="birthday">  
            <label>Родной город</label>
            <input class="hometown" type="text" name="hometown"> 
            <?php 
                $errorMessage = implode("<br>", $errors->getErrors());
                if (isset($_POST['submit'])) {
                    if ($errors->hasErrors()) {
                        echo ('<div class="errors">');
                        echo ('<div class="line"></div>');
                        echo ($errorMessage);
                        echo ("</div>");
                    } else {
                        echo ('<div class="succes">');
                        echo ("Данные успешно сохранены!");
                        echo ('</div>');
                    }
                }
            ?>
            <div class="btn">
                <input type="submit" value="Сохранить" name="submit">
                <input type="submit" value="Вернуться" name="back">   
            </div>
        </form>
    </div>
</body>
</html>