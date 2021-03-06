<?php $this->layout('layout', ['title' => 'Вход']) ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Вход</div>

                <div class="card-body">
                    <form method="POST" action="/login">
                        <input type="hidden" name="<?= $this->csrf()->getFormKey() ?>" value="<?= $this->csrf()->generateToken() ?>"/>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-mail адрес</label>

                            <div class="col-md-6">
                                <input id="email" type="email"
                                       class="form-control" name="email"
                                       value="admin@admin.com" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Пароль</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                       class="form-control"
                                       value="123"
                                       name="password" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Войти
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
