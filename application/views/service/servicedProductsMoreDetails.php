<?php include('header_service.php');?>
<br>
<body>
	<div class="container">
	    <ol class="breadcrumb" style="width: 450px;">
	        <li class="breadcrumb-item"><a href="#">Service</a></li>
           <li class="breadcrumb-item"><a href="#">Serviced Products</a></li>
	        <li class="breadcrumb-item active">Serviced Product Detail</li>
	    </ol>	   
	    <section class="text-gray-600 body-font overflow-hidden">
          <div class="container px-5 py-24 mx-auto">
            <div class="lg:w-4/5 mx-auto flex flex-wrap">
              <img alt="ecommerce" class="lg:w-1/2 w-full lg:h-1/2 h-66 object-cover object-center rounded" src="<?= $details->e_img ?>">
              <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                <h2 class="text-sm title-font text-gray-500 tracking-widest"><?= $details->e_type ?></h2>
                <h1 class="text-gray-900 text-3xl title-font font-medium mb-1"><?= $details->e_name ?></h1>                
                <p class="leading-relaxed"><b>Specifications:</b> <?= $details->e_specs; ?></p>
                <p class="leading-relaxed"><b>Usage(In Months):</b> <?= $details->e_age ?></p>                      
                <p class="leading-relaxed"><b>Quantity:</b> <?= $details->e_quantity; ?></p>
                <p class="leading-relaxed"><b>Problem:</b> <?= $details->problem; ?></p>
                <p class="leading-relaxed"><b>Feedback:</b> <?= $details->service_feedback; ?></p>
                
                <p class="leading-relaxed"><b>Credit Points Allotted:</b> <?= $details->s_creditpoints; ?></p>

              </div>
            </div>
          </div>
        </section>
	</div>    
</body>
<?php include('footer.php');?>