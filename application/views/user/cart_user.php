<?php include('header_user.php');?>
<br>
<body>
  <?php $creditpoints = $this->session->userdata('creditpoints');?>
  <div class="container">
  <?php if($feedback = $this->session->flashdata('feedback')): ?> 
      <?php $class = $this->session->flashdata('class');?>   
    <div class="row">
      <div class="col-lg-6">
         <div class="alert alert-dismissible alert-<?php echo $class; ?>">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong></strong> <a href="#" class="alert-link">
            <?= $feedback ?>
          </a>
        </div>
      </div>
    </div>
  <?php endif; ?>
  <br>
  <ol class="breadcrumb" style="width: 200px;">
        <li class="breadcrumb-item"><a href="#">User</a></li>
        <li class="breadcrumb-item active">Cart</li>
    </ol>
    <br>
    <h2 class="text-primary">Your Cart (<?php echo $this->cart->total_items()?> items)</h2>
    <br>
<!--Section: Block Content-->
<section>

  <!--Grid row-->
  <div class="row">

    <!--Grid column-->
    <div class="col-lg-8">

      <!-- Card -->
      <div class="mb-3">
        <div class="pt-4 wish-list">
          <div class="row mb-4">
          <?php foreach ($this->cart->contents() as $items): ?>
            <br>
              <div class="col-md-5 col-lg-3 col-xl-3">
                <div class="view zoom overlay z-depth-1 rounded mb-3 mb-md-0">
                  <img class="img-fluid w-100"
                    src="<?= $items['photo1'] ?>" alt="Product Image">
                </div>
              </div>

              <div class="col-md-7 col-lg-9 col-xl-9">
                <div>
                  <div class="d-flex justify-content-between">
                    <div>
                      <h5><?php echo $items['name']; ?></h5>
                      <p class="mb-2 text-muted text-uppercase small">TYPE: <strong><?php echo $items['type']; ?></strong></p>
                      <p class="mb-3 text-muted text-uppercase small">Provided by: <strong><?php echo $items['cname']; ?></strong></p>
                    </div>
                    <div>
                      <div class="def-number-input number-input safari_only mb-0 w-100">
                        
                        <?= anchor("user/updateItemM/".$items['rowid'],'-',['class'=>'btn btn-danger btn-sm']);?>
                        <?php echo $items['qty']." Unit/s"?>
                        <?= anchor("user/updateItemP/".$items['rowid'],'+',['class'=>'btn btn-primary btn-sm']);?>
                        
                      </div>
                      
                    </div>
                  </div>
                  <div class="d-flex justify-content-between align-items-center">
                    <div>
                      <?= anchor("user/deleteItem/".$items['rowid'],'Remove Item',['class'=>'btn btn-danger btn-sm']);?>
                    </div>
                    <p class="mb-0"><span>PRICE: ₹<strong id="summary"><?php echo $this->cart->format_number($items['price']); ?></strong></span></p class="mb-0">
                    <p class="mb-0"><span>SUB TOTAL: ₹<strong id="summary"><?php echo $this->cart->format_number($items['subtotal']); ?></strong></span></p class="mb-0">
                  </div>
                </div>
              </div>
              
            <?php endforeach; ?>
          </div>
          <hr class="mb-4">
          <p class="text-primary mb-0"><i class="fas fa-info-circle mr-1"></i>NOTE: Do not delay the purchase, adding
            items to your cart does not mean booking them.</p>
        </div>
      </div>
      <!-- Card -->

    </div>
    <!--Grid column-->

    <!--Grid column-->
    <div class="col-lg-4">

      <!-- Card -->
      <div class="mb-3">
        <div class="pt-4">

          <h5 class="mb-3">The Total Amount</h5>

          <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
              Sub Total Of All Items
              <span>RS <?php echo $this->cart->format_number($this->cart->total()); ?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
              Discount
              <span>RS <?php if($creditpoints>$this->cart->total()){$creditpoints=$this->cart->total();echo $creditpoints;}else{echo $creditpoints; }?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
              Shipping
              <span>Gratis</span>
            </li>

            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
              <div>
                <strong>The Total Amount</strong>
                <strong>
                  <p class="mb-0">(including Taxes)</p>
                </strong>
              </div>
              <span><strong><?php echo $this->cart->format_number($this->cart->total()-$creditpoints); ?></strong></span>
              <?php 
                $_SESSION["payment_total"] = $this->cart->total()-$creditpoints;
                //echo $_SESSION["payment_total"];
              ?>
            </li>
          </ul>
          <?= anchor("user/payment",'Checkout',['class'=>'btn btn-primary btn-block']);?>
        </div>
      </div>
      <!-- Card -->

      <!-- Card -->
      <div class="mb-3">
        <div class="pt-4">

          <?= anchor("user/useCreditPoints",'Use Credit Points (optional), Click Here!',['class'=>'dark-grey-text d-flex justify-content-between']);?>

          <div class="collapse" id="collapseExample">
            <div class="mt-3">
              <div class="md-form md-outline mb-0">
                <input type="text" id="discount-code" class="form-control font-weight-light"
                  placeholder="Enter discount code">
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Card -->

    </div>
    <!--Grid column-->

  </div>
  <!-- Grid row -->

</section>
</div>
<body>
<!--Section: Block Content-->
<?php include('footer.php');?>