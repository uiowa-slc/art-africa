    <div class="content" id="essay">
       <% loop $getPaginatedPages %>
        $Content
      <% end_loop %>
      <% include EssayPagination %>
    </div>

