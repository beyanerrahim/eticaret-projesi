<?php
error_reporting(false);
 session_start();
 $pageTitle='My profile';
  include 'init.php';
  include $tpl . 'navbar.php';
  $bodybackground = 'body-login';
  include $tpl.'header.php';

  if (isset($_SESSION['email'])) {
    $getUser = $con->prepare('SELECT * FROM users WHERE Email = ?');

    $getUser->execute(array($sessionemail));
    $info = $getUser->fetch();


?>
    <h2 class="text-center mt-3">My Profile</h2>
    <div class="information block">

        <div class="container">
            <div class="card panel-primary">
                <div class="card-header progress-bar ">My information</div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li>
                            <i class="fa fa-unlock-alt fa-fw"></i>
                            <span>User Name </span>: <?php echo $info['UserName']; ?>
                        </li>                    
                        <li> 
                        <i class="fa fa-envelope-o fa-fw"></i>
                            <span>Email </span>: <?php echo $info['Email']; ?>
                        </li>
                        <li>
                        <i class="fa fa-venus fa-fw"></i>
                            <span>Gender  </span>: <?php echo $info['gender']; ?>
                        </li>
                       
                        <li>
                        <i class="fa fa-birthday-cake fa-fw"></i>
                            <span>Birthday </span> : <?php echo $info['Birthday']; ?>
                        </li>
                        <li>
                        <i class="fa fa-calendar fa-fw"></i>
                            <span>Register Date </span> : <?php echo $info['Date']; ?>
                        </li>
                        <a href="" class="btn btn-primary my-button mt-3">Edit Information</a>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="my-comments block mt-3">

        <div class="container">
            <div class="card card-primary">
                <div class="card-header progress-bar">Latest Comments</div>
                <div class="card-body">
                    <?php

                    // select all except admin 
                    $stmt = $con->prepare("SELECT comment,comment_date FROM comments where user_id = ? ");
                    $stmt->execute(array($info['UserID']));

                    //assaign to varible
                    $comments = $stmt->fetchAll();
                    if (!empty($comments)) {
                        foreach ($comments as $comment) {
                            echo '<p>' . $comment['comment'] .'</p>';
                        }
                    } else {
                        echo 'There Is Not Comments To Show';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>


<?php } else {
    header('Location: login.php');
    exit();
}

    include $tpl.'footer.php';
?>