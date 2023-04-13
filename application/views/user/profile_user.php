<?php include('header_user.php');?>
<br><br>
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
        <li class="breadcrumb-item"><a href="#">User/Organisation</a></li>
        <li class="breadcrumb-item active">Profile</li>
    </ol>
    <br>
    <h2 class="text-primary" style="padding-bottom: 10px">Details</h2>
    	<table style="font-size: 20px;border-spacing: 0 30px; border-collapse: separate; width: 60%">
    		<tr>
		      <th>Role:&nbsp;</th>
		      <td>User</td>
		      <td rowspan="5"><img src="<?= $user->profile_img ?>" alt="Profile Image" height="158px" width="158px" style="border-radius: 50%;"> 
          </td>
    		</tr>
    		<tr>
		      <th>Name:&nbsp;</th>
		      <td><?= $user->fname ?></td>
		      <td> </td>
    		</tr>
    		<tr>
		      <th>Company:&nbsp;</th>
		      <td><?= $user->cname ?></td>
		      <td> </td>
    		</tr >
    		<tr>
		      <th>Contact:&nbsp;</th>
		      <td><?= $user->contact ?></td>
		      <td> </td>
    		</tr>
        <tr>
          <th>Email:&nbsp;</th>
          <td><?= $user->email ?></td>
          <td> </td>
        </tr>
        <tr>
          <th>Address:&nbsp;</th>
          <td><?= $user->address ?></td>
          <td> </td>
        </tr>
        
    	</table>
      <p style="font-size: 120%"><b>Credit Points:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $user->creditpoints ?></p>
        <br>
        <div>
            <?= anchor("user/updateProfilePhoto",'Update Profile Photo',['class'=>'btn btn-primary']);?>
            <br><br>
            <?= anchor("user/editProfile",'Edit Profile',['class'=>'btn btn-warning']);?>   
            <?= anchor("user/changePassword",'Change Password',['class'=>'btn btn-warning']);?>   
            <br><br>
            <?= anchor("user/yourOrders",'Your Orders',['class'=>'btn btn-info']);?>
            <?= anchor("user/yourDonations",'Your Donations',['class'=>'btn btn-info']);?>
        </div>
	</div>
</body>
<?php include('footer.php');?>