<?php $this->layout("layouts/default", ["title" => "Thông tin cá nhân"]) ?>
<?php $this->start("page_specific_css") ?>
<style>
  .empty-cart {
    min-height: 37.5rem;
  }
</style>
<?php $this->stop() ?>
<?php $this->start("page") ?>
<div class="container mt-2">
<?php
  echo '
  <div class="row g-3 align-items-center mb-3">
    <div class="col-md-4 col-2 text-end">
      <label for="name" class="col-form-label">Tên</label>
    </div>
    <div class="col-md-4 col">
      <input type="text" id="name" class="form-control" value="'. $user->name .'" name="name">
    </div>
  </div>

  <div class="row g-3 align-items-center mb-3">
    <div class="col-md-4 col-2 text-end">
      <label for="email" class="col-form-label">Email</label>
    </div>
    <div class="col-md-4 col">
      <input type="email" id="email" class="form-control" value="'. $user->email .'" name="email">
    </div>
  </div>

  ';
?>
</div>
<?php $this->stop() ?>

<?php $this->start("page_specific_js") ?>
<script>





</script>
<?php $this->stop() ?>