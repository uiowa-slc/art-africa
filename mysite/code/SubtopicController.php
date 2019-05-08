<?php
class SubtopicController extends PageController {

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

	public function show( $request ) {
		//Displays a data object


		$otherClass = 'Subtopic';

		$objectID = $this->request->param( 'ID' );
		if ( $objectID ) {

			$object = $otherClass::get_by_id( $otherClass, $objectID );

			if ( isset( $object ) ) {
				$showTemplate = $otherClass . '_show';
				return $this->Customise( $object )->renderWith( array( $showTemplate, 'Page' ) );

			}else {
			}
		}
		else {
			return $this->renderWith( 'Page' );
		}

	}

	public function nextPageInTree() {

		$page = Page::get()->filter( array (
				'ParentID' => $this->ParentID,
				'Sort:GreaterThan' => $this->Sort
			) )->First();

		if ( !$page ) {

			$parentPage = $this->getParent();

			$page = Page::get()->filter( array (
					'ParentID' => $parentPage->ParentID,
					'Sort:GreaterThan' => $parentPage->Sort
				) )->First();
		}

		return $page;
	}

	public function getNextSubtopic( $title, $type='Subtopic' ) {
		//Title is used to get the next subtopic, returnType returns either a Link or the Title
		$currentSubtopic = $type::get()->filter( array( 'Title' => $title ) )->First();
		$chapter = $currentSubtopic->getParent();
		$chapterSubtopics = $chapter->Children();

		$check = false; //true when match for subtopic found

		foreach ( $chapterSubtopics as $subtopic ) {
			if ( $check == true ) {
				$returnedItem = $subtopic;

				$check = false;
			}
			if ( $subtopic->Title == $currentSubtopic->Title ) {
				$check = true;
			}
		}


		if ( !isset( $returnedItem ) ) {
			//If returned subtopic isn't set, it's the last subtopic in a chapter -- meaning we want the next link to point to the next chapter
			$chapterHolder = $chapter->getParent();
			$chapters = $chapterHolder->Children();

			$check = false; //true when match for chapter found

			foreach ( $chapters as $loopChapter ) {

				if ( $check == true ) {
					$returnedItem = $loopChapter;

					$check = false;
				}
				if ( $loopChapter->Title == $chapter->Title ) {
					$check = true;
				}
			}

			if ( !isset( $returnedItem ) ) {
				//We're in the last chapter, so return the first chapter's link or title
				$returnedItem = Chapter::get()->First();
			}

		}

		return $returnedItem;
	}



}
