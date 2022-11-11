<?php $this->layout("layouts/default", ["title" => "Đăng kí"]) ?>
<?php $this->start("page_specific_css") ?>
<style>
 .form-control {
    height: 2.5rem;
 }
 .banner {
    min-height: 37.5rem;

 }


 .form-group {
    margin-bottom: 0.5rem;
 }

 .form-label {
    margin-bottom: 0.125rem;
 }
</style>
<?php $this->stop() ?>
<?php $this->start("page") ?>
<div class="container">
    <div class="row banner d-flex align-items-center">
        <div class="col-md-6 col-lg-4 offset-md-3 offset-lg-4">
            <div class="d-flex flex-column align-items-center bg-white form rounded-4 shadow-lg p-4">
                <h2>Đăng kí</h2>
                <form action="/register" method="post" class="d-flex flex-column w-100">
                    <div class="form-group<?=isset($errors['name']) ? ' has-error' : '' ?>">
                        <label for="name" class="form-label fw-semibold">Họ tên</label>
                        <div>
                            <input id="name" type="text" class="form-control" name="name" 
                                value="<?=isset($old['name']) ? $this->e($old['name']) : '' ?>" required autofocus>

                            <?php if (isset($errors['name'])): ?>
                                <span class="help-block">
                                    <strong><?=$this->e($errors['name'])?></strong>
                                </span>
                            <?php endif ?>                                  
                        </div>
                    </div>

                    <div class="form-group<?=isset($errors['email']) ? ' has-error' : '' ?>">
                        <label for="email" class="form-label fw-semibold">Địa chỉ Email</label>
                        <div>
                            <input id="email" type="email" class="form-control" name="email" 
                                value="<?=isset($old['email']) ? $this->e($old['email']) : '' ?>" required>

                            <?php if (isset($errors['email'])): ?>
                                <span class="help-block">
                                    <strong><?=$this->e($errors['email'])?></strong>
                                </span>
                            <?php endif ?>       
                        </div>
                    </div>

                   <div class="form-group<?=isset($errors['password']) ? ' has-error' : '' ?>">
                        <label for="password" class="form-label fw-semibold">Mật khẩu</label>
                        <div>
                            <input id="password" type="password" class="form-control" name="password" required>

                            <?php if (isset($errors['password'])): ?>
                                <span class="help-block">
                                    <strong><?=$this->e($errors['password'])?></strong>
                                </span>
                            <?php endif ?>                                  
                        </div>
                    </div>

                   <div class="form-group<?=isset($errors['password_confirmation']) ? ' has-error' : '' ?>">
                        <label for="password-confirm" class="form-label fw-semibold">Nhập lại mật khẩu</label>
                        <div>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                            <?php if (isset($errors['password_confirmation'])): ?>
                                <span class="help-block">
                                    <strong><?=$this->e($errors['password_confirmation'])?></strong>
                                </span>
                            <?php endif ?>                                  
                        </div>
                    </div>                        

                    <div class="form-group mt-3">
                        <div class="d-flex flex-column">
                            <button type="submit" class="btn btn-primary">
                                Đăng kí
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->stop() ?>
