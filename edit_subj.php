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
if (isset($_GET["subj_id"])) {
  $subj=get_by_id("pro0inter_subjects","subject_id",$_GET["subj_id"]);
  if(!empty($subj)){
    // the subject is exist
    if (is_admin()||($_SESSION["id"]==$subj["subject_writer_id"])) {
      // check the user if he is admin Or the writer
    } else{
      // dont' have the right to see it
      redirect("Sorry ,you dont' have the right to edit it");
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
    $src_page=$_GET["src_page"];
  }else{
    $src_page="";
  }
?>
<?php // this include the header without nav
 include("includes/header.php");
 ?>
    <div class="content">
      <br>
      <p class="Note"><?php if(isset($_GET["msg"])) echo $_GET["msg"]; ?></p>
      <h4>Edit a subject</h4>
      <p class="Note">You can use some HTML tags in content plz revise
        <a href="accepted_html_tags.php">Using HTML Tags</a> page Before you do that</p>
        <p class="Note">Note : Plz ,upload your subject images in any image
           hosting servers than put just the URL of it </p>
      <form  action="forms_procc/try_edit_subj.php?src_page=<?php echo urlencode($src_page); ?>" method="post" class="form_general">
        <input type="text" name="subj_id" value="<?php echo $subj["subject_id"]; ?>" hidden>
        New Title : <input type="text" name="title" required value="<?php echo $subj["subject_title"];  ?>"><br><br>
        Filed : <select name="filed_id" required >
          <?php
            $filed_set=get_all("pro0inter_fildes");
            while ($filed_res=mysqli_fetch_assoc($filed_set)) {
              echo "<option value=\"{$filed_res["filed_id"]}\">
              {$filed_res["filed_name"]}</option>";
            }
           ?>
        </select><br><br>
        New Cover Image URL: <input type="url" name="cover_img" value=""><br><br>
        Content : <br><textarea name="content" rows="8" cols="80" required ><?php echo $subj["subject_content"];  ?></textarea><br><br>
        <input type="submit" name="submit" value="Apply">
      </form>

      <a href="<?php if (isset($src_page)){
        echo $src_page;
      }else{
        echo "login.php";
      } ?>">Cancel</a>

    </div>
    <br>
<?php display_message(); ?>
    <?php // this include the footer
     require("includes/footer.php");
     ?>
