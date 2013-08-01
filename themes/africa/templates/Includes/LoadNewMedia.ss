
<% loop imageList('Image') %>
	<div class="item"><img src="{$SetWidth(200).URL}" data-mfp-src="{$URL}" class="artPhoto {$size}" title="{$CreditLine}" data-mfp-href="{$Link(false)}" /></div>
<% end_loop %>
