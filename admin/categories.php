<?php
error_reporting(false);
ob_start();
session_start();

$pageTitle='Categories';
if(isset($_SESSION['Username'])){

    include 'init.php';

    $do = isset($_GET['do'])? $_GET['do'] : 'Manage';

    if($do=='Manage'){
      $sort='ASC';
        $sort_array=array('ASC','DESC');
        if(isset($_GET['sort']) && in_array($_GET['sort'],$sort_array)){
            $sort=$_GET['sort'];
        }
        $stmt2 = $con->prepare("SELECT * FROM categories ORDER BY Ordering $sort");

       $stmt2->execute();

       $cats = $stmt2->fetchAll();?>
  <div class="section-cat">
            
            <div class="">
              <h2 class="mb-3 text-center" style="color: #3c3c3d;">Manage Categories </h2>
       
        <div class="categories">
        <!-- <a class="btn btn-primary  add-cat" href="categories.php?do=Add"><i class="fa fa-plus"></i>Add New Category</a> -->

            <div class="">
               <div class="panel-heading">
                <label class="ml-3 managenav mt-2">
               <i class="fa fa-edit"></i><span class="ml-2" style="font-size: 17px;">Manage categories</span>
                </label>
                   <div class="option pull-right mt-2 pr-3">
                   <i class="fa fa-sort"></i>Ordering :[
                      <a class="<?php if($sort == 'ASC') {echo 'active';}?>" href="?sort=ASC">ASC</a> |
                      <a class="<?php if($sort == 'DESC') {echo 'active';}?>" href="?sort=DESC">DESC</a>]
                    </div>

               </div>
              
               
               <div class="panel-body">
              
                   <?php
                          foreach($cats as $cat){
                            echo "<div class='cat'>";
                               echo "<div class='hidden-buttons'>";
                                  echo "<a href='categories.php?do=Edit&catid=".$cat['ID']."' class='btn btn-xs btn-primary'><i class='fa fa-edit'></i>Edit</a>";
                                  echo "<a href='categories.php?do=Delete&catid=".$cat['ID']."' class='confirm btn btn-xs btn-danger'><i class='fa fa-close'></i>Delete</a>";

                               echo "</div>";
                               echo "<h3>".$cat['Name'] .'</h3>';
                                   echo "<div class='full-view'>";
                                      echo "<p>"; if($cat['Description']==''){ echo 'this category has no description';} else{ echo $cat['Description'];} echo'</p>';
                                     if($cat['Visibility']==1){ echo '<span class="visibility"><i class="fa fa-eye"></i>Hidden</span>';}
                                    
                                   echo "</div>";
                              echo "</div>";
                              echo '<hr>';
                          }

                  ?>
              
               </div>
              
            </div>
         <a class="btn btn-primary add-cat" href="categories.php?do=Add"><i class="fa fa-plus"></i>Add New Category</a>
        </div>
</div>
</div>
<?php 
 
    }elseif($do=='Add'){?>

        <div class="father-section">
            
                <div class="container">
                  <h2 class="edit-title text-center mb-5">Add New Categories </h2>
                  <form action="?do=Insert" class="" method="POST">
                    <div class="row form-group edit-contant">
                      <label for="" class="col-sm-2 contol-label">Categoy Name :</label>
                      <div class="col-sm-10 edit-input">
                        <input type="text" name="name" class="form-control formcontrol" placeholder="Name Of The Categories" >
                      </div>
                    </div>
                    <div class="row form-group edit-contant">
                      <label for="" class="col-sm-2 contol-label">Description :</label>
                      <div class="col-sm-10 edit-input">
                        <input type="text" name="description" class="form-control formcontrol" placeholder="Discribe the Category" >
                      </div>
                    </div>
                    <div class="row form-group edit-contant">
                      <label for="" class="col-sm-2 contol-label">Ordering :</label>
                      <div class="col-sm-10 edit-input">
                        <input type="text" name="ordering" class="password form-control formcontrol" placeholder="Number To Arrange The Categories" >
                      
                      </div>
                    </div>
                    <div class="row form-group edit-contant">
                      <label for="" class="col-sm-2 contol-label">Visiblility :</label>
                      <div class="col-sm-10 radio-input">
                        <input id="yes" type="radio" name="visibility" value="0" checked>
                         <label for="yes">Yes</label>
                        <span class="ml-3"></span>
                        <input id="no" type="radio" name="visibility" value="1"> 
                        <label for="no">No</label>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-10 ">
                        <input type="submit" value="Add New Category" class="btn btn-primary btn-save">
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
            <h2 class="edit-title text-center mb-4">Insert Category </h2>
    <?php
               //Get variables from the form
              
               $name=$_POST['name'];
               $desc=$_POST['description'];
               $order=$_POST['ordering'];
               $visible=$_POST['visibility'];
              
        
               //check if categorys exist in database 
              
                $check = checkItem('Name','categories',$name);
                if($check == 1){
        
                    $themsg = "<div class='alert alert-danger'>sorry this category is exist</div>";
                    redirectHome($themsg ,'back');
        
                } else {
               //insert category info in database
               
               $stmt=$con->prepare("INSERT INTO categories(Name ,Description ,Ordering ,Visibility ) VALUES(:name , :desc,:order,:visible)" );
               $stmt->execute(array(
                   'name' => $name,
                   'desc' => $desc,
                   'order' => $order,
                   'visible' => $visible
                  
               ));
               //print seccess massage ;
        
                $themsg = "<div class='alert alert-success'> ". $stmt->rowCount() . " Record inserted</div>";
                redirectHome($themsg,'back');
                 }
               
              } else{
        
                echo "<div class='container'>";
                $themsg = "<div class='alert alert-danger'>sorry you cant browser this page directly</div>";
                redirectHome($themsg,'back',3);
                echo "</div>";
              }
              ?>
        </div>
 </div>
    
 <?php

    }elseif($do=='Edit'){
?>
        <div class="father-section">
    
          <div class="">
            <h2 class="edit-title text-center mb-3">Edit Category </h2>
       <?php
              // chek if get request catid is numeric & get the integer value of it
      $catid=isset($_GET['catid']) && is_numeric($_GET['catid']) ?  intval($_GET['catid']) : 0;

      // select all data depend on this ID
        $stmt = $con ->prepare("SELECT * FROM categories where ID = ?");
        //Execute Query
        $stmt->execute(array($catid));
        //Fetch the data
        $cat = $stmt->fetch();
        //the row count
        $count = $stmt->rowCount();
        //if theres such id show the form
        if($stmt->rowCount()> 0 ){      
      ?>
           
        <div class="container">
        <form action="?do=Update" class="" method="POST">
                    <div class="row form-group edit-contant">
                      <label for="" class="col-sm-2 contol-label">Categoy Name :</label>
                      <div class="col-sm-10 edit-input">
                      <input type="hidden" name="catid" value="<?php echo $catid; ?>">
                        <input type="text" name="name" class="form-control formcontrol" value="<?php echo $cat['Name'];?>">
                      </div>
                    </div>
                    <div class="row form-group edit-contant">
                      <label for="" class="col-sm-2 contol-label">Description :</label>
                      <div class="col-sm-10 edit-input">
                        <input type="text" name="description" class="form-control formcontrol" value="<?php echo $cat['Description'];?>" >
                      </div>
                    </div>
                    <div class="row form-group edit-contant">
                      <label for="" class="col-sm-2 contol-label">Ordering :</label>
                      <div class="col-sm-10 edit-input">
                        <input type="text" name="ordering" class="password form-control formcontrol" value="<?php echo $cat['Ordering'];?>">
                      
                      </div>
                    </div>
                    <div class="row form-group edit-contant">
                      <label for="" class="col-sm-2 contol-label">Visiblility :</label>
                      <div class="col-sm-10 radio-input">
                        <input id="yes" type="radio" name="visibility" value="0" <?php  if($cat['Visibility'] == 0){echo 'checked';}?> >
                         <label for="yes">Yes</label>
                        <span class="ml-3"></span>
                        <input id="no" type="radio" name="visibility" value="1" <?php  if($cat['Visibility'] == 1){echo 'checked';}?> > 
                        <label for="no">No</label>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-10 ">
                        <input type="submit" value="Update" class="btn btn-primary btn-save">
                      </div>
        
                    </div>
        
                  </form>
                   <!-- end visibility field-->
                   

        </div>
  
      <?php 
      //if theres no such id show Error Message
      }else{
          echo "<div class='container'>";
          $themsg = '<div class="alert alert-danger">theres no such ID</div>';
          redirectHome($themsg);
          echo "</div>";
      }
        ?>
        </div>
 </div>
 <?php
    }elseif($do=='Update'){
        ?>
        <div class="father-section">
    
          <div class="">
            <h2 class="edit-title text-center mb-3">Update Category </h2>
       <?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
 
    //Get variables from the form
    $id=$_POST['catid'];
    $name=$_POST['name'];
    $desc=$_POST['description'];
    $order=$_POST['ordering'];

    $visible=$_POST['visibility'];
   
   
    //Update the database with this Info
    $stmt=$con->prepare("UPDATE categories set Name = ?, Description = ?, Ordering = ? , Visibility =?  where ID = ?");
    $stmt->execute(array($name,$desc,$order,$visible,$id));
    //print seccess massage ;

   $themsg = "<div class='alert alert-success'> ". $stmt->rowCount() . ' Record Updated</div>';
    redirectHome($themsg,'back');
   

   }else{
     $errormsg = "<div class='alert alert-danger'>sorry you cant browser this page directly</div>";
     redirectHome($errormsg);
       //echo "sorry you cant browser this page directly";
   }
  

        ?>
        </div>
 </div>
 <?php


    }elseif($do=='Delete'){ ?>
        <div class="father-section">
    
          <div class="">
            <h2 class="edit-title text-center mb-3">Delete Category </h2>
<?php

 // chek if get request catid is numeric & get the integer value of it
 $catid=isset($_GET['catid']) && is_numeric($_GET['catid']) ?  intval($_GET['catid']) : 0;

 // select all data depend on this ID
  // $stmt = $con ->prepare("SELECT * FROM users where UserID = ? limit 1");
  $check = checkItem('ID','categories',$catid);
   //Execute Query
  // $stmt->execute(array($userid));

   //the row count
   //$count = $stmt->rowCount();

   //if theres such id show the form
   if($check > 0 ){

      $stmt = $con->prepare('DELETE FROM categories WHERE ID = :zid');
      $stmt->bindParam("zid",$catid);
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

}include $tpl . 'footer.php';

}else{

  header('Location:index.php');
  exit();

}

ob_end_flush();

?>







