<?php include('header_user.php');?>
<br>
<body>
	<div class="container">
	    <ol class="breadcrumb" style="width: 250px;">
	        <li class="breadcrumb-item"><a href="#">User</a></li>
	        <li class="breadcrumb-item active">Product Detail</li>
	    </ol>
	    <section class="text-gray-600 body-font overflow-hidden">
          <div class="container px-5 py-24 mx-auto">
            <div class="lg:w-4/5 mx-auto flex flex-wrap">
              <img alt="ecommerce" class="lg:w-1/2 w-full lg:h-full h-66 object-cover object-center rounded" src="<?= $details->p_img1 ?>">
              <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                <h2 class="text-sm title-font text-gray-500 tracking-widest"><?= $details->p_type ?></h2>
                <h1 class="text-gray-900 text-3xl title-font font-medium mb-1"><?= $details->p_name ?></h1>
                <div class="flex mb-4">
                      <span class="flex items-center">

                        <?php for($i=0;$i<$details->avg_rating;$i++)
                          echo '<svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-yellow-500" viewBox="0 0 24 24">
                          <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                        </svg>';
                        ?>                      

                        <?php for($i=$details->avg_rating;$i<5;$i++)
                          echo '<svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-yellow-500" viewBox="0 0 24 24">
                          <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                        </svg>';
                        ?>
                    <span class="text-gray-600 ml-3"><?=$details->no_reviews?> Reviews</span>
                  </span>
                </div>
                <p class="leading-relaxed"><b>Specifications:</b> <?= $details->p_specs; ?></p>
                <p class="leading-relaxed"><b>Seller:</b> <?= $details->cname ?></p>       
                <p class="leading-relaxed"><b>Price:</b> ₹<?= $details->p_cost ?></p>

               <?php if($option==0){   ?>
                <?= anchor("user/addtoCart/{$details->p_id}",'Add to Cart',['class'=>'btn btn-success']);?>  
            <?php } ?>
              </div>
            </div>
          </div>
        </section>


        <section class="text-gray-600 body-font overflow-hidden">
		  <div class="container px-5 py-24 mx-auto">
		  	<h3 class="text-primary">Review's</h3><br>
		    <div class="-my-8 divide-y-2 divide-gray-100">

		    <?php if( count($reviews) ):
		    foreach ($reviews as $reviews): ?>
		      <div class="py-8 flex flex-wrap md:flex-nowrap">
		        <div class="md:w-64 md:mb-0 mb-6 flex-shrink-0 flex flex-col">
		          <div class="flex mb-4">
                      <span class="flex items-center">

                        <?php for($i=0;$i<$reviews->rating;$i++)
                          echo '<svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-yellow-500" viewBox="0 0 24 24">
                          <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                        </svg>';
                        ?>                      

                        <?php for($i=$reviews->rating;$i<5;$i++)
                          echo '<svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-yellow-500" viewBox="0 0 24 24">
                          <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                        </svg>';
                        ?>
                  </span>
                </div>
		          <span class="mt-1 text-gray-500 text-sm"><?= $reviews->date?></span>
		        </div>
		        <div class="md:flex-grow">
		        <br>
		          <p class="leading-relaxed"><?= $reviews->review?></p><br>		          
		        </div>
		      </div>
		    <?php endforeach; ?>
		    <?php else: ?>
                <tr>
                	<br>
                  <td colspan="3">No reviews available for this Product.</td>
                </tr>
            <?php endif; ?>
	          
		    </div>
		  </div>
		</section>

		<section class="text-gray-600 body-font">
          <div class="container px-5 py-24 mx-auto">
            <h2 class="text-primary">Similar Products</h2><br>
            <div class="flex flex-wrap -m-4">
        <?php if( count($recommend) ):
        foreach ($recommend as $recommend): ?>

        <div class="lg:w-1/4 md:w-1/2 p-4 w-full">
        <a class="block relative h-53 rounded overflow-hidden">
          <img alt="ecommerce" class="object-cover object-center w-full h-full block" src="<?= $recommend->p_img1 ?>">
        </a>
        <div class="mt-4">
          <h3 class="text-gray-500 text-xs tracking-widest title-font mb-1"><?= $recommend->p_type; ?></h3>
          <h2 class="text-gray-900 title-font text-lg font-medium"><?= $recommend->p_name; ?></h2>
          <div class="flex mb-4">
                      <span class="flex items-center">

                        <?php for($i=0;$i<$recommend->avg_rating;$i++)
                          echo '<svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-yellow-500" viewBox="0 0 24 24">
                          <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                        </svg>';
                        ?>                      

                        <?php for($i=$recommend->avg_rating;$i<5;$i++)
                          echo '<svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-yellow-500" viewBox="0 0 24 24">
                          <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                        </svg>';
                        ?>
                  </span>
                </div>
          <p class="mt-1">₹<?= $recommend->p_cost; ?></p>
          <?= anchor("user/addtoCart/{$recommend->p_id}",'Add to Cart',['class'=>'btn btn-success']);?>
          &nbsp;<br><br>
          <?= anchor("user/productDetails/{$recommend->p_id}/0",'More Details',['class'=>'btn btn-info']);?>
        </div>
      </div>

            <?php endforeach; ?>
            
            <?php else: ?>
                <tr>
                  <td colspan="3">No records found.</td>
                </tr>
            <?php endif; ?>
            </div>
          </div>
        </section>
	</div>    

<?php include('footer.php');?>