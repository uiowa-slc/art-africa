<div class="content-container typography">
  <article role="main">
    <h1>$Title</h1>
    <% with Parent %>
		<% if Author %>
			<h2>By $Author
				<% if University %><br />$University<% end_if %>
			</h2>
		<% end_if %>
	<% end_with %>

	<% include EssayPages %>
  
  </article>
</div>

