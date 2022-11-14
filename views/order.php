<?php $this->layout("layouts/default", ["title" => "Đơn đặt hàng"]) ?>
<?php $this->start("page_specific_css") ?>
<style>
  body {
    background: whitesmoke;
  }
  .product-name {
    overflow: hidden;
    max-width: 400px;
  }

</style>
<?php $this->stop() ?>

<?php $this->start("page") ?>
<div class="container table-responsive-md">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Mã đơn</th>
        <th scope="col">Tên sản phẩm</th>
        <th scope="col">Đơn giá</th>
        <th scope="col">Số lượng</th>
        <th scope="col">Ngày đặt</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    <?php
      foreach ($orders as $order) {
        echo '
          <tr>
            <td class="order-id">' . $order->id .'</td>
            <td class="product-name">' . $order->products->name .'</td>
            <td class="product-price">' . $order->unit_price .'</td>
            <td class="product-amount">' . $order->amount .'</td>
            <td class="order-date">' . $order->updated_at.'</td>
            <td class="detail">Chi tiêt</td>
          </tr>
          ';
        }
    ?>
    </tbody>
  </table>
  <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-md-down modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body info-order">
        </div>
        <div class="modal-footer">
          <button type="button" class="close-modal btn border-secondary rounded-pill">Đóng</button>
          <button type="button" class="btn btn-danger rounded-pill" id="remove-btn">Huỷ đơn</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="cancelOrder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-md-down modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Xác nhận huỷ đơn hàng
            #<span id="order-id-confirm"></span>
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Bạn có muốn huỷ đơn hành này
        </div>
        <div class="modal-footer">
          <button type="button" class="close-modal btn border-secondary rounded-pill" data-bs-dismiss="modal">Đóng</button>
          <button type="button" class="btn btn-danger rounded-pill" id="confirm-btn">Xác nhận</button>
        </div>
      </div>
    </div>
  </div>

<?php $this->stop() ?>

<?php $this->start("page_specific_js") ?>
<script>

$(function(){
  const myModal = new bootstrap.Modal('#myModal', {
    keyboard: false
  });

  const confirmRemoveOrder = new bootstrap.Modal('#cancelOrder', {
    keyboard: false
  });

  $("#confirm-btn").click(function() {
    let order_id = $('#order-id-confirm').text();
    $.post("/remove-order", {id: order_id}, function () {
          location.reload();
        });
  });

  $("#remove-btn").click(function () {
    let order_id = $('#order-id').text();
    confirmRemoveOrder.show();
    $('#order-id-confirm').text(order_id);
    myModal.hide();
  });

  $(".close-modal").each(function () {
    $(this).click(function () {
      myModal.hide();
      $("#exampleModalLabel").text("");
      $(".modal-body").html("");
    });
  });

  $(".detail").each(function () {
    $( this ).click(function () {
      myModal.show();
      let orderId = $(this).siblings(".order-id").text();
      $.get(`/order/${orderId}`, function(res) {
        let order = JSON.parse(res);
        $.get(`/product/${order.product_id}`, function(prod) {
          let prodData = JSON.parse(prod);
          $("#exampleModalLabel").html(`<span>Đơn hàng #</span><span id="order-id">${orderId}</span>`);
          $(".info-order").html(
            `
            <div class="row"><span class="fw-semibold col-3 text-end">Tên sản phẩm: </span><span class="col">${prodData.name}</span></div>
            <div class="row"><span class="fw-semibold col-3 text-end">Số lượng: </span><span class="col">${order.amount}</span></div>
            <div class="row"><span class="fw-semibold col-3 text-end">Đơn giá: </span><span class="col">${order.unit_price}</span></div>
            <div class="row"><span class="fw-semibold col-3 text-end">Thành tiền: </span><span class="col">${order.amount * order.unit_price}</span></div>
            <div class="row"><span class="fw-semibold col-3 text-end">Địa chỉ nhận hàng: </span><span class="col">${order.delivery_address}</span></div>
            <div class="row"><span class="fw-semibold col-3 text-end">Số điện thoại liên hệ: </span><span class="col">${order.phone_number}</span></div>

            `
          );
        });
      });
    });
  });

});

</script>
<?php $this->stop() ?>