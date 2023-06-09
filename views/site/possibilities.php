<?php
use Model\User;
?>
<div>
    <h1>Здравствуйте, <?= app()->auth::user()->name?> <?=app()->auth::user()->patronymic?></h1>
    <h2>Что вы можете?</h2>
    <h3><?= $message ?? ''; ?></h3>
    <div class="opportunities">
        <ul>
            <li>Вы можете добавить нового работника в базу</li>
            <li>Вы можете удалить сотрудника из базы</li>
            <?php if ((new User)->is_admin()):?>
            <li>Подсчитать возраст всех сотрудников</li>
            <li>Посмотреть полный список сотрудников</li>
            <li>Отсортировать работников по признаку</li>
            <li>Отредактировать данные работников</li>
            <li>Отредактировать списки должностей и подразделений</li>
            <li>Добавить и удалить пользователя системы</li>
        </ul>
        <a class="button" href="<?= app()->route->getUrl('/signup') ?>">Зарегистировать нового пользователя</a>
        <?php endif; ?>
    </div>
</div>