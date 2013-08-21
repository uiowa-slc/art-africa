<div class="content-container typography">
  <h1>$Title</h1>
  <article class="page">
    
    <!-- Layout/Page.ss in the building -->
    <div class="content">$Content</div>
  </article>
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
        <p><img src="$CoverImage.URL" alt=""></p>
        <a class="grid-item-title" href="$Link">$MenuTitle</a>
        <p>$Description</p>
      </div>
    <% end_loop %>
  </div>
<% end_if %>

<%# include SideBar %>
