<?php include('header_service.php');?>
<br>
<body>
	<div class="container">
	    <ol class="breadcrumb" style="width: 400px;">
	        <li class="breadcrumb-item"><a href="#">Service</a></li>
	         <li class="breadcrumb-item"><a href="#">Order Status and Details</a></li> 
	        <li class="breadcrumb-item active">Order Detail</li>
	    </ol>
	    <section class="text-gray-600 body-font overflow-hidden">
          <div class="container px-5 py-24 mx-auto">
            <div class="lg:w-4/5 mx-auto flex flex-wrap">
              <img alt="ecommerce" class="lg:w-1/2 w-full lg:h-1/2 h-66 object-cover object-center rounded" src="<?= $details->p_img1 ?>">
              <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                <h2 class="text-sm title-font text-gray-500 tracking-widest"><?= $details->p_type ?></h2>
                <h1 class="text-gray-900 text-3xl title-font font-medium mb-1"><?= $details->p_name ?></h1>                
                <p class="leading-relaxed"><b>Specifications:</b> <?= $details->p_specs; ?></p>
                <p class="leading-relaxed"><b>Amount:</b> ₹<?= $details->amount ?></p>                      
                <p class="leading-relaxed"><b>Quantity:</b> <?= $details->quantity; ?></p>   
                <h3 class="text-sm title-font text-gray-500 tracking-widest">Order Details</h3>
                <p class="leading-relaxed"><b>Ordered By:</b> <?= $details->fname; ?></p>     
                <p class="leading-relaxed"><b>Contact Number:</b> <?= $details->contact; ?></p>      
                <p class="leading-relaxed"><b>Email Id:</b> <?= $details->email; ?></p> 
                <p class="leading-relaxed"><b>Delivery Address:</b> <?= $details->address; ?></p> 
                <p class="leading-relaxed"><b>order id:</b> <?= $details->o_id; ?></p>
                <p class="leading-relaxed"><b>product id:</b> <?= $details->p_id; ?></p>
                 <?php if($option==1){?>

                      <?php echo form_open('service/orderTracking'); ?>
        
         
                  <h3 class="text-sm title-font text-gray-500 tracking-widest">Current Status</h3> 
                  <p class="leading-relaxed">Ready for Dispatch 
                  <input type="radio" name="tracking" value="Ready" <?php if($details->Tracking=="Ready"){ ?> checked=checked <?php } ?> />
                       
                  </p>

                  <p class="leading-relaxed"> Dispatched for Delivery
                     <input type="radio" name="tracking" value="Dispatched" <?php if($details->Tracking=="Dispatched"){ ?> checked=checked <?php } ?> />
                  </p> 
                  
                  <p class="leading-relaxed"> Delivered
                        <input type="radio" name="tracking" value="Delivered" <?php if($details->Tracking=="Delivered") { ?> checked=checked <?php } ?> />
                  </p> 
                  
          &nbsp;<br>
             <input type="hidden"  name="orderId" value="<?= $details->o_id ?>">
             <input type="hidden"  name="productId" value="<?= $details->p_id ?>">
        
           <?php echo form_submit(['name'=>'submit','class'=>'btn btn-warning','value'=>'Save Status']); ?>
              <?php } ?>                      
              </div>
                  

            </div>
          </div>
        </section>
	</div>    
<?php include('footer.php');?>