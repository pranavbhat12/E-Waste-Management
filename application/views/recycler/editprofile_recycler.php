<?php include('header_recycler.php'); ?> 
<br>
<div class="container">
	<?php echo form_open('recycler/updateProfile'); ?>
	<ol class="breadcrumb" style="width: 410px;">
        <li class="breadcrumb-item"><a href="#">Recycler</a></li>
        <li class="breadcrumb-item"><a href="#">Profile</a></li>
        <li class="breadcrumb-item active">Edit Profile</li>
    </ol>
  <fieldset>
  	<br>
    <h1 class="text-primary">Edit Profile</h1>
    <br>

<div class="row">
	<div class="col-lg-6">
	    <div class="form-group">
	      <label for="exampleInputEmail1">Company Name</label>
	      <?php echo form_input(['name'=>'cname','type'=>'text','class'=>'form-control','placeholder'=>'Enter Company Name','value'=>set_value('cname',$profile->cname)]); ?>
	    </div>
	</div>
	<div class="col-lg-6">
		<?php echo form_error('cname');?>
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
	    <div class="form-group">
	      <label for="exampleInputEmail1">Contact No</label>
	      <?php echo form_input(['name'=>'contact','type'=>'number','class'=>'form-control','placeholder'=>'Enter Mobile No','value'=>set_value('contact',$profile->contact)]); ?>
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
	      <?php echo form_input(['name'=>'email','type'=>'text','class'=>'form-control','placeholder'=>'Enter Email ID','value'=>set_value('email',$profile->email)]); ?>
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
	      <?php echo form_textarea(['name'=>'address','type'=>'text','class'=>'form-control','placeholder'=>'Enter Address','value'=>set_value('address',$profile->address)]); ?>
	    </div>
	</div>
	<div class="col-lg-6">
		<?php echo form_error('address');?>
	</div>
</div>

    <br>
    <?php echo form_reset(['name'=>'reset','class'=>'btn btn-primary','value'=>'Reset']); ?>
    <?php echo form_submit(['name'=>'submit','class'=>'btn btn-primary','value'=>'Enter']); ?>
  </fieldset>
</form>
</div>

<?php include('footer.php'); ?>