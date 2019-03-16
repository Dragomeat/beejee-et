<?php
/**
 * @var \BeeJeeET\Application\Tasks\TaskDto $task
 * @var string $referer
 */
?>

<?php $this->layout('layout', ['title' => 'Просмотр задачи']) ?>

<div class="container">
    <div class="row">
        <form action="" method="POST">
            <input type="hidden" name="<?= $this->csrf()->getFormKey() ?>" value="<?= $this->csrf()->generateToken() ?>"/>
            <input type="hidden" name="referer" value="<?= $referer ?>"/>
            <div class="form-group">
                <input class="form-control"
                       name="goal"
                       type="text"
                       value="<?= $task->goal ?>"
                       placeholder="Задача"
                />
            </div>

            <button type="submit" class="btn btn-primary">Редактировать</button>
        </form>
    </div>
</div>

