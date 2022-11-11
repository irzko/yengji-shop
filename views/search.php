<?php $this->layout("layouts/default", ["title" => "Tìm kiếm"]) ?>
<?php $this->start("page_specific_css") ?>
<style>
  .empty-cart {
    min-height: 37.5rem;
  }
</style>
<?php $this->stop() ?>
<?php $this->start("page") ?>
<div class="container">
  <?php
    if (count($products) == 0) {
      echo '
      <div class="empty-cart d-flex flex-column justify-content-center align-items-center">
        <h1><i class="bi bi-bag"></i></h1>
        <div>Không tìm thấy sản phẩm này</div>
      </div>
      ';
    }
    foreach ($products as $product) {
      echo '
        <div class="col-6 col-md-4 col-lg-3 col-xl-2 card-container">
          <div
            class="rounded-2s card border d-flex flex-column justify-content-between"
            data-bs-toggle="modal"
            data-bs-target="#productDetails'. $product->id .'"
            style="min-height: 282px"
          >
            <img class="card-img-top" src="'. $product->image .'"">
            <div class="px-2 d-flex flex-column justify-content-between">
              <div class="product-label h-40 text-sm">'. $product->name . '</div>
              <div class="d-flex justify-content-between">
                <span class="text-danger">
                  &#8363; '. number_format($product->unit_price, 0, ",", ".") .'
                </span>
                <span class="text-xs">Đã bán '.$product->sold.'</span>
              </div>
            </div>
          </div>
        </div>
      ';
    } 
  ?>
    
</div>

<?php $this->stop() ?>

<?php $this->start("page_specific_js") ?>
<script>





</script>
<?php $this->stop() ?>