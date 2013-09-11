A few Art And Life In Africa notes: 

Most of the classes on the site are related to many other classes.  Check the tabs of a page type or data object to access the grid fields used to manage each relation.  In the case these gridfields need to be edited, they are either in the AfricaDataObjectExtension class or the getCMSFields method for that page type.

Outside of chapters and subtopics, most of the content is stored in DataObjects and rendered via the show method of that class's holder.

The naming format is <name of class>Holder for the appropriate holders of each class.  Make sure to keep in mind that Videos are VideoPieces (thus VideoPieces are stored within VideoPieceHolders)

Images have relationships with Peoples and Countries via the ImageExtension defined in ImageExtension.php.  

Keyword functionality was planned via the Word and Glossary classes.  That functionality doesn't work with other functionality that uses popups, so at present, those classes aren't used on the site.

The site uses short codes to handle images inserted within the HTMLText content of chatpers, subtopics or essays. Those short code handlers can be found in Page.php.  

Possibly confusingly, the pages of an Essay are each separate DataObjects.  This was done to allow ALA staff exact control over page breaks. 

