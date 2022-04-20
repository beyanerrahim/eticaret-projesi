<?php
session_start();

?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">


  <a class="navbar-brand" href="mainpage.php">home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav  ml-auto">
      <?php
            foreach(getCat() as $cat){
                echo 
                '<li class="ml-3 links-h">
                         <a href="categories.php?pageid='.$cat['ID'].'&pagename=' .str_replace(' ','-',$cat['Name']).'">'. $cat['Name']. '</a>
                </li>';
            }

       ?>
       <li class="ml-3 links-h1 dropdown ">
        <a class=" dropdown-toggle t ml-3" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <?php
          $e = $_SESSION['email'];
          $tmt2 = $con->prepare("SELECT * FROM users where Email = '$e'");

          $tmt2->execute();
          $row=$tmt2->fetch();
          $count = $tmt2->rowCount();

         if ($count == 1) {
              echo $row['UserName'];

         }?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="profile.php">Edit profile</a>
          <a class="dropdown-item" href="logout.php">Logout</a>
        </div>
      </li>
    </ul>
    
   
  </div>
  </div>
</nav>
