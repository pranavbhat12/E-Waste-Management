<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?= link_tag('assets/css/bootstrap.min.css'); ?>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  		<a class="navbar-brand" href="#"><img height=130 width=130 src=<?= base_url('/assets/images/logo.png')?> ></a>
  		<a class="btn btn-primary btn-lg" style="margin-left:1120px;" href="<?= base_url('login/publicLogin')?>" role="button">Login</a>
		<a class="btn btn-primary btn-lg" href="<?= base_url('login/publicSignup')?>" role="button">Sign Up</a>
 </nav> 