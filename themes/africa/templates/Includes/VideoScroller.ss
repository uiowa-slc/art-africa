<% if VideoPieces %> 
<div class="image-scroller-container" id="video-scroller">
<h3>Video</h3>
  <ul>
	    <% loop $VideoPieces %> 
	    <li>
	    	<% include VideoPiece %>
	    </li>
	    <% end_loop %>
  </ul>
</div>
<% end_if %>
