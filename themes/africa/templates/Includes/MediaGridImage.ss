<% if $AltImage %>
	<img src="{$AltImage.SetWidth(282).URL}" data-mfp-src="{$AltImage.ScaledImage.URL}" class="artPhoto {$size}" title="Tap or click for more info." data-mfp-href="{$ShowLink}" />
<% else %>
	<img src="{$SetWidth(282).URL}" data-mfp-src="{$ScaledImage.URL}" class="artPhoto {$size}" title="Tap or click for more info." data-mfp-href="{$ShowLink}" />	
<% end_if %>