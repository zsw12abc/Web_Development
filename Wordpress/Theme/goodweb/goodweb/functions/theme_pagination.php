<?php
function pagination($start_end_links = 3, $middle_links = 3)
{
	global $wp_query;		
	// No Pagination if is single
	if(!is_single())	
	{			
		$current = get_query_var('paged') == 0 ? 1 : get_query_var('paged');	// This Page
		$total = $wp_query->max_num_pages;										// All Pages
		$links_left = floor(($middle_links - 1) / 2);							// Left Links
		$links_right = ceil(($middle_links - 1) / 2);							// Right Links
		
		if($total > 1)	
		{				
			echo '<div class="page-navi"><ul>';
			// Run through all Pages
				for($i=1; $i<=$total; $i++)	
				{
					// Current Page
					if($i == $current)
					{
						echo '<li>
						<a href="#" class="current"><span>'.($current).'</span></a>
						</li>
						';
					}
					// The Others
					elseif($i >= ($current - $links_left) && $i <= ($current + $links_right) || $i <= $start_end_links || $i > ($total - $start_end_links))
					{
						echo '<li>
							<a href="'.get_pagenum_link($i).'">'.$i.'</a>
						</li>
						';
					}
					// auszulassene Seiten
					elseif($i == ($start_end_links + 1) && $i < ($current - $links_left + 1) || $i == ($total - $start_end_links) && $i > ($current + $links_right))
					{
						echo '<li>
						<a href="#">...</a>
						</li>
						';
					}
				}
			//Next/Prev Links
				if($current<$total){
					echo '<li>
					<a href="'.get_pagenum_link($current+1).'">'.__("next","goodweb").'</a>
					</li>
					';
					echo '<li>
					<a href="'.get_pagenum_link($total).'">'.__("last","goodweb").'</a>
					</li>
					';
				}
				else{
					echo '<li>
					<a href="'.get_pagenum_link(1).'">'.__("first","goodweb").'</a>
					</li>
					';
					echo '<li>
					<a href="#" class="current">'.__("last","goodweb").'</a>
					</li>
					';
				}
			// The End
			echo '</ul></div>';
		}
	}
}

function spec_pagination($query,$start_end_links = 3, $middle_links = 3)
{
	// No Pagination if is single
	if(!is_single())	
	{			
		$current = get_query_var('paged') == 0 ? 1 : get_query_var('paged');	// This Page
		$total = $query->max_num_pages;											// All Pages
		$links_left = floor(($middle_links - 1) / 2);							// Left Links
		$links_right = ceil(($middle_links - 1) / 2);							// Right Links
		
		if($total > 1)	
		{				
			echo '<div class="page-navi"><ul>';
			// Run through all Pages
				for($i=1; $i<=$total; $i++)	
				{
					// Current Page
					if($i == $current)
					{
						echo '<li>
						<a href="#" class="current"><span>'.($current).'</span></a>
						</li>
						';
					}
					// The Others
					elseif($i >= ($current - $links_left) && $i <= ($current + $links_right) || $i <= $start_end_links || $i > ($total - $start_end_links))
					{
						echo '<li>
							<a href="'.get_pagenum_link($i).'">'.$i.'</a>
						</li>
						';
					}
					// auszulassene Seiten
					elseif($i == ($start_end_links + 1) && $i < ($current - $links_left + 1) || $i == ($total - $start_end_links) && $i > ($current + $links_right))
					{
						echo '<li>
						<a href="#">...</a>
						</li>
						';
					}
				}
			//Next/Prev Links
				if($current<$total){
					echo '<li>
					<a href="'.get_pagenum_link($current+1).'">'.__("next","goodweb").'</a>
					</li>
					';
					echo '<li>
					<a href="'.get_pagenum_link($total).'">'.__("last","goodweb").'</a>
					</li>
					';
				}
				else{
					echo '<li>
					<a href="'.get_pagenum_link(1).'">'.__("first","goodweb").'</a>
					</li>
					';
					echo '<li>
					<a href="#" class="current">'.__("last","goodweb").'</a>
					</li>
					';
				}
			// The End
			echo '</ul></div>';
		}
	}
}

function head_pagination($paged,$posts_per_page)
{
	// No Pagination if is single
	if(!is_single())	
	{			
			$args = array('offset'=> 0, 'paged'=>$paged, 'posts_per_page'=>$posts_per_page);
			$all_posts = new WP_Query($args);	
			
			$total = $all_posts->max_num_pages;											// All Pages
			
			if($total > 1){				 
					echo '<div class="navigation alignright">';
					//Next/Prev Links
					switch($paged){
						case 1:
								echo '<a href="'.get_pagenum_link($total).'" title="'.__("Previous Page","goodweb").'"><i class="icon-left-open-1"></i></a><a href="'.get_pagenum_link($paged+1).'" title="'.__("Next Page","goodweb").'"><i class="icon-right-open-1"></i></a>';
								break;
						case $total:
								echo '<a href="'.get_pagenum_link($paged-1).'" title="'.__("Previous Page","goodweb").'"><i class="icon-left-open-1"></i></a><a href="'.get_pagenum_link(1).'" title="'.__("Next Page","goodweb").'"><i class="icon-right-open-1"></i></a>';
								break;
						default:
								echo '<a href="'.get_pagenum_link($paged-1).'" title="'.__("Previous Page","goodweb").'"><i class="icon-left-open-1"></i></a><a href="'.get_pagenum_link($paged+1).'" title="'.__("Next Page","goodweb").'"><i class="icon-right-open-1"></i></a>';
								break;
					}
					echo '</div>';
			}
	}
	
}

function head_pagination_arch($paged,$posts_per_page)
{
	// No Pagination if is single
	if(!is_single())	
	{			
			global $wp_query;
			$total = $wp_query->max_num_pages;											// All Pages
			
			if($total > 1){				 
					echo '<div class="navigation alignright">';
					//Next/Prev Links
					switch($paged){
						case 1:
								echo '<a href="'.get_pagenum_link($total).'" title="'.__("Previous Page","goodweb").'"><i class="icon-left-open-1"></i></a><a href="'.get_pagenum_link($paged+1).'" title="'.__("Next Page","goodweb").'"><i class="icon-right-open-1"></i></a>';
								break;
						case $total:
								echo '<a href="'.get_pagenum_link($paged-1).'" title="'.__("Previous Page","goodweb").'"><i class="icon-left-open-1"></i></a><a href="'.get_pagenum_link(1).'" title="'.__("Next Page","goodweb").'"><i class="icon-right-open-1"></i></a>';
								break;
						default:
								echo '<a href="'.get_pagenum_link($paged-1).'" title="'.__("Previous Page","goodweb").'"><i class="icon-left-open-1"></i></a><a href="'.get_pagenum_link($paged+1).'" title="'.__("Next Page","goodweb").'"><i class="icon-right-open-1"></i></a>';
								break;
					}
					echo '</div>';
			}
	}
	
}




?>