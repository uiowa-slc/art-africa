<div class="content-container typography">
  <article class="page">
    <h1>$Title</h1>
    <!-- Layout/Page.ss in the building -->
    <div class="content">$filteredContent</div>
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
        <p><img src="{$ThemeDir}/images/african-vase.jpg" alt=""></p>
        <a class="grid-item-title" href="$Link">$MenuTitle</a>
        <p>$Description</p>
      </div>
    <% end_loop %>
  </div>
<% end_if %>

<%# include SideBar %>
