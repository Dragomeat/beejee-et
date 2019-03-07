<?php $this->layout('layout', ['title' => 'Просмотр задачи']) ?>

<div class="container">
    <div class="row">
        <form action="" method="POST">
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

