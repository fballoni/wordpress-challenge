<?php /*
Template Name: Movies
*/ 
?>

<?php get_header(); ?>

<div class="default-page">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				
				<h1 class="centered">Movies</h1>
				<?php
				if ( have_posts() ) : 
				    while ( have_posts() ) : the_post(); ?>
					    <div class="page-content"><?php the_content(); ?></div>
				    <?php
					endwhile; 
				endif; 
				?>


				
				
				<select id="sort_by" class="movies-search-select">
				<?php

					if($_GET['sort_by']){
						$theOrder = $_GET['sort_by'];
					} else {
						$theOrder = 'asc';
					}

					if($theOrder == 'asc'){
						echo '<option value="asc" selected="selected">Ascending</option>';
						echo '<option value="desc">Descending</option>';
					} else {
						echo '<option value="asc">Ascending</option>';
						echo '<option value="desc" selected="selected">Descending</option>';
					}
				?>
				</select>
				
				

				<select id="year" class="movies-search-select">
					<option value="noYear">Filter by Year</option>

					<?php
					if($_GET['year']){
						$theYear = $_GET['year'];
					} else {
						$theYear = '';
					}

					for ($i=1900;$i<=2022;$i++){
						if($theYear == $i){
							echo '<option value="'.$i.'" selected="selected">'.$i.'</option>';
						} else {
							echo '<option value="'.$i.'">'.$i.'</option>';
						}
					}
					?>
					

					
				</select>

				

				<select id="genres" class="movies-search-select">
					<option value="noGenre">Filter by genre</option>
				<?php

				if($_GET['genre']){
					$theGenre = $_GET['genre'];
				} else {
					$theGenre = '';
				}

				$genres = file_get_contents("https://api.themoviedb.org/3/genre/movie/list?api_key=8c19b69ef99a48c3f8cc582a379e22e4&language=en-US", false, $context);
		        $genres_json = json_decode($genres,true);

		        for($i=0;$i<count($genres_json['genres']);$i++){
		        	$genreID = $genres_json['genres'][$i]['id'];
		        	if($theGenre == $genreID){
		        		echo '<option value="'.$genreID.'" selected="selected">'.$genres_json['genres'][$i]['name'].'</option>';
		        	} else {
		        		echo '<option value="'.$genreID.'">'.$genres_json['genres'][$i]['name'].'</option>';
		        	}

		            
		        }
		        ?>
		        </select>

		
		        <div class="row">
		        	<div class="col-md-12">
			        		
			        		<?php

							$thePage = $_GET['movie_page'];
							if ($thePage == NULL){
								$thePage = 1;
							}

							if ($theYear != ''){
								$movies_list = file_get_contents("https://api.themoviedb.org/3/discover/movie?api_key=8c19b69ef99a48c3f8cc582a379e22e4&include_adult=0&vote_count.gte=1&sort_by=".$theOrder."original_title.asc&page=1&language=en-US&certification=18&sort_by=&certification_country=US&page=".$thePage."&with_genres=".$theGenre."&primary_release_date.gte=".$theYear."-01-01&primary_release_date.lte=".$theYear."-12-31", false, $context);
							} else {
								$movies_list = file_get_contents("https://api.themoviedb.org/3/discover/movie?api_key=8c19b69ef99a48c3f8cc582a379e22e4&include_adult=0&vote_count.gte=1&sort_by=".$theOrder."original_title.asc&page=1&language=en-US&certification=18&sort_by=&certification_country=US&page=".$thePage."&with_genres=".$theGenre, false, $context);
							}
							
					        $movies_list_json = json_decode($movies_list,true);

					        $thePrevPage = $thePage-1;
							$theNextPage = $thePage+1;

							$query = $_GET;
							

					        echo '<div class="row"><div class="col-md-12">';
					        if ($thePage != 1){ ?>
								<?php
									$query['movie_page'] = $thePrevPage;
									$query_result = http_build_query($query);
								?>
								<a href="<?php echo $_SERVER['PHP_SELF']; ?>?<?php echo $query_result; ?>" class="lnk-prev">&laquo; Previous</a>
							<?php }

							if ($thePage < $movies_list_json['total_pages']){ ?>
								<?php
									$query['movie_page'] = $theNextPage;
									$query_result = http_build_query($query);
								?>
								<a href="<?php echo $_SERVER['PHP_SELF']; ?>?<?php echo $query_result; ?>" class="lnk-next">Next &raquo;</a>
							<?php }
					        echo '</div></div>';

					        echo '<div class="row">';
					        for($i=0;$i<count($movies_list_json['results']);$i++){
					        	echo '<div class="col-md-2"><div class="movie-item3">';

					        	if($movies_list_json['results'][$i]['poster_path'] != ''){
									echo '<a href="'.get_site_url().'?page_id=20&movie_id='.$movies_list_json['results'][$i]['id'].'" class="img"><img src="https://image.tmdb.org/t/p/original/'.$movies_list_json['results'][$i]['poster_path'].'" class="movie_poster" /></a>';
								} else {
									echo '<a href="'.get_site_url().'?page_id=20&movie_id='.$movies_list_json['results'][$i]['id'].'" class="img"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 150" width="100" height="150"><rect width="100" height="150" fill="#cccccc"></rect><text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" font-family="monospace" font-size="26px" fill="#333333">Jobsity </text></svg></a>';
								}

								echo '<a href="'.get_site_url().'?page_id=20&movie_id='.$movies_list_json['results'][$i]['id'].'" class="name">'.$movies_list_json['results'][$i]['title'].'</a>';

								echo '<a href="'.get_site_url().'?page_id=20&movie_id='.$movies_list_json['results'][$i]['id'].'" class="more">More info about this movie</a>';

					        	echo '</div></div>';	

					        	if(($i+1) % 6 == 0){
					        		echo '</div><div class="row">';
					        	}

					        }
					        echo '</div>';


							?>
							
							
							
							<?php if ($thePage != 1){ ?>
								<?php
									$query['movie_page'] = $thePrevPage;
									$query_result = http_build_query($query);
								?>
								<a href="<?php echo $_SERVER['PHP_SELF']; ?>?<?php echo $query_result; ?>" class="lnk-prev">&laquo; Previous</a>
							<?php } ?>



							<?php if ($thePage < $movies_list_json['total_pages']){ ?>
								<?php
									$query['movie_page'] = $theNextPage;
									$query_result = http_build_query($query);
								?>
								<a href="<?php echo $_SERVER['PHP_SELF']; ?>?<?php echo $query_result; ?>" class="lnk-next">Next &raquo;</a>
							<?php } ?>
				
						
					</div>
	        	</div>

				
				

				

			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>