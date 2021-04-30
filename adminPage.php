<?php
    session_start();
    if($_SESSION['role'] != 'admin')
    {
        header("Location: index.php"); exit();
    }
    if($_SESSION['role'] == 'user')
    {
        header("Location: userPage.php"); exit();
    }
    if (isset($_GET['leave']))
    {
        $_SESSION = array();
        session_destroy();
        header("Location: index.php"); exit();
    }
    require_once 'conn.php';
    if (!$link) {
        die('Ошибка соединения: ' . mysqli_error());
    }
    else
    {
        $queryUsers = mysqli_query($link, "SELECT id_user, login FROM users WHERE accept=0 LIMIT 3");
        $queryReviews = mysqli_query($link, "SELECT users.login, otzivi.stars, otzivi.otziv FROM otzivi LEFT JOIN users ON otzivi.id_user = users.id_user WHERE status=0 ORDER BY id_otziv DESC LIMIT 5");
    }
    $id=$_POST["id_hide"];
    echo $_POST["id_hide"];
    if(isset($_POST['agree'])){
        $sqlest=mysqli_query($link, "UPDATE users SET accept = 1 WHERE users.id_user = ".$id);
        echo '<script>document.location.href="adminPage.php"</script>';
    }
    if(isset($_POST['disagree'])){
        $sqldel=mysqli_query($link, "DELETE FROM users WHERE users.id_user=".$id);
        echo '<script>document.location.href="adminPage.php"</script>';
    }
    if(isset($_POST['disagreeREW'])){
        $sqldelREW=mysqli_query($link, "DELETE FROM otzivi WHERE otzivi.id_otziv=".$idREW);
        echo '<script>document.location.href="adminPage.php"</script>';
    }
    if(isset($_POST['agreeREW'])){
        $sqlestREW=mysqli_query($link, "UPDATE otzivi SET status = 1 WHERE otzivi.id_otziv".$idREW);
        echo '<script>document.location.href="adminPage.php"</script>';
    }
    mysqli_close($link);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CompFix</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div id="logo">
            <img src="logo1.png" width='' alt="">
        </div>
        <div id="name"><a href="index.php">CompFix</a></div>
        <div id="controls"><p class="loginPHP"><?php echo $_SESSION['login'].' - '.$_SESSION['role'];?></p><form action="" method="get"><input type="submit" value="Выйти" name='leave'></form></div>
    </header>
    <main style="margin-top: 0;">
        <div class="mnogoDobra">
            <? include("modal.php") ?>
        </div>
          <a href="#" data-bs-toggle="modal" data-bs-target="#odobrenieUser"><input type="submit" value="Просмотреть пользователей в очереди на одобрение"></a>
          <a href="#" data-bs-toggle="modal" data-bs-target="#odobrenieReview"><input type="submit" value="Просмотреть заявки в очереди на одобрение"></a>
    </main>
</body>
<script>
                if(document.getElementById('dobro').childElementCount==0){
                    document.getElementById('dobro').innerHTML="Новых пользователей нет";
                }
                if(document.getElementById('dobro1').childElementCount==0){
                    document.getElementById('dobro1').innerHTML="Новых заявок нет";
                }
            </script>
</html>