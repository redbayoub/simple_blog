<?php require_once("includes/session.php") ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_Logged_In(); ?>
<?php // this include the header without nav
 include("includes/header.php");
 ?>
    <div class="content">
      <br>
      <h4>Add a new subject</h4>
      <p class="Note">You can use some HTML tags in content plz revise
        <a href="accepted_html_tags.php">Using HTML Tags</a> page Before you do that</p>
        <p class="Note">Note : Plz ,upload your subject images in any image
           hosting servers than put just the URL of it </p>
      <form  action="forms_procc/try_add_subj.php" method="post" class="form_general">
        Title : <input type="text" name="title" required><br><br>
        Filed : <select name="filed_id" required >
          <?php
            $filed_set=get_all("pro0inter_fildes");
            while ($filed_res=mysqli_fetch_assoc($filed_set)) {
              echo "<option value=\"{$filed_res["filed_id"]}\">
              {$filed_res["filed_name"]}</option>";
            }
           ?>
        </select><br><br>
        Cover Image URL: <input type="url" name="cover_img" value="" required><br><br>
        Content : <br><textarea name="content" rows="8" cols="80" required></textarea><br><br>
        <input type="submit" name="submit" value="Preview">
      </form>

      <a href="<?php if (isset($_GET["src_page"])){
        echo "{$_GET["src_page"]}";
      }else{
        echo "login.php";
      } ?>">Cancel</a>

    </div>
    <br>
<?php display_message(); ?>
    <?php // this include the footer
     require("includes/footer.php");
     ?>
