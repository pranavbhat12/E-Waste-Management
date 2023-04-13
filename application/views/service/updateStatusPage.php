<?php include('header_service.php');?>

<br><br>
<div class="container">
    <ol class="breadcrumb" style="width: 430px;">
        <li class="breadcrumb-item"><a href="#">Service</a></li>
         <li class="breadcrumb-item"><a href="#">Set Status</a></li>
        <li class="breadcrumb-item"><a href="#">Update Status</a></li>
     
    </ol>
    <br>
   
    <?php echo form_open_multipart('service/statusCheck'); ?>
    <?= form_hidden('date',date('Y-m-d H:i:s')) ?>
    <fieldset>
      
      <h2 class="text-primary">Update Status of the Product</h2>
      <br>

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

      <div class="row">
    <div class="col-lg-6">
        <div class="form-group">
          <label for="Problem">What was the problem?</label>
          <?php echo form_textarea(['name'=>'problem','type'=>'text','class'=>'form-control','placeholder'=>'Enter Details Here','value'=>set_value('problem')]); ?>
          <?php echo form_input(['name'=>'e_id','type'=>'hidden','class'=>'form-control','value'=>$e_id]); ?>
        </div>
    </div>
    <div class="col-lg-6">
      <?php echo form_error('problem');?>
    </div>
  </div>

   <div class="row">
    <div class="col-lg-6">
        <div class="form-group">
          <label for="What Did You Do">Describe in detail what did you do?</label>
          <?php echo form_textarea(['name'=>'service_feedback','type'=>'text','class'=>'form-control','placeholder'=>'Enter Details','value'=>set_value('service_feedback')]); ?>
        </div>
    </div>
    <div class="col-lg-6">
      <?php echo form_error('service_feedback');?>
    </div>
  </div>


  <div class="row">
    <div class="col-lg-6">
        <div class="form-group">
        <label for="exampleInputEmail1">How many credit points would you give this E-waste out of 5?</label>      
        <?php $options = array(1=>'1',2=>'2',3=>'3',4=>'4',5=>'5');?>
        <?php echo form_dropdown('creditpoints',$options,'Credit Points',['class'=>'custom-select']); ?>
      </div>
    </div>
  </div>

  <br>
    <?php echo form_reset(['name'=>'reset','class'=>'btn btn-warning','value'=>'Reset']); ?>
    <?php echo form_submit(['name'=>'submit','class'=>'btn btn-success','value'=>'Submit']); ?>
  </fieldset>
</div>
<?php include('footer.php');?>