<?php 
    global $prefix, $update_msg,   
        $city_checked, $country_checked, $show_tag_checked, $show_any_checked;
?>

<div class='map_settings'>
    <div class="wrap">
        <h2>
            <?php _e('Map Settings',SLPLUS_PREFIX); ?>
            
            <a href='/wp-admin/admin.php?page=<?php echo SLPLUS_PLUGINDIR?>add-locations.php' 
                class='button add-new-h2'><?php _e('Add Locations',SLPLUS_PREFIX); ?></a>
            
            <a href='/wp-admin/admin.php?page=<?php echo SLPLUS_PLUGINDIR?>view-locations.php' 
                class='button add-new-h2'><?php _e('Manage Locations',SLPLUS_PREFIX); ?></a>            
        </h2>
        
    <?php echo $update_msg?>
    
    <form method='post' name='mapDesigner'>
        <table class='widefat'>
            <thead>
                <tr>
                    <th colspan='2'><?php _e('Search Settings', SLPLUS_PREFIX);?></th>
                </tr>
            </thead>
            <tbody>
            <tr>
                <td class='left_side'>                
                    <h3><?php _e('Search Features', SLPLUS_PREFIX);?></h3>
                    <h4><?php _e('Show Search By...',SLPLUS_PREFIX);?></h4>
                    
                    <div class='form_entry'>
                        <label for='sl_use_city_search'>
                            <?php _e('City Pulldown', SLPLUS_PREFIX); ?>:
                        </label>
                        <input name='sl_use_city_search' 
                            value='1' 
                            type='checkbox' 
                            <?php echo $city_checked?> 
                            >
                    </div>
       
                   <div class='form_entry'>
                        <label for='sl_use_country_search'>
                            <?php _e('Country Pulldown', SLPLUS_PREFIX); ?>:
                        </label>
                        <input name='sl_use_country_search' 
                            value='1' 
                            type='checkbox' 
                            <?php echo $country_checked?> 
                            >
                   </div>
                   
                   <div class='form_entry'>
                        <label for='<?php echo $prefix?>_show_tag_search'>
                            <?php _e('Tag Input', SLPLUS_PREFIX); ?>:
                        </label>
                        <input name='<?php echo $prefix?>_show_tag_search' 
                            value='1' 
                            type='checkbox' 
                            <?php echo $show_tag_checked?> 
                            >
                   </div>     
                                      
                    <div class='form_entry'>
                        <label for='<?php echo $prefix?>_tag_search_selections'>
                            <?php _e('Preselected Tag Searches', SLPLUS_PREFIX); ?>:
                        </label>
                        <input  name='<?php echo $prefix?>_tag_search_selections' 
                            value='<?php print get_option($prefix.'_tag_search_selections'); ?>' 
                            >
                        <span class='input_note'>
                          <?php 
                            _e("Enter a comma (,) separated list of tags to show in the search pulldown, mark the default selection with parenthesis '( )'. This is a default setting that can be overriden on each page within the shortcode.", SLPLUS_PREFIX); 
                          ?>
                       </span>
                    </div>        
                    
                   <div class='form_entry'>
                        <label for='<?php echo $prefix?>_show_tag_any'>
                            <?php _e('Show "any" on tag pulldown', SLPLUS_PREFIX); ?>:
                        </label>
                        <input name='<?php echo $prefix?>_show_tag_any' 
                            value='1' 
                            type='checkbox' 
                            <?php echo $show_any_checked?> 
                            >
                        <span class='input_note'>
                          <?php 
                            _e("If checked the tag pulldown list will have an 'any' option that returns any location.", SLPLUS_PREFIX); 
                          ?>
                       </span>
                   </div>                       
               </td>
            
            
            
