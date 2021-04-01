<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>TPM Admin Template | Log in</title>
  	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="softdevelopinc">
    <meta name="author" content="softdevelopinc@gmail.com">

    <link rel="stylesheet" href="<?php echo RootREL; ?>media/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo RootREL; ?>media/libs/css/font-awesome.min.css">
  	<link rel="stylesheet" href="<?php echo RootREL; ?>media/libs/css/AdminLTE.min.css">
  	<link rel="stylesheet" href="<?php echo RootREL; ?>media/libs/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="<?php echo RootREL; ?>media/css/style.css">
  	<!-- Google Font -->
  	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  	
    <script src="<?php echo RootREL; ?>media/libs/js/jquery.min.js"></script>
    <script src="<?php echo RootREL; ?>media/js/jquery-1.12.4.js"></script>
    <script src="<?php echo RootREL; ?>media/js/ajaxError.js"></script>
    <script src="<?php echo RootREL; ?>media/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript">
      var rootUrl   = "<?=RootURL;?>";
    </script>
</head>
<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">

  <?php include_once 'views/admin/layout/'.$this->layout.'header.php'; ?>

  <?php include_once 'views/admin/layout/'.$this->layout.'left-sidebar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="min-height: 770px !important ;">
