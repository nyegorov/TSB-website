<?php
/**
 * The sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage TSB
 * @since TSB 1.0
 */
?>
	<div id="hamburger" class="hamburger" onclick="showmenu(true)">
		<img id="menu_icon" src="<?php echo get_stylesheet_directory_uri();?>/icons/menu.svg"/>
	</div>

	<div id="secondary" class="secondary">

		<div id="hamb_close" class="hamb_close" onclick="showmenu(false)">
			<img src="<?php echo get_stylesheet_directory_uri();?>/icons/menu_close.svg"/>
		</div>

		<nav class="main-navigation">
			<div class="menu-main-menu-container">
				<ul class="nav-menu">
				<?php # main menu
				$cats = get_the_category($post->ID);
				$cat = empty($cats) ? '' : $cats[0]->slug;
				$activepost = $post->post_name;
				$front_page_id = get_option( 'page_on_front' );
				$pages = get_pages( array('sort_column' => 'menu_order'));
				foreach ( $pages as $page ) { 
					if($page->post_parent != '')	continue;


					$permalink = get_permalink($page->ID);
					#if($page->ID == $front_page_id) $permalink = _get_page_link( $front_page_id ); 
					$is_case_study = ($cat == 'case-study' && $page->post_name == 'case-studies'); 
					$is_active_page = is_page($page->post_title);?>
					<li class="menu-item<?php if(is_page($page->post_title) || $is_case_study) echo " current-menu-item" ?>">
					
					<?php if($is_active_page) { 
						echo '<span>' . $page->post_title . '</span>';
					} else { 
						echo '<a class="sliding" href="' . esc_url($permalink) . '">' . $page->post_title . '</a>';
					} ?>
					</li>
					<?php if( is_page($page->post_title) && $page->post_name == 'aktuelles') { ?>
						<ul class="sub-menu toggled-on" id="calendar-menu">
						<?php # Actual projects submenu
						$posts = get_posts( array('orderby' => 'date', 'order' => 'ASC', 'category_name' => 'actual'));
						$prev_year = '';
						$prev_mont  = '';
						foreach ( $posts as $post ) { 
							$year = get_the_date('Y', $post);
							$mont = get_the_date('F', $post);
							if($year != $prev_year) { 
								if($prev_year != '') echo "</ul>"; 
								echo '<li class="menu-item dropdown-toggle"><a class="sliding">' . $year . '</a></li><ul class="sub-menu';
								if($year == date("Y")) echo ' toggled-on';
								echo '">'; 
								$prev_mont = ''; 
							}
							if($mont != $prev_mont) { echo '<li class="menu-item"><a class="sliding" href="#post'.get_the_ID($post).'">' . $mont . '</a></li>';}
							$prev_mont = $mont;
							$prev_year = $year;
						}
						if($prev_year != '') echo "</ul>"; ?>
						</ul>
					<?php }?>

					<?php if((is_page($page->post_title) && $page->post_name == 'case-studies') || $is_case_study) { ?>
						<ul class="sub-menu toggled-on" id="case-menu">
						<?php # Case Studies submenu
    					$my_query = new WP_Query(array('category_name' => 'case-study'));
						if ( $my_query->have_posts() ) { 
							while ( $my_query->have_posts() ) { $my_query->the_post(); ?>
								<li class="menu-item<?php if($post->post_name == $activepost) echo " current-menu-item" ?>">
								<a class="sliding" id="post<?php the_ID(); ?>" href="<?php echo esc_url(get_permalink($post));?>"><?php echo get_the_title($post);?>
								</a></li>
						<?php }
						}
						wp_reset_postdata(); ?>
						</ul>
					<?php }?>
				<?php }?>

				</ul>
			</div>

		</nav>

		<div class="menu-footer<?php if(is_page($page->post_title)) echo "-active"?>">
			<a href="<?php echo get_page_link(get_page_by_title('Impressum')->ID) ?>">Impressum</a>
		</div>

	</div><!-- .secondary -->
