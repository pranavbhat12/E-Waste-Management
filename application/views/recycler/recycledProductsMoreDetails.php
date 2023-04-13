<?php include('header_recycler.php');?>
<br>
<body>
	<div class="container">
	    <ol class="breadcrumb" style="width: 300px;">
	        <li class="breadcrumb-item"><a href="#">Recycler</a></li>
	        <li class="breadcrumb-item active">Recycled Product Detail</li>
	    </ol>
	    <br>
	    <section class="text-gray-600 body-font overflow-hidden">
          <div class="container px-5 py-24 mx-auto">
            <div class="lg:w-4/5 mx-auto flex flex-wrap">
              <img alt="ecommerce" class="lg:w-1/2 w-full lg:h-1/2 h-66 object-cover object-center rounded" src="<?= $details->e_img ?>">
              <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                <h2 class="text-sm title-font text-gray-500 tracking-widest"><?= $details->e_type ?></h2>
                <h1 class="text-gray-900 text-3xl title-font font-medium mb-1"><?= $details->e_name ?></h1>                
                <p class="leading-relaxed"><b>Specifications:</b> <?= $details->e_specs; ?></p>
                <p class="leading-relaxed"><b>Usage:</b> <?= $details->e_age; ?></p>                      
                <p class="leading-relaxed"><b>Quantity:</b> <?= $details->e_quantity; ?></p>                                             
              </div>
              <section class="text-gray-600 body-font overflow-hidden">
        	<div class="container px-5 py-24 mx-auto">
        		<div class="lg:w-4/5 mx-auto flex flex-wrap">
         <p class="leading-relaxed"><b>Elements Retrieved After Recycling:</b></p>
                <p class="leading-relaxed"><b>Gold-></b><?= $details->gold ?>kg</p> &nbsp;
                <p class="leading-relaxed"><b>Silver-></b><?= $details->silver ?>kg</p> &nbsp;
                <p class="leading-relaxed"><b>Palladium-></b><?= $details->palladium ?>kg</p> &nbsp;
                <p class="leading-relaxed"><b>Copper-></b><?= $details->copper ?>kg</p> &nbsp;
                <p class="leading-relaxed"><b>Other Metals-></b><?= $details->other_metals ?>kg</p> &nbsp;
                <p class="leading-relaxed"><b>Other Non-Metals-></b><?= $details->other_non_metals ?>kg</p>
                <div id="piechart"></div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
  var data = google.visualization.arrayToDataTable([
  ['Gold', <?php echo json_encode($details->gold) ?>],
  ['Silver', <?php echo json_encode($details->silver) ?>],
  ['Palladium', <?php echo json_encode($details->palladium) ?>],
  ['Copper', <?php echo json_encode($details->copper) ?>],
  ['Other Metals', <?php echo json_encode($details->other_metal) ?>],
  ['Other Non-Metals', <?php echo json_encode($details->other_non_metals) ?>]
]);

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'Elements Retrieved After Recycling:', 'width':550, 'height':400};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}
</script>
            </div>
            </div>
        </section>
            </div>
          </div>
        </section>


	</div>    
</body>
<?php include('footer.php');?>