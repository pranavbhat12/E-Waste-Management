<?php include('header_recycler.php');?>

<br><br>
<div class="container">
    <ol class="breadcrumb" style="width: 430px;">
        <li class="breadcrumb-item"><a href="#">Recycler</a></li>
        <li class="breadcrumb-item"><a href="#">Set Status</a></li>
        <li class="breadcrumb-item"><a href="#">Update Status</a></li>    
    </ol>
    <br>
   
    <?php echo form_open_multipart('recycler/statusCheck'); ?>
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
          <label for="What Did You Do">Describe in detail what did you do to Recycle the Product?</label>
          <?php echo form_textarea(['name'=>'recycler_feedback','type'=>'text','class'=>'form-control','placeholder'=>'Enter Details','value'=>set_value('recycler_feedback')]); ?>
          <?php echo form_input(['name'=>'e_id','type'=>'hidden','class'=>'form-control','value'=>$e_id]); ?>
        </div>
    </div>
    <div class="col-lg-6">
      <?php echo form_error('recycler_feedback');?>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-6">
        <div class="form-group">
        <label for="forElements">How Many elements have you recovered(Approximately)?</label> <br>
        <label for="gold"> Gold</label>    

         <input type="checkbox" id="Element1" onclick="addElements(this,1)" name="Element1" />
          <div id="container1"></div>

        <label for="silver"> Silver</label>    

         <input type="checkbox" id="Element2" onclick="addElements(this,2)"  name="Element2" />
          <div id="container2"></div>

           <label for="palladium"> Palladium</label>    

         <input type="checkbox" id="Element3" onclick="addElements(this,3)"  name="Element3" />
          <div id="container3"></div>

           <label for="copper"> Copper</label>    

         <input type="checkbox" id="Element4" onclick="addElements(this,4)" name="Element4" />
          <div id="container4"></div>

           <label for="othermetals">Other Metals</label>    

         <input type="checkbox" id="Element5" onclick="addElements(this,5)"  name="Element5" />
          <div id="container5"></div>

           <label for="other non-metals"> Other-Nonmetals</label>    

         <input type="checkbox" id="Element6" onclick="addElements(this,6)"  name="Element6" />
          <div id="container6"></div>
       
      </div>
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
<script type="text/javascript">

 
  
  
  function addElements(cbox,index)
  {
    if (cbox.checked) {
          
        var input = document.createElement("input");
        input.type = "number";
        input.name=cbox.name+"Value";
         input.id=cbox.name+"Value";
        document.getElementById("container"+(index)).appendChild(input);
      } 

      else {
        document.getElementById(cbox.name+"Value").remove();
        document.getElementById('Element'+index).checked=false;
      }
  }
</script>
<?php include('footer.php');?>