
<div class="content-container typography">	
	<article>
		<div class="content container-fluid">
			<p>
			<% if $Source %>
			<a href="$Source">Return to the previous page</a>
			<% end_if %>

			<% if $CurrentMember %> 
				| <a href="admin/assets/EditForm/field/File/item/{$Object.ID}/edit" target="_blank">Edit this Image</a>
			<% end_if %> 
			
			 </p>

			<% with $Object %>

				<% include EmbeddedImage %>

				<% if $ParentImage.Description %>
					$ParentImage.Description</div>
				<% else %>
					<div class="content columns description">$Description</div>
				<% end_if %>

			<% end_with %>
		
			<% include SocialShare %>

			<div class="clearfix"></div>
			
		</div>
	</article>
		
</div>
<%-- include SideBar --%>