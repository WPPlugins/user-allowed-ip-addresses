<div class="wrap">

	<?php screen_icon(); ?>

	<form action="options.php" method="post" id="<?php echo $plugin_id; ?>_options_form" name="<?php echo $plugin_id; ?>_options_form">

		<?php settings_fields($plugin_id . '_options'); ?>

		<h2>User Allowed IP Addresses &raquo; Settings</h2>
		<table class="widefat">
			<thead>
			   <tr>
				<th><input type="submit" name="submit" value="Save Settings" class="button-primary" /></th>
			</tr>
			</thead>
			<tfoot>
			<tr>
				<th><input type="submit" name="submit" value="Save Settings" class="button-primary" /></th>
			</tr>
			</tfoot>
			<tbody>
			<tr>
				<td>
					<label for="<?php echo $this->plugin_name .'_no_access_url' ?>">
						<p>The URL of where you want folks that do not have access to get redirected to.  By default it will redirect to Homepage.</p>
						<p><input placeholder="Enter URL" type="text" style="width:272px;height:24px;" name="<?php echo $this->plugin_name .'_no_access_url' ?>" value="<?php echo $no_access_url; ?>" /></p>
					</label>
				</td>
			</tr>

			</tbody>
		</table>

	</form>
</div>