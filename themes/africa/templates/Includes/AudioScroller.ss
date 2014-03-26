<% if $AudioPieces %> 
 	<div class="media-container">
 		<h3>Audio</h3>
 		<% loop $AudioPieces %>
 			<div class="item $ID">
 				<% include AudioPiece %>
 			</div>
 		<% end_loop %>	
 	</div>
</div>
<% end_if %>
