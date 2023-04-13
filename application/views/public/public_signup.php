<?php include('header_login.php'); ?> 
<br>
<div class="container">
	<?php echo form_open_multipart('login/verifySignUp'); ?>
  <fieldset>
  	<br><br>
    <h1 class="text-primary">SignUp</h1>
    <br>

<?php if($error = $this->session->flashdata('login_failed')): ?>    
<div class="row">
	<div class="col-lg-6">
		 <div class="alert alert-dismissible alert-danger">
		  <button type="button" class="close" data-dismiss="alert">&times;</button>
		  <strong>Oh snap!</strong> <a href="#" class="alert-link">
		  	<?= $error ?>
		  </a>
		</div>
	</div>
</div>
<?php endif; ?>

<div class="row">
	<div class="col-lg-6">
	    <div class="form-group">
	      <label for="exampleInputEmail1">Owner's Full Name</label>
	      <?php echo form_input(['name'=>'fname','type'=>'text','class'=>'form-control','placeholder'=>'Enter Full Name','value'=>set_value('fname')]); ?>
	    </div>
	</div>
	<div class="col-lg-6">
		<?php echo form_error('fname');?>
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
	    <div class="form-group">
	      <label for="exampleInputEmail1">Company Name</label>
	      <?php echo form_input(['name'=>'cname','type'=>'text','class'=>'form-control','placeholder'=>'Enter Company Name','value'=>set_value('cname')]); ?>
	    </div>
	</div>
	<div class="col-lg-6">
		<?php echo form_error('cname');?>
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
	    <div class="form-group">
	      <label for="exampleInputEmail1">Role</label>      
	      <?php $options = array('user'=>'User','service'=>'Service Center','recycler'=>'Recycler');?>
	      <?php echo form_dropdown('role',$options,'Role',['class'=>'custom-select']); ?>
	    </div>
	</div>
	<div class="col-lg-6">
		<?php echo form_error('role');?>
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
	    <div class="form-group">
	      <label for="exampleInputEmail1">Contact No</label>
	      <?php echo form_input(['name'=>'contact','type'=>'number','class'=>'form-control','placeholder'=>'Enter Mobile No','value'=>set_value('contact')]); ?>
	    </div>
	</div>
	<div class="col-lg-6">
		<?php echo form_error('contact');?>
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
	    <div class="form-group">
	      <label for="exampleInputEmail1">Email ID</label>
	      <?php echo form_input(['name'=>'email','type'=>'text','class'=>'form-control','placeholder'=>'Enter Email ID','value'=>set_value('email')]); ?>
	    </div>
	</div>
	<div class="col-lg-6">
		<?php echo form_error('email');?>
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
	    <div class="form-group">
	      <label for="exampleInputEmail1">Address</label>
	      <?php echo form_textarea(['name'=>'address','type'=>'text','class'=>'form-control','placeholder'=>'Enter Address','value'=>set_value('address')]); ?>
	    </div>
	</div>
	<div class="col-lg-6">
		<?php echo form_error('address');?>
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
	    <div class="form-group">
	      <label for="exampleInputPassword1">Password</label>
	      <?php echo form_input(['name'=>'pword','type'=>'password','class'=>'form-control','placeholder'=>'Enter Password','value'=>set_value('pword')]); ?>
	    </div>
	</div>
	<div class="col-lg-6">
		<?php echo form_error('pword');?>
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
	    <div class="form-group">
	      <label for="exampleInputEmail1">Profile Picture/Company Logo</label>
	      <br>
	      <?php echo form_upload(['name'=>'userfile','class'=>'custom-file']); ?>
	    </div>
	</div>
	<div class="col-lg-6">
		<?php if(isset($upload_error)) echo $upload_error ?>
	</div>
</div>


    <br>
    <?php echo form_reset(['name'=>'reset','class'=>'btn btn-primary','value'=>'Reset']); ?>
    <?php echo form_submit(['name'=>'submit','class'=>'btn btn-primary','value'=>'Enter']); ?>
  </fieldset>
</form>
</div>

<?php include('footer.php'); ?>