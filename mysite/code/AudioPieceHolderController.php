<?php
class AudioPieceHolderController extends PageController {

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
	private static $allowed_actions = array ( 'show', 'getAudio' );

	public static $childPage = 'AudioPiece';
	public function index(){
		return $this->redirect('media/');
	}
	/*
	public function show (){
	//Displays a data object


		$otherClass = 'AudioPiece';

		$objectID = $this->request->param('ID');
		if ($objectID){

		    $object = $otherClass::get_by_id($otherClass, $objectID);

		    if(isset($object)){
		       $showTemplate = $otherClass . 'Holder_show';
			   return $this->Customise($object)->renderWith(array($showTemplate, 'Page'));

		    }else{
		    }
		}
		else {
			return $this->renderWith('Page');
		}

	}*/

	public function getAudio() {
		$audio = AudioPiece::get();
		return $audio;
	}




}