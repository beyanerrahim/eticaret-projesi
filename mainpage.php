


<?php
   error_reporting(false);
   $pageTitle ='Home Page';
   include "init.php";
   include $tpl . 'navbar.php';?>


   <div class="container">
   <h2 class="text-center mt-3 mb-4">All products</h2>
   <div class="row">
   
   <?php
      $all = getAllFrom('*','product','','','Item_ID');
     
       foreach( $all as $item){
           echo '<div class="col-md-3 col-sm-6">';
                echo '<div class="thumbnail item-box">';
                      echo '<span class="price-tag">'. $item['Price'] .'</span>';?>                      
                    <img class="img-responsive imgduzenle" src="admin/uploads/products/<?php echo $item['Image'];?>" alt="">
                      <?php
                      echo '<div class="option">';
                            echo '<h3 class="pname"><a href="product.php?itemid='.$item['Item_ID'].'">'.$item['Name'].'</a></h3>';
                            echo '<p class="dname">'.$item['Description'].'</p>';
                           
                      echo '</div>';
                echo '</div>';
           echo '</div>';     
       }
   ?>
   </div>
</div>


<?php
   include $tpl . "footer.php";
   ob_end_flush();
?>










