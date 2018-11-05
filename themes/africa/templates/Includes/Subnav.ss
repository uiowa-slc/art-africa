<%-- for chapter pages --%> <div id="subnav-container"><div id="chapters_heading"> <% if $Action == "SearchForm" %>Search Results<% else %><a href="$Level(1).Link">$Level(1).Title</a><% end_if %> </div><nav class="nav2 interior-page"> <% if $Action =="SearchForm" %> <div id="quick-links-container"><h3><% if $ResultsFound %>Jump To<% end_if %></h3><ul class="quick-links"> <% if $Chapter || $ChapterEssayPage %><li><a href="#chapters">Chapter Results ({$ChapterCount})</a></li><% end_if %> <% if $Subtopic %><li><a href="#subtopics">Subtopics ({$Subtopic.Count})</a></li><% end_if %> <% if $People %><li><a href="#people">People ({$People.Count})</a></li><% end_if %> <% if $TopicEssayPage || $EssayContainer %><li><a href="#topic-essays">Topic Essay Results ($TopicEssayCount)</a></li><% end_if %> <% if $Country %><li><a href="#countries">Countries ({$Country.Count})</a></li><% end_if %> <% if $BibliographyPage %><li><a href="#bibliographic">Bibliographic Entries ({$BibliographyPage.Count})</a></li><% end_if %> <% if $VideoPiece %><li><a href="#videos">Videos ({$VideoPiece.Count})</a></li><% end_if %> <% if $AudioPiece %><li><a href="#audio">Audio ({$AudioPiece.Count})</a></li><% end_if %> <% if Image %><li><a href="#images">Images ({$Image.Count}<% if $Image.Count == 100 %>+<% end_if %>)</a></li><% end_if %> <li><hr><a href="#">Top of the page</a></li><li><button><a href="media/" class="button"><i class="fa fa-search" aria-hidden="true"></i> Advanced search</a></button></li></ul><hr><h3>Search for "{$Query}" on other websites:</h3><ul class="quick-links"><li><a href="http://www.google.com/search?q=site:anthro.amnh.org+$Query" target="_blank">American Museum of Natural History</a></li><li><a href="http://www.google.com/search?q=site:artic.edu+$Query" target="_blank">Art Institute of Chicago</a></li><li><a href="http://www.google.com/search?q=site:artbma.org+$Query" target="_blank">Baltimore Museum of Art</a></li><li><a href="http://www.google.com/search?q=site:barnesfoundation.org+$Query" target="_blank">Barnes Foundation</a></li> <%-- American Museum of Natural History
https://anthro.amnh.org/collections

Art Institute of Chicago
http://www.artic.edu/aic/collections/afr

Baltimore Museum of Art
https://artbma.org/collections/african.html

Barnes Foundation
http://www.barnesfoundation.org/collections/

Birmingham Museum of Art
https://artsbma.org/collection/?fwp_department=african

Bowers Museum
https://goo.gl/bfVzNr

British Museum
http://www.britishmuseum.org/research/collection_online/search.aspx?place=40703

Brooklyn Museum
http://www.brooklynmuseum.org/opencollection/african_art

Cantor Arts Center at Stanford University
https://museum.stanford.edu/collections

Chazen Museum of Art
http://embarkkiosk.chazen.wisc.edu/PRT771?sid=39195&x=2131964&x=2131965

Cleveland Museum of Art
http://www.clevelandart.org/art/departments/african-art

Dallas Museum of Art
https://collections.dma.org/topic/departments/arts-of-africa

De Young Fine Arts Museums of San Francisco
http://deyoung.famsf.org/deyoung/collections/african-art

Denver Art Museum
http://www.denverartmuseum.org/collections/african-art

Detroit Institute of Arts
https://www.dia.org/art/collection?collection%5B0%5D=225

Ethnologisches Museum Berlin
https://goo.gl/tJjkMA

The Field Museum
http://fieldmuseum.org/explore/department/anthropology/africa/collections

Fowler Museum at UCLA
https://www.fowler.ucla.edu/collections/?swoof=1&pa_geographic-region=africa

Harn Museum of Art
http://www.harn.ufl.edu/collections/african

High Museum of Art, Atlanta
https://www.high.org/explore/page/0/?collections=234&

Hood Museum of Art
http://hoodmuseum.dartmouth.edu/explore/collection/africa

Indiana University Art Museum
https://artmuseum.indiana.edu/online/highlights/view/categories/21

Kimbell Art Museum
https://www.kimbellart.org/collections/african-oceanic

Krannert Art Museum and Kinkead Pavillion, U of IL, Urbana-Champaign
http://collection.kam.illinois.edu/Prt294?sid=5998&x=420313&display=th

Los Angeles County Museum of Art
http://collections.lacma.org/search/site/?front=1&f[0]=bm_field_has_image%3Atrue&f[1]=im_field_curatorial_area%3A31

Menil Collection
https://www.menil.org/collection/5049-arts-of-africa

Metropolitan Museum of Art
http://www.metmuseum.org/art/collection#!?perPage=20&geolocation=Africa&sortBy=Relevance&sortOrder=asc&offset=0&pageSize=0

Michael C. Carlos Museum
http://www.digitalgallery.emory.edu/luna/servlet/view/all/?&sort=Classification,Country,Culture,Accession_Number

Minneapolis Institute of Arts
https://collections.artsmia.org/index.php?page=africa#

Musée d’ethnographie de Genève
http://www.ville-ge.ch/meg/musinfo00.php?dpt=ETHAF

Musée du quai Branly – Jacques Chirac
https://goo.gl/uCLFTU

Musée Barbier-Mueller
http://www.barbier-mueller.ch/collections/afrique/?lang=en

Muzej afričke umetnosti (Museum of African Art)
http://www.museumofafricanart.org/en/collections.html

Museum of Fine Arts, Boston
http://www.mfa.org/collections/africa-and-oceania

The Museum of Fine Arts, Houston
http://www.mfah.org/art/collections/arts-of-africa/

Museum Liaunig
http://www.museumliaunig.at/en/collections/akan-gold.html

Nelson-Atkins Museum of Art
http://art.nelson-atkins.org/collections/27499/african-art;jsessionid=385CBBBBF4AF84D423868E42011286E2/objects

Neuberger Museum of Art
http://www.neuberger.org/africanArt.php

Newark Museum
http://www.newarkmuseum.org/AfricanArt.html

New Orleans Museum of Art
https://noma.org/collection/category/african-art/

Peabody Museum of Archaeology and Ethnology
https://www.peabody.harvard.edu/node/199

Princeton University Art Museum
http://www.princetonartmuseum.org/collections/674/view

Rietburg Museum
http://www.rietberg.ch/en-gb/collection/online-collection.aspx

Royal Museum for Central Africa
http://www.africamuseum.be/collections/browsecollections/humansciences/advanced_combined_search

Royal Ontario Museum
http://images.rom.on.ca/advancedsearch/objects/geography%3AAfrica

Saint Louis Art Museum
http://www.slam.org/Collections/african.php

Seattle Art Museum
http://art.seattleartmuseum.org/collections/92383/african-art/objects

Smithsonian National Museum of African Art
https://africa.si.edu/collections/

Smithsonian National Museum of Natural History
https://collections.nmnh.si.edu/search/anth/

Society of African Missions – African Art Museum
http://smafathers.org/museum/

University of Michigan Museum of Art
https://goo.gl/pxw5z2

University of Iowa Museum of Art
https://goo.gl/qwYexz

University of Pennsylvania Museum of Archaeology and Anthropology
http://www.penn.museum/about-our-collections/african-section.html

Virginia Museum of Fine Arts
http://vmfa.museum/collections/african-art/

Weltkulturen Museum Munich
http://www.weltkulturenmuseum.de/en/collections/africa

Yale University Art Gallery
http://artgallery.yale.edu/african-art

Zeitz Museum of Contemporary Art Africa
https://zeitzmocaa.museum/ --%> </ul></div> <% end_if %> <ul class="$URLSegment"> <%-- Chapters --%> <% if $Level(1).Title == 'Chapters' %> <% include Subnav__Chapters %> <% end_if %> <%-- Countries --%> <% if $Level(1).Title == 'Countries' %> <% include Subnav__Countries %> <% end_if %> <%-- Peoples --%> <% if $Level(1).Title == 'Peoples' %> <% include Subnav__Peoples %> <% end_if %> <%-- Media --%> <% if $Level(1).Title == 'Media' %> <% include Subnav__Media %> <% end_if %> <%-- Video --%> <% if $Level(1).Title == 'Video' %> <% include Subnav__Video %> <% end_if %> <%-- Audio --%> <% if $Level(1).Title == 'Audio' %> <% include Subnav__Audio %> <% end_if %> <%-- ArtPhotos --%> <% if $Level(1).Title == 'Art Photos' %> <% include Subnav__ArtPhotos %> <% end_if %> <%-- Field Essays (refered to on front end as topic essays)--%> <% if $Level(1).Title == 'Topic Essays' %> <% include Subnav__TopicEssays %> <% end_if %> <%-- Bibliogrpahy --%> <% if $Level(1).Title == 'About' %> <% loop ChildrenOf('about') %> <% include Subnav__About %> <% end_loop %> <% end_if %> </ul> <% if $Level(1).Title == "Media" %> <a href="media/" class="button button--full button--dark">Clear all filters <i class="fa fa-times search-form" aria-hidden="true"></i></a> <% end_if %> </nav></div>