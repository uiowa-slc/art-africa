 <div class="embedded-image {$SizeCategory}">
 	<% if $AltImage %>
 		<% with $AltImage %>
			<img src="{$Filename}" data-mfp-src="{$Filename}" class="artPhoto" title="Tap or click the image for more info." data-mfp-href="{$ShowLink}" />
		<% end_with %>
	<% else %>
			<img src="{$Filename}" data-mfp-src="{$Filename}" class="artPhoto" title="Tap or click the image for more info." data-mfp-href="{$ShowLink}" />

	<% end_if %>
	
	<% if $AltImage.Caption %>

		<div class="credit-line">$AltImage.Caption</div>

	<% else %>
		<div class="credit-line">$Caption</div>
	<% end_if %>

</div>
