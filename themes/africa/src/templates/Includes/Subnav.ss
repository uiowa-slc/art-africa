
  <%-- for chapter pages --%>
  <div id="subnav-container">
    <div id="chapters_heading">
      <% if $Action == "SearchForm" %>Search Results<% else %><a href="$Level(1).Link">$Level(1).Title</a><% end_if %> 
    </div><!-- end chapters_heading -->
    <nav class="nav2 interior-page">
      <% if $Action =="SearchForm" %>
        <div id="quick-links-container">
          <h3><% if $ResultsFound %>Jump To<% end_if %></h3>
          <ul class="quick-links">
            <% if Image %><li><a href="#images">Images ({$Image.Count})</a></li><% end_if %>
            <% if VideoPiece %><li><a href="#videos">Videos ({$VideoPiece.Count})</a></li><% end_if %>
            <% if AudioPiece %><li><a href="#audio">Audio ({$AudioPiece.Count})</a></li><% end_if %>
            <% if Subtopic %><li><a href="#subtopics">Subtopics ({$Subtopic.Count})</a></li><% end_if %>
            <% if People %><li><a href="#people">People ({$People.Count})</a></li><% end_if %>
            <% if Essay %><li><a href="#essays">Essays ({$Essay.Count})</a></li><% end_if %>
            <% if Country %><li><a href="#countries">Countries ({$Country.Count})</a></li><% end_if %>
            <% if BibliographyPage %><li><a href="#bibliographic">Bibliographic Entries ({$BibliographyPage.Count})</a></li><% end_if %>
            <li><hr /><a href="#">Top of the page</a></li>
            <li><button><a href="media/" class="button"><i class="fa fa-search" aria-hidden="true"></i> Advanced search</a></button></li>
          </ul>
        </div><!-- end quick-links-container -->
      <% end_if %>
      <ul class="$URLSegment">
        <%-- Chapters --%>
        <% if $Level(1).Title == 'Chapters' %>
          <% include Subnav__Chapters %>
        <% end_if %>

        <%-- Countries --%>
        <% if $Level(1).Title == 'Countries' %>
          <% include Subnav__Countries %>
        <% end_if %>

        <%-- Peoples --%>
        <% if $Level(1).Title == 'Peoples' %>
          <% include Subnav__Peoples %>
        <% end_if %>

        <%-- Media --%>
        <% if $Level(1).Title == 'Media' %>
          <% include Subnav__Media %>
        <% end_if %>

        <%-- Video --%>
        <% if $Level(1).Title == 'Video' %>
          <% include Subnav__Video %>
        <% end_if %>

        <%-- Audio --%>
        <% if $Level(1).Title == 'Audio' %>
          <% include Subnav__Audio %>
        <% end_if %>

        <%-- ArtPhotos --%>
        <% if $Level(1).Title == 'Art Photos' %>
          <% include Subnav__ArtPhotos %>
        <% end_if %>

        <%-- Field Essays (refered to on front end as topic essays)--%>
        <% if $Level(1).Title == 'Topic Essays' %>
          <% include Subnav__TopicEssays %>
        <% end_if %>
     
        <%-- Bibliogrpahy --%>
        <% if $Level(1).Title == 'About' %>
          <% loop ChildrenOf('about') %>
            <% include Subnav__About %>
          <% end_loop %>
        <% end_if %>
    </ul>
    <% if $Level(1).Title == "Media" %>
      <a href="media/" class="button button--full button--dark">Clear all filters <i class="fa fa-times search-form" aria-hidden="true"></i></a>
    <% end_if %>
  </nav>
  </div>
