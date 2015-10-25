  

<header>
    <div id="top" class="container">
      <div class="row">
        <nav class="col-md-12">
          <div class="col-md-3 logo-content">
           						<?php 
						if (ot_get_option( 'minime_logo' )) { ?>
                        <a title="<?php bloginfo('name'); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo ot_get_option( 'minime_logo' ); ?>" alt="<?php bloginfo('name'); ?>" /></a>
                        <?php } else { ?>
                        <a class="klb-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php echo ot_get_option( 'minime_logotext' ); ?></a>
                        <?php } ?>
          </div>
          <div class="mini-menu"><i class="fa fa-bars"></i></div>
			               <?php 
                wp_nav_menu(array(
                  'theme_location' => 'main-menu',
                  'container' => '',
                  'fallback_cb' => 'show_top_menu',
                  'menu_class' => 'col-md-9 menu',
                  'menu_id' => '',
                  'echo' => true,
                  'walker' => new description_walker(),
                  'depth' => 0 
                )); 
              ?>
        </nav>
      </div>
    </div>
  </header>