<?php
    session_start();
    if($_SESSION['role'] == 'user')
    {
        header("Location: userPage.php"); exit();
    }
    if($_SESSION['role'] == 'admin')
    {
        header("Location: adminPage.php"); exit();
    }
    require_once 'conn.php';
    if (!$link) {
        die('Ошибка соединения: ' . mysqli_error());
    }
    else
    {
        if (isset($_POST['submit']))
        {
            if (isset($_POST['login'])&&isset($_POST['pas']))
            {
                if(($_POST['pas'])===($_POST['pas2'])){
                $query = mysqli_query($link, "SELECT id_user, password FROM users WHERE login='".mysqli_real_escape_string($link, $_POST['login'])."'");
                if(mysqli_num_rows($query)>0)
                {

                }
                else
                {
                    $data = mysqli_fetch_assoc($query);
                    $login = $_POST['login'];
                    $password = md5(md5(trim($_POST['pas'])));
                    mysqli_query($link,"INSERT INTO users SET login='".$login."', password='".$password."'");
                    ?>
                    <script>
                      document.location.href="index.php"
                      alert("Вы зарегестрированы!Ожидайте проверку администратором")
                    </script>
                    <?php
                }
            }
            else {
              ?>
              <script>
                alert("Пароли не совпадают")
              </script>
              <?php
            }
        }
    }
}
    mysqli_close($link);
?>
<!DOCTYPE html>
<html lang="en">
<head>
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
        <div id="controls"><a href="auth.php">Авторизация</a><a href="reg.php">Регистрация</a></div>
    </header>
    <main>
        <form action="" method="POST">
            <label>Логин: <input type="text" name="login" required></label><br><br>
            <label>Пароль: <input type="password" name="pas" required></label><br><br>
            <label>Повторите пароль: <input type="password" name="pas2" required></label>
            <input type="submit" value="Регистрация" name="submit">
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
        ©"ООО"CompFix
        </div>
    </footer>
</body>
</html>
