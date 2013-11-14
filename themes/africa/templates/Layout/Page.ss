<div class="content-container typography">
  <h1>$Title</h1>
    <div class="content">$Content</div>
  $Form
  $PageComments
</div>

<script type="text/javascript">
  $('.open-glossary-popup').magnificPopup({
    type:'inline',
    midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
  });
</script>

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
