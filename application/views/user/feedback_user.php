<?php include('header_user.php'); ?> 
<br>
<div class="container">
	<?php echo form_open('user/updateFeedback'); ?>
	<ol class="breadcrumb" style="width: 450px;">
        <li class="breadcrumb-item"><a href="#">User/Organisation</a></li>
        <li class="breadcrumb-item"><a href="#">Profile</a></li>
        <li class="breadcrumb-item"><a href="#">Your Orders</a></li>
        <li class="breadcrumb-item"><a href="#">Details</a></li>
        <li class="breadcrumb-item active">Give Feedback</li>
    </ol>
    <br>
  <fieldset>
  	<br><br>
    <h1 class="text-primary">Give Feedback</h1>
    <br>

<div class="row">
	<div class="col-lg-6">
	    <div class="form-group">
	      <label for="exampleInputEmail1">Feedback:</label>
	      <?php echo form_textarea(['name'=>'review','type'=>'text','class'=>'form-control','placeholder'=>'How was the Product?']); ?>
	    </div>
	</div>
	<div class="col-lg-6">
		<?php echo form_error('address');?>
	</div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
        <label for="exampleInputEmail1">How many stars would you give it out of 5?</label>      
        <?php $options = array(1=>'1',2=>'2',3=>'3',4=>'4',5=>'5');?>
        <?php echo form_dropdown('rating',$options,'Rating',['class'=>'custom-select']); ?>
      </div>
    </div>
</div>

    <br>
    <?php echo form_reset(['name'=>'reset','class'=>'btn btn-primary','value'=>'Reset']); ?>
    <?php echo form_submit(['name'=>'submit','class'=>'btn btn-primary','value'=>'Enter']); ?>
  </fieldset>
</form>
</div>

<?php include('footer.php'); ?>