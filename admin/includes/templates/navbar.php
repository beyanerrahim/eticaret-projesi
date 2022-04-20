

<div class="sidebar">
<div class="logo-details">
  <!-- <i class='fa-solid fa-cart-shopping'></i> -->
  <i class="bx bx-cart cart three"></i>
  <span class="logo_name">eCommerce</span>
</div>
  <ul class="nav-links">
    <li class="links">
      <a href="dashboard.php" class="active">
        <i class='bx bxs-home'></i>
        <span class="links_name">Dashboard</span>
      </a>
    </li>
    
    <li class="links">
      <a href="members.php">
        <i class='bx bxs-user' ></i>
        <span class="links_name">Members</span>
      </a>
    </li>
    <li class="links">
      <a href="categories.php">
        <i class='bx bx-pie-chart-alt-2' ></i>
        <span class="links_name">Categories</span>
      </a>
    </li>
    <li class="links">
      <a href="products.php">
        <i class='bx bx-tag' ></i>
        <span class="links_name">Product</span>
      </a>
    </li>
    <li class="links">
      <a href="comments.php">
        <i class='bx bx-comment-detail' ></i>
        <span class="links_name">Comments</span>
      </a>
    
     </li>
     <!-- <li class="links">
      <a href="messages.php">
        <i class='bx bx-message' ></i>
        <span class="links_name">Messages</span>
      </a>
    </li> -->
   
    <li class="log_out links">
      <a href="logout.php">
        <i class='bx bx-log-out'></i>
        <span class="links_name">Log out</span>
      </a>
    </li>
  </ul>
</div>
<section class="home-section">
<nav>
  <div class="sidebar-button">
    <i class='bx bx-menu sidebarBtn'></i>
    <span class="dashboard"><?php echo getTitle();?></span>
  </div>
  <div class="search-box">
    <input id="myInput" type="text" placeholder="Search...">
    <i class='bx bx-search' ></i>
  </div>
  <div class="profile-details">
    <!-- <img src="" alt=""> -->
   <ul class="nav">
   <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <?php
           echo $_SESSION['Username'];
    ?>
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown" >
      <a class="dropdown-item" href="members.php?do=Edit&userid=<?php echo $_SESSION['ID'] ;?>">Edit profile</a>
      <a class="dropdown-item" href="logout.php">Logout</a>
    </div>
   </li>
  </ul>      
  </div>
</nav>
<script>
  let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");
sidebarBtn.onclick = function() {
  sidebar.classList.toggle("active");
  if(sidebar.classList.contains("active")){
  sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
}else
  sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
}

</script>