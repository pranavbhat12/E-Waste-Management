<?php include('header_user.php'); ?> 
<br>
<div class="container">
	<?php echo form_open_multipart('user/updatePhoto'); ?>
  <fieldset>
  	<br><br>
    <ol class="breadcrumb" style="width: 430px;">
        <li class="breadcrumb-item"><a href="#">User/Organisation</a></li>
        <li class="breadcrumb-item"><a href="#">Profile</a></li>
        <li class="breadcrumb-item active">Update Profile Photo</li>
    </ol>
    <br>
    <h2 class="text-primary" style="padding-bottom: 10px">Current Profile Photo</h2>
    <br>
    <img src="<?= $data->profile_img ?>" alt="Profile Image" height="158px" width="158px" style="border-radius: 50%;">
    <br><br><br>
<div class="row">
	<div class="col-lg-6">
	    <div class="form-group">
	      <label for="exampleInputEmail1">Update Profile Picture/Company Logo</label>
	      <br>
	      <?php echo form_upload(['name'=>'userfile','class'=>'custom-file']); ?>
	    </div>
	</div>
	<div class="col-lg-6">
		<?php if(isset($upload_error)) echo $upload_error ?>
	</div>
</div>
    <br>
    <?php echo form_submit(['name'=>'submit','class'=>'btn btn-primary','value'=>'Update']); ?>
  </fieldset>
</form>
</div>
	
<?php include('footer.php'); ?>