<?php include('header_service.php');?>
<br>
<body>
<div class="container">
    <ol class="breadcrumb" style="width: 250px;">
        <li class="breadcrumb-item"><a href="#">Service Center</a></li>
        <li class="breadcrumb-item active">Set Status</li>
    </ol>
    <?php if($error = $this->session->flashdata('feedback')): ?>    
      <div class="row">
        <div class="col-lg-6">
           <div class="alert alert-dismissible alert-<?=$this->session->flashdata('class')?>">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <a href="#" class="alert-link">
              <?= $error ?>
            </a>
          </div>
        </div>
      </div>
      <?php endif; ?>
  <section class="text-gray-600 body-font">
  <div class="container px-5 py-24 mx-auto">
    <h2 class="text-primary">Set Status</h2><br>
    <div class="flex flex-wrap -m-4">
         <?php          
           if(!empty($status))
           {
            foreach($status as $row)
            {
         ?>
        <?php $option=0;
          $status= $row->service_feedback; 
          $disable='';
          if($status!='')
            $disable='disabled'; ?>
             <div class="lg:w-1/4 md:w-1/2 p-4 w-full">
              <a class="block relative h-53 rounded overflow-hidden">
                <img alt="ecommerce" class="object-cover object-center w-full h-full block" src="<?= $row->e_img ?>">
              </a>
              <div class="mt-4">
                <h3 class="text-gray-500 text-xs tracking-widest title-font mb-1"><?php echo $row->e_type ;?></h3>
                <h2 class="text-gray-900 title-font text-lg font-medium"><?php echo $row->e_name ;?></h2>
                <p class="mt-1">Quantity: <?php echo $row->e_quantity ;?></p>
                <?= anchor("service/productDetails/{$row->e_id}/{$option}",'More Details',['class'=>'btn btn-info echo $disable']);?>
                <br><br>
                <?= anchor("service/updateStatus/{$row->e_id}",'Update Status',['class'=>'btn btn-warning '.$disable]);?>
              
                
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
  </div>
</section>
    
    <div>
        <?= $this->pagination->create_links(); ?>
    </div>    

</div>
<?php include('footer.php');?>
