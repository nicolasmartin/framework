<?php
require_once($_SERVER['DOCUMENT_ROOT'].'../_lib/vendors/rss/class.rss.php');
	
class RssController extends Controller {
	
	// Index
	public function index() {
		$this->View->setAutorender(false);

		$site 	= Config::get('project.url');
		$author = Config::get('project.owner');
		
		$Rss = new RssFeed();
		$Rss->setTitle(Config::get('project.name'));
		$Rss->setDescription(Config::get('project.desc'));
		$Rss->setDate(date('Y-m-d H:i:s', strtotime('-2 day')));
		$Rss->setLink($site);

		$data = array();
		foreach($data as $row) {
			$Item = new RssItem();
			$Item->setTitle('title');
			$Item->setDescription('description');
			$Item->setDate('2010-12-25 00:00:00');
			$Item->setAuthor('no@email.com ('.Config::get('project.owner').')');
			$Item->setLink(Config::get('project.url')); 
			
			$Rss->addItem($Item);
		}
		
		echo $Rss->spit();
	}
}