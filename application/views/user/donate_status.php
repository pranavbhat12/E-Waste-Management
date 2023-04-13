<?php include('header_user.php');?>
<br>
<body>
	<div class="container">
	    <ol class="breadcrumb" style="width: 500px;">
        <li class="breadcrumb-item"><a href="#">User</a></li>
        <li class="breadcrumb-item"><a href="#">Profile</a></li>
        <li class="breadcrumb-item"><a href="#">Donated Products</a></li>
        <li class="breadcrumb-item"><a href="#">Details</a></li>
        <li class="breadcrumb-item active"><a href="#">Report Status</a></li>

    </ol>
	    <section class="text-gray-600 body-font overflow-hidden">
          <div class="container px-5 py-24 mx-auto">
            <div class="lg:w-4/5 mx-auto flex flex-wrap">
              <img alt="ecommerce" class="lg:w-1/2 w-full lg:h-1/2 h-66 object-cover object-center rounded" src="<?= $donation->e_img ?>">
              <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                <h3 class="text-sm title-font text-gray-500 tracking-widest">Service Center Details</h3>
                                
                <p class="leading-relaxed"><b>Request Approved by(Service Center):</b> <?= $donation->s_name; ?></p>
                <?php if($donation->service_feedback!=""){ ?>

                  <p class="leading-relaxed"><b>Problem:</b> <?= $donation->problem; ?></p>
                  <p class="leading-relaxed"><b>Service Feedback:</b> <?= $donation->service_feedback; ?></p>
                  <p class="leading-relaxed"><b>Credit Points Allotted:</b> <?= $donation->s_creditpoints; ?></p>
                <?php } ?>


                <h3 class="text-sm title-font text-gray-500 tracking-widest">Service Center Contact Details</h3>                     
                <p class="leading-relaxed"><b>Contact No:</b> <?= $donation->s_contact; ?></p>
                <p class="leading-relaxed"><b>Email Id:</b> <?= $donation->s_email; ?></p>

                 <?php if($donation->r_id!=0){ ?>
                   <h3 class="text-sm title-font text-gray-500 tracking-widest">Recycler Details</h3>

                   <p class="leading-relaxed"><b>Request Approved by(Recycler):</b> <?= $donation->r_name; ?></p>
                                      
                
                <?php if($donation->recycler_feedback!=""){ ?>
                  
                  <p class="leading-relaxed"><b>Recycler Feedback:</b> <?= $donation->recycler_feedback; ?></p>
                  <p class="leading-relaxed"><b>Credit Points Allotted:</b> <?= $donation->r_creditpoints; ?></p>
                   <h3 class="text-sm title-font text-gray-500 tracking-widest">Elements Retrieved</h3>
                   <p class="leading-relaxed"><b>Gold-></b><?= $donation->gold ?>%</p> 
                <p class="leading-relaxed"><b>Silver-></b><?= $donation->silver ?>%</p> 
                <p class="leading-relaxed"><b>Palladium-></b><?= $donation->palladium ?>%</p> 
                <p class="leading-relaxed"><b>Copper-></b><?= $donation->copper ?>%</p> 
                <p class="leading-relaxed"><b>Other Metals-></b><?= $donation->other_metals ?>%</p>
                <p class="leading-relaxed"><b>Other Non-Metals-></b><?= $donation->other_non_metals ?>%</p>
                <?php } ?>
                <h3 class="text-sm title-font text-gray-500 tracking-widest">Recycler Contact Details</h3>   
                <p class="leading-relaxed"><b>Contact No:</b> <?= $donation->r_contact; ?></p>
                <p class="leading-relaxed"><b>Email Id:</b> <?= $donation->r_email; ?></p>
                <?php } ?>
                        
              </div>
          
            </div>
          </div>
        </section>
	</div>    
<?php include('footer.php');?>