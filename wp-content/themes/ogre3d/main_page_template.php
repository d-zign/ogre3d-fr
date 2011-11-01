<?php
/*
Template Name: Ogre3D Main Page
*/
?>

<?php get_header(); ?>


<div id="container">

    <div id="banner">
        <div class="centered">
            <div id="content_header">
                <div class="left">
                    <?php if (have_posts()) : while (have_posts()) : the_post();?>
                        <?php the_content(); ?>
                    <?php endwhile; endif; ?>
                    <a id="download-button" href="http://www.ogre3d.org/download/" title="Télécharger OGRE"><span>Télécharger</span></a>
                </div>
                <div class="right">
                    <div id="home-screenshots">
                        <?php echo nggShowGallery(1, 'home', 6); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="centered">

    <div id="main_page_content" role="main">

        <div id="latest-news">
            <?php
            if (is_page())
            {
                $cat = 'news';
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $post_per_page = 4; // -1 shows all posts
                $do_not_show_stickies = 1; // 0 to show stickies
                $args = array(
                    'category_in' => array($cat),
                    'orderby' => 'date',
                    'order' => 'DESC',
                    'paged' => $paged,
                    'posts_per_page' => $post_per_page,
                    'caller_get_posts' => $do_not_show_stickies
                );
                $temp = $wp_query;  // assign orginal query to temp variable for later use   
                $wp_query = null;
                $wp_query = new WP_Query($args); 
                if ( have_posts() ) : 
                    ?>
                    <h2>Dernières actus</h2>
                    <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

                        <div class="entry<?php if ($wp_query->current_post < $wp_query->post_count - 1) : ?> not-last-entry<?php endif; ?>" id="post-<?php the_ID(); ?>">
                            <?php echo $current_post; ?>
                            <h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
                            <div class="entry-meta">
		                        <?php
                                printf(__('<time class="entry-date" datetime="%1$s" pubdate>%2$s</time>', 'twentyeleven'),
                                       esc_attr(get_the_date('c')),
                                       esc_html(get_the_date()));
                                ?>
	                        </div><!-- .entry-meta -->
                            <?php 
                                the_excerpt();
                            ?>
                        </div>
                    <?php endwhile; ?>

                <?php else : ?>

                    <p class="no-content-msg">Aucune actualité.</p>
                <?php endif; ?>
                <?php
                $wp_query = $temp;  //reset back to original query

            }  // if ($category)
            ?>
        </div><!-- #latest-news -->

        <div id="latest-topics">

        <?php
				$title        = apply_filters( 'bbp_topic_widget_title', $instance['title'] );
		$max_shown    = !empty( $instance['max_shown']    ) ? (int) $instance['max_shown'] : 5;
		$show_date    = !empty( $instance['show_date']    ) ? 'on'                         : false;
		$parent_forum = !empty( $instance['parent_forum'] ) ? $instance['parent_forum']    : 'any';
		$pop_check    = ( $instance['pop_check'] < $max_shown || empty( $instance['pop_check'] ) ) ? -1 : $instance['pop_check'];

		// Query defaults
		$topics_query = array(
			'author'         => 0,
			'post_parent'    => $parent_forum,
			'posts_per_page' => $max_shown > $pop_check ? $max_shown : $pop_check,
			'posts_per_page' => $max_shown,
			'show_stickies'  => false,
			'order'          => 'DESC',
		);

		bbp_set_query_name( 'bbp_widget' );

		// Topics exist
        ?>
        <h2>Derniers sujets</h2>

        <?php
		if ( bbp_has_topics( $topics_query ) ) : 
        ?>
            
	    <?php
			// Sort by time
			if ( $pop_check < $max_shown ) :

				echo $before_widget;
				echo $before_title . $title . $after_title; ?>

				<?php while ( bbp_topics() ) : bbp_the_topic(); ?>

                <div>
                    <h3><a class="bbp-forum-title" href="<?php bbp_topic_permalink(); ?>" title="<?php bbp_topic_title(); ?>"><?php bbp_topic_title(); ?></a></h3>
                    <!--<div class="entry-meta entry-date"><?php _e( 'Il y a ' . bbp_get_topic_last_active_time()); ?></div>
                    <?php 
                        $content = bbp_get_topic_content();

                        if (strlen($content) > 150)
                            $content = substr($content, 0, 150) . '[...]';
                        echo $content;
                    ?>-->
                </div>
				<?php endwhile; ?>

				<?php echo $after_widget;
            endif;
		
        else :
        ?>

        <p class="no-content-msg">Aucun sujet.</p>

        <?php
		endif;

		bbp_reset_query_name(); ?>

		</div><!-- #latest-topics -->

    </div><!-- #content -->

    

<?php get_footer(); ?>
