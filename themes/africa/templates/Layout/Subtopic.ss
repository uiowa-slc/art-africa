<div class="content-container typography">
  <article>
    <h1>$Title</h1>
    <div class="description">
      $Description
    </div>
    <div class="content columns">
       <% loop $getPaginatedPages('EssayPages') %>
        $Content
      <% end_loop %>
    </div>
    
    <% if $getPaginatedPages('EssayPages').MoreThanOnePage %>
      <div class="pagination">
      <% if $getPaginatedPages('EssayPages').NotFirstPage %>
        <a class="prev" href="$getPaginatedPages('EssayPages').PrevLink">Prev</a>
      <% end_if %>
      <% loop $getPaginatedPages('EssayPages').Pages %>
        <% if $CurrentBool %>
          <span>$PageNum</span>
        <% else %>
          <% if $Link %>
            <a href="$Link">$PageNum</a>
          <% else %>
            ...
          <% end_if %>
        <% end_if %>
      <% end_loop %>
      <% if $getPaginatedPages('EssayPages').NotLastPage %>
        <a class="next" href="$getPaginatedPages('EssayPages').NextLink">Next</a>
      <% end_if %>
      </div>
    <% end_if %>
    <!-- Name: $Name<br><br>
    Description: $Description<br><br>
    Tags: $Tags<br><br> -->
  </article>
</div>

<% include SideBar %>
