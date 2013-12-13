<% if Images %>
<div class="image-scroller-container">
  <ul>
    <% loop Images.Limit(50) %>
    <li>
    	<% if $AltImage %>
				<img src="{$AltImage.CroppedFocusedImage(225,225).URL}" data-mfp-src="{$AltImage.URL}" class="artPhoto" title="Tap or Click for more info" data-mfp-href="$ShowLink">
		<% else %>
				<img src="{$CroppedFocusedImage(225,225).URL}" data-mfp-src="{$URL}" class="artPhoto" title="Tap or Click for more info" data-mfp-href="$ShowLink">		
		<% end_if %>
    </li>
    <% end_loop %>
    <li><a href="#"><img src="{$CroppedFocusedImage(225,225)} /art-africa/assets/ALA_seemore.png}" class="artPhoto" title="Tap or Click for more photos">		
See all images</a></li>
  </ul>
</div>

<% end_if %>
