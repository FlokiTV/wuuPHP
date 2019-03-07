<!DOCTYPE html><html>
<head>
  <base href="<?=$info['url']?>"><?php 
  
  Template::meta();
  Template::scripts();
  Template::styles();
  Template::gAnalytics();?>
  
</head><body>
<div class="container-fluid full-h">
<nav class="navbar">
  <div class="navbar-brand"><a class="navbar-item" href="./"><img src="https://placehold.it/122x28?text=LOGO" alt="Bulma: Free, open source, &amp; modern CSS framework based on Flexbox" width="112" height="28"></a><a class="navbar-burger" role="button" aria-label="menu" aria-expanded="false"><span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span></a></div>
</nav><div class="columns is-mobile full-h" id="canvas">
<div class="column is-3-desktop is-11-mobile full-h" id="menu"><?php 
include 'menu.php';?>
</div>
<div class="column full-h" id="content">