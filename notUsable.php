<?php
    session_start();
    if($_SESSION['role'] != 'user')
    {
        header("Location: index.php"); exit();
    }
    if($_SESSION['role'] == 'admin')
    {
        header("Location: adminPage.php"); exit();
    }
    if (isset($_GET['leave']))
    {
        $_SESSION = array();
        session_destroy();
        header("Location: index.php"); exit();
    }   
    require_once 'conn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
        <div id="logo">
            <img src="logo1.png" width='' alt="">
        </div>

        <div id="name"><a href="#">CompFix</a>        <a href="userPage.php">Оставить отзыв</a></div>
        <div id="controls"><p class="loginPHP"><?php echo $_SESSION['login'].' - '.$_SESSION['role'];?></p><form action="" method="get"><input type="submit" value="Выйти" name='leave'></form></div>
    </header>
    <main>
        <div>Ваши отзывы</div>
        <?
            $get = "SELECT `stars`, `otziv`, `id_otziv` FROM otzivi WHERE id_user='".$_SESSION['id_user']."'";
            $sql=mysqli_query($link,$get);
            while($t = mysqli_fetch_row($sql)){
                Echo '<form method="POST">','оценка:', $t[0], '<br>отзыв', $t[1],'<br>','<input type="hidden" name="id_hide" value=',$t[2],'>','<input type="submit" name="del" value="удалить">','</form>','<br>';
            }
            if(isset($_POST['del'])){
                $s1=$_POST['id_hide'];
               
                $sqldel=mysqli_query($link, "DELETE FROM `otzivi` WHERE `otzivi`.`id_otziv` = ".$s1."");
                echo '<script> document.location.href="userPage2.php    "</script>';
            }
        ?>
    </main>
</body>
</html>