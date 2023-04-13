<?php include('header_recycler.php');?>
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
        <li class="breadcrumb-item"><a href="#">Recycler</a></li>
        <li class="breadcrumb-item active">Profile</li>
    </ol>
    <br>
    <h2 class="text-primary" style="padding-bottom: 10px">Details</h2>
    	<table style="font-size: 20px;border-spacing: 0 30px; border-collapse: separate; width: 60%">
    		<tr>
		      <th>Role:&nbsp;</th>
		      <td>Recycler</td>
		      <td rowspan="5"><img src="<?= $recycler->profile_img ?>" alt="Profile image" height="158px" width="158px" style="border-radius: 50%;"> </td>
    		</tr>
    		<tr>
              <th>Name:&nbsp;</th>
              <td><?= $recycler->fname ?></td>
              <td> </td>
            </tr>
            <tr>
              <th>Company:&nbsp;</th>
              <td><?= $recycler->cname ?></td>
              <td> </td>
            </tr >
            <tr>
              <th>Contact:&nbsp;</th>
              <td><?= $recycler->contact ?></td>
              <td> </td>
            </tr>
            <tr>
              <th>Email:&nbsp;</th>
              <td><?= $recycler->email ?></td>
              <td> </td>
            </tr>
            <tr>
              <th>Address:&nbsp;</th>
              <td><?= $recycler->address ?></td>
              <td> </td>
            </tr>
    	</table>
      <br>
        <div>
            <?= anchor("recycler/updateProfilePhoto",'Update Profile Photo',['class'=>'btn btn-primary']);?>
            <br><br>
            <?= anchor("recycler/editProfile",'Edit Profile',['class'=>'btn btn-warning']);?>   
            <?= anchor("recycler/changePassword",'Change Password',['class'=>'btn btn-warning']);?>   
            <br><br>
            <?= anchor("recycler/recycledProducts",'Recycled Products',['class'=>'btn btn-info']);?>
            
        </div>
        <br>
  </div>
	</div>
</body>
<br>
<?php include('footer.php');?>