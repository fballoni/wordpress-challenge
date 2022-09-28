<?php /*
Template Name: Movie Details
*/ 
?>

<?php get_header(); ?>

<div class="default-page">
	<div class="container">
		<div class="row">
			<div class="col-md-12">

				
				
				
				<?php


				$movie_id = $_GET['movie_id'];

				$movie_det = file_get_contents("https://api.themoviedb.org/3/movie/".$movie_id."?api_key=8c19b69ef99a48c3f8cc582a379e22e4&language=en-US", false, $context);
				$movie_det_json = json_decode($movie_det,true);

				$movie_vid = file_get_contents("https://api.themoviedb.org/3/movie/".$movie_id."/videos?api_key=8c19b69ef99a48c3f8cc582a379e22e4&language=en-US", false, $context);
				$movie_vid_json = json_decode($movie_vid,true);

				$movie_tit = file_get_contents("https://api.themoviedb.org/3/movie/".$movie_id."/alternative_titles?api_key=8c19b69ef99a48c3f8cc582a379e22e4&language=en-US", false, $context);
				$movie_tit_json = json_decode($movie_tit,true);

				$movie_cast = file_get_contents("https://api.themoviedb.org/3/movie/".$movie_id."/credits?api_key=8c19b69ef99a48c3f8cc582a379e22e4&language=en-US", false, $context);
				$movie_cast_json = json_decode($movie_cast,true);

				$movie_reviews = file_get_contents("https://api.themoviedb.org/3/movie/".$movie_id."/reviews?api_key=8c19b69ef99a48c3f8cc582a379e22e4&language=en-US", false, $context);
				$movie_reviews_json = json_decode($movie_reviews,true);

				$movie_similar = file_get_contents("https://api.themoviedb.org/3/movie/".$movie_id."/similar?api_key=8c19b69ef99a48c3f8cc582a379e22e4&language=en-US", false, $context);
				$movie_similar_json = json_decode($movie_similar,true);

				?>

				<div class="row">
					
					<?php if ($movie_det_json['poster_path']){ ?>
					<div class="col-md-2"><img src="https://image.tmdb.org/t/p/original/<?php echo $movie_det_json['poster_path']; ?>" class="movie_poster2" /></div>
					<?php } ?>
					
					<div class="col-md-10">
						<h1><?php echo $movie_det_json['title']; ?></h1>
					
						<h2>Overview:</h2>
						<p><?php echo $movie_det_json['overview']; ?></p>
						<div class="row">
							<div class="col-md-4">
								<h2>Release Date:</h2>
								<p><?php echo $movie_det_json['release_date']; ?></p>
							</div>
							<div class="col-md-4">
								<h2>Popularity:</h2>
								<p>
								<?php
									echo $movie_det_json['popularity'];
								?>
								</p>
							</div>
							<div class="col-md-4">
								<h2>Original Language:</h2>
								<p>
								<?php
									echo $movie_det_json['original_language'];
								?>
								</p>
							</div>
						</div>
						
					</div>
				</div>


				<div class="row">
					<?php if ($movie_vid_json['results']){ ?>
					<div class="col-md-6">
						<h2>Trailer:</h2>
						<?php
						for ($i=0;$i<count($movie_vid_json['results']);$i++){
							if ($movie_vid_json['results'][$i]['type'] == "Trailer"){
								echo '<iframe width="560" height="315" src="//www.youtube.com/embed/'.$movie_vid_json['results'][$i]['key'].'" frameborder="0" allowfullscreen></iframe><br />';
								break;
							}
						}
						?>		
					</div>
					<?php } ?>

					<div class="col-md-6">
						<h2>Cast:</h2>
						<div class="row">
						<?php
						for ($i=0;$i<count($movie_cast_json['cast']);$i++){
							if ($movie_cast_json['cast'][$i]['known_for_department'] == "Acting"){
								echo '<div class="col-md-4"><a href="'.get_site_url().'?page_id=18&person_id='.$movie_cast_json['cast'][$i]['id'].'">'.$movie_cast_json['cast'][$i]['name'].'</a></div>';
							}
							
						}
						?>
						
						</div>
						
					</div>
				</div>
				
				<?php if ($movie_reviews_json['results']){ ?>
				<div class="row">
					<div class="col-md-12">
						<h2>Reviews:</h2>
						<?php
						for ($i=0;$i<count($movie_reviews_json['results']);$i++){
							echo '<strong>By: '.$movie_reviews_json['results'][$i]['author'].'</strong><br />';
							echo $movie_reviews_json['results'][$i]['content'].'<br /><br />';
						}
						?>
					</div>
				</div>
				<?php } ?>


				<div class="row">

					<?php if ($movie_det_json['production_companies']){ ?>
					<div class="col-md-4">
						<h2>Production Companies:</h2>
						<?php
							for ($i=0;$i<count($movie_det_json['production_companies']);$i++){
								echo $movie_det_json['production_companies'][$i]['name'].'<br />';
							}
						?>
					</div>
					<?php } ?>

					<?php if ($movie_tit_json['titles']){ ?>
					<div class="col-md-4">
						<h2>Alternative Titles:</h2>
						<?php
						for ($i=0;$i<count($movie_tit_json['titles']);$i++){
							echo $movie_tit_json['titles'][$i]['title'].'<br />';
						}
						?>
					</div>
					<?php } ?>

					<?php if ($movie_similar_json['results']){ ?>
					<div class="col-md-4">
						<h2>Similar Movies:</h2>
						<?php
						for ($i=0;$i<count($movie_similar_json['results']);$i++){
							echo '<a href="'.get_site_url().'?page_id=20&movie_id='.$movie_similar_json['results'][$i]['id'].'">'.$movie_similar_json['results'][$i]['original_title'].'</a><br />';
						}
						?>
					</div>
					<?php } ?>
				</div>
				

				

				
				
				
				

			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>

