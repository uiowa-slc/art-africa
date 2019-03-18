<% if $AltImage %>
	<img src="{$ThemeDir}/dist/images/media-grid-placeholder.jpg" data-src="{$AltImage.SetWidth(282).URL}" data-mfp-src="{$AltImage.ScaledImage.URL}" class="lozad artPhoto {$size} media-grid-image media-grid-image--alt" alt="" title="Tap or click the image for more info." data-mfp-href="{$ShowLink}" height="{$AltImage.SetWidth(282).Height}" />
<% else %>
	<img src="{$ThemeDir}/dist/images/media-grid-placeholder.jpg" data-src="{$SetWidth(282).URL}" data-mfp-src="{$ScaledImage.URL}" class="lozad artPhoto {$size} media-grid-image" alt="" title="Tap or click the image for more info." data-mfp-href="{$ShowLink}" height="{$SetWidth(282).Height}" />	
<% end_if %>