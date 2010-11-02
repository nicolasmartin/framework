<?php
class PagesController extends Controller {

	// 403
	public function page403() {
		header($_SERVER['SERVER_PROTOCOL']." 403 Forbidden");
		header("Status: 403 Forbidden");
	}

	// 404	
	public function page404() {
		header($_SERVER['SERVER_PROTOCOL']." 404 Not found");
		header("Status: 404 Not found");
	}

	// 500
	public function page500() {		
		header($_SERVER['SERVER_PROTOCOL']." 500 Internal Server Error");
		header("Status: 500 Internal Server Error");
	}

	// 503
	public function page503() {		
		header($_SERVER['SERVER_PROTOCOL']." 503 Service Temporarily Unavailable");
		header("Status: 503 Service Temporarily Unavailable");
	}
}