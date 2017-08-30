<?php
class Page extends SiteTree {

	private static $db = array(
		/*"Keywords" => "Text" */
	);

	private static $has_one = array(
	);

	//static $searchable_fields = array('Keywords', 'Content', 'Title');


}


class Page_Controller extends ContentController {

	/**
	 * An array of actions that can be accessed via a request. Each array element should be an action name, and the
	 * permissions or conditions required to allow the user to access it.
	 *
	 * <code>
	 * array (
	 *     'action', // anyone can access this action
	 *     'action' => true, // same as above
	 *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
	 *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
	 * );
	 * </code>
	 *
	 * @var array
	 */
	private static $allowed_actions = array (
		"queryTest",
		"SplitKeywords",
		"results",
		'show',
		'loadTest',
	);

	public function getLatitudeLongitude() {
		$countries = Country::get();
		return $countries;
	}

	public function init() {
		parent::init();

		$themeFolder = $this->ThemeDir();
		// Requirements::set_combined_files_folder( $themeFolder . '/_combinedfiles' );

		$jsFiles = array(
			$themeFolder.'/javascript/jquery-1.9.1.min.js',
			$themeFolder.'/javascript/jquery.magnific-popup.min.js',
			$themeFolder.'/javascript/jquery.sticky.js',
			$themeFolder. '/javascript/jquery.infinitescroll.js',
			$themeFolder. '/javascript/jquery.isotope.min.js',
			$themeFolder. '/javascript/isotope-init.js',
			$themeFolder. '/javascript/mediaelement/build/mediaelement-and-player.min.js',
			$themeFolder. '/javascript/jquery.placeholder.js',
			$themeFolder. '/javascript/jquery.placeholder-init.js',
			$themeFolder. '/javascript/script.js'

		);

		$cssFiles = array(
			$themeFolder. '/css/normalize.min.css',
			$themeFolder. '/css/bootstrap.min.css',
			$themeFolder. '/css/bootstrap-tables.css',
			$themeFolder. '/css/layout.css',
			$themeFolder. '/css/magnific-popup.css',
			$themeFolder. '/javascript/mediaelement/build/mediaelementplayer.css',
			$themeFolder. '/font-awesome-4.6.3/css/font-awesome.min.css'
		);

		// Requirements::combine_files( 'allcombined.js', $jsFiles );
		// Requirements::combine_files( "combinedCSS.css", $cssFiles );

	}


	/**
	 * IMPORTANT!!!
	 * Create custom search results when a user searches.  Pages and data object arrays are combined to form the final result array
	 */


	function results( $data, $form, $request ) {
		$keyword = trim( $request->requestVar( 'Search' ) );
		$keyword = Convert::raw2sql( $keyword );
		$keywordArray = explode( " ", $keyword );
		$keywordHTML = htmlentities( $keyword, ENT_NOQUOTES, 'UTF-8' );

		$resultsFound = false;

		$pages = new ArrayList(); //Output these to template
		$dataObjects = new ArrayList(); //Output these to template

		$bibliographyFlag = false; //set to true below if checkbox in searchform.ss is checked
		$chapters = new ArrayList();
		$subtopics = new ArrayList();
		$people = new ArrayList();
		$essays = new ArrayList();
		$essayContainers = new ArrayList();
		$essayPages = new ArrayList();
		$countries = new ArrayList();
		$audioPieces = new ArrayList();
		$videoPieces = new ArrayList();

		$images = new ArrayList();

		$photos = new ArrayList();
		$biblographyPages = new ArrayList();

		$chapterCount = 0;
		$topicEssayCount = 0;
		if($keyword == ''){
			$data = array(
				'Query' => false
			);
			return $this->customise( $data )->renderWith( array( 'Search', 'Page' ) );
		}

		//Search happens here:
		$images = Image::get()->filterAny(array(
		    'Title:PartialMatch' =>  $keyword,
		    'Caption:PartialMatch' => $keyword,
		    'Photographer:PartialMatch' => $keyword,
		    'Description:PartialMatch' => $keyword
		))->filter(array(
			'HideFromMediaGrid' => false,
			'AltImage' => false
		));


		$videoPieces = VideoPiece::get()->filterAny(array(
		    'Title:PartialMatch' =>  $keyword,
		    'Caption:PartialMatch' => $keyword,
		    'Tags:PartialMatch' => $keyword,
		    'Description:PartialMatch' => $keyword
		));

		$audioPieces = AudioPiece::get()->filterAny(array(
		    'Title:PartialMatch' =>  $keyword,
		    'Caption:PartialMatch' => $keyword,
		    'Tags:PartialMatch' => $keyword,
		    'Description:PartialMatch' => $keyword
		));

		$countries = Country::get()->filterAny(array(
		    'Title:PartialMatch' =>  $keyword
		));

		//Get essays and their containers

		$essayContainers = Essay::get()->filterAny(array(
			'AuthorFirstName:PartialMatch' => $keyword,	
			'AuthorLastName:PartialMatch' => $keyword,
			'Content:PartialMatch' => $keyword,	
			'University:PartialMatch' => $keyword,	
			'Consultant:PartialMatch' => $keyword,	
			'Title:PartialMatch' => $keyword,	
			'Tags:PartialMatch' => $keyword
		));

		$essayPages = EssayPage::get()->filterAny(array(
			'Content:PartialMatch' => $keyword,
		));

		$topicEssayPages = $essayPages->filter(array(
			'EssayID:GreaterThan' => 0
		));

		$chapterEssayPages = $essayPages->filterAny(array(
			'ChapterID:GreaterThan' => 0,
			'SubtopicID:GreaterThan' => 0
		));

		// print_r($chapterEssayPages->toArray());
		// print_r($topicEssayPages->toArray());

		$chapters = Chapter::get()->filterAny(array(
			'Title:PartialMatch' => $keyword,
			'Description:PartialMatch' => $keyword,
			'Author:PartialMatch' => $keyword,
			'University:PartialMatch' => $keyword,
			'Tags:PartialMatch' => $keyword
		));

		$subtopics = Subtopic::get()->filterAny(array(
			'Title:PartialMatch' => $keyword,
			'Content:PartialMatch' => $keyword,
			'Description:PartialMatch' => $keyword,
			'Tags:PartialMatch' => $keyword
		));

		$people = People::get()->filterAny(array(
		  'Title:PartialMatch' => $keyword,
		  'AlternateNames:PartialMatch' => $keyword,
		  'Location:PartialMatch' => $keyword,
		  // 'Languages:PartialMatch' => $keyword,
		  // 'Population:PartialMatch' => $keyword,
		  // 'Neighbors:PartialMatch' => $keyword,
		  // 'TypesOfArt:PartialMatch' => $keyword,
		  // 'History:PartialMatch' => $keyword,
		  // 'Economy:PartialMatch' => $keyword,
		  // 'PoliticalSystems:PartialMatch' => $keyword,
		  // 'Religion:PartialMatch' => $keyword,
		  // 'Tags:PartialMatch' => $keyword
		));

		$biblographyPages = BibliographyPage::get()->filterAny(array(
	  	  'Content:PartialMatch' => $keyword,
		  'Description:PartialMatch' => $keyword

		));

		if($chapters->First() 
			|| $subtopics->First() 
			|| $people->First()
			|| $essayContainers->First()
			|| $chapterEssayPages->First()
			|| $topicEssayPages->First()
			|| $countries->First()
			|| $audioPieces->First()
			|| $videoPieces->First()
			|| $images->First()
			|| $biblographyPages->First()
		){
			$resultsFound = true;
		}

		
		$chapterCount = $chapters->Count() + $chapterEssayPages->Count();
		$topicEssayCount = $topicEssayPages->Count() + $essayContainers->Count();


	
		$searchText =  _t('SearchForm.SEARCH', 'Search');

		if($this->getRequest() && $this->getRequest()->getVar('Search')) {
		 $searchText = $this->getRequest()->getVar('Search');
		}

		$searchField = new TextField('Search', false, 'hellur');
	
		$fields = new FieldList(
		 $searchField
		);
		$actions = new FieldList(
		 new FormAction('results', _t('SearchForm.GO', 'Go'))
		);
		$form = SearchForm::create($this, 'SearchForm', $fields, $actions);
		$form->classesToSearch(FulltextSearchable::get_searchable_classes());

		/*THIS ARRAY IS WHAT THE SEARCH TEMPLATE IS CUSTOMISED WITH*/
		$data = array(
			'Chapter' => $chapters,
			'Subtopic' => $subtopics,
			'People' => $people,
			'EssayContainer' => $essayContainers,
			'ChapterEssayPage' => $chapterEssayPages,
			'TopicEssayPage' => $topicEssayPages,
			'TopicEssayCount' => $topicEssayCount,
			'ChapterCount' => $chapterCount,
			'Country' => $countries,
			'AudioPiece' => $audioPieces,
			'VideoPiece' => $videoPieces,
			'Image' => $images,
			'Query' => $keyword,
			'BibliographyPage' => $biblographyPages,
			'ResultsFound' => $resultsFound,
			'SearchFormPage' => $form
		);

		return $this->customise( $data )->renderWith( array( 'Search', 'Page' ) );
	}
	/*TEMPLATE FUNCTIONS*/

	//Get a holder.  HolderType passed through in template
	public function getHolderLink( $holderType ) {
		$holderLink = $holderType::get()->First()->Link();
		return $holderLink;
	}


	//Get a DataList for an object type.  Object type passed through in template
	public function getObjects( $type ) {

		if ( $type == 'Essay' ) {
			$desiredDataList = $type::get()->sort( 'AuthorLastName' );

		}else {
			$desiredDataList = $type::get()->sort( 'Title' );
		}


		return $desiredDataList;
	}


	public function getPaginatedPages( $relation ='EssayPages' ) {
		if($this->getComponents($relation)->exists()){
			$list = new PaginatedList( $this->$relation(), $this->request );
			$list->setPageLength( 1 );
			return $list;
		} else{
		//	echo "false";
			return false;
		}
	}


	//Filters a field for glossary terms.  Returns content of page with words that appear in glossary as hypertext
	public function filteredField( $field, $ID, $class ) {

		$object = DataObject::get_by_id( $class, $ID );
		$pageContent = $object->$field;
		$wordArray = Word::get();
		$iter = 0;

		//IDs for the glossary boxes that pop up are generated using semantically meaningless IDs (Word2, Word3) instead of the actual word to keep it from interfering with the string replacement
		foreach ( $wordArray as $word ) {
			$iter++;
			$allLowerCaseWord = strtolower( $word->Word );
			$wordID = $word->ID;
			$newHTML = '<span id="' . 'word' . $iter . '" class="white-popup mfp-hide">' . $word->Definition . "</span>";
			$newHTML .= '<a class="open-glossary-popup" data-mfp-src="#' . 'word' . $iter . '">' . $allLowerCaseWord . '</a>';
			$pageContent = str_replace( $allLowerCaseWord, $newHTML, $pageContent );

			$firstLetterUpperWord = ucwords( $word->Word );
			$newHTML = '<span id="' . $word->Word . '" class="white-popup mfp-hide">' . $word->Definition . "</span>";
			$newHTML .= '<a class="open-glossary-popup" data-mfp-src="#' . $word->Word . '">' . $firstLetterUpperWord . '</a>';
			$pageContent = str_replace( $firstLetterUpperWord, $newHTML, $pageContent );

		}





		return $pageContent;
	}


	//Displays a data object of the class childPage, which is found in the controller of the holder class show is called on
	public function show( $request ) {

		$otherClass = $this::$childPage;
		$objectID = Convert::raw2xml( $this->request->param( 'ID' ) );
		$source = $this->request->getVar( 'back' );
		$source = preg_replace("(^https?://)", "", $source );

		//We can '/show/ID' or '/show/object+name'
		if ( $objectID ) {
			if ( is_numeric( $objectID ) ) {
				$object = $otherClass::get_by_id( $otherClass, $objectID );
			}else {
				$object = $otherClass::get( $otherClass )->filter( 'Title', urldecode($objectID))->first();
			}

			if ( $object ) {

				$showTemplate = $otherClass . 'Holder_show';
				if ( !isset( $source ) ) {
					$data = array (
						"Object" => $object,
					);
				}else {
					$data = array (
						"Object" => $object,
						"Source" => $source
					);
				}

				if(($object->ClassName == "Image") &&  ($object->ParentImage())){
					$parent = $object->ParentImage();
					$this->redirect($parent->ShowLink());
				}

				return $this->Customise( $data )->renderWith( array( $showTemplate, 'Page' ) );
			}else {
				// If Object isn't set/found, return a 404 error.
				$this->httpError( 404 );
			}
		}
		else {
			return $this->renderWith( 'Page' );
		}


	}

	public function search() {
		if ( $this->request && $this->request->requestVar( 'Search' ) ) {
			$searchText = $this->request->requestVar( 'Search' );
		}else {
			$searchText = 'Search';
		}

		$f = new TextField( 'Search', false, $searchText );

		$fields = new FieldList(
			$f
		);
		$actions = new FieldList(
			new FormAction( 'results', 'Go' )
		);
		$form = new Form(
			$this,
			'search',
			$fields,
			$actions
		);
		//$form->disableSecurityToken();
		$form->setFormMethod( 'GET' );
		$form->setTemplate( 'SearchForm' );

		return $form;
	}




	public function queryTest() {
		$query = new SearchQuery();

		$query->search( 'Cone', 'SiteTree_Title' );
		$results = singleton( 'MyIndex' )->search( $query );
		return;
	}



	static public function imageHandler( $arguments ) {

		//ID actually points to title attribute
		if ( isset( $arguments["ID"] ) ) {
			$photoID = $arguments["ID"];
			$photoID = strtoupper( $photoID );
		}
		else {
			return;
		}
		$photoObject = Image::get()->filter( array( 'Title' => $photoID ) )->First();

		if ( $photoObject ) {
			$template = new SSViewer( 'EmbeddedImage' );
			return $template->process( $photoObject );
		}
		else {

			return;
		}

	}

	static public function videoHandler( $arguments ) {
		//ID actually points to title attribute
		if ( isset( $arguments["ID"] ) ) {
			$videoID = $arguments["ID"];
			$videoID = strtoupper( $videoID );
		}
		else {
			return;
		}
		$videoObject = VideoPiece::get()->filter( array( 'Title' => $videoID ) )->First();

		if ( $videoObject ) {
			$template = new SSViewer( 'EmbeddedVideoPiece' );
			return $template->process( $videoObject );
		}
		else {

			return;
		}


	}
	static public function audioHandler( $arguments ) {
		//ID actually points to title attribute
		if ( isset( $arguments["ID"] ) ) {
			$audioID = $arguments["ID"];
			$audioID = strtoupper( $audioID );
		}
		else {
			return;
		}
		$audioObject = AudioPiece::get()->filter( array( 'Title' => $audioID ) )->First();

		if ( $audioObject ) {
			$template = new SSViewer( 'EmbeddedAudioPiece' );
			return $template->process( $audioObject );
		}
		else {

			return;
		}


	}

	static public function shortCodeHandler( $arguments, $class ) {
		if ( isset( $arguments["ID"] ) ) {
			$photoID = $arguments["ID"];
		}
		else {
			return;
		}

		$photoObject = DataObject::get_by_id( $class, $photoID );
		$newObject = $photoObject->toMap();
		$newObject = new ArrayData( $newObject ); //cast to array that can be displayed on template

		if ( isset( $arguments["size"] ) ) {
			$newObject->setField( 'size', $arguments["size"] . 'Image' ); //size is (for instance) medium, CSS class for sizing the image in the template is mediumImage
		}
		else {
			$customise['size'] = 'normal';
		}

		$template = new SSViewer( $class );

		$picture = $photoObject->Picture();
		$newObject->setField( 'filename', $picture->getFilename() );

		return $template->process( $newObject );
	}

	public function loadTest() {
		for ( $iter = 0; $iter <= 100; $iter++ ) {
			$artPhoto = ArtPhoto::get()->byID( 7 );
			$newPhoto = $artPhoto->duplicate();

		}
		return $this->renderWith( 'Page' );


	}
}
