<?php include('header_service.php');?>
<br>
<body>
	<div class="container">
	    <ol class="breadcrumb" style="width: 400px;">
	        <li class="breadcrumb-item"><a href="#">Service</a></li>
	        <li class="breadcrumb-item"><a href="#">Set Status</a></li>
	        <li class="breadcrumb-item active">More Product Detail</li>
	    </ol>
	    <section class="text-gray-600 body-font overflow-hidden">
          <div class="container px-5 py-24 mx-auto">
            <div class="lg:w-4/5 mx-auto flex flex-wrap">
              <img alt="ecommerce" class="lg:w-1/2 w-full lg:h-auto h-66 object-cover object-center rounded" src="<?= $details->e_img ?>">
              <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                <h2 class="text-sm title-font text-gray-500 tracking-widest"><?= $details->e_type ?></h2>
                <h1 class="text-gray-900 text-3xl title-font font-medium mb-1"><?= $details->e_name ?></h1>                
                <p class="leading-relaxed"><b>Specifications:</b> <?= $details->e_specs; ?></p>
                <p class="leading-relaxed"><b>Usage:</b> <?= $details->e_age; ?></p>                      
                <p class="leading-relaxed"><b>Quantity:</b> <?= $details->e_quantity; ?></p>
                <?php
        			   if($option==1)
        			   {
        			?>
                <form action="<?= base_url('service/accept') ?>" method="post">                    
                    <input type="hidden" id="accept" name="hiddenAccept" value="<?= $details->e_id ?>">
                    <input type="submit" name="accept"  class="btn btn-primary"  value="Accept" />
        			</form>

        		<?php } else{  
                    $status= $details->service_feedback; 
                    $disable='';
                    if($status!='')
                          $disable='disabled';?>
                <button  name="forward" formaction="<?= base_url('service/forwardRequest') ?>" type="submit" class="btn btn-primary"  value="<?= $details->e_id ?>">Forward</button> 
                <br><br>
                    <?= anchor("service/updateStatus/{$details->e_id}",'Update Status',['class'=>'btn btn-warning '.$disable]);?>
                    <?php }  ?>
              </div>
            </div>
          </div>
        </section>
	</div>    
<?php include('footer.php');?>