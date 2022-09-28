<?php
/**
 * Plugin Name: Jobsity Wordpress Challenge - Homepage Content
 * Plugin URI: https://github.com/fballoni/
 * Description: This is the Jobsite Wordpress Challenge plugin!
 * Version: 1.0
 * Author: Fausto Balloni Filho
 * Author URI: https://faustoballoni.com/portfolio/
 * License: A "Slug" license name e.g. GPL2
 */

add_action("the_content", "jobsite_add_content");

function jobsite_add_content(){

    
    if(is_front_page() ){



        $upcoming_movies = file_get_contents("https://api.themoviedb.org/3/movie/upcoming?api_key=8c19b69ef99a48c3f8cc582a379e22e4&language=en-US&page=1", false, $context);
        $upcoming_movies_json = json_decode($upcoming_movies,true);

        $genres = file_get_contents("https://api.themoviedb.org/3/genre/movie/list?api_key=8c19b69ef99a48c3f8cc582a379e22e4&language=en-US", false, $context);
        $genres_json = json_decode($genres,true);

        $popular_actors = file_get_contents("https://api.themoviedb.org/3/person/popular?api_key=8c19b69ef99a48c3f8cc582a379e22e4&language=en-US&page=1", false, $context);
        $popular_actors_json = json_decode($popular_actors,true);

        echo '<div class="container">';
        echo '<div class="row"><div class="col-md-12"><h2 class="centered">Upcoming Movies</h2></div></div>';
        for($i=0;$i<10;$i++){
            if($i==0 || $i==5){
                $o = 'col-md-offset-1';
            } else {
                $o = '';
            }

            if ($i==0 || $i==5){
                echo '<div class="row">';
            }

            
            echo '<div class="col-md-2 '.$o.'">';
            echo '<div class="movie-item">';
            echo '<a href="'.get_site_url().'?page_id=20&movie_id='.$upcoming_movies_json['results'][$i]['id'].'" class="img"><img src="https://image.tmdb.org/t/p/original/'.$upcoming_movies_json['results'][$i]['poster_path'].'" class="movie_poster" /></a>';
            echo '<h3><a href="'.get_site_url().'?page_id=20&movie_id='.$upcoming_movies_json['results'][$i]['id'].'">'.$upcoming_movies_json['results'][$i]['title'].'</a></h3>';
            echo '<div class="date">'.$upcoming_movies_json['results'][$i]['release_date'].'</div>';

            echo '<div class="genres">';
            echo '| ';
            for($j=0;$j<count($upcoming_movies_json['results'][$i]['genre_ids']);$j++){
                

                for($k=1;$k<=count($genres_json['genres']);$k++){
                    if($genres_json['genres'][$k]['id'] == $upcoming_movies_json['results'][$i]['genre_ids'][$j]){
                        echo $genres_json['genres'][$k]['name'].' | ';
                    }
                }
                
            }
            echo '</div>';

            echo '</div>';
            echo '</div>';
            if ($i==4 ||$i==10){
                echo '</div>';
            }

            
        }
       

        
        echo '<div class="row"><div class="col-md-12"><h2 class="centered">Most Popular Actors</h2></div></div>';

        
        for($i=0;$i<10;$i++){
            if($i==0 || $i==5){
                $o = 'col-md-offset-1';
            } else {
                $o = '';
            }
        
            if ($i==0 || $i==5){
                echo '<div class="row">';
            }
            echo '<div class="col-md-2 '.$o.'"><div class="actor-item">';
            echo '<div class="num">'.($i+1).'</div>';
            echo '<a href="'.get_site_url().'?page_id=18&person_id='.$popular_actors_json['results'][$i]['id'].'" class="img"><img src="https://image.tmdb.org/t/p/original/'.$popular_actors_json['results'][$i]['profile_path'].'" class="movie_poster" /></a>';
            echo '<h3><a href="'.get_site_url().'?page_id=18&person_id='.$popular_actors_json['results'][$i]['id'].'">'.$popular_actors_json['results'][$i]['name'].'</a></h3>';
            echo '</div></div>';
            if ($i==4 ||$i==10){
                echo '</div>';
            }
        }
        
        echo '</div>'; 
        echo '</div>'; 
        echo '</div>';
    }
 
}


?>
