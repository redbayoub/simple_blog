<?php require_once("includes/session.php") ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
		if (!isset($_GET["filed"])||empty($_GET["filed"])){
			$filed_sel=false;
			$filed_name="";
			$filed_id=NULL;
		}else{
			$filed_res=get_by_id("pro0inter_fildes","filed_name",$_GET["filed"]);
			if (!empty($filed_res)) { // filed found
				$filed_name=$_GET["filed"];
				$filed_sel=true;
				$filed_id=$filed_res["filed_id"];
			}else { // filed not found
				$filed_sel=false;
			}
		}
 ?>
 <?php
 if (isset($_GET["page"])&&($_GET["page"]>0)) {
	 $current_page=$_GET["page"];
	 $perv_page=$current_page-1;
 }else {
	 $current_page=1;
	 $perv_page=$current_page;
 }
 $next_page=$current_page+1;
 if ($current_page==1) {
	 $min_page=1;
 }else {
	 $min_page=$current_page-1;
	 while ($min_page%5!=0&&$min_page>1) {
		 $min_page-=1;
	 }
 }
 $max_page=$min_page+6;
 $count_subjs=count_subjects($filed_id);
 if ($count_subjs<($max_page*10)-10) {
	 while ($count_subjs%10!=0) {
	 	$count_subjs-=1;
	 }
 	$max_page=$count_subjs/10;
	if ($max_page<1) {
		$max_page=1;
		$next_page=1;
	}
 }

 ?>
<?php // this include the header without nav
 include("includes/header.php");
 ?>
 <?php // this include the fildes nav
  include("includes/fildes_navigation.php");
  ?>

    <div class="index_content">
      <br>

      <div class="mostVisit">
        <h3>Most Viewed Subjectes</h3>
        <ul>
					<?php
							$subject_set=get_most_viewed_subjects(5);
							$output="";
							while ($subj=mysqli_fetch_assoc($subject_set)) {
								$output.="<li><a href=\"view.php?subj_id={$subj["subject_id"]}\">{$subj["subject_title"]}</a></li>";
							}
							echo $output;
					 ?>
        </ul>
      </div>

      <div class="subjects">
				<?php
						$min_subj_id=($current_page*10)-10;
						if($filed_sel){
							$subject_set=get_aproved_subjects($min_subj_id,$filed_id);
						}else{
							$subject_set=get_aproved_subjects($min_subj_id);
						}
				 ?>

				<?php if (is_writer()) { ?>
					<div class="subject">
						<a href="add_subj.php"><img src="images/add_subj.png" alt="add subject"></a>
						<a href="add_subj.php">Add Subject</a>
					</div>

				<?php } ?>
				 <?php
				 $output="";
				 while($subj=mysqli_fetch_assoc($subject_set)) {
					 $output.="<div class=\"subject\">";
					 $subj_id=$subj["subject_id"];
					 $subj_title=$subj["subject_title"];
					 $subj_writer=$subj["subject_writer"];
					 $subj_coverImg=$subj["cover_img_path"];
					 $subj_date=$subj["subject_date"];
					 $subj_url_view="view.php?subj_id={$subj_id}&title={$subj_title}";
					 $output.="<a href=\"{$subj_url_view}\"><img src=\"{$subj_coverImg}\" alt=\"subject cover image\"></a>";
					 $output.="<a href=\"{$subj_url_view}\"><h4>{$subj_title}</h4></a>";
					 $output.="<span class=\"subj_info\">Writen by : {$subj_writer} at ".$subj_date."</span>";
					 $output.="<p>".substr(strip_tags($subj["subject_content"]),0,350)." ...etc </p>";
					 $output.="</div>";
				 }
				 echo $output;
				  ?>
      </div>

		 <!-- Thers will be here pagination -->
			 <ul class="pagination">


   	 			<li><a href="<?php echo "index.php?page={$perv_page}&filed={$filed_name}";?>">&laquo;</a></li>
					<?php
					$output="";
						for ($page_nb=$min_page; $page_nb <=$max_page ; $page_nb++) {
							$output.="<li><a href=\"index.php?page={$page_nb}&filed={$filed_name}\" ";
							if($current_page==$page_nb){
								$output.="class=\"active\"";
							}
							$output.=">{$page_nb}</a></li>";
						}
						echo $output;

					 ?>

   				<li><a href="<?php echo "index.php?page={$next_page}&filed={$filed_name}";?>">&raquo;</a></li>
 				</ul>


    </div>
    <br>
<?php display_message(); ?>
    <?php // this include the footer
     require("includes/footer.php");
     ?>
