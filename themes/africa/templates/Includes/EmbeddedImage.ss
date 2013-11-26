 <div class="embedded-image {$SizeCategory}">
 	<% if $AltImage %>
 		<% with $AltImage %>
			<img src="{$Filename}" data-mfp-src="{$Filename}" class="artPhoto" title="Tap or click the image for more info." data-mfp-href="{$ShowLink}" />
		<% end_with %>
	<% else %>
			<img src="{$Filename}" data-mfp-src="{$Filename}" class="artPhoto" title="Tap or click the image for more info." data-mfp-href="{$ShowLink}" />	
	<% end_if %>
	<div class="credit-line">$Caption</div>
</div>
