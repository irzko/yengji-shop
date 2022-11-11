<?php $this->layout("layouts/default", ["title" => APPNAME]) ?>
<?php $this->start("page_specific_css") ?>
<style>

  body {
    background: whitesmoke;
  }

 .h-12 {
    height: 3rem;
 }
 .banner {
    min-height: 37.5rem;
 }
</style>
<?php $this->stop() ?>
<?php $this->start("page") ?>
<div class="container">
    <div class="row banner d-flex align-items-center">
        <div class="col-md-6 col-lg-4 offset-md-3 offset-lg-4">
            <div class="d-flex flex-column align-items-center bg-white rounded-4 shadow-lg p-4">
                <h2 class="fw-semibold">Đăng nhập</h2>
                <form action="/login" method="post" class="d-flex flex-column w-100">
                    
                    <div class="form-group mt-3 <?=isset($errors['email']) ? 'has-error' : '' ?>">
                        <div>
                            <input id="email" type="email" class="form-control h-12" name="email" placeholder="Email"
                                value="<?=isset($old['email']) ? $this->e($old['email']) : '' ?>" required autofocus>

                            <?php if (isset($errors['email'])): ?>
                                <span class="help-block">
                                    <strong><?=$this->e($errors['email'])?></strong>
                                </span>
                            <?php endif ?>                               
                        </div>
                    </div>

                    <div class="form-group mt-3 <?=isset($errors['password']) ? 'has-error' : '' ?>">
                        <div>
                            <input id="password" type="password" class="form-control h-12" name="password" placeholder="Mật khẩu" required>

                            <?php if (isset($errors['password'])): ?>
                                <span class="help-block">
                                    <strong><?=$this->e($errors['password'])?></strong>
                                </span>
                            <?php endif ?>                                  
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <div class="d-flex flex-column">
                            <button type="submit" class="btn btn-primary h-12">
                                Đăng nhập
                            </button>

                            <a class="btn mt-3" href="/register">
                                Tạo tài khoản mới
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->stop() ?>
