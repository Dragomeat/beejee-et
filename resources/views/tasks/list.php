<?php
/**
 * @var \BeeJeeET\Application\Tasks\TaskDto[] $tasks
 * @var \BeeJeeET\Application\Tasks\PerformerDto[] $performers
 * @var array<string, mixed> $filters
 * @var \Pagerfanta\Pagerfanta $pagerfanta
 * @var callable $routeGenerator
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
                    <option value>Все исполнители</option>

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
                                       'active' => 'В работе',
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
                            <p class="card-title"><?= $this->e($task->goal) ?></p>
                            <p class="card-subtitle">
                                <span class="badge badge-<?= $task->isCompleted ? 'success' : 'light' ?>">
                                    <?= $task->isCompleted ? 'Завершена' : 'В работе' ?>
                                </span>
                                <small class="text-muted">
                                    <a
                                        href="/tasks?performer=<?= $task->performer->id ?>"
                                    >
                                        @<?= $this->e($task->performer->name) ?>
                                    </a>
                                </small>
                            </p>

                            <?php if ($this->auth()->isAuthenticated()
                                && $this->auth()->getUser()->isAdmin()): ?>
                                <div class="custom-control custom-switch">
                                    <input
                                            type="checkbox"
                                            data-id="<?= $task->id ?>"
                                            class="custom-control-input change-task-status"
                                            <?= (int)$this->e($task->isCompleted) ? 'checked' : '' ?>
                                            id="customSwitch-<?= $task->id ?>"/>
                                    <label class="custom-control-label" for="customSwitch-<?= $task->id ?>"></label>
                                </div>

                                <?php if (!$task->isCompleted): ?>
                                    <div class="btn-group mt-3" role="group">
                                        <a href="/tasks/<?= $task->id ?>" class="btn btn-primary"><i class="fas fa-pen"></i></a>
                                    </div>
                                <?php endif; ?>
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
        <?= $this->pagerfanta($pagerfanta, $routeGenerator) ?>
    </div>
</div>
<script src="<?=$this->asset('/js/tasks.js')?>"></script>
