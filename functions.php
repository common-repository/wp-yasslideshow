<?php

function dazake_yass_load_script() {
	if (!is_admin()) {
		wp_register_script('jquery', plugins_url().'/wp-yasslideshow/mobile/jquery-1.7.1.min.js');
		wp_register_script('flexslider', plugins_url().'/wp-yasslideshow/mobile/flexslider/jquery.flexslider.js');
		wp_register_script('royalslider', plugins_url().'/wp-yasslideshow/mobile/jquery.royalslider.min.js');
		wp_register_script('mobile', plugins_url().'/wp-yasslideshow/mobile/mobile.js');

		/**
		 * Laddar skripten vi registrerat ovan.
		 */
		wp_enqueue_script('jquery');
		wp_enqueue_script('flexslider');
		wp_enqueue_script('royalslider');
		wp_enqueue_script('mobile');

		/**
		 * load stylesheet
		 */
		wp_enqueue_style( 'royalslider', plugins_url().'/wp-yasslideshow/mobile/royalslider.css' );
		wp_enqueue_style( 'mobile', plugins_url().'/wp-yasslideshow/mobile/mobile.css' );
		wp_enqueue_style( 'flexslider', plugins_url().'/wp-yasslideshow/mobile/flexslider/flexslider.css' );
	}
}

if(strstr($_SERVER['HTTP_USER_AGENT'],"iPad") || strstr($_SERVER['HTTP_USER_AGENT'],"iPhone")) {
	add_action('init', 'dazake_yass_load_script');
}

function yass_get_def_settings()
{
	$yass_settings = array('slideshow_width' => '550',
	'slideshow_height' => '300',
	'bgcolor' => 'FFFFFF',
	'border_size' => '6',
	'border_color' => '000000',
	'arrow_color' => 'FFFF00',
	'arrow_alpha' => '0.8',
	'transition_speed' => '1000',
	'auto_slide' => 'true',
	'autoslide_time' => '10',
	'show_desc' => 'true',
	'desc_position' => 'left',
	'desc_bgcolor' => 'FFFFFF',
	'desccolor_alpha' => '0.5',
	'desc_color' => '000000',
	'desc_size' => '18',
	'animation_type' => 'top',
	'transition_type' => 'easeOutBounce',
	'pagbar_style' => 'compact',
	'pagbar_bgcolor' => '000000',
	'pagbar_fgcolor' => 'FFFFFF',
	'pagbar_hilitecolor' => 'CCCCCC',
	'pagbar_hiliteTextcolor' => '000000',
	'pagbar_bgmouseovercolor' => 'FFFFFF',
	'pagbar_fgmouseovercolor' => '000000',
	'pagbar_alpha' => '1',
	'picture_scalling' => 'true',
	'target' => '_self',
	'wmode' => 'transparent'		
			);
	return $yass_settings;
}
function __get_yass_xml_settings()
{
	$ops = get_option('yass_settings', array());
	$xml_settings = '<border size="'.$ops['border_size'].'">'.$ops['border_color'].'</border>
	<slider width="'.$ops['slideshow_width'].'" height="'.$ops['slideshow_height'].'" bgColor="'.$ops['bgcolor'].'" target="'.$ops['target'].'" scalling="'.$ops['picture_scalling'].'" desc_pos="'.$ops['desc_position'].'">test</slider>
	<arrow>'.$ops['arrow_color'].'</arrow>
	<arrow_alpha>'.$ops['arrow_alpha'].'</arrow_alpha>
	<transition_speed>'.$ops['transition_speed'].'</transition_speed>

	<auto_slide on="'.$ops['auto_slide'].'">'.$ops['autoslide_time'].'</auto_slide>
	<description on="'.$ops['show_desc'].'">
		
		<background>'.$ops['desc_bgcolor'].'</background>
		<alpha>'.$ops['desccolor_alpha'].'</alpha>
		<text>'.$ops['desc_color'].'</text>
		<size>'.$ops['desc_size'].'</size>

	</description>
	<transition>'.$ops['animation_type'].'</transition>
	<transition_type>'.$ops['transition_type'].'</transition_type>
	
	<tooltip_text_color>0x'.$ops['tooltip_text_color'].'</tooltip_text_color>
	<tooltip_text_alpha>'.$ops['tooltip_text_alpha'].'</tooltip_text_alpha>
	<tooltip_base_color>0x'.$ops['tooltip_base_color'].'</tooltip_base_color>

	<tooltip_base_alpha>'.$ops['tooltip_base_alpha'].'</tooltip_base_alpha>

	<navbar style="'.$ops['pagbar_style'].'">
		<background>'.$ops['pagbar_bgcolor'].'</background>
		<foreground>'.$ops['pagbar_fgcolor'].'</foreground>
		<highlight>'.$ops['pagbar_hilitecolor'].'</highlight>
		<highlight_text>'.$ops['pagbar_hiliteTextcolor'].'</highlight_text>

		<bg_mouseover>'.$ops['pagbar_bgmouseovercolor'].'</bg_mouseover>
		<fg_mouseover>'.$ops['pagbar_fgmouseovercolor'].'</fg_mouseover>
		<alpha>'.$ops['pagbar_alpha'].'</alpha>
	</navbar>';
	return $xml_settings;
}
function yass_get_album_dir($album_id)
{
	global $gyass;
	$album_dir = YSS_PLUGIN_UPLOADS_DIR . "/{$album_id}_uploadfolder";
	return $album_dir;
}
/**
 * Get album url
 * @param $album_id
 * @return unknown_type
 */
function yass_get_album_url($album_id)
{
	global $gyass;
	$album_url = YSS_PLUGIN_UPLOADS_URL . "/{$album_id}_uploadfolder";
	return $album_url;
}
function yass_get_table_actions(array $tasks)
{
	?>
	<div class="bulk_actions">
		<form action="" method="post" class="bulk_form">Bulk action
			<select name="task">
				<?php foreach($tasks as $t => $label): ?>
				<option value="<?php print $t; ?>"><?php print $label; ?></option>
				<?php endforeach; ?>
			</select>
			<button class="button-secondary do_bulk_actions" type="submit">Do</button>
		</form>
	</div>
	<?php 
}
function shortcode_display_yass_gallery($atts)
{
	$vars = shortcode_atts( array(
									'cats' => '',
									'imgs' => '',
								), 
							$atts );
	//extract( $vars );
	
	$ret = display_yass_gallery($vars);
	return $ret;
}
function display_yass_gallery($vars)
{
	global $wpdb, $gyass;
	$ops = get_option('yass_settings', array());
	//print_r($ops);
	$albums = null;
	$images = null;
	$cids = trim($vars['cats']);
	if (strlen($cids) != strspn($cids, "0123456789,")) {
		$cids = '';
		$vars['cats'] = '';
	}
	$imgs = trim($vars['imgs']);
	if (strlen($imgs) != strspn($imgs, "0123456789,")) {
		$imgs = '';
		$vars['imgs'] = '';
	}
	$categories = '';
	$xml_filename = '';
	if( !empty($cids) && $cids{strlen($cids)-1} == ',')
	{
		$cids = substr($cids, 0, -1);
	}
	if( !empty($imgs) && $imgs{strlen($imgs)-1} == ',')
	{
		$imgs = substr($imgs, 0, -1);
	}
	//check for xml file
	if( !empty($vars['cats']) )
	{
		$xml_filename = "cat_".str_replace(',', '', $cids) . '.xml';	
	}
	elseif( !empty($vars['imgs']))
	{
		$xml_filename = "image_".str_replace(',', '', $imgs) . '.xml';
	}
	else
	{
		$xml_filename = "yass_all.xml";
	}
	//die(YSS_PLUGIN_XML_DIR . '/' . $xml_filename);

	$imageContainer = "";
	
	if( !empty($vars['cats']) )
	{
		$query = "SELECT * FROM {$wpdb->prefix}yass_albums WHERE album_id IN($cids) AND status = 1 ORDER BY `order` ASC";
		//print $query;
		$albums = $wpdb->get_results($query, ARRAY_A);
		foreach($albums as $key => $album)
		{
			$images = $gyass->yass_get_album_images($album['album_id']);
			if ($images && !empty($images) && is_array($images)) {
				$album_dir = yass_get_album_url($album['album_id']);//YSS_PLUGIN_UPLOADS_URL . '/' . $album['album_id']."_".$album['name'];
				foreach($images as $key => $img)
				{
					if( $img['status'] == 0 ) continue;
					
					$imageContainer .= "<picture src=\"".str_replace(" ","-",$album_dir)."/big/{$img['image']}\" scale=\"".($ops['picture_scalling'])."\"><link target=\"".$ops['target']."\">{$img['link']}</link> <description  align=\"".$ops['desc_position']."\" >".($ops['show_desc']=='no'||$img['description']==""?"":$img['description'])."</description><download_file></download_file><download_tooltip>".$ops['DownloadTooltipTxt']."</download_tooltip></picture>";

				}
			}
		}
		//$xml_filename = "cat_".str_replace(',', '', $cids) . '.xml';
	}
	elseif( !empty($vars['imgs']))
	{
		$query = "SELECT * FROM {$wpdb->prefix}yass_images WHERE image_id IN($imgs) AND status = 1 ORDER BY `order` ASC";
		$images = $wpdb->get_results($query, ARRAY_A);
		if ($images && !empty($images) && is_array($images)) {
			foreach($images as $key => $img)
			{
				$album = $gyass->yass_get_album($img['category_id']);
				$album_dir = yass_get_album_url($album['album_id']);//YSS_PLUGIN_UPLOADS_URL . '/' . $album['album_id']."_".$album['name'];
				if( $img['status'] == 0 ) continue;
				
				$imageContainer .= "<picture src=\"".str_replace(" ","-",$album_dir)."/big/{$img['image']}\" scale=\"".($ops['picture_scalling'])."\"><link target=\"".$ops['target']."\">{$img['link']}</link> <description  align=\"".$ops['desc_position']."\" >".($ops['show_desc']=='no'||$img['description']==""?"":$img['description'])."</description><download_file></download_file><download_tooltip>".$ops['DownloadTooltipTxt']."</download_tooltip></picture>";

			}
		}
	}
	//no values paremeters setted
	else//( empty($vars['cats']) && empty($vars['imgs']))
	{
		$query = "SELECT * FROM {$wpdb->prefix}yass_albums WHERE status = 1 ORDER BY `order` ASC";
		$albums = $wpdb->get_results($query, ARRAY_A);
		foreach($albums as $key => $album)
		{
			$images = $gyass->yass_get_album_images($album['album_id']);
			$album_dir = yass_get_album_url($album['album_id']);//YSS_PLUGIN_UPLOADS_URL . '/' . $album['album_id']."_".$album['name'];
			if ($images && !empty($images) && is_array($images)) {
				foreach($images as $key => $img)
				{
					if($img['status'] == 0 ) continue;
					
					$imageContainer .= "<picture src=\"".str_replace(" ","-",$album_dir)."/big/{$img['image']}\" scale=\"".($ops['picture_scalling'])."\"><link target=\"".$ops['target']."\">{$img['link']}</link> <description  align=\"".$ops['desc_position']."\" >".($ops['show_desc']=='no'||$img['description']==""?"":$img['description'])."</description><download_file></download_file><download_tooltip>".$ops['DownloadTooltipTxt']."</download_tooltip></picture>";

				}
			}
		}
		//$xml_filename = "yass_all.xml";
	}
	
	$xml_tpl = __get_yass_xml_template();
	$settings = __get_yass_xml_settings();
//	$xml = str_replace(array('{settings}', '{default_category}', '{categories}'), 
//						array($settings, $album['album_id'], $categories), $xml_tpl);
	$xml = str_replace(array('{settings}', '{image_container}'), 
						array($settings, $imageContainer), $xml_tpl);
						
	//write new xml file
	$fh = fopen(YSS_PLUGIN_XML_DIR . '/' . $xml_filename, 'w+');
	fwrite($fh, $xml);
	fclose($fh);
	//print "<h3>Generated filename: $xml_filename</h3>";
	//print $xml;
	if( file_exists(YSS_PLUGIN_XML_DIR . '/' . $xml_filename ) )
	{
		$fh = fopen(YSS_PLUGIN_XML_DIR . '/' . $xml_filename, 'r');
		$xml = fread($fh, filesize(YSS_PLUGIN_XML_DIR . '/' . $xml_filename));
		fclose($fh);
		//print "<h3>Getting xml file from cache: $xml_filename</h3>";
		$ret_str = "
		<script language=\"javascript\">AC_FL_RunContent = 0;</script>
<script src=\"".YSS_PLUGIN_URL."/js/AC_RunActiveContent.js\" language=\"javascript\"></script>

		<script language=\"javascript\"> 
	if (AC_FL_RunContent == 0) {
		alert(\"This page requires AC_RunActiveContent.js.\");
	} else {
		AC_FL_RunContent(
			'codebase', 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0',
			'width', '".$ops['slideshow_width']."',
			'height', '".$ops['slideshow_height']."',
			'src', '".YSS_PLUGIN_URL."/js/wp_yassslideshow',
			'quality', 'high',
			'pluginspage', 'http://www.macromedia.com/go/getflashplayer',
			'align', 'middle',
			'play', 'true',
			'loop', 'true',
			'scale', 'showall',
			'wmode', '".$ops['wmode']."',
			'devicefont', 'false',
			'id', 'xmlswf_vmyass',
			'bgcolor', '".$ops['bgcolor']."',
			'name', 'xmlswf_vmyass',
			'menu', 'true',
			'allowFullScreen', 'true',
			'allowScriptAccess','sameDomain',
			'movie', '".YSS_PLUGIN_URL."/js/wp_YASS',
			'salign', '',
			'flashVars','dataFile=".YSS_PLUGIN_URL."/xml/$xml_filename'
			); //end AC code
	}
</script>
";
//echo YSS_PLUGIN_UPLOADS_URL."<hr>";
//		print $xml;
		return $ret_str;
	}
	return true;
}
function __get_yass_xml_template()
{
	$xml_tpl = '<?xml version="1.0" encoding="utf-8" ?>
				<slideshow>
					<settings>{settings}</settings>
					<!-- end settings -->
					<pictures>{image_container}					    
					</pictures><!-- end images -->
				</slideshow>';
	return $xml_tpl;
}
?>