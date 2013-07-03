<div class="content-container typography">
  <article class="page">
    <h1>$Title</h1>
    Layout/Page.ss in the building
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
  <ul class="columns">
    <% loop ChildrenOf('chapters') %>
      <li>
        <a href="$Link">$MenuTitle</a>
        <p>$Description</p>
      </li>
    <% end_loop %>
  </ul>
<% end_if %>

<% include SideBar %>
