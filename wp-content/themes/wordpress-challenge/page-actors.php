<?php /*
Template Name: Actors
*/ 
?>

<?php get_header(); ?>

<div class="default-page">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1 class="centered">Actors</h1>
				<?php
				if ( have_posts() ) : 
				    while ( have_posts() ) : the_post(); ?>
					    <div class="page-content"><?php the_content(); ?></div>
				    <?php
					endwhile; 
				endif; 
				?>

				<?php
					$query = $_GET;
					$query['actors_page'] = 1;
					$query_result = http_build_query($query);
					$form_action = $_SERVER['PHP_SELF'].'?'.$query_result;
				?>
				<div class="search-form">
					<form method="post" action="<?php echo $form_action; ?>">
						<input type="text" value="<?php if($_POST['searchPeople']){echo $_POST['searchPeople'];} ?>" placeholder="Search for actor" name="searchPeople" id="searchPeople" />
						<div class="ctas">
							<input type="submit" value="Find" />
							<input type="submit" id="clearSearch" value="Clear Search" />
						</div>
					</form>
				</div>
				<div class="row">
					<div class="col-md-12">
						
					
				<?php
					$thePage = $_GET['actors_page'];
					if ($thePage == NULL){
						$thePage = 1;
					}
					$thePrevPage = $thePage-1;
					$theNextPage = $thePage+1;

					if($_POST['searchPeople']){
						$searchQuery = $_POST['searchPeople'];
						$searchQuery = str_replace(" ","+",$searchQuery);
						$actors_search = file_get_contents("https://api.themoviedb.org/3/search/person?api_key=8c19b69ef99a48c3f8cc582a379e22e4&language=en-US&query=".$searchQuery, false, $context);
						$actors_search_json = json_decode($actors_search,true);

						echo '<div class="row"><div class="col-md-12">';

						if ($thePage != 1){ 
							$query['actors_page'] = $thePrevPage;
							$query_result = http_build_query($query);
						?>
						<a href="<?php echo $_SERVER['PHP_SELF']; ?>?<?php echo $query_result; ?>" class="lnk-prev">&laquo; Previous Page</a>
						<?php } 

						if ($thePage < $actors_search_json['total_pages']){
							$query['actors_page'] = $theNextPage;
							$query_result = http_build_query($query);
						?>
						<a href="<?php echo $_SERVER['PHP_SELF']; ?>?<?php echo $query_result; ?>" class="lnk-next">Next Page &raquo;</a>
						<?php }

						echo '</div></div>';

						echo '<div class="row">';
						for($i=0;$i<count($actors_search_json['results']);$i++){
							
							echo '<div class="col-md-2"><div class="actor-item2">';

							if($actors_search_json['results'][$i]['profile_path'] != ''){
								echo '<a href="'.get_site_url().'?page_id=18&person_id='.$actors_search_json['results'][$i]['id'].'" class="img"><img src="https://image.tmdb.org/t/p/original/'.$actors_search_json['results'][$i]['profile_path'].'" class="movie_poster" /></a>';
							} else {
								echo '<a href="'.get_site_url().'?page_id=18&person_id='.$actors_search_json['results'][$i]['id'].'" class="img"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 150" width="100" height="150"><rect width="100" height="150" fill="#cccccc"></rect><text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" font-family="monospace" font-size="26px" fill="#333333">Jobsity </text></svg></a>';
							}
				        	echo '<a href="'.get_site_url().'?page_id=18&person_id='.$actors_search_json['results'][$i]['id'].'">'.$actors_search_json['results'][$i]['name'].'</a>';	
				        	echo '<a href="'.get_site_url().'?page_id=18&person_id='.$actors_search_json['results'][$i]['id'].'" class="more">More info about this actor</a>';

				        	echo '</div></div>';

				        	if(($i+1) % 6 == 0){
				        		echo '</div><div class="row">';
				        	}
				        }
						echo '</div>';				        

					    if ($thePage != 1){ 
							$query['actors_page'] = $thePrevPage;
							$query_result = http_build_query($query);
						?>
						<a href="<?php echo $_SERVER['PHP_SELF']; ?>?<?php echo $query_result; ?>" class="lnk-prev">&laquo; Previous Page</a>
						<?php } 

						if ($thePage < $actors_search_json['total_pages']){
							$query['actors_page'] = $theNextPage;
							$query_result = http_build_query($query);
						?>
						<a href="<?php echo $_SERVER['PHP_SELF']; ?>?<?php echo $query_result; ?>" class="lnk-next">Next Page &raquo;</a>
						<?php }	

					} else {
						$searchQuery = '';

						$actors_list = file_get_contents("https://api.themoviedb.org/3/person/popular?api_key=8c19b69ef99a48c3f8cc582a379e22e4&language=en-US&page=".$thePage, false, $context);
						$actors_list_json = json_decode($actors_list,true);

						echo '<div class="row"><div class="col-md-12">';

						if ($thePage != 1){ 
							$query['actors_page'] = $thePrevPage;
							$query_result = http_build_query($query);
						?>
						<a href="<?php echo $_SERVER['PHP_SELF']; ?>?<?php echo $query_result; ?>" class="lnk-prev">&laquo; Previous Page</a>
						<?php } 

						if ($thePage < $actors_list_json['total_pages']){
							$query['actors_page'] = $theNextPage;
							$query_result = http_build_query($query);
						?>
						<a href="<?php echo $_SERVER['PHP_SELF']; ?>?<?php echo $query_result; ?>" class="lnk-next">Next Page &raquo;</a>
						<?php }

						echo '</div></div>';

						echo '<div class="row">';
						for($i=0;$i<count($actors_list_json['results']);$i++){
							
							echo '<div class="col-md-2"><div class="actor-item2">';

							if($actors_list_json['results'][$i]['profile_path'] != ''){
								echo '<a href="'.get_site_url().'?page_id=18&person_id='.$actors_list_json['results'][$i]['id'].'" class="img"><img src="https://image.tmdb.org/t/p/original/'.$actors_list_json['results'][$i]['profile_path'].'" class="movie_poster" /></a>';
							} else {
								echo '<a href="'.get_site_url().'?page_id=18&person_id='.$actors_list_json['results'][$i]['id'].'" class="img"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 150" width="100" height="150"><rect width="100" height="150" fill="#cccccc"></rect><text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" font-family="monospace" font-size="26px" fill="#333333">Jobsity </text></svg></a>';
							}
				        	echo '<a href="'.get_site_url().'?page_id=18&person_id='.$actors_list_json['results'][$i]['id'].'">'.$actors_list_json['results'][$i]['name'].'</a>';	
				        	echo '<a href="'.get_site_url().'?page_id=18&person_id='.$actors_list_json['results'][$i]['id'].'" class="more">More info about this actor</a>';

				        	echo '</div></div>';

				        	if(($i+1) % 6 == 0){
				        		echo '</div><div class="row">';
				        	}
				        }
						echo '</div>';				        

					    if ($thePage != 1){ 
							$query['actors_page'] = $thePrevPage;
							$query_result = http_build_query($query);
						?>
						<a href="<?php echo $_SERVER['PHP_SELF']; ?>?<?php echo $query_result; ?>" class="lnk-prev">&laquo; Previous Page</a>
						<?php } 

						if ($thePage < $actors_list_json['total_pages']){
							$query['actors_page'] = $theNextPage;
							$query_result = http_build_query($query);
						?>
						<a href="<?php echo $_SERVER['PHP_SELF']; ?>?<?php echo $query_result; ?>" class="lnk-next">Next Page &raquo;</a>
						<?php }


					}
				
				?>
				
						</div>
					</div>				



				
				
				
				

			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>

