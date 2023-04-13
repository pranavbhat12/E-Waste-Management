<?php include('header_recycler.php'); ?>
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<div class="container">
	  <br><br>
	  <br> 
	  <?php if($feedback = $this->session->flashdata('feedback')): ?> 
	  	<?php $class = $this->session->flashdata('class');?>   
		<div class="row">
			<div class="col-lg-6">
				 <div class="alert alert-dismissible alert-<?php echo $class; ?>">
				  <button type="button" class="close" data-dismiss="alert">&times;</button>
				  <strong></strong> <a href="#" class="alert-link">
				  	<?= $feedback ?>
				  </a>
				</div>
			</div>
		</div>
	<?php endif; ?>
	<br>
	<div class="jumbotron">
	  <h1 class="display-3">Welcome <?= $name->cname ?>!</h1>
	  <p class="lead">Welcome to EWM, A web applications which allows you to buy refurbished products from the most entrusted sellers. It also provides you an opportunity to save the planet by recycling your E-waste in an organised and transperent way.</p>
	  <hr class="my-4">
	  <br>
	  <?= anchor("recycler/editProfile",'Edit Profile',['class'=>'btn btn-warning']);?>
	  <p class="lead">
	  </p>
	</div>
	<br>
	
	<section class="text-gray-600 body-font overflow-hidden">
  <div class="container px-5 py-24 mx-auto">
    <div class="flex flex-wrap -m-12">
      <div class="p-12 md:w-1/2 flex flex-col items-start">
        <span class="inline-block py-1 px-2 rounded bg-green-50 text-green-500 text-xs font-medium tracking-widest">CATEGORY</span>
        <h2 class="sm:text-3xl text-2xl title-font font-medium text-gray-900 mt-3 mb-4">Recent Items Recycled</h2>
		<?php $count=0;?>
        <p class="leading-relaxed mb-1"><?php foreach($recycled as $recycled): ?>
			
			<p><?= ++$count ?>&nbsp;&nbsp;<?= $recycled->e_name?>&nbsp;&nbsp;<?= anchor("recycler/recycledProductDetails/{$recycled->e_id}",'View Details',['class'=>'btn btn-info']);?></p>
			<br>
		<?php endforeach; ?></p>
        <div class="flex items-center flex-wrap pb-4 mb-4 border-b-2 border-gray-100 mt-auto w-full">
          <a class="text-green-500 inline-flex items-center" href="recycledProducts">See More
            <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path d="M5 12h14"></path>
              <path d="M12 5l7 7-7 7"></path>
            </svg>
          </a>
          
        </div>
   
      </div>
      <div class="p-12 md:w-1/2 flex flex-col items-start">
        <span class="inline-block py-1 px-2 rounded bg-green-50 text-green-500 text-xs font-medium tracking-widest">CATEGORY</span>
        <h2 class="sm:text-3xl text-2xl title-font font-medium text-gray-900 mt-3 mb-4">Recent Request</h2>
		<?php $count=0; ?>
        <p class="leading-relaxed mb-1">	<?php foreach($request as $request): ?>
			
			<p><?= ++$count ?>&nbsp;&nbsp;<?= $request->e_type?>&nbsp;&nbsp;<?= date('d M y H:i:s',strtotime($request->date)) ?>&nbsp;&nbsp;<button  name="accept" formaction="<?= base_url('recycler/accept') ?>" type="submit" class="btn btn-primary"  value="<?= $request->e_id ?>">Accept</button></p><br>
	<?php endforeach; ?></p>
	<br>
        <div class="flex items-center flex-wrap pb-4 mb-4 border-b-2 border-gray-100 mt-auto w-full">
          <a class="text-green-500 inline-flex items-center" href="requestPage">See More
            <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path d="M5 12h14"></path>
              <path d="M12 5l7 7-7 7"></path>
            </svg>
          </a>
         
        </div>
        
      </div>
    </div>
  </div>
</section>

	
</div> 
<?php include('footer.php'); ?>