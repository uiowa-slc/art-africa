<?php

// add to your dataobjects:
// http://api.silverstripe.org/trunk/sapphire/core/Object.html#methodadd_extension
Object::add_extension("ArtPhoto","RequiredFieldsCmsDataExtension");


RequiredFieldsCmsDataExtension::enable_serverside(); // uncomment to append through PHP rather than CSS
/*
if (!RequiredFieldsCmsDataExtension::get_serverside()) {
	LeftAndMain::require_css('RequiredFieldsCmsDataExtension/css/admin.css');
}
*/








