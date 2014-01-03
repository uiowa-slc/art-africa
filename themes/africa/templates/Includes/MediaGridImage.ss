<% if $AltImage %>
	<img src="{$AltImage.SetWidth(282).URL}" data-mfp-src="{$AltImage.SetRatioSize(1000,1000).URL}" class="artPhoto {$size}" title="Tap or click for more info." data-mfp-href="{$ShowLink}" />
<% else %>
	<img src="{$SetWidth(282).URL}" data-mfp-src="{$SetRatioSize(1000,1000).URL}" class="artPhoto {$size}" title="Tap or click for more info." data-mfp-href="{$ShowLink}" />	
<% end_if %>