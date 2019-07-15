<?php require_once("includes/session.php") ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
  function redirect($msg)
  {
    if (isset($_GET["src_page"])) {
      redirect_to("{$_GET["src_page"]}&msg=".urlencode($msg));
    } else {
      redirect_to("index.php");
    }
  }
 ?>
<?php
  $in_prev=false;
    if (isset($_GET["subj_id"])) {
      $subj=get_by_id("pro0inter_subjects","subject_id",$_GET["subj_id"]);
      if(!empty($subj)){
        // the subject is exist
        if ($subj["subject_aproved"]==1) {
          //the subject is aproved

        } elseif (is_admin()) {
          // check the user if he is admin
        } elseif (isset($_SESSION["perv"])&&$_SESSION["perv"]=="true") {
          // check is this is a Preview
          $in_prev=true;
          $_SESSION["perv"]=NULL;

        } else{
          // dont' have the right to see it
          redirect("Sorry ,you dont' have the right to see it");
        }
      }else {
        redirect("Sorry ,Subject dosen't exist ");
      }
    }else{
      // there is no subj ID in get
      redirect("Sorry ,fail in  the request ");
  }
 ?>
 <?php
    if (isset($_GET["src_page"])) {
      $src_page=urlencode($_GET["src_page"]);
    }else{
      $src_page=urlencode("view.php?subj_id={$_GET["subj_id"]}");
    }
  ?>
<?php // this include the header without nav
 include("includes/header.php");
 ?>
 <?php // this include the fildes nav
  include("includes/fildes_navigation.php");
  ?>
  <?php if (loggedIn()) { ?>
  <div class="view_btn">
  <?php if (is_admin()||$in_prev||($_SESSION["id"]==$subj["subject_writer_id"])) { ?>
   <a href="<?php echo "edit_subj.php?src_page={$src_page}&subj_id={$_GET["subj_id"]}" ; ?>" style="float :right;margin: 5px;"><button type="button">Edit</button></a>
 <?php } ?>
 <?php if (is_admin()||$in_prev) { ?>
   <a href="<?php echo "delate_subj.php?src_page={$src_page}&subj_id={$_GET["subj_id"]}" ; ?>" style="float :right;margin: 5px;"><button type="button">Remove</button></a>
 <?php } ?>
  </div>
<?php } ?>
    <div class="subj_content">
      <br><?php set_value("pro0inter_subjects","subject_viewes",$_GET["subj_id"],1,true); ?>
        <h4><?php echo $subj["subject_title"]; ?></h4>
        <?php echo $subj["subject_content"]; ?>
        <div class="writer_part">
          <?php $writer=get_by_id("pro0inter_users","ID",$subj["subject_writer_id"]);
            if(empty($writer)){ ?>
              <img src="images/no_writer_image.png" alt=" no writer image">
              <h4><?php echo $subj["subject_writer"]; ?></h4>
            <?php }else{ ?>
              <img src="<?php //echo $writer["image"];
                          echo "images/no_writer_image.png";
              ?>" alt="writer image">
              <h4><?php echo $writer["firstname"]." ".$writer["surname"]; ?></h4>
              <p><?php echo $writer["description"]; ?></p>
            <?php } ?>
        </div>
    </div>
    <br>
<?php display_message(); ?>
    <?php // this include the footer
     require("includes/footer.php");
     ?>
