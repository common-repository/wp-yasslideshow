<?php
global $wpdb, $gyass;
$ops = get_option('yass_settings', array());
//$ops = array_merge($yass_settings, $ops);
?>
<div class="wrap">
	<h2><?php _e('Create XML File'); ?></h2>
	<form action="" method="post">
		<input type="hidden" name="task" value="save_yass_settings" />
		<table>
		<tr>
			<td><?php _e('Slideshow Width (px)'); ?></td>
			<td><input type="text" name="settings[slideshow_width]" value="<?php print  @$ops['slideshow_width']; ?>" /></td>
		</tr>

		<tr>
			<td><?php _e('Slideshow Height (px)'); ?></td>
			<td><input type="text" name="settings[slideshow_height]" value="<?php print  @$ops['slideshow_height']; ?>" /></td>
		</tr>

		<tr>
			<td><?php _e('Background Color'); ?></td>
			<td><input type="text" name="settings[bgcolor]" class="color {hash:false,caps:false}"  value="<?php print  @$ops['bgcolor']; ?>" /></td>
		</tr>

		<tr>
			<td><?php _e('Slideshow Border Size'); ?></td>
			<td><input type="text" name="settings[border_size]" value="<?php print  @$ops['border_size']; ?>" /></td>
		</tr>

		<tr>
			<td><?php _e('Slideshow Border Color'); ?></td>
			<td><input type="text" name="settings[border_color]" class="color {hash:false,caps:false}"  value="<?php print  @$ops['border_color']; ?>" /></td>
		</tr>

		<tr>
			<td><?php _e('Navugation Arrow Color'); ?></td>
			<td><input type="text" name="settings[arrow_color]" class="color {hash:false,caps:false}"  value="<?php print  @$ops['arrow_color']; ?>" /></td>
		</tr>

		<tr>
			<td><?php _e('Arrow Color Alpha'); ?></td>
			<td>
				<select name="settings[arrow_alpha]">
					<option value="0" <?php print (@$ops['arrow_alpha'] == '0') ? 'selected' : ''; ?>><?php _e('0');?></option>

					<option value="0.1" <?php print (@$ops['arrow_alpha'] == '0.1') ? 'selected' : ''; ?>><?php _e('0.1');?></option>

					<option value="0.2" <?php print (@$ops['arrow_alpha'] == '0.2') ? 'selected' : ''; ?>><?php _e('0.2');?></option>

					<option value="0.3" <?php print (@$ops['arrow_alpha'] == '0.3') ? 'selected' : ''; ?>><?php _e('0.3');?></option>

					<option value="0.4" <?php print (@$ops['arrow_alpha'] == '0.4') ? 'selected' : ''; ?>><?php _e('0.4');?></option>

					<option value="0.5" <?php print (@$ops['arrow_alpha'] == '0.5') ? 'selected' : ''; ?>><?php _e('0.5');?></option>

					<option value="0.6" <?php print (@$ops['arrow_alpha'] == '0.6') ? 'selected' : ''; ?>><?php _e('0.6');?></option>

					<option value="0.7" <?php print (@$ops['arrow_alpha'] == '0.7') ? 'selected' : ''; ?>><?php _e('0.7');?></option>

					<option value="0.8" <?php print (@$ops['arrow_alpha'] == '0.8') ? 'selected' : ''; ?>><?php _e('0.8');?></option>

					<option value="0.9" <?php print (@$ops['arrow_alpha'] == '0.9') ? 'selected' : ''; ?>><?php _e('0.9');?></option>

					<option value="1" <?php print (@$ops['arrow_alpha'] == '1') ? 'selected' : ''; ?>><?php _e('1');?></option>

				</select>
			</td>
		</tr>

		<tr>
			<td><?php _e('Slideshow Transition Speed'); ?></td>
			<td><input type="text" name="settings[transition_speed]" value="<?php print  @$ops['transition_speed']; ?>" /></td>
		</tr>

		<tr>
			<td><?php _e('Picture Scalling'); ?></td>
			<td>
				<input type="radio" name="settings[picture_scalling]" value="true" <?php print (@$ops['picture_scalling'] == 'true') ? 'checked' : ''; ?>><span><?php _e('Yes'); ?></span>
				<input type="radio" name="settings[picture_scalling]" value="false" <?php print (@$ops['picture_scalling'] == 'false') ? 'checked' : ''; ?>><span><?php _e('No'); ?></span>
			</td>
		</tr>

		<tr>
			<td><?php _e('Auto slide'); ?></td>
			<td>
				<input type="radio" name="settings[auto_slide]" value="true" <?php print (@$ops['auto_slide'] == 'true') ? 'checked' : ''; ?>><span><?php _e('Yes'); ?></span>
				<input type="radio" name="settings[auto_slide]" value="false" <?php print (@$ops['auto_slide'] == 'false') ? 'checked' : ''; ?>><span><?php _e('No'); ?></span>
			</td>
		</tr>



		<tr>
			<td><?php _e('Autoslide Time'); ?></td>
			<td><input type="text" name="settings[autoslide_time]" value="<?php print  @$ops['autoslide_time']; ?>" /></td>
		</tr>

		<tr>
			<td><?php _e('Show Description'); ?></td>
			<td>
				<input type="radio" name="settings[show_desc]" value="true" <?php print (@$ops['show_desc'] == 'true') ? 'checked' : ''; ?>><span><?php _e('Yes'); ?></span>
				<input type="radio" name="settings[show_desc]" value="false" <?php print (@$ops['show_desc'] == 'false') ? 'checked' : ''; ?>><span><?php _e('No'); ?></span>
			</td>
		</tr>

		<tr>
			<td><?php _e('Description Position'); ?></td>
			<td>
				<input type="radio" name="settings[desc_position]" value="right" <?php print (@$ops['desc_position'] == 'right') ? 'checked' : ''; ?>><span><?php _e('Right'); ?></span>
				<input type="radio" name="settings[desc_position]" value="left" <?php print (@$ops['desc_position'] == 'left') ? 'checked' : ''; ?>><span><?php _e('Left'); ?></span>
			</td>
		</tr>

		<tr>
			<td><?php _e('Description Bgcolor'); ?></td>
			<td><input type="text" name="settings[desc_bgcolor]" class="color {hash:false,caps:false}"  value="<?php print  @$ops['desc_bgcolor']; ?>" /></td>
		</tr>

		<tr>
			<td><?php _e('Description Color Alpha'); ?></td>
			<td>
				<select name="settings[desccolor_alpha]">
					<option value="0" <?php print (@$ops['desccolor_alpha'] == '0') ? 'selected' : ''; ?>><?php _e('0');?></option>

					<option value="0.1" <?php print (@$ops['desccolor_alpha'] == '0.1') ? 'selected' : ''; ?>><?php _e('0.1');?></option>

					<option value="0.2" <?php print (@$ops['desccolor_alpha'] == '0.2') ? 'selected' : ''; ?>><?php _e('0.2');?></option>

					<option value="0.3" <?php print (@$ops['desccolor_alpha'] == '0.3') ? 'selected' : ''; ?>><?php _e('0.3');?></option>

					<option value="0.4" <?php print (@$ops['desccolor_alpha'] == '0.4') ? 'selected' : ''; ?>><?php _e('0.4');?></option>

					<option value="0.5" <?php print (@$ops['desccolor_alpha'] == '0.5') ? 'selected' : ''; ?>><?php _e('0.5');?></option>

					<option value="0.6" <?php print (@$ops['desccolor_alpha'] == '0.6') ? 'selected' : ''; ?>><?php _e('0.6');?></option>

					<option value="0.7" <?php print (@$ops['desccolor_alpha'] == '0.7') ? 'selected' : ''; ?>><?php _e('0.7');?></option>

					<option value="0.8" <?php print (@$ops['desccolor_alpha'] == '0.8') ? 'selected' : ''; ?>><?php _e('0.8');?></option>

					<option value="0.9" <?php print (@$ops['desccolor_alpha'] == '0.9') ? 'selected' : ''; ?>><?php _e('0.9');?></option>

					<option value="1" <?php print (@$ops['desccolor_alpha'] == '1') ? 'selected' : ''; ?>><?php _e('1');?></option>

				</select>
			</td>
		</tr>

		<tr>
			<td><?php _e('Description Color'); ?></td>
			<td><input type="text" name="settings[desc_color]" class="color {hash:false,caps:false}"  value="<?php print  @$ops['desc_color']; ?>" /></td>
		</tr>

		<tr>
			<td><?php _e('Description Size'); ?></td>
			<td><input type="text" name="settings[desc_size]"   value="<?php print  @$ops['desc_size']; ?>" /></td>
		</tr>

		<tr>
			<td><?php _e('Animation Type'); ?></td>
			<td>
				<select name="settings[animation_type]">
					<option value="fade" <?php print (@$ops['animation_type'] == 'fade') ? 'selected' : ''; ?>><?php _e('Fade');?></option>

					<option value="top" <?php print (@$ops['animation_type'] == 'top') ? 'selected' : ''; ?>><?php _e('Top');?></option>

					<option value="bottom" <?php print (@$ops['animation_type'] == 'bottom') ? 'selected' : ''; ?>><?php _e('Bottom');?></option>

					<option value="left" <?php print (@$ops['animation_type'] == 'left') ? 'selected' : ''; ?>><?php _e('Left');?></option>

					<option value="right" <?php print (@$ops['animation_type'] == 'right') ? 'selected' : ''; ?>><?php _e('Right');?></option>

				</select>
			</td>
		</tr>

		
		<tr>
			<td><?php _e('Transition Type'); ?></td>
			<td>
				<select name="settings[transition_type]">
					<option value="easeInSine" <?php print (@$ops['transition_type'] == 'easeInSine') ? 'selected' : ''; ?>><?php _e('EaseIn Sine');?></option>

					<option value="easeInElastic" <?php print (@$ops['transition_type'] == 'easeInElastic') ? 'selected' : ''; ?>><?php _e('EaseIn Elastic');?></option>

					<option value="easeInBack" <?php print (@$ops['transition_type'] == 'easeInBack') ? 'selected' : ''; ?>><?php _e('EaseIn Back');?></option>

					<option value="easeInBounce" <?php print (@$ops['transition_type'] == 'easeInBounce') ? 'selected' : ''; ?>><?php _e('EaseIn Bounce');?></option>

					<option value="easeOutSine" <?php print (@$ops['transition_type'] == 'easeOutSine') ? 'selected' : ''; ?>><?php _e('EaseOut Sine');?></option>

					<option value="easeOutElastic" <?php print (@$ops['transition_type'] == 'easeOutElastic') ? 'selected' : ''; ?>><?php _e('EaseOut Elastic');?></option>

					<option value="easeOutBack" <?php print (@$ops['transition_type'] == 'easeOutBack') ? 'selected' : ''; ?>><?php _e('EaseOut Back');?></option>

					<option value="easeOutBounce" <?php print (@$ops['transition_type'] == 'easeOutBounce') ? 'selected' : ''; ?>><?php _e('EaseOut Bounce');?></option>

					<option value="easeInOutSine" <?php print (@$ops['transition_type'] == 'easeInOutSine') ? 'selected' : ''; ?>><?php _e('EaseInOut Sine');?></option>

					<option value="easeInOutElastic" <?php print (@$ops['transition_type'] == 'easeInOutElastic') ? 'selected' : ''; ?>><?php _e('EaseInOut Elastic');?></option>

					<option value="easeInOutBack" <?php print (@$ops['transition_type'] == 'easeInOutBack') ? 'selected' : ''; ?>><?php _e('EaseInOut Back');?></option>

					<option value="easeInOutBounce" <?php print (@$ops['transition_type'] == 'easeInOutBounce') ? 'selected' : ''; ?>><?php _e('EaseInOut Bounce');?></option>

				</select>
			</td>
		</tr>

		<tr>
			<td><?php _e('Pagination Bar Style'); ?></td>
			<td>
				<input type="radio" name="settings[pagbar_style]" value="pager" <?php print (@$ops['pagbar_style'] == 'pager') ? 'checked' : ''; ?>><span><?php _e('pager'); ?></span>
				<input type="radio" name="settings[pagbar_style]" value="compact" <?php print (@$ops['pagbar_style'] == 'compact') ? 'checked' : ''; ?>><span><?php _e('compact'); ?></span>
			</td>
		</tr>

		<tr>
			<td><?php _e('PaginationBar Background Color'); ?></td>
			<td><input type="text" name="settings[pagbar_bgcolor]" class="color {hash:false,caps:false}"  value="<?php print  @$ops['pagbar_bgcolor']; ?>" /></td>
		</tr>

		<tr>
			<td><?php _e('PaginationBar Foreground Color'); ?></td>
			<td><input type="text" name="settings[pagbar_fgcolor]" class="color {hash:false,caps:false}"  value="<?php print  @$ops['pagbar_fgcolor']; ?>" /></td>
		</tr>

		<tr>
			<td><?php _e('PaginationBar Hihglight Color'); ?></td>
			<td><input type="text" name="settings[pagbar_hilitecolor]" class="color {hash:false,caps:false}"  value="<?php print  @$ops['pagbar_hilitecolor']; ?>" /></td>
		</tr>

		<tr>
			<td><?php _e('PaginationBar Text Highlight Color'); ?></td>
			<td><input type="text" name="settings[pagbar_hiliteTextcolor]" class="color {hash:false,caps:false}"  value="<?php print  @$ops['pagbar_hiliteTextcolor']; ?>" /></td>
		</tr>

		<tr>
			<td><?php _e('PaginationBar Mouseover Background color'); ?></td>
			<td><input type="text" name="settings[pagbar_bgmouseovercolor]" class="color {hash:false,caps:false}"  value="<?php print  @$ops['pagbar_bgmouseovercolor']; ?>" /></td>
		</tr>

		<tr>
			<td><?php _e('PaginationBar Mouseover Foreground color'); ?></td>
			<td><input type="text" name="settings[pagbar_fgmouseovercolor]" class="color {hash:false,caps:false}"  value="<?php print  @$ops['pagbar_fgmouseovercolor']; ?>" /></td>
		</tr>

		<tr>
			<td><?php _e('PaginationBar Alpha'); ?></td>
			<td>
				<select name="settings[pagbar_alpha]">
					<option value="0" <?php print (@$ops['pagbar_alpha'] == '0') ? 'selected' : ''; ?>><?php _e('0');?></option>

					<option value="0.1" <?php print (@$ops['pagbar_alpha'] == '0.1') ? 'selected' : ''; ?>><?php _e('0.1');?></option>

					<option value="0.2" <?php print (@$ops['pagbar_alpha'] == '0.2') ? 'selected' : ''; ?>><?php _e('0.2');?></option>

					<option value="0.3" <?php print (@$ops['pagbar_alpha'] == '0.3') ? 'selected' : ''; ?>><?php _e('0.3');?></option>

					<option value="0.4" <?php print (@$ops['pagbar_alpha'] == '0.4') ? 'selected' : ''; ?>><?php _e('0.4');?></option>

					<option value="0.5" <?php print (@$ops['pagbar_alpha'] == '0.5') ? 'selected' : ''; ?>><?php _e('0.5');?></option>

					<option value="0.6" <?php print (@$ops['pagbar_alpha'] == '0.6') ? 'selected' : ''; ?>><?php _e('0.6');?></option>

					<option value="0.7" <?php print (@$ops['pagbar_alpha'] == '0.7') ? 'selected' : ''; ?>><?php _e('0.7');?></option>

					<option value="0.8" <?php print (@$ops['pagbar_alpha'] == '0.8') ? 'selected' : ''; ?>><?php _e('0.8');?></option>

					<option value="0.9" <?php print (@$ops['pagbar_alpha'] == '0.9') ? 'selected' : ''; ?>><?php _e('0.9');?></option>

					<option value="1" <?php print (@$ops['pagbar_alpha'] == '1') ? 'selected' : ''; ?>><?php _e('1');?></option>

				</select>
			</td>
		</tr>

		<tr>
			<td><?php _e('Target Link'); ?></td>
			<td>
				<input type="radio" name="settings[target]" value="_self" <?php print (@$ops['target'] == '_self') ? 'checked' : ''; ?>><span><?php _e('Same Window'); ?></span>
				<input type="radio" name="settings[target]" value="_blank" <?php print (@$ops['target'] == '_blank') ? 'checked' : ''; ?>><span><?php _e('New Window'); ?></span>
			</td>
		</tr>
			
		<tr>
			<td><?php _e('Wmode'); ?></td>
			<td>
				<select name="settings[wmode]">
					<option value="window" <?php print (@$ops['wmode'] == 'window') ? 'selected' : ''; ?>><?php _e('Window');?></option>

					<option value="opaque" <?php print (@$ops['wmode'] == 'opaque') ? 'selected' : ''; ?>><?php _e('Opaque');?></option>

					<option value="transparent" <?php print (@$ops['wmode'] == 'transparent') ? 'selected' : ''; ?>><?php _e('Transparent');?></option>

				</select>
			</td>
		</tr>
		</table>
	<p><button type="submit" class="button-primary"><?php _e('Save Config'); ?></button></p>
	</form>
</div>