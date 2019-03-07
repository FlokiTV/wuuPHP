
<div class="box">
  <aside class="menu"><?php 
    foreach(Dashboard::$menu as $key => $subitens):?>
    
    <p class="menu-label"><?=
      $key?>
      
    </p>
    <ul class="menu-list"><?php 
      foreach($subitens as $name => $href):?>
      
      <li><a href="<?=$href?>"><?=
          $name?>
          </a></li>
    </ul><?php 
    
        endforeach;
    endforeach;?>
    
  </aside>
</div>