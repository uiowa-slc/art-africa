    <div class="content" id="essay">
       <% loop $getPaginatedPages('EssayPages') %>
        $Content
      <% end_loop %>
      <% include EssayPagination %>
    </div>

