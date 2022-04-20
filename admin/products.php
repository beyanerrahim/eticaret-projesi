<?php
error_reporting(false);
ob_start();
session_start();

$pageTitle='products';
if(isset($_SESSION['Username'])){

    include 'init.php';

    $do = isset($_GET['do'])? $_GET['do'] : 'Manage';

    if($do=='Manage'){
         // select all except admin 
         $stmt = $con->prepare("SELECT product.*,
         categories.Name as category_name,
         users.UserName FROM product
         inner join categories on categories.ID = product.Cat_ID
         inner join users on users.UserID = product.Member_ID
         order by Item_ID DESC
         ");
 
         $stmt->execute();
 
         //assaign to varible
         $items = $stmt->fetchAll();
 
         if(! empty($items) ){
             
        ?>

<div class="table-member">
      <div class="t-content">
      <h2 class="mb-3 text-center" style="color: #3c3c3d;">Manage Products </h2>
        <table class="table text-center table-hover t-member border table-bordered">
          <thead class="theadmember">
            <tr>
                    <th scope="col">ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Date</th>
                    <th>Category</th>
                    <th>Username</th>
                    <th>Control</th>
             </tr>
             </thead>
             <tbody id="myTable">
                <?php 
                foreach($items as $item){?>
             <tr>
                    <td><?php echo $item['Item_ID'];?></td>
                    <td><?php echo $item['Name'];?></td>
                    <td><?php echo $item['Description'];?></td>
                    <td><?php echo $item['Price'];?></td>
                    <td><?php echo $item['Add_Date'];?></td>
                    <td><?php echo $item['category_name'];?></td>
                    <td><?php echo $item['UserName'];?></td>
                    <td>
                        <a href="products.php?do=Edit&itemid=<?php echo $item['Item_ID']?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>Edit</a>
                        <a href="products.php?do=Delete&itemid=<?php echo $item['Item_ID']?>" class="btn btn-danger btn-sm confirm"><i class="fa fa-close"></i>Delete</a>

                    </td>
                </tr> 
              <?php 
               }?>
            </tbody>
          </table>
          <a href="products.php?do=Add" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>Add New Member</a>
  
    <?php
    }
    else{
        echo '<div class="container">';
            echo '<div class="nice-massage alert alert-danger ">There is No Member To Manage</div>';
            echo '<a href="items.php?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i> New Item</a>';
       echo '</div>';
    
    }?>
       </div>
      </div>
    <?php

    }elseif($do=='Add'){?>

<div class="father-section">
            <div class="container">
              <h2 class="edit-title text-center mb-3">Add New Products </h2>
              <form action="?do=Insert" class="" method="POST" enctype="multipart/form-data">
                <div class="row form-group edit-contant">
                  <label for="" class="col-sm-2 contol-label">product Name :</label>
                  <div class="col-sm-10 edit-input">
                    <input type="text" name="name" class="form-control formcontrol" placeholder="Name Of The product" >
                  </div>
                </div>
                <div class="row form-group edit-contant">
                  <label for="" class="col-sm-2 contol-label">Description :</label>
                  <div class="col-sm-10 edit-input">
                    <input type="text" name="description" class="form-control formcontrol" placeholder="Description Of The product" >
                  </div>
                </div>
                <div class="row form-group edit-contant">
                 <label for="" class="col-sm-2 contol-label">Product image :</label>
                 <div class="col-sm-10 edit-input">
                <input type="file" name="avatar" class="form-control formcontrol" placeholder="Enter product image" >
                
              </div>
               </div>
                <div class="row form-group edit-contant">
                  <label for="" class="col-sm-2 contol-label">Price :</label>
                  <div class="col-sm-10 edit-input">
                    <input type="text" name="price" class="form-control formcontrol" placeholder="Price Of The product" >
                  </div>
                </div>
                <div class="row form-group edit-contant">
                  <label for="" class="col-sm-2 contol-label">Country :</label>
                  <div class="col-sm-10 edit-input">
                    <input type="text" name="country" class="form-control formcontrol" placeholder="Country Of Made" >
                  </div>
                </div>
                <div class="row form-group edit-contant">
                  <label for="" class="col-sm-2 contol-label">Status :</label>
                  <div class="col-sm-10 edit-input">
                        <select class="form-control formcontrol"name="status" id="">
                            <option value="0">...</option>
                            <option value="1">New</option>
                            <option value="2">Like New</option>
                            <option value="3">Used</option>
                            <option value="4">Very old</option>
                        </select>

                  </div>
                </div>
                <div class="row form-group edit-contant">
                  <label for="" class="col-sm-2 contol-label">Member :</label>
                  <div class="col-sm-10 edit-input">
                        <select class="form-control formcontrol"name="member" id="">
                        <?php
                             $stmt=$con->prepare("SELECT * FROM users");
                             $stmt->execute();
                             $users=$stmt->fetchAll();
                             foreach($users as $user){
                                 echo "<option value='". $user['UserID']."'>".$user['UserName'] ."</option>";
                             }
                            ?>
                        </select>

                  </div>
                </div>
                <div class="row form-group edit-contant">
                  <label for="" class="col-sm-2 contol-label">Category :</label>
                  <div class="col-sm-10 edit-input">
                        <select class="form-control formcontrol"name="category" id="">
                        <?php
                             $stmt1=$con->prepare("SELECT * FROM categories");
                             $stmt1->execute();
                             $cats=$stmt1->fetchAll();
                             foreach($cats as $cat){
                                 echo "<option value='". $cat['ID']."'>".$cat['Name'] ."</option>";
                             }
                            ?>
                        </select>

                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-10 ">
                    <input type="submit" value="Add product" class="btn btn-primary btn-save">
                  </div>
    
                </div>   
              </form>
            </div>
        </div>
    
    
    <?php

    }elseif($do=='Insert'){

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            ?>
        
            <div class="father-section">
        
              <div class="container">
                <h2 class="edit-title text-center mb-4">Insert Product </h2>
        <?php


$avatarName=$_FILES['avatar']['name'];
$avatarSize=$_FILES['avatar']['size'];
$avatarTmp=$_FILES['avatar']['tmp_name'];
$avatarType=$_FILES['avatar']['type'];

//list of allowed file typed to upload
$avatarAllowedExtension = array("jpeg","jpg","png","gif");

//get avatar extention
$avatarExtension = strtolower(end(explode('.',$avatarName)));
        //Get variables from the form

        $name = $_POST['name'];
        $desc = $_POST['description'];
        $price = $_POST['price'];
        $country = $_POST['country'];
        $status = $_POST['status'];
        $member = $_POST['member'];
        $cat = $_POST['category'];
        //validate the form

        $formerrors = array();

        if (empty($name) ) {
            $formerrors[] = "Name can not be <strong> Empty</strong>";
        }
        if (empty($desc)) {
            $formerrors[] = 'Description can not be <strong> Empty</strong>';
        }
        if (empty($price)) {
            $formerrors[] = 'The Price can not be <strong> Empty</strong>';
        }
        if (empty($country)) {
            $formerrors[] = 'the Country not be <strong> Empty</strong>';
        }
        if ($status==0) {
            $formerrors[] = 'You Most Choose the <strong>Status </strong>';
        }
        if ($member==0) {
            $formerrors[] = 'You Most Choose the <strong>Member </strong>';
        }
        if ($cat==0) {
            $formerrors[] = 'You Most Choose the <strong>Category </strong>';
        }
        if(!empty($avatarName) && ! in_array($avatarExtension,$avatarAllowedExtension)){
          $formerrors[] = 'this extention is not <strong>allowed</strong>';
         }
        
         
        foreach ($formerrors as $error) {
            echo "<div class='alert alert-danger'>" . $error . "</div>";
        }


        //check if theres no error proced the update operation 
        if (empty($formerrors)) {

          $ava =rand(0,1000000)."_".$avatarName;
          move_uploaded_file($avatarTmp,"uploads\products\\" . $ava);

                //insert user information in database

                $stmt = $con->prepare("INSERT INTO product(Name , Description ,Image,Price ,Country_Made ,Status,Add_Date,Cat_ID,Member_ID) VALUES(:name , :desc,:img,:price,:country,:status,now(),:cat,:member)");
                $stmt->execute(array(
                    'name' => $name,
                    'desc' => $desc,
                    'img'  => $ava,
                    'price' => $price,
                    'country' => $country,
                    'status' => $status,
                    'cat' => $cat,
                    'member' => $member
                ));
                //print seccess massage ;

                $themsg = "<div class='alert alert-success'> " . $stmt->rowCount() . " Record inserted</div>";
                redirectHome($themsg, 'back');
           
        }
        
        ?>
        </div>
 </div>
       <?php
     } 
     
     else {

       echo "<div class='container'>";
       $themsg = "<div class='alert alert-danger'>sorry you cant browser this page directly</div>";
       redirectHome($themsg,'back',3);
       echo "</div>";
     }


     ?>

 <?php
    }elseif($do=='Edit'){

      $itemid=isset($_GET['itemid']) && is_numeric($_GET['itemid']) ?  intval($_GET['itemid']) : 0;

      // select all data depend on this ID
        $stmt = $con ->prepare("SELECT * FROM product where Item_ID = ?");
        //Execute Query
        $stmt->execute(array($itemid));
        //Fetch the data
        $item = $stmt->fetch();
        //the row count
        $count = $stmt->rowCount();
        //if theres such id show the form
        if($count> 0 ){?>
        <div class="father-section">
            <div class="container">
              <h2 class="edit-title text-center mb-2">Edit Product </h2>
              <form action="?do=Update" method="POST">
              <input type="hidden" name="itemid" value="<?php echo $itemid; ?>">
                <div class="row form-group edit-contant">
                  <label for="" class="col-sm-2 contol-label">product Name :</label>
                  <div class="col-sm-10 edit-input">
                    <input type="text" name="name" class="form-control formcontrol" value="<?php echo $item['Name']?>">
                  </div>
                </div>
                <div class="row form-group edit-contant">
                  <label for="" class="col-sm-2 contol-label">Description :</label>
                  <div class="col-sm-10 edit-input">
                    <input type="text" name="description" class="form-control formcontrol" value="<?php echo $item['Description']?>">
                  </div>
                </div>
                <div class="row form-group edit-contant">
                  <label for="" class="col-sm-2 contol-label">Price :</label>
                  <div class="col-sm-10 edit-input">
                    <input type="text" name="price" class="form-control formcontrol" value="<?php echo $item['Price']?>">
                  </div>
                </div>
                <div class="row form-group edit-contant">
                  <label for="" class="col-sm-2 contol-label">Country :</label>
                  <div class="col-sm-10 edit-input">
                    <input type="text" name="country" class="form-control formcontrol" value="<?php echo $item['Country_Made']?>">
                  </div>
                </div>
                <div class="row form-group edit-contant">
                  <label for="" class="col-sm-2 contol-label">Status :</label>
                  <div class="col-sm-10 edit-input">
                        <select class="form-control formcontrol"name="status" >
                            <option value="1" <?php if($item['Status']== 1){echo 'selected';}?>>New</option>
                            <option value="2" <?php if($item['Status']== 2){echo 'selected';}?>>Like New</option>
                            <option value="3" <?php if($item['Status']== 3){echo 'selected';}?>>Used</option>
                            <option value="4" <?php if($item['Status']== 4){echo 'selected';}?>>Very old</option>
                        </select>

                  </div>
                </div>
                <div class="row form-group edit-contant">
                  <label for="" class="col-sm-2 contol-label">Member :</label>
                  <div class="col-sm-10 edit-input">
                        <select class="form-control formcontrol"name="member" id="">
                        <?php
                             $stmt=$con->prepare("SELECT * FROM users");
                             $stmt->execute();
                             $users=$stmt->fetchAll();
                             foreach($users as $user){
                                 echo "<option value='". $user['UserID']."'";
                                 if($item['Member_ID'] == $user['UserID'] ){echo 'selected';}
                                 echo ">".$user['UserName'] ."</option>";
                             }
                            ?>
                        </select>

                  </div>
                </div>
                <div class="row form-group edit-contant">
                  <label for="" class="col-sm-2 contol-label">Category :</label>
                  <div class="col-sm-10 edit-input">
                        <select class="form-control formcontrol" name="category" id="">
                        <?php
                             $stmt1=$con->prepare("SELECT * FROM categories");
                             $stmt1->execute();
                             $cats=$stmt1->fetchAll();
                             foreach($cats as $cat){
                                 echo "<option value='". $cat['ID']."'";
                                 if($item['Cat_ID'] == $cat['ID'] ){echo 'selected';}
                                 echo ">".$cat['Name'] ."</option>";
                             }
                            ?>
                        </select>

                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-10 ">
                    <input type="submit" value="Edit product" class="btn btn-primary btn-save">
                  </div>
    
                </div>   
              </form>

              <!--  comments of product  -->
        <?php 
              // select all except admin 
        $stmt=$con->prepare("SELECT comments.*,users.UserName as Member  FROM comments
         INNER JOIN users ON users.UserID = comments.user_id where item_id = ?
        ");
        $stmt->execute(array($itemid));

        //assaign to varible
        $rows = $stmt->fetchAll();
        if(! empty($rows)){
    ?>

          <h2 class="mb-3 text-center" style="color: #3c3c3d;">Manage <?php echo $item['Name'] ?> Comments </h2>
            <table class="table text-center table-hover t-member border table-bordered">
              <thead class="theadmember">
              <tr>
                   
                    <th>Comment</td>
                    <th>User Name</th>
                    <th>Added Date</th>
                    <th>Control</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                foreach($rows as $row){?>
                  <tr>   
                    <td><?php echo $row['comment'];?></td>
                    <td><?php echo $row['Member'];?></td>
                    <td><?php echo $row['comment_date'];?></td>
                    <td>
                        <a href="comments.php?do=Edit&comid=<?php echo $row['c_id']?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>Edit</a>
                        <a href="comments.php?do=Delete&comid=<?php echo $row['c_id']?>" class="btn btn-danger btn-sm confirm"><i class="fa fa-close"></i>Delete</a>
                        <?php
                      if($row['status'] == 0){?>
                     <a href="comments.php?do=Approve&comid=<?php echo $row['c_id']?>" class="btn btn-info btn-sm Activate "><i class="fa fa-check"></i>Approve</a>

                      <?php }
                        ?>
                    </td>
                </tr>                 
                 <?php
                      
                } }
                ?> 
              </tbody>
            </table>   
  
            </div>
        
        </div>
      <?php
      } else {
        echo "<div class='container'>";
        $themsg = '<div class="alert alert-danger">theres no such ID</div>';
        redirectHome($themsg);
        echo "</div>";
      }

    }elseif($do=='Update'){?>

      <div class="father-section">
      <div class="container">
        <h2 class="edit-title text-center mb-4">Update Product </h2>

        <?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){

  //Get variables from the form
  $id=$_POST['itemid'];
  $name=$_POST['name'];
  $desc=$_POST['description'];
  $price=$_POST['price'];
  $country=$_POST['country'];

  $status=$_POST['status'];
  $member=$_POST['member'];
  $category=$_POST['category'];
  //validate the form

  $formerrors = array();

      if (empty($name) ) {
          $formerrors[] = "Name can not be <strong> Empty</strong>";
      }
      if (empty($desc)) {
          $formerrors[] = 'Description can not be <strong> Empty</strong>';
      }
      if (empty($price)) {
          $formerrors[] = 'The Price can not be <strong> Empty</strong>';
      }
      if (empty($country)) {
          $formerrors[] = 'the Country not be <strong> Empty</strong>';
      }
      if ($status==0) {
          $formerrors[] = 'You Most Choose the <strong>Status </strong>';
      }
      if ($member==0) {
          $formerrors[] = 'You Most Choose the <strong>Member </strong>';
      }
      if ($category==0) {
          $formerrors[] = 'You Most Choose the <strong>Category </strong>';
      }
      foreach ($formerrors as $error) {
          echo "<div class='alert alert-danger'>" . $error . "</div>";
      }

  //check if theres no error proced the update operation 
  if(empty($formerrors)){
  //Update the database with this Info
  $stmt=$con->prepare("UPDATE product set
   Name = ?, Description = ?, Price = ? , Country_Made =?, Status =?,Cat_ID =? ,Member_ID =? where Item_ID = ?");


  $stmt->execute(array($name,$desc,$price,$country,$status,$category ,$member,$id));
  //print seccess massage ;

 $themsg = "<div class='alert alert-success'> ". $stmt->rowCount() . ' Record Updated</div>';
  redirectHome($themsg,'back');
  }

 }else{
   $errormsg = "<div class='alert alert-danger'>sorry you cant browser this page directly</div>";
   redirectHome($errormsg);
     //echo "sorry you cant browser this page directly";
 }

        ?>
        </div>
      </div>
  <?php

    }elseif($do=='Delete'){?>

      <div class="father-section">
      <div class="container">
        <h2 class="edit-title text-center mb-4">Delete Product </h2>

        <?php


       // chek if get request itemid is numeric & get the integer value of it
       $itemid=isset($_GET['itemid']) && is_numeric($_GET['itemid']) ?  intval($_GET['itemid']) : 0;

       // select all data depend on this ID
        $check = checkItem('Item_ID','product',$itemid);

         //if theres such id show the form
         if($check > 0 ){
      
            $stmt = $con->prepare('DELETE FROM product WHERE Item_ID = :zid');
            $stmt->bindParam("zid",$itemid);
            $stmt->execute();
            
            $themsg ="<div class='alert alert-success'> ". $stmt->rowCount() . ' Record Deleted</div>';
            redirectHome($themsg,'back');

         }else{
            $themsg ='<div class="alert alert-danger">this id is not Exist</div>';
            redirectHome($themsg);
         }
         ?>
         </div>
       </div>
   <?php
 

    }

 include $tpl . 'footer.php';

}else{

  header('Location:index.php');
  exit();

}

ob_end_flush();

?>

