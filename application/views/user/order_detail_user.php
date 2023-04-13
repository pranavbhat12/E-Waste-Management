<?php include('header_user.php');?>
<br>
<body>
    <div class="container">
    <ol class="breadcrumb" style="width: 330px;">
        <li class="breadcrumb-item"><a href="#">User</a></li>
        <li class="breadcrumb-item"><a href="#">Profile</a></li>
        <li class="breadcrumb-item"><a href="#">Your Orders</a></li>
        <li class="breadcrumb-item active">Details</li>
    </ol>    
    <br>
    <h2 class="text-primary">Order Details</h2>
        <section class="text-gray-600 body-font overflow-hidden">
          <div class="container px-5 py-24 mx-auto">
            <div class="lg:w-4/5 mx-auto flex flex-wrap ">
        <?php if( count($order) ):
         
        $countR=0;
        $countDis=0;
        $countDel=0;
        $track="Yet to be Ready";
        
        foreach ($order as $order): ?>
          <?php 
            
                $track=$order->Tracking;
          if($track=="Ready")
            $countR+=1;
          else if($track=="Dispatched")
            $countDis+=1;
          else if($track=="Delivered")
            $countDel+=1;
          ?>


              <img alt="ecommerce" class="lg:w-1/2 w-full lg:h-1/2 h-65 object-cover object-center rounded" src="<?= $order->p_img1 ?>">
              <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0" style="margin-bottom: 5%">
                <h2 class="text-sm title-font text-gray-500 tracking-widest"><?= $order->p_type; ?></h2>
                <?= anchor("user/productDetails/{$order->p_id}/1",$order->p_name,['class'=>'text-gray-900 text-3xl title-font font-medium mb-1']);?>
                <br><br>
                <p class="leading-relaxed"><b>Specifications:</b> <?= $order->p_specs; ?></p>
                <p class="leading-relaxed"><b>Quantity:</b> <?= $order->quantity; ?></p>
                <p class="leading-relaxed"><b>Sub Total:</b> <?= $order->amount; ?></p>          
                <p class="leading-relaxed"><b>Delivery Status:<?php if(!empty($track)) echo $track; else echo "Yet to be Ready for Dispatch"; ?></b></p>
                  <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: <?php if( $track=="Ready") {?> 35%<?php }
                    else if( $track=="Disptached") {?>70%<?php }
                    else if( $track=="Delivered")  {?>100%<?php } 
                      else { ?>0%<?php }  ?> " >
                    </div>  
                  </div> 
                  <?php if($track=="Delivered" && $order->rating==0) {?>
                    <br><?= anchor("user/giveFeedback/{$order->p_id}",'Give Feedback',['class'=>'btn btn-info']);?>
                  <?php } else if($order->review!=''){?>
                    <br><p class="leading-relaxed"><b>Your Feedback:</b> <?= $order->review; ?></p>
                    <div class="flex mb-4">
                      <span class="flex items-center">

                        <?php for($i=0;$i<$order->rating;$i++)
                          echo '<svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-yellow-500" viewBox="0 0 24 24">
                          <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                        </svg>';
                        ?>                      

                        <?php for($i=$order->rating;$i<5;$i++)
                          echo '<svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-yellow-500" viewBox="0 0 24 24">
                          <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                        </svg>';
                        ?>
                      </span>
                    </div>
                  <?php }?>               
                </div>  
              <br>

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