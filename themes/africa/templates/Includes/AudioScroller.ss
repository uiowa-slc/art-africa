<% if $AudioPieces %> 
<div class="image-scroller-container" id="audio-scroller">
	<h3>Audio</h3>
	  <ul>
	    <% loop $AudioPieces %> 
	       <% include AudioPiece %>
	    <% end_loop %>
	  </ul>
	</div>
<% end_if %>
<!--art-africa/assets/Uploads/176484-goup-1-piano-key-a-2.wav-->