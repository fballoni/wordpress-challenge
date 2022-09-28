<?php get_header(); ?>

<div class="default-page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <?php
                if ( have_posts() ) : 
                    while ( have_posts() ) : the_post(); ?>
                        <div class="page-content"><?php the_content(); ?></div>
                    <?php
                    endwhile; 
                endif; 
                ?>

                https://api.themoviedb.org/3/movie/upcoming?api_key=8c19b69ef99a48c3f8cc582a379e22e4&language=en-US&page=1


            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>