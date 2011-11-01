<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>
    
            </div><!-- #content -->
        </div><!-- #container -->

        <div class="clear">&nbsp;</div>
    
    </div><!-- #page -->
    <div id="footer" role="contentinfo">
        <div class="centered">
		    <?php
			    /* A sidebar in the footer? Yep. You can can customize
			     * your footer with three columns of widgets.
			     */
			    get_sidebar( 'footer' );
		    ?>

		    <!--<div id="site-generator">
			    <?php do_action( 'twentyeleven_credits' ); ?>
			    <a href="<?php echo esc_url( __( 'http://wordpress.org/', 'twentyeleven' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'twentyeleven' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'twentyeleven' ), 'WordPress' ); ?></a>
		    </div>-->
        </div><!-- .centered -->
    </div><!-- #footer -->

<?php wp_footer(); ?>
</div><!-- #global -->
</body>
</html>
