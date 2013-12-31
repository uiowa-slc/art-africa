 <div class="embedded-image {$SizeCategory}">
 	<% if $AltImage %>
 
			<img src="{$AltImage.Filename}" data-mfp-src="{$AltImage.Filename}" class="artPhoto" title="Tap or click the image for more info." data-mfp-href="{$ShowLink}" />

	<% else %>
			<img src="{$Filename}" data-mfp-src="{$Filename}" class="artPhoto" title="Tap or click the image for more info." data-mfp-href="{$ShowLink}" />

	<% end_if %>
	
	<% if $AltImage.Caption %>

		<div class="credit-line">$AltImage.Caption</div>

	<% else %>
		<div class="credit-line">$Caption</div>
	<% end_if %>

</div>
