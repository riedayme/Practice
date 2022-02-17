<!DOCTYPE html>
<html lang="en-us">
<head>

 <meta charset='UTF-8'/>
 <meta content='width=device-width, initial-scale=1' name='viewport'/>
 <title><?php echo $title ?></title>

 <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url(APP_LOGO) ?>" />
 <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url(APP_LOGO) ?>" />
 <link rel="icon" href ="<?php echo base_url(APP_LOGO) ?>" type="image/x-icon" /> 
 <link rel="shortcut icon" href="<?php echo base_url(APP_LOGO) ?>" type="image/x-icon" />

 <!-- CSS template -->
 <link rel="stylesheet" href="<?php echo base_url(app_all_modules_css) ?>"/> 
 <link rel="stylesheet" href="<?php echo base_url(app_main_css) ?>"/>

 <?php if (!empty($css) AND is_array($css)): ?>
  <!-- CSS Libraries -->
  <?php foreach ($css as $row ): ?>
   <link rel="stylesheet" href="<?php echo base_url($row) ?>">
  <?php endforeach ?>
 <?php endif ?>

 <?php if (!empty($css_external) AND is_array($css_external)): ?>
  <!-- CSS External CDN -->
  <?php foreach ($css_external as $row ): ?>
   <link rel="stylesheet" href="<?php echo $row ?>">
  <?php endforeach ?>
 <?php endif ?>

 <link rel="stylesheet" href="<?php echo base_url(app_custom_css) ?>"/>
 
 <!-- Google Font -->
 <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">

</head>
<body class="o-page <?php if(!empty($classbody)) echo $classbody;?>">

<!--[if lte IE 9]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
<![endif]-->
