<?php
global $project;
$project = 'mysite';

global $database;
$database = '';

require_once('conf/ConfigureFromEnv.php');

Director::addRules(100, array(
));

/***MEMBER LOGIN*****/
// To do: don't have this as a project-specific hack
//Authenticator::unregister('MemberAuthenticator');
//Authenticator::register('UsernameAuthenticator');
//Authenticator::set_default_authenticator('UsernameAuthenticator');

// API keys for various services
if(defined('SS_METABLOG_API_KEY')) {
	MetablogService::setAPIKey(SS_METABLOG_API_KEY);
}

// GMaps API key
global $GMaps_API_Key;
if(defined('SS_GMAPS_API_KEY')) {
	$GMaps_API_Key = SS_GMAPS_API_KEY;
}

//Flickr API key
if(defined('SS_FLICKR_API_KEY')) {
	FlickrService::setAPIKey(SS_FLICKR_API_KEY);
}
/*
SpamProtectorManager::set_spam_protector('RecaptchaProtector');
if(defined('R_PKEY') && defined('R_UKEY')) {
	RecaptchaField::$public_api_key = R_UKEY;
	RecaptchaField::$private_api_key = R_PKEY;
}
*/

///i18n::enable();

HTTP::set_cache_age(0);

// enable nested URLs
SiteTree::enable_nested_urls();

ContentNegotiator::disable();

SSViewer::set_theme('simple');
