<?php include('header_service.php'); ?>
<br>
<div class="container">
	<?php echo form_open("service/updatePassword"); ?> 

	<ol class="breadcrumb" style="width: 410px;">
        <li class="breadcrumb-item"><a href="#">Service Center</a></li>
        <li class="breadcrumb-item"><a href="#">Profile</a></li>
        <li class="breadcrumb-item active">Change Password</li>
    </ol>
    <br>
  <fieldset>
    <h2 class="text-primary">Change Password</h2>
    <br>

<div class="row">
	<div class="col-lg-6">
	    <div class="form-group">
	      <label for="exampleInputEmail1">Enter Old Password</label>
	      <?php echo form_input(['name'=>'passwordold','type'=>'password','class'=>'form-control','placeholder'=>'Enter Old password']); ?>
	    </div>
	</div>
	<div class="col-lg-6">
		<?php echo form_error('passwordold');?>
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
	    <div class="form-group">
	      <label for="exampleInputEmail1">Enter New Password</label>
	      <?php echo form_input(['name'=>'password','type'=>'password','class'=>'form-control','placeholder'=>'Enter New Password']); ?>
	    </div>
	</div>
	<div class="col-lg-6">
		<?php echo form_error('password');?>
	</div>
</div>
    <br><br>
    <?php echo form_reset(['name'=>'reset','class'=>'btn btn-primary','value'=>'Reset']); ?>
    <?php echo form_submit(['name'=>'submit','class'=>'btn btn-primary','value'=>'Submit']); ?>
  </fieldset>
</form>
</div>

<?php include('footer.php'); ?>