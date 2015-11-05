<?php
/*
Template Name: Page: Home
*/
?>
<?php get_header(); ?>
		
        <?php if (is_front_page()) { ?>
        
            <a id="prevslide" class="slideshow-prev load-item"></a>
            <a id="nextslide" class="slideshow-next load-item"></a>
            
            <div class="slideshow-caption round">
                <div id="slidecaption" class="slideshow-caption-container round-bottom">
                
                <br class="clear" />
                </div><!-- slideshow-caption-container -->
            </div><!-- slideshow-caption -->
            
            <div class="slideshow-overlay round"></div><!-- slideshow-overlay -->
        
        <?php } ?>

        <!--<div class="content-home shadow-big-top left">-->
        <div class="content-home left">
            <div class="content-home-container">
            
            	<div class="callouts left">
				
					<?php
                        $query = new WP_Query();
                        $query->query('post_type=callouts&posts_per_page=9999');
                        $post_count = $query->post_count;
                        $itemcount = 1;
            
                        if ($query->have_posts()) { 
                            while ($query->have_posts()) {
                                $query->the_post();
                    ?>
                                
                                <div class="callout-block<?php if($itemcount % 3 === 0) { ?> last<?php } ?> round shadow left">
                                
									<?php if (get_post_meta($post->ID, 'gp_callout_link', true)) { ?>
                                    <h2 class="callout-title">
                                    	<a href="<?php echo get_post_meta($post->ID, 'gp_callout_link', true); ?>">
											<?php the_title(); ?>
										</a>
									</h2><!-- callout-title -->
                                    <?php } else { ?>
                                    <h2 class="callout-title without-link">
										<?php the_title(); ?>
									</h2><!-- callout-title -->
                                    <?php } ?>
                                    
                                    <?php if (has_post_thumbnail()) { ?>
                                    <div class="callout-image">
                                        <div class="callout-image-container image-overlay image left">
                                            <?php if (get_post_meta($post->ID, 'gp_callout_link', true)) { ?>
                                            <a href="<?php echo get_post_meta($post->ID, 'gp_callout_link', true); ?>">
                                                <?php the_post_thumbnail('callout'); ?>
                                                <span><span></span></span>
                                            </a>
                                            <?php } else { ?>
                                                <?php the_post_thumbnail('callout'); ?>
                                            <?php } ?>
                                        </div><!-- callout-image-container -->
                                    </div><!-- callout-image -->
                                    <?php } ?>
                                    
                                    <div class="callout-content round-bottom left">
                                    	<div class="callout-content-container">
                                        
											<?php the_content(); ?>
                                            
                                            <?php if (get_post_meta($post->ID, 'gp_callout_link', true) && get_post_meta($post->ID, 'gp_callout_button', true)) { ?>
                                                <div class="button-standard button">
                                                    <a href="<?php echo get_post_meta($post->ID, 'gp_callout_link', true); ?>">
                                                        <?php echo __(stripslashes(get_post_meta($post->ID, 'gp_callout_button', true))); ?>
                                                    </a>
                                                </div>
                                            <?php } ?>
                                            
                                        <br class="clear" />
                                        </div><!-- callout-content-container -->
                                    </div><!-- callout-content -->
                                    
                                </div><!-- callout-block -->
                                
                                <?php if($itemcount % 3 === 0) { ?><br class="clear" /><?php } ?>
            
                    <?php
                            $itemcount++; 
                            } //while
                        } //if
                    ?>

                </div><!-- callouts -->
                
                <?php
                if (have_posts()) {
                    while (have_posts()) {
                        the_post();
                ?>
                        <?php if (!empty($post->post_content)) { ?>
                        
                        	<div class="content-page-home content-page left">
								<?php the_content(); ?>
                        	</div><!-- content-page-home -->
                        
						<?php } ?>
                
                <?php 
                    } //while
                } //if
                ?>

                <?php if (get_option('gp_homepage_posts') != 'No') { ?>
                
                <div class="list-posts-home list-posts left">
                    
                    <?php
					if (get_option('gp_homepage_posts_number') != '') {
						$posts_number = get_option('gp_homepage_posts_number');	
					} else {
						$posts_number = 3;
					}
					
                    $gp_query= NULL;
                    $gp_query = new WP_Query('posts_per_page='. $posts_number);
					$postcount = 1;
                    
                    if ($gp_query->have_posts()) {
                        while ($gp_query->have_posts()) { 
							$gp_query->the_post(); 
                    ?>
                        
                            <article id="post-<?php the_ID(); ?>" class="post<?php if($postcount % 3 === 0) { ?> last<?php } ?>">
                                
                                <div class="post-info left">
                                    <ul>
                                        <li class="post-date post-info-block"><?php the_time('d/m') ?></li>
                                        <?php if (comments_open()) { ?>
                                            <li class="post-comments post-info-block"><a href="<?php comments_link(); ?>"><?php comments_number(__('0', 'gp'),__('1', 'gp'),__('%', 'gp')); ?></a></li>
                                        <?php } ?>
                                    </ul>
                                </div><!-- post-info -->
                                
                                <div class="post-content left">
                                    <?php if ( has_post_thumbnail() ) { ?>
                                    <div class="post-image image image-overlay shadow left">
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
                                        <?php the_post_thumbnail('post-small'); ?>
                                        <span><span></span></span>
                                        </a>
                                    </div><!-- post-image -->
                                    <?php } ?>
                                    
                                    <header class="post-header">
                                        <h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                                    </header><!-- post-header -->
                                
                                    <div class="post-excerpt">
                                        <?php gp_excerpt(); ?>
                                    </div><!-- post-excerpt -->
                                
                                </div><!-- post-content -->
                                
                            </article><!-- post -->
                            
                            <?php if($postcount % 3 === 0) { ?> <br class="clear" /><?php } ?>
                    
                    <?php
						$postcount++;
                        } //while
                    } //if
                    ?>		
                    <?php wp_reset_query(); ?>
                    
                <br class="clear" />
                </div><!-- list-posts -->
                
                <?php } ?>
        
        	<br class="clear" />          
            </div><!-- content-container -->
        </div><!-- content -->

<?php get_footer(); ?>