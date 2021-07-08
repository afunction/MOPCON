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
        <a id="main_logo" class="brand" href="./"><img src="img/logo.png"/></a>
        <div class="nav-collapse">
          <ul class="nav">
            <li class="<?php echo $function['session']; ?>"><a href="session.php">議程</a></li>
            <li class="<?php echo $function['sponsor']; ?>"><a href="sponsor.php">贊助</a></li>
            <!-- <li class="<?php echo $function['cfp']; ?>"><a href="cfp.php">議程投稿</a></li> -->
            <li class="<?php echo $function['speakers']; ?>"><a href="speakers.php">講者</a></li>
            <li class="<?php echo $function['map']; ?>"><a href="map.php">交通</a></li>
            <li class="<?php echo $function['irc']; ?>"><a href="irc.php">IRC</a></li>
            <li class="<?php echo $function['apps']; ?>"><a href="apps.php">Apps</a></li>
            <li class="<?php echo $function['social']; ?>"><a href="social.php">社群</a></li>
            <li class="dropdown <?php echo $function['other']; ?>">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">其他 <b class="caret"></b></a>
              <ul class="dropdown-menu" role="menu">
                <!-- <li class="<?php echo $function['register']; ?>"><a href="register.php">報名</a></li> -->
                <!-- <li class="divider"></li> -->
                <!-- <li class="<?php echo $function['cfs']; ?>"><a href="cfs.php">贊助活動</a></li> -->
                <li class="<?php echo $function['contact']; ?>"><a href="contact.php">聯絡我們</a></li>
                <li class="divider"></li>
                <li class="<?php echo $function['activity']; ?>"><a href="../history.html">歷年活動</a></li>
              </ul>
            </li>
          </ul>
          <ul id="language" class="nav pull-right">
            <li class="divider-vertical"></li>
            <li><a href="index_en.php">English</a></li>
          </ul>
        </div><!-- /.nav-collapse -->
      </div>
    </div><!-- /navbar-inner -->
    <div id="functionSeprate"></div>
  </div><!-- /navbar -->
