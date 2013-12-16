<% if Images %>
  <div class="image-scroller-container">
    <ul>
      <% loop Images.Limit(30) %>
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

  <% if $Images.Count > "30" %>
  <p class="padded"><a href="$ShowMoreLink" target="_blank">See all images listed under $Title</a></p>
  <% end_if %>

<% end_if %> 