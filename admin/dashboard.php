<?php
error_reporting(false);
ob_start();
  session_start();
  $pageTitle = 'Dashboard';

  if(isset($_SESSION['Username'])){
    //echo 'Welcome ' . $_SESSION['Username'];

  $pageTitle = 'Dashboard';
  include 'init.php';

   /* start dashboard page */  
   $numusers = 5; //number of latest users
   $Latestusers = getLatest('*','users','UserID' ,$numusers);  //latest users Array

   $numitems = 5; //number of latest itemss
   //$Latestitems = getLatest('*','productss','item_ID' ,$numitems); //latest items Array

   $numcomments = 5; //number of latest comments
  // $Latestcomments = getLatest('*','comments','c_id' ,$numcomments); //latest comments gArray
  
?>

<div class="home-content">
<div class="overview-boxes">
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Users</div>
            <div class="number"><a href="members.php"><?php  echo countItems('UserID','users');?> </a></div>
            <div class="indicator">
            
            </div>
          </div>
          <i class='fa fa-users icon icon1'></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">pending Users</div>
            <div class="number"><a href="members.php?do=Manage&page=Pending"><?php  echo checkItem('RegStatus','users', 0 );?> </a></div>
            <div class="indicator">
           
            </div>
          </div>
          <i class='fa fa-user-plus icon icon2' ></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total product</div>
            <div class="number"><a href="products.php"><?php  echo countItems('Item_ID','product');?> </a></div>
            <div class="indicator">
             
            </div>
          </div>
          <i class='fa fa-tag icon icon3' ></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Comment</div>
            <div class="number"><a href="comments.php"><?php  echo countItems('c_id','comments');?> </a></div>
            <div class="indicator">
              <!-- <i class='bx bx-down-arrow-alt down'></i>
              <span class="text">Down From Today</span> -->
            </div>
          </div>
          <i class='fa fa-comments icon icon4' ></i>
        </div>
  </div>
 
  <div class="sales-boxes">
      <div class="recent-sales box">
          <div class="title"> <i class="fa fa-users mr-2"></i>Latest <?php echo $numusers; ?> Regisrers Users</div>
          <table class="table  table-striped mt-2">

          <tbody class="dashtable" id="myTable">
            <?php 
              foreach($Latestusers as $row){?>
          
            <tr>
              <td><?php echo $row['UserName'] ?></td>
              <td><?php echo $row['Email'] ?></td>
             
              <td>
              <?php 
                if($row['RegStatus'] == 0){?>
              
                <a href='members.php?do=Activate&userid=<?php echo $row['UserID']?>' class="btn btn-info btn-sm activate "><i class="fa fa-check"></i>Activate</a>
               <?php } ?>
               
              <a href='members.php?do=Edit&userid=<?php echo $row['UserID']?>' class="btn btn-success btn-sm"><i class="fa fa-edit"></i>Edit</a>

              </td>
             
            </tr>
            <?php 
             }?>
          </tbody>
        </table>
          <?php
          // select all except admin 
        $stmt=$con->prepare("SELECT comments.*,product.Name as Item_Name ,users.UserName as Member, users.avatar as avatar  FROM comments
        INNER JOIN product ON product.Item_ID = comments.item_id
        INNER JOIN users ON users.UserID = comments.user_id
        order by c_id DESC limit 4
       ");
       $stmt->execute();

       //assaign to varible
       $rows = $stmt->fetchAll();
          
          ?>
        </div>
        <div class="top-sales box">
          <div class="title"><i class="fa fa-comments mr-2"></i>The Comments</div>
          <hr>
          <ul class="top-sales-details">
          <?php 
            foreach($rows as $row){?>
            <li>
              <img src="uploads/avatars/<?php echo $row['avatar'];?>" class="col-md-3"alt="image">
              <span class="commenttext col-md-5"><?php echo $row['comment'];?></span>
              <br>
              <div class="date col-md-5"><?php echo $row['comment_date'];?></div>
           
            </li>
            <hr>
            <?php }
            ?>

          </ul>
        </div>
      </div>
    </div> 
 

<?php
  include $tpl.'footer.php';
}else{
  header('Location: index.php');
  exit();
}
ob_end_flush();
?>

 <!-- <a href="#">
              <img src="images/sunglasses.jpg" alt="">
              <span class="product">Vuitton Sunglasses</span>
            </a>
            <span class="price">$1107</span> -->