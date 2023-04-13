<?php include('header_user.php');?>
<br>
<body>
    <div class="container">
    <ol class="breadcrumb" style="width: 400px;">
        <li class="breadcrumb-item"><a href="#">User</a></li>
        <li class="breadcrumb-item"><a href="#">Profile</a></li>
        <li class="breadcrumb-item"><a href="#">Donated Products</a></li>
        <li class="breadcrumb-item active">Details</li>
    </ol>    
    <br>

    <h2 class="text-primary" style="padding-bottom: 10px;">E-Waste Donated:</h2>
        
    <br>
        <div class="row">
        <section class="text-gray-600 body-font overflow-hidden">
          <div class="container px-5 py-24 mx-auto">
            <div class="lg:w-4/5 mx-auto flex flex-wrap">
               <img alt="ecommerce" class="lg:w-1/2 w-full lg:h-1/2 h-66 object-cover object-center rounded" src="<?= $donation->e_img ?>">
              <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                <h2 class="text-sm title-font text-gray-500 tracking-widest"><?= $donation->e_type; ?></h2>
                <h1 class="text-gray-900 text-3xl title-font font-medium mb-1"><?= $donation->e_name ?></h1>                 
                <p class="leading-relaxed"><b>Specifications:</b> <?= $donation->e_specs; ?></p>
                <p class="leading-relaxed"><b>Quantity:</b> <?= $donation->e_quantity; ?></p>
                <p class="leading-relaxed"><b>Used(Months):</b> <?= $donation->e_age; ?></p>  
                <p class="leading-relaxed"><b>Issued On:</b> <?= $donation->date; ?></p>
                <?php 
                $track=0;
                $current="";
                   if($donation->s_id!=0 && $donation->service_feedback=="")
                    { 
                        $track=25; 
                        $current="Request Accepted by Service Center and Product is under Check.";
                    }
                   else if($donation->service_feedback!=""  && $donation->r_id==0)
                   {
                       $track=50;
                       $current="Product Check Done and Credit Points alloted.";
                   }
                   else if($donation->r_id!=0 && $donation->recycler_feedback=="")
                   {
                       $track=75;
                       $current="Product forwarded to Recycler";
                   }
                   else if($donation->recycler_feedback!="")
                   { 
                       $track=100; 
                       $current="Recycling of your E-Waste is done.Click on More Details to know about Recycling of Product.";
                   }

                ?>         
                <p class="leading-relaxed"><b>Current Status:</b><?= $current ;?></p>
                
                 <div class="progress">
                  <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: <?= $track?>% " >
                  </div>        
                 </div>
                  <br>
                 <?php if($track>=50){ ?>
                 <p class="leading-relaxed"><b>Credit Points Earned: </b><?= $donation->s_creditpoints+ $donation->r_creditpoints ;?></p>
             <?php }?>
                
                    <?php 
                  if($track==100){ ?>
                       <?= anchor("user/donationStatus/{$donation->e_id}",'Status Report',['class'=>'btn btn-warning']) ; ?>
                     <?php } ?>  
                </div>  
              </div>
            </div>
          </div>
        </section>
              
</div>    
</body>

<?php include('footer.php');?>