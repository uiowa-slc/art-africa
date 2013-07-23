<div class="content-container typography">
  <article>
    <h1>$Title</h1>
    <% if $CoverImage %>
		<img src="$CoverImage.URL" class="full-width" alt="">
	<% end_if %>
    <div class="description">
      $Description
    </div>
	<% include EssayPages %>
    <!-- Name: $Name<br><br>
    Description: $Description<br><br>
    Tags: $Tags<br><br> -->
  </article>
</div>

<%# include SideBar %>
