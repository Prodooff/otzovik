<!-- ADMIN MODALS ADMIN MODALS ADMIN MODALS ADMIN MODALS ADMIN MODALS ADMIN MODALS-->
<div class="modal fade" id="odobrenieUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><div><h3>Одобрение ПОЛЬЗОВАТЕЛЕЙ</h3></div></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="dobro">
                        <?
                            while ($sqler=mysqli_fetch_assoc($queryUsers)){
                        ?>
                        <div id='zlo'>
                        
                        <div id='login'>Пользователь: <?echo $sqler['login'];?></div>
                        <div id='elements'><form action="" method="post"><input type="submit" value="Одобрить"name='agree'><input type="submit" value="Отклонить"name='disagree'><input type="hidden"value='<? echo $sqler['id_user'];?>' name="id_hide"></form></div>
                        <?}?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="odobrenieReview" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><div><h3>Одобрение ЗАЯВОК</h3></div></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mnogoDobra">
                        <div id="dobro1">
                            <?while ($sqlzaya=mysqli_fetch_assoc($queryReviews)){?>
                            <div id='zlo1'>
                                    <div id='login'>Пользователь: <?echo $sqlzaya['login']?></div>
                                    <div id='otziv'><?echo $sqlzaya['otziv']?></div>
                                    <div id="controls"><form method='POST'><input type="submit" value="Одобрить"name='agreeREW'><input type="submit" value="Отклонить"name='disagreeREW'><input type="hidden"value='<? echo $sqlzaya['id_otziv'];?>' name="id_hideREW"></form></div>
                            </div>
                            <?}?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- USER MODALS  USER MODALS  USER MODALS  USER MODALS  USER MODALS  USER MODALS  USER MODALS  USER MODALS  USER MODALS -->
<div class="modal fade" id="checkUrReviews" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><div><h3>Ваши отзывы</h3></div></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>Ваши отзывы</div>
                    <?
                        $get = "SELECT `stars`, `otziv`, `id_otziv` FROM otzivi WHERE id_user='".$_SESSION['id_user']."'";
                        $sql=mysqli_query($link,$get);
                        while($t = mysqli_fetch_row($sql)){
                            Echo '<form method="POST">','оценка: ', $t[0], '<br>отзыв: ', $t[1],'<br>','<input type="hidden" name="id_hide" value=',$t[2],'>','<input type="submit" name="del" value="удалить" style="width:80%;margin:20px;">','</form>','<br>';
                        }
                        if(isset($_POST['del'])){
                            $s1=$_POST['id_hide'];
                        
                            $sqldel=mysqli_query($link, "DELETE FROM `otzivi` WHERE `otzivi`.`id_otziv` = ".$s1."");
                            echo '<script> document.location.href="userPage.php    "</script>';
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>