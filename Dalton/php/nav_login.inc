<nav>
  <ul class="breadcrumb" id="navDiv">
    <li><a href="index.php" class="item">ABOUT US</a></li>
    <li><a href="contactUs.php" class="item">CONTACT US</a></li>
    <li><a href="viewConsultant.php" class="item">CONSULTANTS</a></li>
    <li><a href="viewProject.php" class="item">PROJECTS</a></li>
    <li><a href="viewProjectstaffing.php" class="item">PROJECT STAFFING </a></li>
    <?php
    if( !empty($_SESSION['UserID'])) {
      echo "<li class='topnav-right'><a href='login.php' class='item'>Logout</a></li>";
      echo "<span class='loginstatus'>".$_SESSION['UserID']." logged in</span>";
    }
     ?>
  </ul>
</nav>
