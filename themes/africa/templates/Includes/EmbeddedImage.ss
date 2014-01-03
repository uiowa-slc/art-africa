 <div class="embedded-image {$SizeCategory}">
 	<% if $AltImage %>
 
			<img src="{$AltImage.SetRatioSize(1000,1000).Filename}" data-mfp-src="{$AltImage.SetRatioSize(1000,1000).Filename}" class="artPhoto" title="Tap or click the image for more info." data-mfp-href="{$ShowLink}" />

	<% else %>
			<img src="{$SetRatioSize(1000,1000).Filename}" data-mfp-src="{$SetRatioSize(1000,1000).Filename}" class="artPhoto" title="Tap or click the image for more info." data-mfp-href="{$ShowLink}" />

	<% end_if %>
	
	<% if $AltImage.Caption %>

		<div class="credit-line">$AltImage.Caption</div>

	<% else %>
		<div class="credit-line">$Caption</div>
	<% end_if %>

</div>
