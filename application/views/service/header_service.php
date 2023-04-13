<!DOCTYPE html>  
<html>
<head>
  <style type="text/css">
  .mycol4{
            margin-right: 10px; 
            padding-left: 20px; 
            padding-bottom: 10px; 
            padding-top: 10px;
            -ms-flex: 0 0 33.333333%;
            flex: 0 0 33.333333%;
            max-width: 33.333333%;
          }
  </style>
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  <title></title>
  <?= link_tag('assets/css/bootstrap.min.css'); ?>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="homePage"><img height=110 width=110 src=<?= base_url('/assets/images/logo.png')?> ></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor01" style="margin-left: 10px;">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('service/homePage')?>">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('service/requestPage')?>">E-waste Requests</a>
      </li>       
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('service/statusPage')?>">Report Status</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('service/sellrefurbish')?>">Sell Products</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('service/orderStatus')?>">Orders</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('service/profilePage')?>">Profile</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('login/logout')?>">Logout</a>
      </li>
    </ul>

    

  </div>
 </nav>