<?php include('header_service.php');?>
<br>
<body>
	<div class="container">
    <?php if($feedback = $this->session->flashdata('feedback')): ?>    
      <div class="row">
        <div class="col-lg-6">
           <div class="alert alert-dismissible alert-<?=$this->session->flashdata('class')?>">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong></strong> <a href="#" class="alert-link">
              <?= $feedback ?>
            </a>
          </div>
        </div>
      </div>
      <?php endif; ?>
    <ol class="breadcrumb" style="width: 250px;">
        <li class="breadcrumb-item"><a href="#">Service Center</a></li>
        <li class="breadcrumb-item active">Profile</li>
    </ol>
    <br>
    <h2 class="text-primary" style="padding-bottom: 10px">Details</h2>
    	<table style="font-size: 20px;border-spacing: 0 30px; border-collapse: separate; width: 60%">
    		<tr>
		      <th>Role:&nbsp;</th>
		      <td>Service Center</td>
		      <td rowspan="5"><img src="<?= $service->profile_img ?>" alt="Profile image" height="158px" width="158px" style="border-radius: 50%;"> </td>
    		</tr>
    		<tr>
		      <th>Name:&nbsp;</th>
		      <td><?= $service->fname ?></td>
		      <td> </td>
    		</tr>
    		<tr>
		      <th>Company:&nbsp;</th>
		      <td><?= $service->cname ?></td>
		      <td> </td>
    		</tr >
    		<tr>
		      <th>Contact:&nbsp;</th>
		      <td><?= $service->contact ?></td>
		      <td> </td>
    		</tr>
    		<tr>
		      <th>Email:&nbsp;</th>
		      <td><?= $service->email ?></td>
		      <td> </td>
    		</tr>
            <tr>
              <th>Address:&nbsp;</th>
              <td><?= $service->address ?></td>
              <td> </td>
            </tr>
    	</table>
        <br>
        <div>
            <?= anchor("service/updateProfilePhoto",'Update Profile Photo',['class'=>'btn btn-primary']);?>
            <br><br>
            <?= anchor("service/editProfile",'Edit Profile',['class'=>'btn btn-warning']);?>   
            <?= anchor("service/changePassword",'Change Password',['class'=>'btn btn-warning']);?>   
            <br><br>
            <?= anchor("service/historyProducts",'History of Sold Products',['class'=>'btn btn-info']);?>
            <?= anchor("service/servicedProducts",'Serviced Products',['class'=>'btn btn-info']);?>
       </div>
        <br>
    </div>
	</div>
</body>
<br>
<?php include('footer.php');?>