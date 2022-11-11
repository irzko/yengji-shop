<?php $this->layout("layouts/default", ["title" => "Giỏ hàng"]) ?>
<?php $this->start("page_specific_css") ?>
<style>
  .amount-input {
    width: 46px;
  }

  .product-label {
    display: -webkit-box;
    overflow: hidden;
    text-overflow: ellipsis;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    line-height: 25px;
  }

  .container-cart {
    min-height: 37.5rem;
    display: flex;
    flex-flow: column;
    align-items: center;
  }

  .empty-cart {
    min-height: 37.5rem;
  }

  .cart-items {
    width: 100%;
  }

</style>
<?php $this->stop() ?>
<?php $this->start("page") ?>
<div class="container container-cart">
  <?php
    if (count($carts) == 0) {
      echo '
      <div class="empty-cart d-flex flex-column justify-content-center align-items-center">
        <h1><i class="bi bi-bag"></i></h1>
        <div>Giỏ hàng trống</div>
      </div>
      ';
    }
    foreach ($carts as $cart) {
      echo '
      <div class="row cart-items border py-2 my-2">
        <div class="col-2 col-md-1 col-lg-1 col-xl-1">
          <img src="'. $cart->products->image .'" class="img-fluid" />
        </div>
        <div
          class="col-10 col-md-3 col-lg-4 col-xl-6 d-flex align-items-center"
        >
          <div class="product-label">'. $cart->products->name .'</div>
        </div>
        <div
          class="col col-md-2 col-lg-2 col-xl-1 d-flex justify-content-center align-items-center"
        >
          &#8363; '. number_format($cart->products->unit_price, 0, ",", ".") .'
        </div>
        <form
          action="/cart"
          method="post"
          class="col col-md-3 col-lg-2 col-xl-2 d-flex align-items-center"
        >
          <div class="input-group d-flex flex-nowrap justify-content-center">
            <button class="remove-amount btn btn-outline-secondary" type="button">
              <i class="bi bi-dash"></i>
            </button>
            <div class="amount-input">
              <input
                type="text"
                name="amount"
                class="amount form-control rounded-0"
                value="'. $cart->amount .'"
              />
            </div>
            <button class="add-amount btn btn-outline-secondary" type="button">
              <i class="bi bi-plus"></i>
            </button>
          </div>
          <input
            type="text"
            name="product_id"
            class="product-id visually-hidden"
            value="'. $cart->products->id . '"
          />
        </form>
        <div
          class="col col-md-2 col-lg-2 col-xl-1 d-flex justify-content-center align-items-center text-danger"
        >
          &#8363; '. number_format($cart->products->unit_price * $cart->amount, 0, ",",
          ".") .'
        </div>
        <div
          class="col col-md-1 col-lg-1 col-xl-1 d-flex flex-column justify-content-center align-items-center"
        >
          <button class="buy-now-btn btn btn-primary w-100 mb-2">
            Mua
          </button>
          <button class="remove-cart-btn btn btn-danger w-100">
            Xoá 
          </button>
        </div>
      </div>
      ';
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



  $(".remove-cart-btn").each(function () {
    $( this ).click(function () {
      $.post("/rm-cart", {
          product_id : $( this ).parent().siblings('form').find('.product-id').val()
        }, function () {
          location.reload();
        });
    });
  });


  $(".amount").each(function () {
    $( this ).blur(function () {
      $.post("/cart", {
          product_id : $( this ).parent().parent().siblings('.product-id').val(),
          amount: $( this ).val()
        }, function () {
          location.reload();
        });
    });

    $( this ).keypress(function (e) {
      if(e.which == 13) {
        $.post("/cart", {
            product_id : $( this ).parent().parent().siblings('.product-id').val(),
            amount: $( this ).val()
          }, function () {
            location.reload();
        });
      }
    });
  });


  $(".add-amount").each(function () {
    $( this ).click(function () {
      let amount = $( this ).siblings('.amount-input').find('.amount').val();
      $.post("/cart", {
          product_id : $( this ).parent().siblings('.product-id').val(),
          amount: parseInt(amount) + 1
        }, function () {
          location.reload();
        });
    });
  });


  $(".remove-amount").each(function () {
    $( this ).click(function () {
      let amount = $( this ).siblings('.amount-input').find('.amount').val();
      $.post("/cart", {
          product_id : $( this ).parent().siblings('.product-id').val(),
          amount: parseInt(amount) - 1
        }, function (data) {
          location.reload();
        });
    });
  });


  const orderModal = new bootstrap.Modal('#verifyOrder', {
    keyboard: false
  });

  $('.buy-now-btn').each(function () {
    $( this ).click(function () {
      orderModal.show();
      let id = $ ( this ).parent().parent().find(".product-id").val();
      let amount = $(this).parent().parent().find(".amount").val()
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

</script>
<?php $this->stop() ?>