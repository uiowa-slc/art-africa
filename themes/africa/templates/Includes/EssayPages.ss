    <div class="content columns" id="essay">
       <% loop $getPaginatedPages('EssayPages') %>
        $Content
      <% end_loop %>
          <% include EssayPagination %>

    </div>

