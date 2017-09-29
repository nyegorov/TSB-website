<?php
/**
 * The sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>
	<div id="secondary" class="secondary">

		<nav class="main-navigation">
			<div class="menu-main-menu-container">
				<ul class="nav-menu">
				<?php # main menu
				$pages = get_pages( array('sort_column' => 'menu_order'));
				foreach ( $pages as $page ) { ?>
					<li class="menu-item menu-item-post-type menu-item-object-page<?php if(is_page($page->post_title)) echo " current-menu-item" ?>">
					<a href="<?php echo esc_url( get_permalink($page->ID));?>"><?php echo $page->post_title;?></a>
					</li>
					<?php if( is_page($page->post_title) && $page->post_name == 'aktuelles') { ?>
						<ul class="sub-menu toggled-on">
						<?php # Actual projects submenu
						$posts = get_posts( array('orderby' => 'date', 'order' => 'ASC', 'category' => 'project'));
						$prev_year = '';
						$prev_mont  = '';
						foreach ( $posts as $post ) { 
							$year = get_the_date('Y', $post);
							$mont = get_the_date('F', $post);
							if($year != $prev_year) { echo "<li class=\"menu-item\"><a href=\"#post".get_the_ID($post)."\">" . $year . "</a></li><ul class=\"sub-menu toggled-on\">"; $prev_mont = ''; }
							if($mont != $prev_mont) { echo "<li class=\"menu-item\"><a href=\"#post".get_the_ID($post)."\">" . $mont . "</a></li>";}
							$prev_mont = $mont;
							$prev_year = $year;
						}
						if($prev_year != '') echo "</ul>"; ?>
						</ul>
					<?php }?>

					<?php if( is_page($page->post_title) && $page->post_name == 'case-studies') { ?>
						<ul class="sub-menu toggled-on">
						<?php # Case Studies submenu
						$posts = get_posts( array('orderby' => 'date', 'order' => 'ASC', 'category' => 'project'));
						foreach ( $posts as $post ) { ?>
							<li class="menu-item"><a href="<?php echo esc_url(get_permalink($post));?>"><?php echo get_the_title($post);?></a></li>
						<?php }?>
						</ul>
					<?php }?>
				<?php }?>
				</ul>
			</div>
		</nav>

		<?php if ( has_nav_menu( 'primary' ) ) : ?>
			<nav id="site-navigation" class="main-navigation" role="navigation">
				<?php
					// Primary navigation menu.
					wp_nav_menu( array(
						'menu_class'     => 'nav-menu',
						'theme_location' => 'primary',
					) );
				?>
			</nav><!-- .main-navigation -->
		<?php endif; ?>

		<?php if ( has_nav_menu( 'social' ) ) : ?>
			<nav id="social-navigation" class="social-navigation" role="navigation">
				<?php
					// Social links navigation menu.
					wp_nav_menu( array(
						'theme_location' => 'social',
						'depth'          => 1,
						'link_before'    => '<span class="screen-reader-text">',
						'link_after'     => '</span>',
					) );
				?>
			</nav><!-- .social-navigation -->
		<?php endif; ?>

		<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
			<div id="widget-area" class="widget-area" role="complementary">
				<?php dynamic_sidebar( 'sidebar-1' ); ?>
			</div><!-- .widget-area -->
		<?php endif; ?>

	</div><!-- .secondary -->
