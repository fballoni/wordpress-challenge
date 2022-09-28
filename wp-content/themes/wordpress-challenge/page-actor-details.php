<?php /*
Template Name: Actor Details
*/ 
?>

<?php get_header(); ?>

<div class="default-page">
	<div class="container">
		<div class="row">
			<div class="col-md-12">

				
				
				
				<?php


				$person_id = $_GET['person_id'];

				$actor_det = file_get_contents("https://api.themoviedb.org/3/person/".$person_id."?api_key=8c19b69ef99a48c3f8cc582a379e22e4&language=en-US", false, $context);
				$actor_det_json = json_decode($actor_det,true);

				$actor_movies = file_get_contents("https://api.themoviedb.org/3/person/".$person_id."/movie_credits?api_key=8c19b69ef99a48c3f8cc582a379e22e4&language=en-US", false, $context);
				$actor_movies_json = json_decode($actor_movies,true);

				$actor_imgs = file_get_contents("https://api.themoviedb.org/3/person/".$person_id."/images?api_key=8c19b69ef99a48c3f8cc582a379e22e4&language=en-US", false, $context);
				$actor_imgs_json = json_decode($actor_imgs,true);

				?>

				<div class="row">
					<div class="col-md-2">
						<img src="https://image.tmdb.org/t/p/original/<?php echo $actor_det_json['profile_path']; ?>" class="movie_poster2" />
					</div>
					<div class="col-md-10">
						<h1><?php echo $actor_det_json['name']; ?></h1>

						<div class="row">
							<div class="col-md-12">
								<h2>Bio:</h2>
								<p><?php echo $actor_det_json['biography']; ?></p>
							</div>
						</div>




						<div class="row">
							<div class="col-md-2">
								<h2>Popularity:</h2>
								<p><?php echo $actor_det_json['popularity']; ?></p>		
							</div>
							<div class="col-md-2">
								<h2>Birthday:</h2>
								<p><?php echo $actor_det_json['birthday']; ?></p>		
							</div>
							<div class="col-md-2">
								<h2>Place of birth:</h2>
								<p><?php echo $actor_det_json['place_of_birth']; ?></p>
							</div>
							<div class="col-md-2">
								<?php
								if ($actor_det_json['deathday'] != NULL){
									echo '<h2>Day of death:</h2><p>'.$actor_det_json['deathday'].'</p>';
								}
								?>		
							</div>
							<div class="col-md-2">
								<?php
								if ($actor_det_json['homepage'] != NULL){
									echo '<h2>Website:</h2>';
									echo '<a href="'.$actor_det_json['homepage'].'" target="_blank">'.$actor_det_json['homepage'].'</a>';
								}
								?>
							</div>
						</div>
						
						
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h2>Gallery:</h2>
						<div id="slider-gallery">
							<?php for($i=0;$i<10;$i++){ ?>
							<div class="item">
							<?php sleep(1); echo '<img src="https://image.tmdb.org/t/p/original/'.$actor_imgs_json['profiles'][$i]['file_path'].'" class="movie_poster3" />'; ?>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h2>Movies:</h2>

						<div class="row">
						<?php for ($i=0;$i<count($actor_movies_json['cast']);$i++){ ?>

							<div class="col-md-4">
								<div class="movie-item2">
									<div class="row">
										<div class="col-md-4">
										<?php
											if($actor_movies_json['cast'][$i]['poster_path'] != ''){
												echo '<a href="'.get_site_url().'?page_id=20&movie_id='.$actor_movies_json['cast'][$i]['id'].'" class="img"><img src="https://image.tmdb.org/t/p/original/'.$actor_movies_json['cast'][$i]['poster_path'].'" class="movie_poster" /></a>';
											} else {
												echo '<a href="'.get_site_url().'?page_id=20&movie_id='.$actor_movies_json['cast'][$i]['id'].'" class="img"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 150" width="100" height="150"><rect width="100" height="150" fill="#cccccc"></rect><text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" font-family="monospace" font-size="26px" fill="#333333">Jobsity </text></svg></a>';
											}
										?>
										</div>
										<div class="col-md-8">
										<h5>Movie:</h5>
										<?php
											echo '<a href="'.get_site_url().'?page_id=20&movie_id='.$actor_movies_json['cast'][$i]['id'].'" class="tit">'.$actor_movies_json['cast'][$i]['original_title'].'</a>';
											if ($actor_movies_json['cast'][$i]['character']){
												echo '<h5>Character:</h5><p class="character">'.$actor_movies_json['cast'][$i]['character'].'</p>';
											}
										?>
										<?php if ($actor_movies_json['cast'][$i]['release_date']){ ?>
										<h5>Release Date:</h5>
										<?php
											echo '<p>'.$actor_movies_json['cast'][$i]['release_date'].'</p>';
										?>
										<?php } ?>
										</div>
									</div>
								</div>
							</div>
							<?php } ?>
						</div>



					</div>
				</div>

				


				
				
				
				

			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>

