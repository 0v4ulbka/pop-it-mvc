<div>
    <h1>Пользователи системы</h1>
    <table class="title">
        <tr>
            <th>ФИО пользователя</th>
            <th>Номер телефона</th>
            <th>Должность</th>
            <th>Email</th>
            <th>Пароль</th>
            <td colspan="2"><a class="buttonADD" href=""><h2 class="buttonADD">+</h2></a></td>
        </tr>
        <?php foreach ($users as $user){ ?>
        <tr>
            <td><?= $user->surname?> <?= $user->name?> <?= $user->patronymic?></td>
            <td><?= $user->phone?></td>
            <td><?= $user->job_title?></td>
            <td><?= $user->email?></td>
            <td><?= $user->password?></td>
            <td class="buttonADD"><a class="buttonUPD" href="../../updUser.php"><h2>&#9998;</h2></a></td>
            <td><a class="buttonDEL" href=""><h2 class="buttonDEL">&mdash;</h2></a></td>
        </tr>
        <?php }?>
    </table>
</div>