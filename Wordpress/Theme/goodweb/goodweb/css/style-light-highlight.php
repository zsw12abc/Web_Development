<?php
header("Content-Type: text/css; charset=utf-8");
	
	/* COLORS */
	if (!isset($_GET["highlight"]) || empty($_GET["highlight"])) {

		$highlightcolor = "#1D77EF";
	} else {

		$highlightcolor = "#".$_GET["highlight"];
	}
?>

.sticky a, .sticky a:visited 	{	color:<?php echo $highlightcolor;?> !important}
a:hover					{	color:<?php echo $highlightcolor;?> !important}
a:hover icon			{	color:<?php echo $highlightcolor;?> !important}
#subfooter a:hover		{	color:<?php echo $highlightcolor;?> !important}
.subfooter-socials:hover		{   color:<?php echo $highlightcolor;?> !important}
.widget_pages ul li a:hover { color:<?php echo $highlightcolor;?> !important}
.widget_pages ul li.current_page_item a { color:<?php echo $highlightcolor;?> !important }
.widget_nav_menu ul li a:hover { color:<?php echo $highlightcolor;?> !important }
.widget_nav_menu ul li.current_page_item a { color:<?php echo $highlightcolor;?> !important }
.tagcloud a:hover {  color: <?php echo $highlightcolor;?> !important; border: 1px solid <?php echo $highlightcolor;?> !important }
menu #navigation ul li:hover >a .menubutton,
menu #navigation ul li.active >a .menubutton		{	color:<?php echo $highlightcolor;?> !important }
menu #navigation ul li.hassubmenu:hover >a:after 	{ 	color:<?php echo $highlightcolor;?> !important }
.single_bluroverlay								{	background-color:<?php echo $highlightcolor;?> !important }
.minibtn, .logged-in-as a, #cancel-comment-reply-link { color: <?php echo $highlightcolor;?> !important; border: 1px solid <?php echo $highlightcolor;?> !important}
.glassbtn input[type="submit"] { color: <?php echo $highlightcolor;?> !important; border: 1px solid <?php echo $highlightcolor;?> !important }
.mediawall-filter:hover,
.mediawall-filter.selected			{	color:<?php echo $highlightcolor;?> !important}
.teamgroup .centeredlist li a:hover		{	color:<?php echo $highlightcolor;?> !important}
#bo-loadmorebutton:hover				{	background:<?php echo $highlightcolor;?> !important}
.blog-author a:hover,
.blog-category a:hover,
.blog-comments:hover,
.bo-comments:hover,
.bo-category a:hover,
.blog-tag a:hover				{	color:<?php echo $highlightcolor;?> !important }
.sb-nav-goodweb .sb-navigation-left:hover i,
.sb-nav-goodweb .sb-navigation-right:hover i	{	color:<?php echo $highlightcolor;?> !important }
.accordion-colored .accordion-heading .accordion-toggle,
.accordion-colored .accordion-heading .accordion-toggle:hover				{ 	color:<?php echo $highlightcolor;?> !important}
.accordion-glas .accordion-heading .accordion-toggle,
.accordion-glas .accordion-heading .accordion-toggle:hover 					{ 	color:<?php echo $highlightcolor;?> !important }
.nav-tabs>li.active>a,
.nav-tabs>li.active>a:hover,
.nav-tabs>li.active>a:visited,
.nav-tabs>li>a:hover		{	color:<?php echo $highlightcolor;?> !important}
.skill-overlay			{	background: <?php echo $highlightcolor;?> !important }
.ptglas.highlight .decoredbutton		{ 	background-color:<?php echo $highlightcolor;?> !important}
.thecomments .comment-details a:hover		{	color: <?php echo $highlightcolor;?> !important}
.thecomments .comment-details .comment-reply-link span	{ color: <?php echo $highlightcolor;?> !important }
.comment-reply-link:hover .icon-forward	{ color: <?php echo $highlightcolor;?> !important }
code							{	background-color:<?php echo $highlightcolor;?>}
#bo-loadmorebutton:hover		{	background:<?php echo $highlightcolor;?> !important}
.skill-overlay					{	background: <?php echo $highlightcolor;?> !important }
.page-navi ul li a:hover { color: '.$highlightcolor.'; border: 1px solid <?php echo $highlightcolor;?> !important}
.page-navi ul li a.current { color: <?php echo $highlightcolor;?> !important; border: 1px solid <?php echo $highlightcolor;?> !important}
.page-navi ul li a.current span { color: <?php echo $highlightcolor;?> !important}
.menuontop menu #navigation >ul >li:hover,
.menuontop menu #navigation >ul >li.active {	 color:<?php echo $highlightcolor;?> !important  }
.menuontop menu #navigation >ul >li.hassubmenu:hover >a:after,
.menuontop menu #navigation >ul >li.hassubmenu.active >a:after			{	color:<?php echo $highlightcolor;?> !important  }
.menuontop menu #navigation >ul >li >a:hover .menubutton,
.menuontop menu #navigation >ul >li:hover >a .menubutton,	
.menuontop menu #navigation >ul >li.active >a .menubutton		{	color:<?php echo $highlightcolor;?> !important}