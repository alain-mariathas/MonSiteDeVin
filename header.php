
  <div class="navbar-fixed">
    <nav>
      <div class="nav-wrapper">
        <div class="left"><a href="#!" class="brand-logo">Logo</a></div>
        <a class="brand-logo center" style="font-family:'Barrio', cursive; font-size: 28px;margin-right:8%;" disabled=true>Apprenez, buvez du vin divin! </a>
        <ul class="right hide-on-med-and-down">
          <li><a href="vinebody.php">Catalogue des vins</a></li>
          <li><a href="AjoutVin.php">Ajout d'un vin</a></li>
          <?php
          if($_SESSION['cn']=="admin")
          {
          ?>
          <li><a href="admin/index.php">Adminsitration</a></li>
          <?php }?>
          <li><a href="post_deconnexion.php"><i class="material-icons">power_settings_new</i></a></li>
        </ul>
      </div>
    </nav>
  </div>
        
