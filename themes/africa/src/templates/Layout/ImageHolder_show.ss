
<div class="content-container content-container--constrained content-container--centered typography">	
	<article>
		<div class="content container-fluid">
			<p class="top-breadcrumbs">
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
					<div class="content description">$Description</div>
				<% end_if %>
	
			<% end_with %>
		
			<% include SocialShare %>



			<div class="clearfix"></div>
			
		</div>
		<% with $Object %>
		<div class="content-container content-container--constrained content-container--centered typography">
			<div class="row-fluid">
				<% if $ObjectMediums %>
				<div class="span3">
					<h2>Medium<% if $ObjectMediums.Count > 1 %>s<% end_if %></h2>
					<% loop $ObjectMediums %><a href="$Link">$Title</a><% if not $Last %>, <% end_if %><% end_loop %>
				</div>
				<% end_if %>
				<% if $ObjectTypes %>
				<div class="span3">
					<h2>Type<% if $ObjectTypes.Count > 1 %>s<% end_if %></h2>
					<% loop $ObjectTypes %><a href="$Link">$Title</a><% if not $Last %>, <% end_if %><% end_loop %>
				</div>
				<% end_if %>
				<% if $ObjectCollections %>
				<div class="span3">
					<h2>Collection<% if $ObjectCollections.Count > 1 %>s<% end_if %></h2>
					<% loop $ObjectCollections %><a href="$Link">$Title</a><% if not $Last %>, <% end_if %><% end_loop %>
				</div>
				<% end_if %>
				<% if $ObjectMuseums %>
				<div class="span3">
					<h2>Museum<% if $ObjectCollections.Count > 1 %>s<% end_if %></h2>
					<% loop $ObjectMuseums %><a href="$Link">$Title</a><% if not $Last %>, <% end_if %><% end_loop %>
				</div>
				<% end_if %>

			</div>
		</div>
		<% end_with %>
	</article>
		
</div>
<%-- include SideBar --%>