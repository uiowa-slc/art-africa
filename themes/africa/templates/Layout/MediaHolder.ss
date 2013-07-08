<div class="content-container typography">
  <article>
    <h1>$Title</h1>
    <div class="content columns">
      <h4>Videos</h4>
      <ul>
      <% loop getObjects('VideoPiece') %>
        <% if Title %>
          <li><a href="$Link(false)">$Title</a></li>
        <% end_if %>
      <% end_loop %>
      </ul>

      <h4>Audio</h4>
      <ul>
      <% loop getObjects('AudioPiece') %>
        <% if Title %>
          <li><a href="$Link(false)">$Title</a></li>
        <% end_if %>
      <% end_loop %>
      </ul>

      <h4>Art Photos</h4>
      <ul>
      <% loop getObjects('ArtPhoto') %>
        <% if Title %>
          <li><a href="$Link(false)">$Title</a></li>
        <% end_if %>
      <% end_loop %>
      </ul>
      
      <h4>Field Photos</h4>
      <ul>
      <% loop getObjects('FieldPhoto') %>
        <% if Title %>
          <li><a href="$Link(false)">$Title</a></li>
        <% end_if %>
      <% end_loop %>
      </ul>
    </div>
  </article>
</div>

<% include SideBar %>
