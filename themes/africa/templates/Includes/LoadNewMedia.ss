
<% loop imageList('Image') %>
 			<div class="item">
<a href="{$PopupLink}" class="artPhoto mfp-iframe" title="$Title"><img src="{$SetWidth(200).URL}" /></a>
 			</div>
<% end_loop %>
