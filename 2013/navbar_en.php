<?php
  $function[$page] = 'active';
?>
  <div class="navbar">
    <div class="navbar-inner">
      <?php
      // the overrided class 'container' in the 'navbar' will make dropdown-menu can't be display correctly.
      // <div class="container">
      ?>
      <div class="navbar-container">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
        <a id="main_logo" class="brand" href="index_en.php"><img src="img/logo.png"/></a>
        <div class="nav-collapse">
          <ul class="nav">
            <!-- <li class="<?php echo $function['session']; ?>"><a href="session.php">議程</a></li> -->
            <li class="<?php echo $function['sponsor']; ?>"><a href="sponsor_en.php">Sponsors</a></li>
            <li class="<?php echo $function['cfp']; ?>"><a href="cfp_en.php">Call for Papers</a></li>
            <li class="<?php echo $function['map']; ?>"><a href="map_en.php">Location</a></li>
          </ul>
          <ul id="language" class="nav pull-right">
            <li class="divider-vertical"></li>
            <li><a href="./index.php">中文版</a></li>
          </ul>
        </div><!-- /.nav-collapse -->
      </div>
    </div><!-- /navbar-inner -->
    <div id="functionSeprate"></div>
  </div><!-- /navbar -->
