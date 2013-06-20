silverstripe-requiredfieldscms
==============================
This DataExtension reads the required fields for a DataObject and will add a 'required' class to these fields. 

By default, the supplied stylesheet then appends a asterisk to these fields. You can customize this stylesheet to style required fields differently. Alternatively uncomment a line from _config.php to have the asterisk added serverside.

## Usage

* Extract / clone this so that the path to _config.php is SITEROOT/RequiredFieldsCmsDataExtension/_config.php
* Adjust _config.php if you don't want it to apply to all DataObjects

## DIY Demo:

Course.php:

    <?php
    class Course extends DataObject {
    	public static $db = array(
    		'Title'             => 'Varchar(500)',
    		'Synopsis'          => 'Text',
    	);
    
    	public function getCMSValidator() {
    		return new RequiredFields(
    			'Title',
    		);
    	} 
    
    }

CourseModelAdmin.php:

    <?php
    
    class CourseModelAdmin extends ModelAdmin {
    	public static $managed_models = array(
    		'Course',
    	); 
      	static $url_segment = 'courses'; // Linked as /admin/products/
      	static $menu_title = 'Course Admin';
    	
    }

Do a /dev/build and create a new course in the CMS. You will see the Title field has an asterisk behind it.


## Screenshot

![Example screenshot](http://content.screencast.com/users/SanderVD/folders/Jing/media/c66ae9b9-d681-4940-adbd-71773d110d54/2012-11-20_1340.png)

1. Unsaved message provided through [ManyMessageDataExtension](https://github.com/svandragt/silverstripe-manymessage)
2. Styling for required formfields provided through [RequiredFieldsCmsDataExtension](https://github.com/svandragt/silverstripe-requiredfieldscms)
3. Field descriptions automatically linked through [DescriptionDataExtension](https://github.com/svandragt/silverstripe-description)