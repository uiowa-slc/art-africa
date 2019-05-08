<% if Images %>
<div class="image-scroller-container">
  <ul class="large-image-grid">
    <% loop Images.Limit(30) %>
    <li>
     <% if $AltImage %>
      		<img src="{$AltImage.FocusFill(650,650).URL}" data-mfp-src="{$AltImage.URL}" class="artPhoto" title="Tap or click for more info." data-mfp-href="{$ShowLink}">
     <% else %>
	  		<img src="{$FocusFill(650,650).URL}" data-mfp-src="{$URL}" class="artPhoto" title="Tap or click for more info." data-mfp-href="{$ShowLink}">  
     <% end_if %>
      <!-- <% if $CurrentMember %><span><a href="#">Edit this image</a></span><% end_if %> -->
    </li>
    <% end_loop %>
  </ul>
</div>
<% end_if %>