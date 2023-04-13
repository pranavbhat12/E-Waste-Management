<?php include('header_user.php');?>
<br>
<body>
    <div class="container">
    <ol class="breadcrumb" style="width: 250px;">
        <li class="breadcrumb-item"><a href="#">User</a></li>
        <li class="breadcrumb-item active">Buying</li>
    </ol><br>
    <label for="exampleInputEmail1">Sort By / Search By </label> <br><br> 
    <?= form_open('user/search',['class'=>'form-inline my-2 my-lg-0']) ?> 
    <table>
      <tr>
        <td>    
          <?php $options = array(1=>'Price:Lowest to Highest',2=>'Price:Highest to Lowest');?>
          <?php echo form_dropdown('sortby',$options,'Sort By',['class'=>'custom-select']); ?>
        </td>
        <td>
          <?php echo form_input(['name'=>'search','type'=>'text','class'=>'form-control mr-sm-2','placeholder'=>'Name Or Category','value'=>set_value('search')]); ?>
        </td>
        <td>
          <?php echo form_submit(['name'=>'submit','class'=>'btn btn-primary','style'=>'color:white;','value'=>'Submit']); ?> 
        </td>
      </tr>
    </table>
    <?= form_close(); ?>
        
        <section class="text-gray-600 body-font">
          <div class="container px-5 py-24 mx-auto">
            <h2 class="text-primary">Our Top Rated Products</h2><br>
            <div class="flex flex-wrap -m-4">
        <?php if( count($products) ):
        $count=$this->uri->segment(3);
        foreach ($products as $products): ?>

        <div class="lg:w-1/4 md:w-1/2 p-4 w-full">
        <a class="block relative h-53 rounded overflow-hidden">
          <img alt="ecommerce" class="object-cover object-center w-full h-full block" src="<?= $products->p_img1 ?>">
        </a>
        <div class="mt-4">
          <h3 class="text-gray-500 text-xs tracking-widest title-font mb-1"><?= $products->p_type; ?></h3>
          <h2 class="text-gray-900 title-font text-lg font-medium"><?= $products->p_name; ?></h2>
          <div class="flex mb-4">
                      <span class="flex items-center">

                        <?php for($i=0;$i<$products->avg_rating;$i++)
                          echo '<svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-yellow-500" viewBox="0 0 24 24">
                          <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                        </svg>';
                        ?>                      

                        <?php for($i=$products->avg_rating;$i<5;$i++)
                          echo '<svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-yellow-500" viewBox="0 0 24 24">
                          <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                        </svg>';
                        ?>
                  </span>
                </div>
          <p class="mt-1">₹<?= $products->p_cost; ?></p>
          <?= anchor("user/addtoCart/{$products->p_id}",'Add to Cart',['class'=>'btn btn-success']);?>
          &nbsp;<br><br>
          <?= anchor("user/productDetails/{$products->p_id}/0",'More Details',['class'=>'btn btn-info']);?>
        </div>
      </div>

            <?php endforeach; ?>
            </div>
          </div>
        </section>
            <?php else: ?>
                <tr>
                  <td colspan="3">No records found.</td>
                </tr>
            <?php endif; ?>   
        

      <div>
        <?= $this->pagination->create_links(); ?>
      </div>
</div>    
</body>
<?php include('footer.php');?>