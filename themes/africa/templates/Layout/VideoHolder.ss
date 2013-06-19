<div class="content-container typography">	
	<article>
		<h1>$Title</h1>
		<div class="content">
		<% loop getObjects('VideoPiece') %>
			<% if Title %>
				<li><a href="{$Up.getHolderLink('VideoHolder')}/show/{$ID}">$Title</a></li><br>
			<% end_if %>
		<% end_loop %>
		
		<br><br>
		</div>
	</article>
		
</div>
<% include SideBar %>