 <div class="embedded-image {$SizeCategory}">
 	<% if $AltImage %>
			<img src="{$AltImage.ScaledImage.URL}" data-mfp-src="{$AltImage.ScaledImage.URL}" class="artPhoto" title="Tap or click the image for more info." data-mfp-href="{$ShowLink}" <% if $SizeCategory == 'medium' %>style="max-width: {$AltImage.ScaledImage.Width}px"<% end_if %> class="alt-image" />
	<% else %>
			<img src="{$ScaledImage.URL}" data-mfp-src="{$ScaledImage.URL}" class="artPhoto" title="Tap or click the image for more info." data-mfp-href="{$ShowLink}" <% if $SizeCategory == 'medium' %>style="max-width: {$ScaledImage.Width}px"<% end_if %> />
	<% end_if %>
	<% if $ParentImage %>
		<div class="credit-line">$ParentImage.Caption</div>
	<% else %>
		<div class="credit-line">$Caption</div>
	<% end_if %>
</div>
