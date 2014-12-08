<% if $AltImage %>
	<img src="{$AltImage.SetWidth(282).URL}" data-mfp-src="{$AltImage.ScaledImage.URL}" class="artPhoto {$size}" alt="" title="Tap or click the image for more info." data-mfp-href="{$ShowLink}" />
<% else %>
	<img src="{$SetWidth(282).URL}" data-mfp-src="{$ScaledImage.URL}" class="artPhoto {$size}" alt="" title="Tap or click the image for more info." data-mfp-href="{$ShowLink}" />	
<% end_if %>