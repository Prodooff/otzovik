<?php
    session_start(); //синхронизация авторизации на всех страницах
    $check = '<a href="auth.php">Авторизация</a><a href="reg.php">Регистрация</a>';
?>
<?php 
    $shape = $_SESSION["role"].'Page.php'; //записываем роль пользователя в переменную
    if (!empty($_SESSION)) $check = '<a href="'.$shape.'">'.$_SESSION["login"].' - '.$_SESSION["role"].'</a><form action="" method="get"><input type="submit" value="Выйти" name="leave"></form>';
    if (isset($_GET['leave'])){ //если нажата кнопка выхода сессия прерывается и возвращает пользователя на главную страницу
        $_SESSION = array();
        session_destroy();
        header("Location: index.php"); exit();
    }
    require_once 'connection.php';
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="favicon" href="favicon.ico">
    <title>CompFix</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php     $queryReviews = mysqli_query($link, "SELECT users.login, reviews.stars, reviews.review FROM reviews LEFT JOIN users ON reviews.id_user = users.id_user WHERE status=1 ORDER BY id_review DESC LIMIT 5"); ?>
    <header>
        <div id="logo">
            <img src="logo1.png" width='' alt="">
        </div>
        <div id="name"><a href="index.php">CompFix</a></div>
        <div id="check"><?php echo $check;?></div>
    </header>
    <main>
    <h2 id='besties'>Отзывы наших клиентов</h2>
    <div class="allReviews">
        <?
            while($otz=mysqli_fetch_assoc($queryReviews)){ //перебор отзывов и вывод ниже
        ?>
        <div class="reviews">
            <div class='login'>
                <?echo $otz['login'];?>
            </div>
            <div class='stars'>
                <i class="fas fa-star" style="color:#6c4da8"></i>
                <? echo $otz['stars'];?>/5
            </div>
            <div class='otziv'>
                <? echo $otz['review'];?>
            </div>
        </div>
        <?}?>
    </div>

    </main>
    <footer>
        <div class="contacts">
            Наш телефон: 7(968)389-18-42
        </div>
        <br>
        <div class="copyright">
            YLVMATH prod
        </div>
    </footer>
</body>
</html>
