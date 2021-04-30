<?php
    session_start();
    if($_SESSION['role'] == 'user') //если роль =user
    {
        header("Location: userPage.php"); exit(); //зайдешь на страницу пользователя
    }
    if($_SESSION['role'] == 'admin') //если роль admin
    {
        header("Location: adminPage.php"); exit(); //зайдешь на страницу администратора
    }
    require_once 'connection.php';
    if (!$link) { //если не подключилось к базе данных,то
        die('Ошибка соединения: ' . mysqli_error()); // выдает ошибку
    }
    else{
        if (isset($_POST['submit'])){ //если кнопка ВХОД нажата,то
            if (isset($_POST['login'])&&isset($_POST['pas'])){ 
                $query = mysqli_query($link, "SELECT id_user, password, role, accept FROM users WHERE login='".mysqli_real_escape_string($link, $_POST['login'])."'");
                if(mysqli_num_rows($query) > 0){
                    $data = mysqli_fetch_assoc($query);
                    if($data['password'] === md5(md5($_POST['pas']))){ // если введенный пароль = зашифрованному паролю,тогда
                        if($data['accept']==1){ 
                        $_SESSION['login'] = $_POST['login'];
                        $_SESSION['role'] = $data['role'];
                        $_SESSION['id_user'] = $data['id_user']
                        ?>
                        <script>document.location.href="index.php" //перенаправление на главную страницу</script> 
                        <?php
                        }
                        else{
                        ?>
                            <script>alert('вы ещё не одобрены администратором!')</script>
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
    }
    mysqli_close($link);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="favicon" href="favicon.ico">
    <title>CompFix</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div id="logo">
            <img src="logo1.png" width='' alt="">
        </div>
        <div id="name"><a href="index.php">CompFix</a></div>
        <div id="check"><?if($_SESSION['login']==''){echo'<a href="auth.php">Авторизация</a><a href="reg.php">Регистрация</a>';}else{echo '<a href="userPage.php">Личный кабинет</a>';}?></div>
    </header>
    <main>
        <form action="" method="POST">
            <label>Логин: <input type="text" name="login" required></label><br><br>
            <label>Пароль: <input type="password" name="pas" required></label><br><br>
            <input type="submit" value="Вход" name="submit">
        </form>
    </main>
    <footer>
        <div class="contacts">
        Наш телефон: 7(968)389-18-42
           </div>
        <br>
        <div class="copyright">
        ©"ООО"CompFix
        </div>
    </footer>
</body>
</html>
