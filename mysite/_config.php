<?php

global $project;
$project = 'mysite';

global $database;
$database = 'africa';
 
// Use _ss_environment.php file for configuration
require_once("conf/ConfigureFromEnv.php");


MySQLDatabase::set_connection_charset('utf8');

// Set the current theme. More themes can be downloaded from
// http://www.silverstripe.org/themes/
SSViewer::set_theme('simple');

// Set the site locale
i18n::set_locale('en_US');


//Shortcodes

ShortcodeParser::get('default')->register(
    'ArtPhoto', array('Page_Controller', 'artPhotoHandler')
);
ShortcodeParser::get('default')->register(
    'FieldPhoto', array('Page_Controller', 'fieldPhotoHandler')
);
ShortcodeParser::get('default')->register(
    'Image', array('Page_Controller', 'imageHandler')
);
ShortcodeParser::get('default')->register(
    'Video', array('Page_Controller', 'videoHandler')
);
ShortcodeParser::get('default')->register(
    'Audio', array('Page_Controller', 'audioHandler')
);

//Extensions

Object::add_extension("DataObject","AfricaDataObjectExtension");
Object::add_extension("Image","ImageExtension");
Object::add_extension("AssetAdmin","AssetAdminExtension");

//Enable Search

FulltextSearchable::enable();

//Other Settings

GD::set_default_quality(90);

// add a button to remove formatting
HtmlEditorConfig::get('cms')->insertButtonsBefore(
    'styleselect',
    'removeformat'
);

HtmlEditorConfig::get('cms')->setOption('paste_remove_spans','true');
HtmlEditorConfig::get('cms')->setOption('paste_auto_cleanup_on_paste','true');
HtmlEditorConfig::get('cms')->setOption('paste_remove_styles','true');
HtmlEditorConfig::get('cms')->setOption('paste_remove_styles_if_webkit','true');
HtmlEditorConfig::get('cms')->setOption('paste_strip_class_attributes','true');

// log errors and warnings
//SS_Log::add_writer(new SS_LogEmailWriter('dustin-quam@uiowa.edu'), SS_Log::WARN, '<=');
// or just errors
//SS_Log::add_writer(new SS_LogEmailWriter('dustin-quam@uiowa.edu'), SS_Log::ERR);
