<?php 
error_reporting(false);
$pageTitle='Categories';
include 'init.php';

include 'includes/templates/navbar.php';

?>

<div class="container">
    <h2 class="text-center mt-3 mb-3"><?php  echo str_replace('-',' ',$_GET['pagename']); ?></h2>
    <div class="row">
    <?php
        foreach(getItems($_GET['pageid']) as $item){
            echo '<div class="col-md-3 col-sm-6">';
                 echo '<div class="thumbnail item-box">';
                       echo '<span class="price-tag">'. $item['Price'] .'</span>';?>
                       
                      <img class="img-responsive" src="admin/uploads/products/<?php echo $item['Image'];?>" alt="">
                       <?php 
                       echo '<div class="option">';
                             echo '<h3 class="pname"><a href="product.php?itemid='.$item['Item_ID'].'">'.$item['Name'].'</a></h3>';
                             echo '<p>'.$item['Description'].'</p>';
                       echo '</div>';
                 echo '</div>';
            echo '</div>';     
        }
    ?>
    </div>
</div>


<?php
include $tpl . 'footer.php';
?>