
<?php
   // if (isset($_POST['accept'])) 
   // {

   //  $this->db->update('ewaste',
   //      array('s_id'=>$this->session->userdata('id')),array('e_id'=>$_POST['hiddenAccept'])) ;
   //      header("refresh: 0");        
   // } 
   // if(isset($_POST['reject']))
   // {
   //   $this->db->update('ewaste',array('s_id'=>'01'),array('e_id'=>$_POST['hiddenAccept'])) ;
   //      header("refresh: 0"); 
   // }
// if(isset($_POST["reject"]))
// {
//     if(isset($_SESSION["shopping_cart"]))
//     {
//         $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
//         if(!in_array($_POST["hiddenAccept"], $item_array_id))
//         {
//             $count = count($_SESSION["shopping_cart"]);
//             $item_array = array(
//                 'item_id'           =>  $_POST["hiddenAccept"]
                
//             );
//             $_SESSION["shopping_cart"][$count] = $item_array;
//         }
//         else
//         {
//             echo '<script>alert("Item Already Added")</script>';
//         }
//     }
//     else
//     {
//         $item_array = array(
//             'item_id'   =>  $_POST["hiddenAccept"]
            
//         );
//         $_SESSION["shopping_cart"][0] = $item_array;
//     }
//     foreach($_SESSION["shopping_cart"] as $keys => $values)
//         {
//             if($values["item_id"] == $_POST["hiddenAccept"])
//             {
//                 // $this->db->update('ewaste',array('s_id'=>$this->session->userdata('id')),array('e_id'=>$values["item_id"])) ;       
//                 unset($_SESSION["shopping_cart"][$keys]);
//                 //header("refresh: 0"); 
//             }
//         }
// }
?>
<?php include('header_service.php');?>
<br>
<body>
<div class="container">
    <ol class="breadcrumb" style="width: 250px;">
        <li class="breadcrumb-item"><a href="#">Service Center</a></li>
        <li class="breadcrumb-item active">Requests</li>
    </ol>
    <br>
    <h2 class="text-primary">Pending Requests</h2>
    <br><br>
    <div class="row">

        <?php
           if(!empty($request))
           {
            foreach($request as $row)
            {  ?>
        <div class="lg:w-1/4 md:w-1/2 p-4 w-full">
              <a class="block relative h-53 rounded overflow-hidden">
                <img alt="ecommerce" class="object-cover object-center w-full h-full block" src="<?= $row->e_img ?>">
              </a>
              <div class="mt-4">
                <h3 class="text-gray-500 text-xs tracking-widest title-font mb-1"><?php echo $row->e_type ;?></h3>
                <h2 class="text-gray-900 title-font text-lg font-medium"><?php echo $row->e_name ;?></h2>
                <p class="mt-1">Quantity: <?php echo $row->e_quantity ;?></p>
                <?php $option=1 ?>
                <?= anchor("service/productDetails/{$row->e_id}/{$option}",'More Details',['class'=>'btn btn-info' ]);?>
                <br><br>
                <form action="<?= base_url('service/accept') ?>" method="post">                                                    
                    <input type="hidden" id="accept" name="hiddenAccept" value="<?= $row->e_id ?>">
                    <input type="submit" name="accept"  class="btn btn-primary"  value="Accept" />                                                           
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
