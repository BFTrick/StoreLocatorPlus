<?php ?>
    <table cellpadding='10px' cellspacing='0' style='width:100%' class='manual_add_table'>
        <tr>
            <td style='padding-top:0px;' valign='top'>
    <form name='manualAddForm' method=post>
        <table cellpadding='0' class='widefat'>
        <thead><tr><th><?php _e("Enter An Address", $text_domain);?></th></tr></thead>
        <tr>
            <td><div class="add_location_form">
            <label  for='sl_store'><?php _e('Name of Location', $text_domain);?></label>
            <input name='sl_store'><br/>

            <label  for='sl_address'><?php _e('Street - Line 1', $text_domain);?></label>
            <input name='sl_address'><br/>

		    <label  for='sl_address2'><?php _e('Street - Line 2', $text_domain);?></label>
            <input name='sl_address2'><br/>

		    <label  for='sl_city'><?php _e('City, State, ZIP', $text_domain);?></label>
            <input name='sl_city'   style='width: 21.4em; margin-right: 1em;'>
            <input name='sl_state'  style='width: 7em; margin-right: 1em;'>
            <input name='sl_zip'    style='width: 7em;'>
            <br/>

		    <label  for='sl_country'><?php _e('Country', $text_domain);?></label>
            <input name='sl_country'><br/>
            </div></td>
        </tr>
        <thead><tr><th><?php _e("Additional Information", $text_domain);?></th></tr></thead>
        <tr><td><div class="add_location_form">
		    <label for='sl_description'><?php _e("Description", $text_domain);?></label>
            <textarea name='sl_description' rows='5'></textarea><br/>
<?php
print "
		<input name='sl_tags'>&nbsp;<small>".__("Tags (seperate with commas)", $text_domain)."</small><br>		
		<input name='sl_url'>&nbsp;<small>".__("URL", $text_domain)."</small><br>
		<input name='sl_hours'>&nbsp;<small>".__("Hours", $text_domain)."</small><br>
		<input name='sl_phone'>&nbsp;<small>".__("Phone", $text_domain)."</small><br>
		<input name='sl_image'>&nbsp;<small>".__("Image URL (shown with location)", $text_domain)."</small><br><br>
	<input type='submit' value='".__("Add Location", $text_domain)."' class='button-primary'>
</div>
	</div></td>
		</tr>
	</table>
</form>

</td>
<td style='/*border-right:solid silver 1px;*/ padding-top:0px;' valign='top'>";

if (file_exists($sl_upload_path."/addons/csv-xml-importer-exporter/csv-import-form.php")) {
	include($sl_upload_path."/addons/csv-xml-importer-exporter/csv-import-form.php");
	print "<br>";
}

include(SLPLUS_PLUGINDIR."/database-info.php");
if (file_exists($sl_upload_path."/addons/db-importer/db-import-form.php")) {
	include($sl_upload_path."/addons/db-importer/db-import-form.php");
}

print "</td><td valign='top' style='padding-top:0px;'>";

if (file_exists($sl_upload_path."/addons/point-click-add/point-click-add-form.php")) {
	include($sl_upload_path."/addons/point-click-add/point-click-add-form.php");
}
?>

                </td>
            </tr>
        </table>
    </div>
