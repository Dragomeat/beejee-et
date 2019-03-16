<?php
/**
 * @var \BeeJeeET\Application\Tasks\TaskDto[] $tasks
 * @var \BeeJeeET\Application\Tasks\PerformerDto[] $performers
 * @var array<string, mixed> $filters
 * @var \Pagerfanta\Pagerfanta $pagerfanta
 */
?>

<?php $this->layout('layout', ['title' => 'Список задач']) ?>

<div class="container">
    <div class="row">
        <form class="form-inline" action="" method="POST">
            <input type="hidden" name="<?= $this->csrf()->getFormKey() ?>" value="<?= $this->csrf()->generateToken() ?>"/>

            <?php if (!$this->auth()->isAuthenticated()): ?>
                <div class="form-group mb-2">
                    <input class="form-control" name="name" type="text" placeholder="Ваше имя"/>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <input class="form-control" name="email" type="email" placeholder="Ваша почта"/>
                </div>
            <?php endif; ?>

            <div class="form-group mb-2">
                <input class="form-control" name="goal" type="text" placeholder="Задача"/>
            </div>

            <button type="submit" class="btn btn-primary mx-sm-3 mb-2">Создать</button>
        </form>
    </div>
    <div class="row">
        <form class="form-inline" action="/tasks">
            <div class="form-group mb-2">
                <select class="custom-select" name="performer" id="performer">
                    <option value="all">Все исполнители</option>

                    <?php foreach ($performers as $performer): ?>
                        <option <?= $performer->id === $filters['performer'] ? 'selected' : '' ?>
                                value="<?= $performer->id ?>"><?= $this->e($performer->name) ?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="form-group  mx-sm-3 mb-2">
                <select class="custom-select" name="status" id="status">
                    <?php foreach ([
                                       'all' => 'Все',
                                       'active' => 'Активные',
                                       'completed' => 'Завершенные'
                                   ] as $status => $label): ?>
                        <option <?= $status === $filters['status'] ? 'selected' : '' ?>
                                value="<?= $status ?>"><?= $this->e($label) ?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary mb-2">Применить</button>
        </form>
    </div>
    <div class="row">
        <form id="complete-form" class="form-inline" style="display: none;" action="" method="POST">
            <input type="hidden" name="<?= $this->csrf()->getFormKey() ?>" value="<?= $this->csrf()->generateToken() ?>"/>
        </form>
        <div class="card-columns mb-3">
            <?php if (count($tasks) > 0): ?>
                <?php foreach ($tasks as $task): ?>
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text"><?= $this->e($task->goal) ?></p>
                            <p class="card-text">
                                <small class="text-muted">
                                    @<?= $this->e($task->performer->name) ?> - <?= $this->e($task->isCompleted) ? 'Завершена' : 'Активна' ?>
                                </small>
                            </p>

                            <?php if ($this->auth()->isAuthenticated()
                                && $this->auth()->getUser()->isAdmin()): ?>
                                <div class="custom-control custom-switch">
                                    <input
                                            type="checkbox"
                                            onchange="event.preventDefault();
                                                     var form = document.getElementById('complete-form');

                                                     var action = this.checked
                                                            ? 'complete'
                                                            : 'activate';

                                                     form.action = `/tasks/<?= $task->id ?>/${action}`;
                                                     form.submit();"
                                            class="custom-control-input"
                                            <?= (int)$this->e($task->isCompleted) ? 'checked' : '' ?>
                                            id="customSwitch-<?= $task->id ?>"/>
                                    <label class="custom-control-label" for="customSwitch-<?= $task->id ?>"></label>
                                </div>

                                <div class="btn-group mt-3" role="group">
                                    <a href="/tasks/<?= $task->id ?>" class="btn btn-primary"><i class="fas fa-pen"></i></a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach ?>
            <?php else: ?>
                <p>Тут пока нет задач.</p>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <?= $this->pagerfanta($pagerfanta) ?>
    </div>
</div>
