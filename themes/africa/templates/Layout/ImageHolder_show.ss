
<div class="content-container typography">	
	<article>
		<div class="content container-fluid">
			<% if $Source %>
			<p><a href="$Source.Link">Return to $Source.Title</a> <% if $CurrentMember %> | <a href="admin/assets/EditForm/field/File/item/{$Object.ID}/edit" target="_blank">Edit this Image</a><% end_if %> 
			
			 </p>
			<% end_if %>

			<% loop $Object %>
				<% include EmbeddedImage %>
			<% end_loop %>
		
			<% include SocialShare %>

			<div class="clearfix"></div>
			
		</div>
	</article>
		
</div>
<%-- include SideBar --%>