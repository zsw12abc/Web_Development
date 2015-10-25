<?php
add_action( 'wp_dashboard_setup', 'my_dashboard_setup_function' );
function my_dashboard_setup_function() {
    add_meta_box( 'docu_dashboard_widget', 'Goodweb Help', 'docu_dashboard_widget_function', 'dashboard', 'side', 'high' );
}
function docu_dashboard_widget_function() {
    // widget content goes here
    ?>
    <strong>Need help?</strong> Find it in our Online Ressources:
<ul>
	<li><a title="Install" href="http://doc.goodwebtheme.com/#!install" target="_blank">Theme Install</a></li>
	<li><a href="http://goodwebtheme.com/docu#included-plugins" target="_blank">Include Plugins</a></li>
	<li><a href="http://goodwebtheme.com/docu#demo-content" target="_blank">Import Demo Content</a></li>
	<li><a href="http://goodwebtheme.com/docu#customize-settings" target="_blank">Customize the Theme</a></li>
	<li><a href="http://goodwebtheme.com/docu#onepager" target="_blank">Build a OnePager</a></li>
	<li><a href="http://goodwebtheme.com/docu#pages" target="_blank">Pages Overview</a></li>
	<li><a href="http://goodwebtheme.com/docu#blog" target="_blank">How to build a Blog</a></li>
	<li><a href="http://goodwebtheme.com/docu#portfolio" target="_blank">How to build a Portfolio</a></li>
	<li><a href="http://goodwebtheme.com/docu#background-slider" target="_blank">How to build a Background Slider</a></li>
	<li><a href="http://goodwebtheme.com/docu#frontend-builder" target="_blank">Frontend Builder Overview</a></li>
	<li><a href="http://goodwebtheme.com/docu#localization-wording" target="_blank">How to Localize the Theme</a></li>
	<li><a href="http://goodwebtheme.com/docu#localization-wording" target="_blank">How to change the wording</a></li>
</ul>
If that is not helping please contact our Support at <a href="http://<?php echo "themepunch"; ?>.ticksy.com" target="_blank">http://<?php echo "themepunch"; ?>.ticksy.com</a> and do not forget to catch the latest news at <a href="http://www.<?php echo "themepunch"; ?>.com" target="_blank">http://www.<?php echo "themepunch"; ?>.com</a> or <a href="http://www.<?php echo "twitter"; ?>.com/<?php echo "themepunch"; ?>" target="_blank">http://www.<?php echo "twitter"; ?>.com/<?php echo "themepunch"; ?></a>
<?php
}


add_action('admin_menu', 'create_theme_style_page');
function create_theme_style_page() {
  add_theme_page(
    'Documentation',
    'Documentation',
    'administrator',
    'themes.php?goto=doc'
  );
}

add_action('after_setup_theme', 'redirect_from_admin_menu');
function redirect_from_admin_menu($value) {
  global $pagenow;
  if ($pagenow=='themes.php' && !empty($_GET['goto'])) {
    switch ($_GET['goto']) {
      case 'doc':
        wp_redirect("http://doc.goodwebtheme.com");
        break;
      default:
        wp_safe_redirect('/wp-admin/');
        break;
    }
    exit;
  }
}

?>