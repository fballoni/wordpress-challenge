<?php get_header(); ?>

<div class="default-page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
<?php
$the_query=get_search_query();
$the_query = str_replace(" ","%20",$the_query);

$movie_search = file_get_contents('https://api.themoviedb.org/3/search/movie?api_key=8c19b69ef99a48c3f8cc582a379e22e4&language=en-US&query='.$the_query.'&page=1&include_adult=false', false, $context);
$movie_search_json = json_decode($movie_search,true);

$actors_search = file_get_contents('https://api.themoviedb.org/3/search/person?api_key=8c19b69ef99a48c3f8cc582a379e22e4&language=en-US&query='.$the_query.'&page=1&include_adult=false', false, $context);
$actors_search_json = json_decode($actors_search,true);

                        
if ($actors_search_json['results']){

    echo '<div class="row"><div class="col-md-12"><h2>Actors Search Results:</h2></div></div>';

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

   
}


if ($movie_search_json['results']){
    
    echo '<div class="row"><div class="col-md-12"><h2>Movies Search Results:</h2></div></div>';
    echo '<div class="row">';
    for($i=0;$i<count($movie_search_json['results']);$i++){
        
        echo '<div class="col-md-2"><div class="movie-item3">';

        if($movie_search_json['results'][$i]['poster_path'] != ''){
            echo '<a href="'.get_site_url().'?page_id=18&person_id='.$movie_search_json['results'][$i]['id'].'" class="img"><img src="https://image.tmdb.org/t/p/original/'.$movie_search_json['results'][$i]['poster_path'].'" class="movie_poster" /></a>';
        } else {
            echo '<a href="'.get_site_url().'?page_id=18&person_id='.$movie_search_json['results'][$i]['id'].'" class="img"><svg class="movie_poster" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 150" width="100" height="150"><rect width="100" height="150" fill="#cccccc"></rect><text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" font-family="monospace" font-size="26px" fill="#333333">Jobsity </text></svg></a>';
        }
        echo '<a href="'.get_site_url().'?page_id=18&person_id='.$movie_search_json['results'][$i]['id'].'" class="name">'.$movie_search_json['results'][$i]['original_title'].'</a>';   
        echo '<a href="'.get_site_url().'?page_id=18&person_id='.$movie_search_json['results'][$i]['id'].'" class="more">More info about this movie</a>';

        echo '</div></div>';

        if(($i+1) % 6 == 0){
            echo '</div><div class="row">';
        }
    }
    echo '</div>';

}                     

                       


?>








                
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>

