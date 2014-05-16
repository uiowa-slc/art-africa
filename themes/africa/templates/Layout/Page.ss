<div class="content-container typography">
  <h1 class="hidden-phone">$Title</h1>
    <div class="content">$Content</div>
  $Form
  $PageComments
</div>

<% if $Level(1).Title == 'Chapters' %>
  <div class="grid">
    <% loop ChildrenOf('chapters') %>
      <div class="grid-item">
        <% with $CoverImage.CroppedFocusedImage(300,300) %>
        <p><img src="$URL" alt=""></p>
        <% end_with %>
        <a class="grid-item-title" href="$Link">$MenuTitle</a>
        <p>$Top.Description</p>
      </div>
    <% end_loop %>
  </div>
<% end_if %>

<%-- include SideBar --%>
