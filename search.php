<?php 
   include_once 'include/functions.php';
   $functions = new Functions();

   if(isset($_GET['search']) && !empty($_GET['search'])) 
   {
       $search = $_GET['search'];
       $searchResult = array();
       
       $updateDetails = $functions->query("SELECT * FROM ".PREFIX."home_headline_master where (title like '%".$search."%' or description like '%".$search."%') AND active='1' ");
       while($updateRow = $functions->fetch($updateDetails)) 
       {
           $searchResult['Home-Headline'][] = $updateRow;
       }

       $homeHealth = $functions->query("SELECT * FROM ".PREFIX."home_testimonial_master where (name like '%".$search."%' or designation like '%".$search."%' or description like '%".$search."%') AND active='1' ");
       while($updateHomeHealth = $functions->fet	) 
       {
           $searchResult['Home-Testimonial'][] = $updateHomeHealth;
       }


       $testimonial = $functions->query("SELECT * FROM ".PREFIX."industry_master where (name like '%".$search."%' or short_description like '%".$search."%' or image_title like '%".$search."%' or description like '%".$search."%' or detail_description1 like '%".$search."%' or detail_description2 like '%".$search."%' ) and active='1'");
       while($testimonialDetails = $functions->fetch($testimonial)) 
       {
           $searchResult['Industry'][] = $testimonialDetails;
       }


       $aboutData = $functions->query("SELECT * FROM ".PREFIX."about_cms where (description like '%".$search."%' or banner_title like '%".$search."%' or banner_description like '%".$search."%' or description1 like '%".$search."%' or description2 like '%".$search."%')");
       while($aboutDetails = $functions->fetch($aboutData)) 
       {
           $searchResult['About'][] = $aboutDetails;
       }

       //echo "SELECT * FROM ".PREFIX."media_master where (title like '%".$search."%' or short_description like '%".$search."%' or description like '%".$search."%') AND active='1' ";

       $mediaCms = $functions->query("SELECT * FROM ".PREFIX."media_master where (title like '%".$search."%' or short_description like '%".$search."%' or description like '%".$search."%') AND active='1' AND third_party_url ='' ");
       while($mediaDetails = $functions->fetch($mediaCms)) 
       {
           $searchResult['Media'][] = $mediaDetails;
       }


       $categoryPageCms = $functions->query("SELECT * FROM ".PREFIX."category_page_cms where (title like '%".$search."%' or page_title like '%".$search."%' or description like '%".$search."%' or page_description like '%".$search."%' or title1 like '%".$search."%' or title2 like '%".$search."%' or title3 like '%".$search."%') ");
       while($categoryPageDetails = $functions->fetch($categoryPageCms)) 
       {
           $searchResult['Product-Category'][] = $categoryPageDetails;
       }


       $subcategoryPageCms = $functions->query("SELECT scm.* FROM ".PREFIX."sub_category_master as scm LEFT JOIN ".PREFIX."faq_master as fm ON scm.id=fm.category_id where (scm.category_name like '%".$search."%' or scm.title like '%".$search."%' or scm.description like '%".$search."%' or scm.page_title like '%".$search."%' or scm.page_description like '%".$search."%' or scm.title2 like '%".$search."%' or scm.title3 like '%".$search."%' or scm.title1 like '%".$search."%' or scm.comparison like '%".$search."%' or fm.question like '%".$search."%' or fm.answer like '%".$search."%') AND scm.active='1' AND fm.active='1' GROUP BY scm.id ");
       while($subcategoryPageDetails = $functions->fetch($subcategoryPageCms)) 
       {
           $searchResult['Product-Sub-Category'][] = $subcategoryPageDetails;
       }


       


       $productCms = $functions->query("SELECT pm.* FROM ".PREFIX."product_master as pm LEFT JOIN ".PREFIX."product_specification_master as psm ON pm.id=psm.product_id where (pm.product_name like '%".$search."%' or pm.product_title like '%".$search."%' or pm.short_description like '%".$search."%' or pm.overview like '%".$search."%' or pm.detail_description like '%".$search."%' or psm.title like '%".$search."%' or psm.description like '%".$search."%') AND pm.active='1' AND psm.active='1' GROUP BY pm.id ");
       while($productDetails = $functions->fetch($productCms)) 
       {
           $searchResult['Product'][] = $productDetails;
       }       
         
   } 
   else 
   {
    	header("Location: ".BASE_URL." ");
    	exit();
   }

?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo SITE_NAME; ?> || Search </title>
	<?php include("include/header-link.php");?>
</head>
<body class="innerpage searchpage">
	<main class="root">
		<?php include("include/header.php");?>
		<section class="innerpagebanner-section mtop">
			<img src="<?php echo BASE_URL; ?>/images/procat.png" alt="procat" class="inbanner">
			<div class="inbantext">
				<div class="container p0">
					<h1>Search</h1>
				</div>
			</div>
		</section>
		<section class="breadcrumb-section">
			<div class="container p0">
				<ul class="breadcrumb-in">
					<li><a href="<?php echo BASE_URL; ?>">Home</a></li>
					<li><a href="javascript:void(0);">Search</a></li>
				</ul>

				<?php if(!empty($searchResult)) 
                     { 
                        foreach($searchResult as $key => $value) 
                        { 
                           if($key == 'Home-Headline') 
                           { ?>
                           <?php if($key == 'Home-Headline') 
                           { 
                              foreach($value as $keyVal) 
                              { ?>
                                 <div class="sear-details-list">
                                    <div class="divsearch">
                                       <a href="<?php echo BASE_URL; ?>/index#headlines"><h2><?php echo $key; ?></h2></a>
                                       <h2><?php echo $keyVal['title']; ?></h2>
                                       <p><?php echo $keyVal['description']; ?></p>
                                       <a href="<?php echo BASE_URL; ?>/index#headlines" class="newsbtn"><span class="angle"></span><p>Read More</p></a>
                                    </div>
                                 </div>
                                 <hr>
                           <?php       
                           } 
                        }
                     }
                              else if($key == 'Home-Testimonial') 
                           { ?>
                                    
                                    <?php if($key == 'Home-Testimonial') 
                                    { 
                                       foreach($value as $keyVal) 
                                       { ?>
                                          <div class="sear-details-list">
                                             <div class="divsearch">
                                                <a href="<?php echo BASE_URL; ?>/index#testimonialss"><h2><?php echo $key; ?></h2></a>
                                                <h2><?php echo $keyVal['name']; ?></h2>
                                                <p><?php echo $keyVal['description']; ?></p>
                                                <a href="<?php echo BASE_URL; ?>/index#testimonialss" class="newsbtn"><span class="angle"></span><p>Read More</p></a>
                                             </div>
                                          </div>
                                          <hr>
                                    <?php       
                                    } 
                                 }
                              }

                               else if($key == 'Industry') 
                                 { ?>
                                          
                                          <?php if($key == 'Industry') 
                                          { 
                                             foreach($value as $keyVal) 
                                             { ?>
                                                <div class="sear-details-list">
                                                   <div class="divsearch">
                                                      <a href="<?php echo BASE_URL; ?>/industries/<?php echo $keyVal['permalink']; ?>"><h2><?php echo $key; ?></h2></a>
                                                      <h2><?php echo $keyVal['name']; ?></h2>
                                                      <p><?php echo $keyVal['short_description']; ?></p>
                                                      <a href="<?php echo BASE_URL; ?>/industries/<?php echo $keyVal['permalink']; ?>" class="newsbtn"><span class="angle"></span><p>Read More</p></a>
                                                   </div>
                                                </div>
                                                <hr>
                                          <?php       
                                          } 
                                       }
                                    }

                                 else if($key == 'Media') 
                                 { ?>
                                          
                                          <?php if($key == 'Media') 
                                          { 
                                             foreach($value as $keyVal) 
                                             { ?>
                                                <div class="sear-details-list">
                                                   <div class="divsearch">
                                                      <a href="<?php echo BASE_URL; ?>/media/<?php echo $keyVal['permalink']; ?>"><h2><?php echo $key; ?></h2></a>
                                                      <h2><?php echo $keyVal['title']; ?></h2>
                                                      <p><?php echo $keyVal['short_description']; ?></p>
                                                      <a href="<?php echo BASE_URL; ?>/media/<?php echo $keyVal['permalink']; ?>" class="newsbtn"><span class="angle"></span><p>Read More</p></a>
                                                   </div>
                                                </div>
                                                <hr>
                                          <?php       
                                          } 
                                       }
                                    }else if($key == 'Product'){
                                       if($key == 'Product') 
                                          { 
                                             foreach($value as $keyVal) 
                                             { ?>
                                                <div class="sear-details-list">
                                                   <div class="divsearch">
                                                      <a href="<?php echo BASE_URL; ?>/product/<?php echo $keyVal['permalink']; ?>"><h2><?php echo $key; ?></h2></a>
                                                      <h2><?php echo $keyVal['product_name']; ?></h2>
                                                      <h2><?php echo $keyVal['product_title']; ?></h2>
                                                      <p><?php echo $keyVal['short_description']; ?></p>
                                                      <a href="<?php echo BASE_URL; ?>/product/<?php echo $keyVal['permalink']; ?>" class="newsbtn"><span class="angle"></span><p>Read More</p></a>
                                                   </div>
                                                </div>
                                                <hr>
                                          <?php       
                                          } 
                                       }
                                    }else if($key == 'Product-Category'){
                                       if($key == 'Product-Category') 
                                          { 
                                             foreach($value as $keyVal) 
                                             { ?>
                                                <div class="sear-details-list">
                                                   <div class="divsearch">
                                                      <a href="<?php echo BASE_URL; ?>/products"><h2><?php echo $key; ?></h2></a>
                                                      <h2><?php echo $keyVal['page_title']; ?></h2>
                                                      <p><?php echo $keyVal['page_description']; ?></p>
                                                      <a href="<?php echo BASE_URL; ?>/products" class="newsbtn"><span class="angle"></span><p>Read More</p></a>
                                                   </div>
                                                </div>
                                                <hr>
                                          <?php       
                                          } 
                                       }
                                    }else if($key == 'Product-Sub-Category'){
                                       if($key == 'Product-Sub-Category') 
                                          { 
                                             foreach($value as $keyVal) 
                                             { ?>
                                                <div class="sear-details-list">
                                                   <div class="divsearch">
                                                      <a href="<?php echo BASE_URL; ?>/category/<?php echo $keyVal['permalink']; ?>"><h2><?php echo $key; ?></h2></a>
                                                      <h2><?php echo $keyVal['category_name']; ?></h2>
                                                      <p><?php echo $keyVal['description']; ?></p>
                                                      <a href="<?php echo BASE_URL; ?>/category/<?php echo $keyVal['permalink']; ?>" class="newsbtn"><span class="angle"></span><p>Read More</p></a>
                                                   </div>
                                                </div>
                                                <hr>
                                          <?php       
                                          } 
                                       }
                                    }else if($key == 'Product-Sub-Categoryss'){
                                       if($key == 'Product-Sub-Category') 
                                          { 
                                             foreach($value as $keyVal) 
                                             { ?>
                                                <div class="sear-details-list">
                                                   <div class="divsearch">
                                                      <a href="<?php echo BASE_URL; ?>/products"><h2><?php echo $key; ?></h2></a>
                                                      <h2><?php echo $keyVal['page_title']; ?></h2>
                                                      <p><?php echo $keyVal['page_description']; ?></p>
                                                      <a href="<?php echo BASE_URL; ?>/products" class="newsbtn"><span class="angle"></span><p>Read More</p></a>
                                                   </div>
                                                </div>
                                                <hr>
                                          <?php       
                                          } 
                                       }
                                    }else if($key == 'Product-Sub-Categorysss'){
                                       if($key == 'Product-Sub-Category') 
                                          { 
                                             foreach($value as $keyVal) 
                                             { ?>
                                                <div class="sear-details-list">
                                                   <div class="divsearch">
                                                      <a href="<?php echo BASE_URL; ?>/products"><h2><?php echo $key; ?></h2></a>
                                                      <h2><?php echo $keyVal['page_title']; ?></h2>
                                                      <p><?php echo $keyVal['page_description']; ?></p>
                                                      <a href="<?php echo BASE_URL; ?>/products" class="newsbtn"><span class="angle"></span><p>Read More</p></a>
                                                   </div>
                                                </div>
                                                <hr>
                                          <?php       
                                          } 
                                       }
                                    }

                           }

                        }else{
                  ?>
                        No relavent details found.
                  <?php
                        }
                  ?>
			</div>
		</section>

	</main>
	<?php include("include/footer.php");?> 
	<?php include("include/footer-link.php");?>
	<script type="text/javascript">
	</script>
</body>
</html>