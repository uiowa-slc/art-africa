<?php

use SilverStripe\ORM\Connect\MySQLDatabase;
use SilverStripe\View\SSViewer;
use SilverStripe\i18n\i18n;
use SilverStripe\View\Parsers\ShortcodeParser;
use SilverStripe\Assets\Image;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\ORM\Search\FulltextSearchable;
use SilverStripe\Control\Email\Email;
use SilverStripe\Control\Director;
use SilverStripe\Security\MemberAuthenticator\MemberAuthenticator;
use SilverStripe\Security\Authenticator;
use SilverStripe\Forms\HTMLEditor\HTMLEditorConfig;

//Shortcodes
ShortcodeParser::get('default')->register(
	'ArtPhoto', ['PageController', 'shortCodeHandler']
);
ShortcodeParser::get('default')->register(
	'FieldPhoto', ['PageController', 'shortCodeHandler']
);
ShortcodeParser::get('default')->register(
	'Image', ['PageController', 'imageHandler']
);
ShortcodeParser::get('default')->register(
	'Video', ['PageController', 'videoHandler']
);
ShortcodeParser::get('default')->register(
	'Audio', ['PageController', 'audioHandler']
);

//Other Settings

// GD::set_default_quality(90);

// add a button to remove formatting
// HtmlEditorConfig::get('cms')->insertButtonsBefore(
// 	'styleselect',
// 	'removeformat'
// );

// HtmlEditorConfig::get('cms')->setOption('paste_remove_spans', 'true');
// HtmlEditorConfig::get('cms')->setOption('paste_auto_cleanup_on_paste', 'true');
// HtmlEditorConfig::get('cms')->setOption('paste_remove_styles', 'true');
// HtmlEditorConfig::get('cms')->setOption('paste_remove_styles_if_webkit', 'true');
// HtmlEditorConfig::get('cms')->setOption('paste_strip_class_attributes', 'true');

if(Director::isLive()) {
	Director::forceSSL();
}