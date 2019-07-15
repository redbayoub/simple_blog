<?php require_once("session.php"); ?>
<?php require_once("connection.php"); ?>
<?php require_once("functions.php"); ?>
     <div class="fileds_nav">
       <ul>
         <li><a href="index.php" class="<?php if(!isset($_GET["filed"])||empty($_GET["filed"])) echo "active"; ?>">Home</a></li>
         <?php $filed_set=get_all("pro0inter_fildes",NULL,"position","ASC");
                $output="";
              while ($filed_res=mysqli_fetch_assoc($filed_set)) {
                $output.="<li><a class=\"";
                if(isset($_GET["filed"])&&$_GET["filed"]==$filed_res["filed_name"]) $output.= "active";
                $output.=" \" href=\"index.php?filed=".urlencode($filed_res["filed_name"])."\">{$filed_res["filed_name"]}</a></li>";
              }
              echo $output;
          ?>
          <?php if (! loggedIn()) { ?>
            <li style="float:right"><a href="login.php" style="float:right;">Login</a></li>
          <?php } ?>
       </ul>
     </div>
