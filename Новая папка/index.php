<?php
    session_start();
    $controls = '<a href="auth.php">Авторизация</a><a href="reg.php">Регистрация</a>';
    $profile = $_SESSION["role"].'Page.php';
    if (!empty($_SESSION)) $controls = '<a href="'.$profile.'">'.$_SESSION["login"].' - '.$_SESSION["role"].'</a><form action="" method="get"><input type="submit" value="Выйти" name="leave"></form>';
    if (isset($_GET['leave']))
    {
        $_SESSION = array();
        session_destroy();
        header("Location: index.php"); exit();
    }
    require_once 'conn.php';
    $queryReviews = mysqli_query($link, "SELECT users.login, otzivi.stars, otzivi.otziv, otzivi.likes, otzivi.dislikes FROM otzivi LEFT JOIN users ON otzivi.id_user = users.id_user WHERE status=1 ORDER BY id_otziv DESC LIMIT 5");
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CompFix</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div id="logo">
            <img src="logo1.png" width='' alt="">
        </div>
        <div id="name"><a href="index.php">CompFix</a></div>
        <div id="controls"><?php echo $controls;?></div>
    </header>
    <main>
    <h2 id='besties'>Отзывы наших клиентов</h2>
    <div class="allReviews">
        <?while($otz=mysqli_fetch_assoc($queryReviews)){
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
                <? echo $otz['otziv'];?>
            </div>
        </div>
        <?}?>
    </div>
        
    </main>
    <footer>
        <div class="contacts">
           <a href='https://vk.com' align='center'><img src="VK.png" alt=""></a>
           <a href='https://facebook.com' align='center'><img src="face.png" alt=""></a>
           <a href='https://instagram.com' align='center'><img src="inst.png" alt=""></a>
        </div>
        <br>
        <div class="copyright">
            YLVMATH prod
        </div>
    </footer>
</body>
</html>