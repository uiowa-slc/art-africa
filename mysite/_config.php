<?php

global $project;
$project = 'mysite';

global $databaseConfig;
$databaseConfig = array(
	"type" => 'MySQLDatabase',
	"server" => 'localhost',
	"username" => 'root',
	"password" => 'omega',
	"database" => 'africa',
	"path" => '',
);

MySQLDatabase::set_connection_charset('utf8');

// Set the current theme. More themes can be downloaded from
// http://www.silverstripe.org/themes/
SSViewer::set_theme('simple');

// Set the site locale
i18n::set_locale('en_US');

// Enable nested URLs for this site (e.g. page/sub-page/)
if (class_exists('SiteTree')) SiteTree::enable_nested_urls();

error_reporting(E_ALL);


Director::set_environment_type("dev");
//Object::add_extension('Country', "FulltextSearchable('Name,Location')");


/*SearchUpdater::bind_manipulation_capture();
Solr::configure_server(isset($solr_config) ? $solr_config : array(
    'host' => 'localhost',
    'indexstore' => array(
        'mode' => 'file',
        'path' => BASE_PATH . '/.solr'
    )
));
*/

ShortcodeParser::get('default')->register(
    'ArtPhoto', array('Page_Controller', 'artPhotoHandler')
);

ShortcodeParser::get('default')->register(
    'FieldPhoto', array('Page_Controller', 'fieldPhotoHandler')
);

Object::add_extension("DataObject","AfricaDataObjectExtension");

Object::add_extension("Image","ImageExtension");

FulltextSearchable::enable();
//Object::add_extension('CollectionPiece', "FulltextSearchable('Keywords')");

Security::setDefaultAdmin("admin", "nimlok");