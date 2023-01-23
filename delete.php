<?php
require_once("./utils/MySQL.php");
$sql = new MySQL();

if (isset($_POST['list'])) {
    $id = $_GET['id'];
    $adress = "http://localhost/lab5/list.php";
    header("Location: $adress");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/delete.css">
    <title>Удалить аккаунт</title>
</head>
<body>  
    <div class="flex container">
        <form class="flex block" method="POST">
            <div class="top">Удаление</div>
            <?php
                if (isset($_POST['delete'])){
                    $id = $_GET['id'];

                    $sql->deleteRow($id);
                    echo ("<div class='question success'>Страница успешно удалена!</div>");
                }
                elseif (isset($_POST['back'])){
                    $id = $_GET['id'];
                    $adress = "http://localhost/lab5/index.php?id=$id";
                    header("Location: $adress");
                }
                else{
                    echo ("<div class='question'>Вы уверены, что хотите удалить страницу?</div>");
                }
            ?>
            <div class="flex btn">
                <?php
                    if (isset($_POST['delete'])) {
                        echo('<input type="submit" value="Войти" name="list">');
                    } else {
                        echo ('<input type="submit" value="Удалить" name="delete">');
                        echo ('<input type="submit" value="Вернуться" name="back">');
                    }
                ?>
            </div>
        </form>
    </div>
</body>
</html>