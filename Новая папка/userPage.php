<?php
    session_start();
    if($_SESSION['role'] != 'user')
    {
        header("Location: index.php"); exit();
    }
    if($_SESSION['role'] == 'admin')
    {
        ?><script>document.location.href='adminPage.php'</script><?
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
<html>
<head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CompFix</title>
    <link rel="stylesheet" href="style.css">
    <style>
    select {
        background-color: transparent;
        border: none;
        padding: 0 1em 0 0;
        margin: 0;
        font-family: inherit;
        font-size: inherit;
        cursor: inherit;
        line-height: inherit;
        outline: none;
}
</style>
</head>
<body>
    <header>
        <div id="logo">
            <img src="logo1.png" width='' alt="">
        </div>
        <div id="name"><a href="index.php">CompFix</a></div>
   
        <div id="controls"><p class="loginPHP"><?php echo $_SESSION['login'].' - '.$_SESSION['role'];?></p><form action="" method="get"><input type="submit" value="Выйти" name='leave'></form></div>
    </header>
    <main>
    <form action="" method='post'>
        <div class="reviews" align='center'>
            <h2>Оставить отзыв</h2>
            <div class='stars'>
            <i class="fas fa-star"></i>
                <select name="str" required id="">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            <div class='otziv'>
                <textarea name="otz" required id="" cols="30" rows="10" style="resize:none"></textarea>
                <input type="submit" name='otpr' value ="Отправить" class="button">
            </div>
            
        </div>
        <? include("modal.php") ?>
        <a href="#" data-bs-toggle="modal" data-bs-target="#checkUrReviews"><input type="submit" value="Просмотреть заявки в очереди на одобрение"></a>
        </form>
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
<?php
    if(isset($_POST['otpr'])){
        
        $otz=$_POST["otz"];
        $str = $_POST["str"];
        $sqlin = "INSERT INTO otzivi (id_user,stars,otziv) VALUES ('".$_SESSION['id_user']."','".$str."','".$otz."')";
        mysqli_query($link,$sqlin);
        ?>
        <script>
            document.location.href='userPage.php'
            alert('Отзыв отправлен на проверку администратором')
        </script>
        <?
    }
?>