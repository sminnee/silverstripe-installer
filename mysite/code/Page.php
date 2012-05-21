<?php
class Page extends SiteTree {

	public static $db = array(
	);

	public static $has_one = array(
	);

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
	public static $allowed_actions = array (
	);

	function init() {
		parent::init();


		$theme = null;
		if(!empty($_GET['theme'])) {
			$theme = $_GET['theme'];
			Session::set('theme', $_GET['theme']);
		} elseif(Session::get('theme')) {
			$theme = Session::get('theme');
		}

		if($theme && Director::fileExists('themes/' . $theme)) {
			SSViewer::set_theme($theme);
		}
		
		if(!$this->onMobileDomain()) {
			Requirements::themedCSS('layout');
			Requirements::themedCSS('form');
			Requirements::themedCSS('typography');
		
			Requirements::javascript(THIRDPARTY_DIR . '/jquery/jquery.js');
		
			Requirements::javascriptTemplate('mysite/javascript/demobar.js', array());
			Requirements::css('mysite/css/demobar.css');
			
			Requirements::customScript(<<<JS
	var _gaq = _gaq || [];
	
	_gaq.push(['_setAccount', 'UA-84547-11']);
	_gaq.push(['_setDomainName', 'none']);
	_gaq.push(['_setAllowLinker', true]);
	_gaq.push(['_trackPageview']);

	(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();
JS
);
		}
	}
	
	/**
	 * Hide content on the login pages as the warning message is hard coded in
	 * the form.
	 */
	function Content() {
		return (Controller::curr() != "Security") ? $this->dbObject('Content') : false;
	}

}