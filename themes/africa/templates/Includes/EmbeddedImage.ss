 <div class="embedded-image {$SizeCategory}">
 	<% if $AltImage %>
 
			<img src="{$AltImage.ScaledImage.Filename}" data-mfp-src="{$AltImage.ScaledImage.Filename}" class="artPhoto" title="Tap or click the image for more info." data-mfp-href="{$ShowLink}" <% if $SizeCategory == 'medium' %>style="max-width: {$AltImage.ScaledImage.Width}px"<% end_if %> />

	<% else %>
			<img src="{$ScaledImage.Filename}" data-mfp-src="{$ScaledImage.Filename}" class="artPhoto" title="Tap or click the image for more info." data-mfp-href="{$ShowLink}" <% if $SizeCategory == 'medium' %>style="max-width: {$ScaledImage.Width}px"<% end_if %> />

	<% end_if %>
	<% if $AltImage.Caption %>

		<div class="credit-line">$AltImage.Caption</div>

	<% else %>
		<div class="credit-line">$Caption</div>
	<% end_if %>
</div>
