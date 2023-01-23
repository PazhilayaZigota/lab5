<?php
require_once('./utils/ErrorCollection.php');
require_once('./utils/MySQL.php');

$errors = new ErrorCollection();
$sql = new MySQL();

$login = '';
$password = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["login"])) {
        $errors->addError("Введите логин");
    } else {
        $login = $_POST["login"];
    }

    if (empty($_POST["password"])) {
        $errors->addError("Введите пароль");
    } else {
        $password = $_POST["password"];
    }

    if ($sql->hasLogin($login)){
        $row = $sql->readRowLogin($login);
        if ($row['password'] == $password) {
            $userId = $row['id'];
            $indexUrl = "http://localhost/lab5/index.php?id=$userId";
            header("Location: $indexUrl");
        } else {
            $errors->addError("Неверный пароль");
        }
    }
    if (!empty($_POST['login'])) {
        $errors->addError("Такого логина не существует");
    }

    $errorMessage = implode("</br>", $errors->getErrors());
}
if (isset($_POST['reg'])){
    header("Location: http://localhost/lab5/create.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/list.css">
    <title>Вход</title>
</head>
<body>  
    <div class="flex container">
        <form class="flex block" method="POST">
            <div class="top">Вход</div>
            <label>Логин:</label>
            <input class="login" type="text" name="login">  
            <label>Пароль:</label>
            <input class="psswd" type="password" name="password">
            <div class="errors">
                <?php         
                    if ($errors->hasErrors()) {
                        echo ("<div class=line></div>");
                        echo ($errorMessage);
                        echo ("<div class=line></div>");
                    } 
                
                ?>
            </div>
            <button type="submit" value="push" for="login">Войти</button>
            <a class="reg" href="create.php">Регистрация</a>
        </form>
    </div>
</body>
</html>