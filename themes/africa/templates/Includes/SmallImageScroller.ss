<% if Images %>
<div class="image-scroller-container">
  <ul>
    <% loop Images %>
    <li>
    	<% if $AltImage %>
				<img src="{$AltImage.CroppedFocusedImage(225,225).URL}" data-mfp-src="{$AltImage.URL}" class="artPhoto" title="Tap or Click for more info" data-mfp-href="$ShowLink">
		<% else %>
				<img src="{$CroppedFocusedImage(225,225).URL}" data-mfp-src="{$URL}" class="artPhoto" title="Tap or Click for more info" data-mfp-href="$ShowLink">		
		<% end_if %>
    </li>
    <% end_loop %>
  </ul>
</div>
<% end_if %>