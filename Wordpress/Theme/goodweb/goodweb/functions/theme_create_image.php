	//Basics & WordPress Standards
		$absolute_path = __FILE__;
		$path_to_file = explode( 'wp-content', $absolute_path );
		$path_to_wp = $path_to_file[0];
		require_once( $path_to_wp.'/wp-load.php' );
		require_once( $path_to_wp.'/wp-includes/functions.php');
		add_theme_support( 'custom-header', $args );
		$template_uri = get_template_directory_uri();
		add_theme_support( 'custom-background', $args );
		$url_array = wp_get_attachment_image_src($_POST["imageid"],"full");
		$url = $url_array[0];
		
		$brightness = isset($_POST["brightness"]) ? $_POST["brightness"] : 0;
		$blur = isset($_POST["blur"]) ? $_POST["blur"] : 0;
				
		$upload_info = wp_upload_dir();
		$upload_dir = $upload_info['basedir'];
		$upload_url = $upload_info['baseurl'];
		
		//check if $img_url is local
		if(strpos( $url, $upload_url ) === false) return false;
		
		//define path of image
		$rel_path = str_replace( $upload_url, '', $url);
		$img_path = $upload_dir . $rel_path;
		
		//check if img path exists, and is an image indeed
		if( !file_exists($img_path) OR !getimagesize($img_path) ) return false;
		
		//get image size after cropping
		$dst_w = $url_array[1];
		$dst_h = $url_array[2];
		
		//use this to check if cropped image already exists, so we can return that instead
		$suffix = "{$dst_w}x{$dst_h}";
		$ext = pathinfo($url, PATHINFO_EXTENSION);
		$dst_rel_path = str_replace( '.'.$ext, '', $rel_path);
		$destfilename = "{$upload_dir}{$dst_rel_path}-{$suffix}-effect.{$ext}";
		$desturl = "{$upload_url}{$dst_rel_path}-{$suffix}-effect.{$ext}";
		
		switch ($ext) {
				case "gif":
					$im = imagecreatefromgif($img_path);
					break;
				case "png":
					$im = imagecreatefrompng($img_path);
					break;
				default:
					$im = imagecreatefromjpeg($img_path);
					break;
		}

		//effects
		if($blur>0){
			for($i=0;$i<$blur+1;$i++){
				imagefilter($im, IMG_FILTER_GAUSSIAN_BLUR);
				imagefilter($im, IMG_FILTER_SMOOTH, -4);
				imagefilter($im, IMG_FILTER_GAUSSIAN_BLUR);
			}
		}
		
		if($brightness!=0){
			imagefilter($im, IMG_FILTER_BRIGHTNESS,$brightness);
		}
		
		if(isset($_POST["gray"]) && $_POST["gray"]=="on"){
			imagefilter($im, IMG_FILTER_GRAYSCALE);
		}

		if($im)
		{
		    switch ($ext) {
				case "gif":
					imagegif( $im, $destfilename );
					break;
				case "png":
					imagepng( $im, $destfilename );
					break;
				default:
					imagejpeg( $im, $destfilename );
					break;
			}
		}
		
		imagedestroy($im);