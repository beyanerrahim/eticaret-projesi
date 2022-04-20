<?php
error_reporting(false);
session_start();
$pageTitle = 'Show Product details';
include 'init.php';
include 'includes/templates/navbar.php';


// chek if get request itemid is numeric & get the integer value of it
$itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ?  intval($_GET['itemid']) : 0;

// select all data depend on this ID
$stmt = $con->prepare("SELECT product.*,
            categories.Name as category_name,
            users.UserName FROM product
            inner join categories on categories.ID = product.Cat_ID
            inner join users on users.UserID = product.Member_ID
            where Item_ID = ?");
//Execute Query
$stmt->execute(array($itemid));

$count = $stmt->rowCount();
//Fetch the data

if ($count > 0) {
    $item = $stmt->fetch();

?>
    <h2 class="text-center mt-3"><?php echo $item['Name'] ?></h2>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <img class="img-responsive img-thumbnail center-block" src="admin/uploads/products/<?php echo $item['Image'] ?>" alt="">
            </div>
            <div class="col-md-9 item-info">
                <h3><?php echo $item['Name'] ?></h2>
                    <p><?php echo $item['Description'] ?></p>
                    <ul class="list-unstyled">
                        <li>
                            <i class="fa fa-calendar fa-fw"></i>
                            <span>Date : </span><?php echo $item['Add_Date'] ?>
                        </li>
                        <li>
                            <i class="fa fa-money fa-fw"></i>
                            <span>Price : </span><?php echo $item['Price'] ?>
                        </li>
                        <li>
                            <i class="fa fa-building fa-fw"></i>
                            <span>Made In :</span> <?php echo $item['Country_Made'] ?>
                        </li>
                        <li>
                            <i class="fa fa-tags fa-fw"></i>
                            <span>Category : </span><?php echo $item['category_name'] ?>
                        </li>
                       
                      
                    </ul>
            </div>
        </div>
        <hr class="custom-hr">
        <!-- Start Add Comment -->
        <?php if (isset($_SESSION['email'])) { ?>
            <div class="row">
                <div class="col-md-5">
                    <div class="add-comment">
                        <h3>Add Your Comment</h3>
                        <form action="<?php echo $_SERVER['PHP_SELF'] . '?itemid=' . $item['Item_ID'] ?>" method="POST">
                            <textarea name="comment" required></textarea>
                            <input type="submit" class="btn btn-primary"  value="Add Comment"/>
                        </form>
                        <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            $comment = $_POST['comment'];
                            $userid = $_SESSION['uid'];
                            $itemid = $item['Item_ID'];

                            if (! empty($comment)) {
                                $stmt = $con->prepare("INSERT INTO comments(comment , `status` , comment_date , item_id , `user_id`)
                                 VALUES(:zcomment , 0 ,now(), :zitemid , :zuserid)");

                                $stmt->execute(array(

                                    'zcomment' => $comment,
                                    'zitemid' => $itemid,
                                    'zuserid' => $userid
                                ));

                                if ($stmt) {
                                    echo '<div class="alert alert-success mt-2">Comment Added</div>';
                                }
                            }
                        }

                        ?>
                    </div>
                </div>
            </div>
            <!-- end Add Comment -->
        <?php } else {
            echo '<a href="login.php">Login</a> or<a href="login.php"> register </a>to Add Comment';
        } ?>
        <hr class="custom-hr">
        <?php

        // select all except admin 
        $stmt = $con->prepare("SELECT comments.*,users.UserName as Member ,users.avatar as avatar FROM comments
            INNER JOIN users ON users.UserID = comments.user_id
            where item_id = ? AND `status` = 1
            order by c_id DESC
            ");
        $stmt->execute(array($item['Item_ID']));
        //assaign to varible
        $comments = $stmt->fetchAll();


        ?>
         <div class="comment-box">
        <?php
        foreach ($comments as $comment) { ?>
           
                <div class="row ">
                    <div class="col-sm-2 text-center">
                        <img class="img-com img-thumbnail rounded-circle mt-1" src="admin/uploads/avatars/<?php echo $comment['avatar'];?>" alt="image">
                        <span class="isim-com"><?php echo $comment['Member']; ?></span>
                    </div>
                    <div class="col-sm-9">
                        <p class="lead">
                            <?php echo $comment['comment']; ?>
                        </p>
                    </div>
                </div>
                <hr class="">  
        <?php  }

        ?>
</div>
    </div>


<?php
} else {
    echo '<div class="container">';
    echo '<div class="alert alert-danger">there is no such id or this product is waiting Aproval</div>';
    echo '</div>';
}

include $tpl . "footer.php";
?>