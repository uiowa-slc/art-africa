<% loop $getArtPhotos %>
	<% if $Name %>
	  <li><a href="$Link(false)">$Name</a></li>
	<% else_if $Title %>
	  <li><a href="$Link(false)">$Title</a></li>
	<% end_if %>
<% end_loop %>