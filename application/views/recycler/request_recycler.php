<?php include('header_recycler.php');?>
<br>
<body>
<div class="container">
    <ol class="breadcrumb" style="width: 250px;">
        <li class="breadcrumb-item"><a href="#">Recycler</a></li>
        <li class="breadcrumb-item active">Requests</li>
    </ol>
    <br>
    <h2 class="text-primary">Pending Requests</h2>
    <br><br>
    <div class="row">
        <?php
             if(!empty($request))
             {
                foreach ($request as $row) 
             { ?>
        <div class="lg:w-1/4 md:w-1/2 p-4 w-full">
              <a class="block relative h-53 rounded overflow-hidden">
                <img alt="ecommerce" class="object-cover object-center w-full h-full block" src="<?= $row->e_img ?>">
              </a>
              <div class="mt-4">
                <h3 class="text-gray-500 text-xs tracking-widest title-font mb-1"><?php echo $row->e_type ;?></h3>
                <h2 class="text-gray-900 title-font text-lg font-medium"><?php echo $row->e_name ;?></h2>
                <p class="mt-1">Quantity: <?php echo $row->e_quantity ;?></p>
                <?php $option=1 ?>
                <?= anchor("recycler/productDetails/{$row->e_id}/{$option}",'More Details',['class'=>'btn btn-info']);?>
                <br><br>
                <form method="post">
                    <button  name="accept" formaction="<?= base_url('recycler/accept') ?>" type="submit" class="btn btn-primary"  value="<?= $row->e_id ?>">Accept</button>                   
                </form>
              </div>
        </div>
       <?php
        }
        }
       else{
       echo "No result found";
        }
        ?>
     </div>
        <!--this is in div row -->
            <div>
               <?= $this->pagination->create_links(); ?>
            </div>
</div>
</body>
<?php include('footer.php');
