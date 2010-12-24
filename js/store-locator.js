var map;
var geocoder;

var theIcon = new GIcon(G_DEFAULT_ICON);
theIcon.image = sl_map_end_icon;
if (sl_map_end_icon.indexOf('flag')!='-1') {
    theIcon.shadow = add_base + "/icons/flag_shadow.png";
} else if (sl_map_end_icon.indexOf('arrow')!='-1') {
    theIcon.shadow = add_base + "/icons/arrow_shadow.png";
} else if (sl_map_end_icon.indexOf('bubble')!='-1') {
    theIcon.shadow = add_base + "/icons/bubble_shadow.png";
} else if (sl_map_end_icon.indexOf('marker')!='-1') {
    theIcon.shadow = add_base + "/icons/marker_shadow.png";
} else if (sl_map_end_icon.indexOf('sign')!='-1') {
    theIcon.shadow = add_base + "/icons/sign_shadow.png";
} else {
    theIcon.shadow = add_base + "/icons/blank.png";
}
theIcon.iconSize = new GSize(sl_map_end_icon_width, sl_map_end_icon_height);


/**************************************
*/
function sl_load() {
	if (GBrowserIsCompatible()) {
        geocoder = new GClientGeocoder();
        map = new GMap2(document.getElementById('map'));
        if (sl_map_overview_control==1) {
            map.addControl(new GOverviewMapControl());
        }
        map.addMapType(G_PHYSICAL_MAP);
        geocoder.getLatLng(sl_google_map_country, 
            function(latlng) {
                map.setCenter(latlng, sl_zoom_level, sl_map_type);
                map.setUIToDefault();
            }
        );
	}
  
    if (sl_load_locations_default=="1") {
        var bounds = new GLatLngBounds();
        markerOpts = { icon:theIcon };
        GDownloadUrl(add_base + "/data-xml.php",
            function(data, responseCode) {
                var xml = GXml.parse(data);
                var markers = xml.documentElement.getElementsByTagName("marker");
                for (var i = 0; i < markers.length; i++) {
                    var name = markers[i].getAttribute('name');
                    var address = markers[i].getAttribute('address');
                    var distance = parseFloat(markers[i].getAttribute('distance'));
                    var point = new GLatLng(parseFloat(markers[i].getAttribute('lat')),
                    parseFloat(markers[i].getAttribute('lng')));
                    var description = markers[i].getAttribute('description');
                    var url = markers[i].getAttribute('url');
                    var hours = markers[i].getAttribute('hours');
                    var phone = markers[i].getAttribute('phone');
                    var image = markers[i].getAttribute('image');
                    var marker = createMarker(point, name, address, "", description, url, hours, phone, image);
                    map.addOverlay(marker);
                    bounds.extend(point);
                }
                map.setCenter(bounds.getCenter(), (map.getBoundsZoomLevel(bounds)-1));
                map.setUIToDefault();
            }
        );
     }
}


/**************************************
 */
function searchLocations() {
    var address = document.getElementById('addressInput').value;
    geocoder.getLatLng(address, 
        function(latlng) {
            if (!latlng) {
                alert(address + ' not found');
            } else {
                searchLocationsNear(latlng, address); 
            }
        }
    );
}


/**************************************
 */
function searchLocationsNear(center, homeAddress) {
    var radius = document.getElementById('radiusSelect').value;
    var searchUrl = add_base + '/generate-xml.php?lat=' + center.lat() + '&lng=' + center.lng() + '&radius=' + radius;
    GDownloadUrl(searchUrl, 
        function(data) {
            var xml = GXml.parse(data);
            var markers = xml.documentElement.getElementsByTagName('marker');
            map.clearOverlays();
   
            var theIcon = new GIcon(G_DEFAULT_ICON);
            theIcon.image = sl_map_home_icon;
            if (sl_map_home_icon.indexOf('flag')!='-1') {
                theIcon.shadow = add_base + "/icons/flag_shadow.png";
            } else if (sl_map_home_icon.indexOf('arrow')!='-1') {
                theIcon.shadow = add_base + "/icons/arrow_shadow.png";
            } else if (sl_map_home_icon.indexOf('bubble')!='-1') {
                theIcon.shadow = add_base + "/icons/bubble_shadow.png";
            } else if (sl_map_home_icon.indexOf('marker')!='-1') {
                theIcon.shadow = add_base + "/icons/marker_shadow.png";
            } else if (sl_map_home_icon.indexOf('sign')!='-1') {
                theIcon.shadow = add_base + "/icons/sign_shadow.png";
            } else {
                theIcon.shadow = add_base + "/icons/blank.png";
            }
            theIcon.iconSize = new GSize(sl_map_home_icon_width, sl_map_home_icon_height);

            var bounds = new GLatLngBounds(); 
            markerOpts = { icon:theIcon };
            point = new GLatLng (center.lat(), center.lng());
            bounds.extend(point); 
            var homeMarker = new GMarker(point, markerOpts);
            var html = '<div id="sl_info_bubble"><span class="your_location_label">Your Location:</span> <br/>' + homeAddress + '</div>';
            GEvent.addListener(homeMarker, 'click', function() {
                homeMarker.openInfoWindowHtml(html);
                }
            );
            map.addOverlay(homeMarker);

            var sidebar = document.getElementById('map_sidebar');
            sidebar.innerHTML = '';
            
            if (markers.length == 0) {
                sidebar.innerHTML = '<div class="no_results_found"><h2>No results found.</h2></div>';
                geocoder = new GClientGeocoder();
                geocoder.getLatLng(sl_google_map_country, 
                    function(latlng) {
                        map.setCenter(point, sl_zoom_level);
                    }
                );
                return;
            }
   
            for (var i = 0; i < markers.length; i++) {
                var name = markers[i].getAttribute('name');
                var address = markers[i].getAttribute('address');
                var distance = parseFloat(markers[i].getAttribute('distance'));
                var point = new GLatLng(parseFloat(markers[i].getAttribute('lat')),
                        parseFloat(markers[i].getAttribute('lng')));
                var description = markers[i].getAttribute('description');
                var url = markers[i].getAttribute('url');
                var hours = markers[i].getAttribute('hours');
                var phone = markers[i].getAttribute('phone');
                var image = markers[i].getAttribute('image');                
                var marker = createMarker(point, name, address, homeAddress, description, url, hours, phone, image); 
                        map.addOverlay(marker);
                var sidebarEntry = createSidebarEntry(marker, name, address, distance, homeAddress, url); 
                sidebar.appendChild(sidebarEntry);
                bounds.extend(point);
            }
          map.setCenter(bounds.getCenter(), (map.getBoundsZoomLevel(bounds)-1)); 
        }
    );  
}

/**************************************
 */
function createMarker(point, name, address, homeAddress, description, url, hours, phone, image) { 
  markerOpts = { icon:theIcon };
  var marker = new GMarker(point, markerOpts);
  
  var more_html="";
  if(url.indexOf("http://")==-1) {url="http://"+url;} 
  if (url.indexOf("http://")!=-1 && url.indexOf(".")!=-1) {more_html+="| <a href='"+url+"' target='_blank' class='storelocatorlink'><nobr>" + sl_website_label +"</nobr></a>"} else {url=""}
  if (image.indexOf(".")!=-1) {more_html+="<br/><img src='"+image+"' class='sl_info_bubble_main_image'>"} else {image=""}
  if (description!="") {more_html+="<br/>"+description+"";} else {description=""}
  if (hours!="") {more_html+="<br/><span class='location_detail_label'>Hours:</span> "+hours;} else {hours=""}
  if (phone!="") {more_html+="<br/><span class='location_detail_label'>Phone:</span> "+phone;} else {phone=""}
  
    var street = address.split(',')[0]; if (street.split(' ').join('')!=""){street+='<br/>';}else{street="";}
    var city = address.split(',')[1]; if (city.split(' ').join('')!=""){city+=', ';}else{city="";}
    var state_zip = address.split(',')[2]; 	  
  
  if (homeAddress.split(" ").join("")!="") {
    var html = '<div id="sl_info_bubble"><!--tr><td--><strong>' + name + '</strong><br>' + street + city + state_zip + '<br/> <a href="http://' + sl_google_map_domain + '/maps?saddr=' + encodeURIComponent(homeAddress) + '&daddr=' + encodeURIComponent(address) + '" target="_blank" class="storelocatorlink">Directions</a> ' + more_html + '<br/><!--/td></tr--></div>'; 
  } else {
    var html = '<div id="sl_info_bubble"><!--tr><td--><strong>' + name + '</strong><br>' + street + city + state_zip + '<br/> <a href="http://' + sl_google_map_domain + '/maps?q=' + encodeURIComponent(address) + '" target="_blank" class="storelocatorlink">Map</a> ' + more_html + '<!--/td></tr--></div>';
  }
  GEvent.addListener(marker, 'click', function() {
    marker.openInfoWindowHtml(html);
  });
  return marker;
}

var resultsDisplayed=0;
var bgcol="white";

/**************************************
 */
function createSidebarEntry(marker, name, address, distance, homeAddress, url) { 
    document.getElementById('map_sidebar_td').style.display='block';
      var div = document.createElement('div');
      var street = address.split(',')[0]; 
      var city = address.split(',')[1]; if (city.split(' ').join('')!=""){city+=', ';}else{city="";}
      var state_zip = address.split(',')[2]; 
      if(url.indexOf("http://")==-1) {url="http://"+url;} 
      if (url.indexOf("http://")!=-1 && url.indexOf(".")!=-1) {link="<a href='"+url+"' target='_blank' class='storelocatorlink'><nobr>" + sl_website_label +"</nobr></a>&nbsp;|&nbsp;"} else {url=""; link="";}
      
      var html = '<center><table width="96%" cellpadding="4px" cellspacing="0" class="searchResultsTable"><tr><td class="results_row_left_column"><span class="location_name">' + name + '</span><br>' + distance.toFixed(1) + ' ' + sl_distance_unit + '</td><td class="results_row_center_column">' + street + '<br/>' + city + state_zip +' </td><td class="results_row_right_column">' + link + '<a href="http://' + sl_google_map_domain + '/maps?saddr=' + encodeURIComponent(homeAddress) + '&daddr=' + encodeURIComponent(address) + '" target="_blank" class="storelocatorlink">Directions</a></td></tr></table></center>'; 
      div.innerHTML = html;
      div.className='results_entry';
      resultsDisplayed++;
      GEvent.addDomListener(div, 'click', function() {
        GEvent.trigger(marker, 'click');
      }); 
    return div;
}
