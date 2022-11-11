<?php $this->layout("layouts/default", ["title" => "Yengji"]) ?>
<?php $this->start("page_specific_css") ?>
<style>
  body {
    background: whitesmoke;
  }

  .form-control {
    background: #F0F2F5;
    border: none;
  }

  .product-label {
    display: -webkit-box;
    overflow: hidden;
    text-overflow: ellipsis;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    line-height: 25px;
  }

  .text-sm {
    font-size: 14px;
    line-height: 20px;
  }

  .text-xs {
    font-size: 12px;
    line-height: 26px;
  }

  .card-container {
    padding: 5px;
  }

  .w-3 {
    width: 150px;
  }

  .add-product {
    bottom: 10px;
    right: 10px;
    height: 50px;
    width: 150px;
  }

  .h-40 {
    height: 40px;
  }

  .card-img-top {
    height: 207.988px;
  }

  .card {
    background: white;
  }

  .sticky-top {
    filter: drop-shadow(0 1px 1px rgb(0 0 0 / 0.05));
    backdrop-filter: blur(12px);
    background: rgba(255, 255, 255, 0.65);
  }

  .input-group-text {
    border: none;
  }

</style>
<?php $this->stop() ?>

<?php $this->start("page") ?>
<div class="container-fluid p-0">
  <div class="nav sticky-top py-3 d-flex justify-content-between p-2">
    <form class="d-flex" role="search" action="/search" method="post">
      <div class="input-group">
        <span class="input-group-text"><i class="bi bi-search"></i></span>
        <input type="text" class="form-control" placeholder="Tìm kiếm" name="key_word">
      </div>
    </form>

    <?php
      if (\App\SessionGuard::isUserLoggedIn() && \App\SessionGuard::user()->permissionLevel === 2) {
        echo '
        <ul class="nav d-flex justify-content-end">
          <li class="nav-item me-3" data-bs-toggle="modal" data-bs-target="#addProduct">
            <a class="nav-link btn btn-primary rounded-pill" href="#">
              <i class="bi bi-plus nav-icon text-white"></i>
              <span class="nav-label text-white">Thêm sản phẩm</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link btn border-secondary rounded-pill" href="/order">
            <i class="bi bi-receipt nav-icon"></i>
              <span class="nav-label">Đơn hàng</span>
            </a>
          </li>
        </ul>
        ';

      } else {
        echo '
        <ul class="nav col-3 d-flex justify-content-end flex-nowrap">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="bi bi-check-circle nav-icon"></i>
              <span class="nav-label">Wishlist</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/cart">
              <i class="bi bi-cart nav-icon"></i>
              <span class="nav-label">Giỏ hàng 
              </span>
            </a>
          </li>
        </ul>
        ';
      }
    ?>
  </div>
  <?php
    if (\App\SessionGuard::isUserLoggedIn() && \App\SessionGuard::user()->permissionLevel === 2) {
      echo '
      <div class="modal fade" id="addProduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl modal-fullscreen-md-down modal-dialog-centered modal-dialog-scrollable">
            <form class="modal-content" method="post" action="/add-prod" enctype="multipart/form-data">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Thêm sản phẩm mới</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <h4>Thông tin cơ bản</h4>
                  <div class="mb-3 row">
                    <label for="name" class="col-2 col-form-label text-end">Tên sản phẩm</label>
                    <div class="col-10">
                      <input type="text" class="form-control" id="name" name="name">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <img id="thumb" src="">
                  </div>
                  <div class="mb-3 row">
                    <label for="image" class="col-2 col-form-label text-end">Ảnh sản phẩm</label>
                    <div class="col-10">
                      <input type="file" class="form-control" id="image" name="image">
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <label for="description" class="col-2 col-form-label text-end">Mô tả sản phẩm</label>
                    <div class="col-10">
                      <textarea class="form-control" id="description" rows="9" name="description"></textarea>
                    </div>
                  </div>
                </div>
                <div class="row p-0 m-0">
                  <div class="col-6 mb-3 row p-0">
                    <label for="name" class="col-4 col-form-label text-end">Số lượng</label>
                    <div class="col-8">
                      <input type="number" class="form-control" id="amount" name="amount">
                    </div>
                  </div>
                  <div class="col-6 mb-3 p-0 row">
                    <label for="name" class="col-4 col-form-label text-end">Giá</label>
                    <div class="col-8">
                      <input type="number" class="form-control" id="unit_price" name="unit_price">
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary rounded-pill">Thêm</button>
                <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Huỷ</button>
              </div>
            </form>
          </div>
        </div>
      ';
    }
  ?>


  <div class="container">
    <div class="row mt-2">
    <?php
      foreach ($products as $product) {
        echo '
        <div class="col-6 col-md-4 col-lg-3 col-xl-2 card-container">
          <div
            class="rounded-2s card border d-flex flex-column justify-content-between"
            data-bs-toggle="modal"
            data-bs-target="#productDetails'. $product->id .'"
            style="min-height: 282px"
          >
            <img class="card-img-top" src="'. $product->image .'">
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
        <div
          class="modal fade"
          id="productDetails'. $product->id .'"
          tabindex="-1"
          aria-labelledby="productDetailsLabel"
          aria-hidden="true"
        >
          <div
            class="modal-dialog modal-dialog-centered modal-fullscreen-md-down modal-dialog-scrollable modal-lg"
          >
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="productDetailsLabel">
                  <i class="bi bi-info-circle"></i> Thông tin sản phẩm
                </h5>
                <button
                  type="button"
                  class="btn-close col-1"
                  data-bs-dismiss="modal"
                  aria-label="Close"
                ></button>
              </div>
              <div class="modal-body">
              <div class="product-id visually-hidden">'. $product->id .'</div>
              <div class="d-flex flex-column">
                <h4>' . $product->name . '</h4>
                <div class="d-flex flex-column align-items-center">
                  <img src="'. $product->image .'" width="300" height="300"/>
                </div>
                <div class="d-flex flex-column">
                  <h5 class="bg-light py-2">Mô tả sản phẩm</h5>
                  <p>'. nl2br($product->description) .'</p>
                </div>
              </div>
              </div>
              <div class="modal-footer">';
              if (!\App\SessionGuard::isUserLoggedIn() || \App\SessionGuard::user()->permissionLevel === 1) {  
                echo '  
                <div class="input-group w-3 d-flex">
                  <button
                    class="remove-amount btn btn-outline-secondary"
                    type="button"
                  >
                    <i class="bi bi-dash"></i>
                  </button>
                  <input
                    type="text"
                    name="amount"
                    class="amount form-control"
                    value="0"
                  />
                  <button class="add-amount btn btn-outline-secondary" type="button">
                    <i class="bi bi-plus"></i>
                  </button>
                </div>
                <div>
                  <input
                    type="text"
                    name="product_id"
                    class="product-id visually-hidden"
                    value="'. $product->id . '"
                  />
                  <button
                    type="button"
                    class="add-to-cart btn btn-outline-secondary rounded-pill"
                  >
                    Thêm vào giỏ hàng
                  </button>
                  <button type="button" class="buy-now-btn btn btn-warning rounded-pill" data-bs-dismiss="modal">
                    Mua ngay
                  </button>
                </div>';
              } else {
                echo '  
                <div class="info-prod d-flex w-100 justify-content-between">
                  <div>
                    <button
                      type="button"
                      data-bs-toggle="modal" data-bs-target="#removeBtn'. $product->id . '"
                      class="btn btn-danger rounded-pill"
                    >
                      <i class="bi bi-trash"></i> Xoá sản phẩm
                    </button>
                    <button
                      type="button"
                      data-bs-toggle="modal" data-bs-target="#editBtn'. $product->id . '"
                      class="btn btn-primary rounded-pill"
                    >
                      <i class="bi bi-pencil-square"></i> Chỉnh sửa
                    </button>
                  </div>
                </div>';
                }
                echo '
                </div>
              </div>
            </div>
          </div>';
          if (\App\SessionGuard::isUserLoggedIn() &&\App\SessionGuard::user()->permissionLevel === 2) {
            echo '
            <div class="modal fade" id="removeBtn'. $product->id . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Xác nhận</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    Bạn có muốn xoá sản phẩm này?
                  </div>
                  <form class="modal-footer" action="remove-product" method="post">
                    <input
                      type="text"
                      name="product_id"
                      class="product-id visually-hidden"
                      value="'. $product->id . '"
                    />
                    <button type="submit" class="btn btn-danger rounded-pill">Xoá</button>
                    <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Huỷ</button>
                  </form>
                </div>
              </div>
            </div>
            ';

            echo '
            <div class="modal fade" id="editBtn'. $product->id . '" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
              <form class="modal-content" method="post" action="/update-prod" enctype="multipart/form-data">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Chỉnh sửa sản phẩm</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <h4>Thông tin cơ bản</h4>
                    <input
                      type="text"
                      name="id"
                      class="visually-hidden"
                      value="'. $product->id . '"
                    />
                    <div class="mb-3 row">
                      <label for="name" class="col-2 col-form-label text-end">Tên sản phẩm</label>
                      <div class="col-10">
                        <input type="text" class="form-control" id="name" name="name" value="'. $product->name . '">
                      </div>
                    </div>
                    <img id="thumb-update" class="img-fluid col-2 offset-2" src="'. $product->image . '" width="100" height="100">
                    <div class="mb-3 row">
                      <label for="image" class="col-2 col-form-label text-end">Ảnh sản phẩm</label>
                      <div class="col-10">
                        <input type="file" class="form-control" id="image-update" name="image">
  
                      </div>
                    </div>
  
                    <div class="mb-3 row">
                      <label for="description" class="col-2 col-form-label text-end">Mô tả sản phẩm</label>
                      <div class="col-10">
                        <textarea class="form-control" id="description" rows="9" name="description">'. $product->description . '</textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row p-0 m-0">
                    <div class="col-6 mb-3 row p-0">
                      <label for="name" class="col-4 col-form-label text-end">Số lượng</label>
                      <div class="col-8">
                        <input type="number" class="form-control" id="amount" name="amount"  value="'. $product->amount . '">
                      </div>
                    </div>
                    <div class="col-6 mb-3 p-0 row">
                      <label for="name" class="col-4 col-form-label text-end">Giá</label>
                      <div class="col-8">
                        <input type="number" class="form-control" id="unit_price" name="unit_price"  value="'. $product->unit_price . '">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary rounded-pill">Xong</button>
                  <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Huỷ</button>
                </div>
              </form>
            </div>
          </div>
            ';
          }
      }
    ?>
    <div class="modal fade" id="verifyOrder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-fullscreen-md-down modal-dialog-scrollable modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Thông tin đơn hàng</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <div class="row mb-3">
            <label for="address" class="col-3 col-form-label text-end fw-semibold">Địa chỉ nhận hàng</label>
            <div class="col">
              <input type="text" class="form-control" id="address" name="address" placeholder="Nhập địa chỉ nhận hàng">
            </div>
          </div>
          <div class="row mb-3">
            <label for="phone" class="col-3 col-form-label text-end fw-semibold">Số điện thoại</label>
            <div class="col">
              <input type="text" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại">
            </div>
          </div>
          <div class="row mb-3">
            <span class="col-3 text-end fw-semibold">Mã sản phẩm: </span>
            <div class="product-id col" id="dw12C"></div>
          </div>
          <div class="row mb-3">
            <span class="col-3 text-end fw-semibold">Tên sản phẩm: </span>
            <div class="product-name col" id="name-4cCBd"></div>
          </div>
          <div class="row mb-3">
            <span class="col-3 text-end fw-semibold">Đơn giá: </span>
            <span class="product-price col" id="cnBc85"></span>
          </div>
          <div class="row mb-3">
            <span class="col-3 text-end fw-semibold">Số lượng: </span>
            <span class="product-amount col" id="xWc46"></span>
          </div>
          <div class="row mb-3">
            <span class="col-3 text-end fw-semibold">Thành tiền: </span>
            <span class="sum-price col" id="Mw9ce"></span>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
            <button type="button" class="submit-order btn btn-primary">Đặt hàng</button>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $this->stop() ?>

<?php $this->start("page_specific_js") ?>
<script>

$(function(){

  $(".add-amount").each(function () {
    $( this ).click(function () {
      let amount = $( this ).siblings('.amount').val();
      $( this ).siblings('.amount').val(parseInt(amount) + 1);
    })
  });


  $(".remove-amount").each(function () {
    $( this ).click(function () {
      let amount = $( this ).siblings('.amount').val();
      if (amount > 0) {
        $( this ).siblings('.amount').val(parseInt(amount) - 1);
      }
    })
  });

  $('.add-to-cart').each(function () {
    $( this ).click(function () {
      if ($(this ).parent().prev().find(".amount").val() > 0) {
        $.post("/cart", {
          product_id : $( this ).siblings('.product-id').val(),
          amount: $(this ).parent().prev().find(".amount").val()
        }, function (data) {
          location.href= "/cart" ;
        });
      }
    });
  });

  $('#image-update').change(function(e) {
    $('#thumb-update').attr(
      'src', window.URL.createObjectURL(e.target.files[0])
    );
  });

  $('#image').change(function(e) {
    $('#thumb').attr({
      'src': window.URL.createObjectURL(e.target.files[0]),
      'width': 100,
      'height': 100,
      'class': 'img-fluid col-2 offset-2'
    });
  });

  const orderModal = new bootstrap.Modal('#verifyOrder', {
    keyboard: false
  });

  $('.buy-now-btn').each(function () {
    $( this ).click(function () {
      orderModal.show();
      let id = $ ( this ).parentsUntil("div.modal-dialog").find(".product-id").text();
      let amount = $(this).parent().prev().find(".amount").val()
      $("#dw12C").text(id);
      $("#xWc46").text(amount);
      $.get(`/product/${id}`, function (res) {
        let data = JSON.parse(res);
        $("#name-4cCBd").text(data.name);
        $("#cnBc85").text(data.unit_price);
        $("#Mw9ce").text(parseInt(amount) * data.unit_price);
        
      });
    });
  });
  

  $('.submit-order').click(function () {
    $.post("/order", {
      delivery_address: $('#address').val(),
      phone_number: $('#phone').val(),
      product_id: $("#dw12C").text(),
      unit_price: $("#cnBc85").text(),
      amount: $("#xWc46").text(),
    }, function () {
      location.reload();
    });
  });

});

</script>
<?php $this->stop() ?>