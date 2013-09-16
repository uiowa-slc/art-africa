
<% loop imageList('Image') %>
	<div class="item"><img src="{$SetWidth(200).URL}" data-mfp-src="{$URL}" class="artPhoto {$size}" data-mfp-href="{$ShowLink}" /></div>
<% end_loop %>
