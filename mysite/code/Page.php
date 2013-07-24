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
		'loadTest'
	);



	public function init() {
		parent::init();
		
		$themeFolder = $this->ThemeDir();
		Requirements::set_combined_files_folder($themeFolder . '/combinedfiles');
		
		$jsFiles = array(
			$themeFolder.'/javascript/jquery.magnific-popup.min.js',
			$themeFolder.'/javascript/jquery.sticky.js',
			$themeFolder. '/javascript/script.js'
		);
		
		$cssFiles = array(
			$themeFolder. '/css/layout.css',
			$themeFolder. '/css/magnific-popup.css'
		);
		
		Requirements::combine_files('allcombined.js',$jsFiles);
		Requirements::combine_files("combinedCSS.css", $cssFiles);	
	}


	/**
	 * Create custom search results when a user searches
	 */


	function results($data, $form, $request) {


		$keyword = trim($request->requestVar('Search'));
		$keyword = Convert::raw2sql($keyword);

		$keywordArray = explode(" ", $keyword);


		$keywordHTML = htmlentities($keyword, ENT_NOQUOTES, 'UTF-8');

		$pages = new ArrayList(); //Output these to template
		$dataObjects = new ArrayList(); //Output these to template


		$bibliographyFlag = false; //set to true below if checkbox in searchform.ss is checked

		//$searchedClasses = array('subtopics', 'people', 'essays', 'countries', 'audio pieces', 'video pieces', 'art photos', 'field photos'
		//Define classes for outputting to template
		$subtopics = new ArrayList();
		$people = new ArrayList();
		$essays = new ArrayList();
		$countries = new ArrayList();
		$audioPieces = new ArrayList();
		$videoPieces = new ArrayList();

		$artPhotos = new ArrayList();
		$fieldPhotos = new ArrayList();

		$photos = new ArrayList();
		$photos = new ArrayList();


		$data = array(
			'Subtopic' => $subtopics,
			'People' => $people,
			'Essay' => $essays,
			'Country' => $countries,
			'AudioPiece' => $audioPieces,

			'ArtPhoto' => $artPhotos,
			'FieldPhoto' => $fieldPhotos,
			'Query' => $keyword
		);

		/*ADD IN CLASSES TO BE SEARCHED HERE */
		$siteTreeClasses = array('Chapter', 'Subtopic'); //add in an classes that extend Page or SiteTree
		$dataObjectClasses = array('Country', 'Essay', 'People', 'ArtPhoto', 'FieldPhoto'); //add in your DataObjects,
	


		$bibliographyClasses = array('Essay', 'MediaPiece'); //add classes with the Bibliography field

		//When the bibliography check box is checked, only search classes that have the Bibliography field + Essays
		if ($request->requestVar('Search_Bibliography')) {
			$siteTreeClasses = array_intersect($bibliographyClasses, $siteTreeClasses);
			$dataObjectClasses = array_intersect($bibliographyClasses, $dataObjectClasses);

			$bibliographyFlag = true; //bibliography search
		}
		
		

		$objects = array();

		foreach ( $siteTreeClasses as $c ) {
			$siteTreeMatch = $this->getItemMatch($c, $request, $keywordArray, $keywordHTML, 'Title, MenuTitle, ', $bibliographyFlag); //This function is in Page.php
			$query = DataList::create($c)
			// ->filter(array('RootLanguageParentID' => $this->RootLanguageParentID))
			->where($siteTreeMatch);

			$query = $query->dataQuery()->query();

			$query->addSelect(array('Relevance' => $siteTreeMatch));


			$records = DB::query($query->sql());


			//$objects = array();
			foreach ( $records as $record ) {

				if ( in_array($record['ClassName'], $siteTreeClasses) )
					$objects[] = new $record['ClassName']($record);
			}


			$pages->merge($objects);
		}


		/*
	     *  DataObjects
	     */

		foreach ($dataObjectClasses as $c) {
			
			$dataObjectsItemMatch = $this->getItemMatch($c, $request, $keywordArray, $keywordHTML, '', $bibliographyFlag); //This function is in Page.php

			$query = DataList::create($c)->where($dataObjectsItemMatch);

			$query = $query->dataQuery()->query();


			$query->addSelect(array('Relevance' => $dataObjectsItemMatch));

			$records = DB::query($query->sql());


			foreach ( $records as $record ) $objects[] = new $record['ClassName']($record);

			$dataObjects->merge($objects);
		}

		foreach ($objects as $object) {
			foreach ($data as $key=>$value) {
				if ($object->ClassName == $key) {
					$value->push($object);
				}
			}
		}




		$pages->sort(array(
				'Relevance' => 'DESC',
				'Title' => 'ASC'
			));
		$dataObjects->sort(array(
				'Relevance' => 'DESC',
				'Date' => 'DESC'
			));

		/*
	    $data = array(
	      'Pages' => $pages,
	       'Files' => $files,
	     'DataObjects' => $dataObjects,
				'Query' => $keyword
			);
		*/

		if ( $pages->count() == 0
			&& $dataObjects->count() == 0
			/* && $files->count() == 0 */) {
			$data['NoResults'] = 1;
		}
		/*
	    foreach($data as $dataKey => $dataValue){
		      print_r($data[$dataKey]);
		      print_r("<br><br><br>");
	    }
	      return;
	     */


		return $this->customise($data)->renderWith(array('Search', 'Page'));
	}


	public function performQuery($classes, $objects, $request, $keywordArray, $extraFields, $bibliographyFlag = false) {
		foreach ($classes as $c) {
			$ItemMatch = $this->getItemMatch($c, $request, $keywordArray, $keywordHTML, ''); //This function is in Page.php

			$query = DataList::create($c)->where($ItemMatch);

			$query = $query->dataQuery()->query();


			$query->addSelect(array('Relevance' => $ItemMatch));

			$records = DB::query($query->sql());


			$objects = array();
			foreach ( $records as $record ) $objects[] = new $record['ClassName']($record);

			$dataObjects->merge($objects);
		}

	}


	/*Returns SQL for searching through DataObjects and Pages in the results function*/

	public function getItemMatch($class, $request, $keywordArray, $keywordHTML, $resultString = '', $bibSearch = false) {

		
		$fields = DataObject::custom_database_fields($class);
		
		//Both Art Photo and Field Photo extend from Photo, so if that class is getting searched, get those fields
	
		if (($class == 'ArtPhoto') || ($class == 'FieldPhoto')){
			$photoFields = DataObject::custom_database_fields('Photo');
			$fields = array_merge($fields, $photoFields);
		}
		
		$count = count($fields);
		$iter = 0;

		$resultString = '';
		//return $resultString;

		if ($fields) {
			foreach ($fields as $fieldValue => $fieldType) {
				foreach ($keywordArray as $keyword) {
					$keyword = trim($keyword);
					if ($iter == 0) {
						$resultString = $fieldValue . ' LIKE ' . "'%" . $keyword. "%'";
						$iter++;
						continue;
					}

					if ($iter != $count) {
						$resultString .= ' OR ' . $fieldValue . ' LIKE ' . "'%" . $keyword. "%'";

					}
					$iter++;
				}
			}
			$resultString .= ' ';
		}



		$mode = ' IN BOOLEAN MODE';

		/*$returnedString = "MATCH(" . $resultString . " ) AGAINST ('$keyword'$mode)
                    + MATCH(" . $resultString . " ) AGAINST ('$keywordHTML'$mode)";*/
		//$returnedString = 'CONCAT(' . $resultString . ") LIKE ('$keyword')";


		return $resultString;
	}


	/*TEMPLATE FUNCTIONS*/

	//Get a holder.  HolderType passed through in template
	public function getHolderLink($holderType) {
		$holderLink = $holderType::get()->First()->Link();
		return $holderLink;
	}


	//Get a DataList for an object type.  Object type passed through in template
	public function getObjects($type) {
		$desiredDataList = $type::get();
		return $desiredDataList;
	}


	public function getPaginatedPages($relation) {
		$list = new PaginatedList($this->$relation(), $this->request);
		$list->setPageLength(1);
		return $list;
	}


	//Filters a field for glossary terms.  Returns content of page with words that appear in glossary as hypertext
	public function filteredField($field, $ID, $class) {

		$object = DataObject::get_by_id($class, $ID);
		//print_r($object);
		$pageContent = $object->$field;
		$wordArray = Word::get();
		$iter = 0;

		//IDs for the glossary boxes that pop up are generated using semantically meaningless IDs (Word2, Word3) instead of the actual word to keep it from interfering with the string replacement
		foreach ($wordArray as $word) {
			$iter++;
			$allLowerCaseWord = strtolower($word->Word);
			$wordID = $word->ID;
			$newHTML = '<span id="' . 'word' . $iter . '" class="white-popup mfp-hide">' . $word->Definition . "</span>";
			$newHTML .= '<a class="open-glossary-popup" data-mfp-src="#' . 'word' . $iter . '">' . $allLowerCaseWord . '</a>';
			$pageContent = str_replace($allLowerCaseWord, $newHTML, $pageContent);

			$firstLetterUpperWord = ucwords($word->Word);
			$newHTML = '<span id="' . $word->Word . '" class="white-popup mfp-hide">' . $word->Definition . "</span>";
			$newHTML .= '<a class="open-glossary-popup" data-mfp-src="#' . $word->Word . '">' . $firstLetterUpperWord . '</a>';
			$pageContent = str_replace($firstLetterUpperWord, $newHTML, $pageContent);

		}





		return $pageContent;
	}


	//Displays a data object of the class childPage, which is found in the controller of the holder class show is called on
	public function show() {
	
		$otherClass = $this::$childPage;
		$objectID = Convert::raw2xml($this->request->param('ID'));
		//We can '/show/ID' or '/show/object+name'
		if ($objectID) {
			if (is_numeric($objectID)) {
				$object = $otherClass::get_by_id($otherClass, $objectID);
			}else {
				$object = $otherClass::get($otherClass)->filter('Title', $objectID)->first();
			}
	
			if ($object) {
				$showTemplate = $otherClass . 'Holder_show';
				// print_r("THIS SHOW IS CALLED");
				// print_r($object);
				return $this->Customise($object)->renderWith(array($showTemplate, 'Page'));

			}else {
				// If Object isn't set/found, return a 404 error.
				$this->httpError(404);
			}
		}
		else {
			return $this->renderWith('Page');
		}


	}




	public function search() {
		if ($this->request && $this->request->requestVar('Search')) {
			$searchText = $this->request->requestVar('Search');
		}else {
			$searchText = 'Search';
		}

		$f = new TextField('Search', false, $searchText);

		$fields = new FieldList(
			$f
		);
		$actions = new FieldList(
			new FormAction('results', 'Go')
		);
		$form = new Form(
			$this,
			'search',
			$fields,
			$actions
		);
		//$form->disableSecurityToken();
		$form->setFormMethod('GET');
		$form->setTemplate('SearchForm');

		return $form;
	}




	public function queryTest() {
		$query = new SearchQuery();

		$query->search('Cone', 'SiteTree_Title');
		//print_r($query);
		$results = singleton('MyIndex')->search($query);
		print_r($results);
		//sleep(5);
		//print_r("HI");
		return;
	}


	public function fieldPhotoHandler($arguments) {

		if (isset($arguments["ID"])) {
			$photoID = $arguments["ID"];
		}
		else {
			return;
		}
		
		$photoObject = DataObject::get("FieldPhoto")->filter(array('PhotoID' => $photoID))->First();

		if ($photoObject){
		
			//$photoObject = ArtPhoto::get()->filter(array()
			$newObject = $photoObject->toMap();
			$newObject = new ArrayData($newObject); //cast to array that can be displayed on template
	
			if (isset($arguments["size"])) {
				$newObject->setField('size', $arguments["size"] . 'Image'); //size is (for instance) medium, CSS class for sizing the image in the template is mediumImage
			}
			else {
				$newObject->setField('size', 'mediumImage');
			}
	
			$template = new SSViewer('FieldPhoto');
	
			$picture = $photoObject->Picture();
			$newObject->setField('filename', $picture->getFilename());
	
			return $template->process($newObject);
		}
		else {

			return;
		}
	}


	public function artPhotoHandler($arguments) {
		if (isset($arguments["ID"])) {
			$photoID = $arguments["ID"];
		}
		else {
			return;
		}

		//$photoObject = DataObject::get_by_id("ArtPhoto", $photoID);		
		$photoObject = DataObject::get("ArtPhoto")->filter(array('PhotoID' => $photoID))->First();
		
		if ($photoObject){
		
			//$photoObject = ArtPhoto::get()->filter(array()
			$newObject = $photoObject->toMap();
			$newObject = new ArrayData($newObject); //cast to array that can be displayed on template
	
			if (isset($arguments["size"])) {
				$newObject->setField('size', $arguments["size"] . 'Image'); //size is (for instance) medium, CSS class for sizing the image in the template is mediumImage
			}
			else {
				$newObject->setField('size', 'mediumImage');
			}
	
			$template = new SSViewer('ArtPhoto');
	
			$picture = $photoObject->Picture();
			$newObject->setField('filename', $picture->getFilename());
	
			return $template->process($newObject);
		}
		else {

			return;
		}

	}


	public function shortCodeHandler($arguments, $class) {
		if (isset($arguments["ID"])) {
			$photoID = $arguments["ID"];
		}
		else {
			return;
		}

		$photoObject = DataObject::get_by_id($class, $photoID);
		$newObject = $photoObject->toMap();
		$newObject = new ArrayData($newObject); //cast to array that can be displayed on template

		if (isset($arguments["size"])) {
			$newObject->setField('size', $arguments["size"] . 'Image'); //size is (for instance) medium, CSS class for sizing the image in the template is mediumImage
		}
		else {
			$customise['size'] = 'normal';
		}

		$template = new SSViewer($class);

		$picture = $photoObject->Picture();
		$newObject->setField('filename', $picture->getFilename());

		return $template->process($newObject);
	}


	public function loadTest() {
		for ($iter = 0; $iter <= 100; $iter++) {
			$artPhoto = ArtPhoto::get()->byID(7);
			$newPhoto = $artPhoto->duplicate();

		}
		return $this->renderWith('Page');


	}
	

	/**
	 * Process and render search results.
	 *
	 * !! NOTE
	 * _config.php includes:
	 *
	 * FulltextSearchable::enable();
	 * Object::add_extension('ExtendedPage', "FulltextSearchable('HeadlineText')");
	 * Object::add_extension('NewsStory', "FulltextSearchable('Name,Content')");
	 * !!
	 *
	 * @param array $data The raw request data submitted by user
	 * @param Form $form The form instance that was submitted
	 * @param SS_HTTPRequest $request Request generated for this action
	 */



}
