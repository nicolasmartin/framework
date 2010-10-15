<?php
class RssFeed {
	private $items = array();
	private $encoding = 'UTF-8';
	private $title;
	private $link;
	private $description;
	private $date;
	private $language = 'fr-fr';
	
	function __construct($encoding = 'UTF-8') {
		$this->setEncoding($encoding);	
	}
	
	function setEncoding($encoding) {
		$this->encoding = $encoding;
	}
	
	function setTitle($title) {
		$this->title = $title;
	}

	function setDescription($description) {
		$this->description = $description;
	}

	function setLink($link) {
		$this->link = $link;
	}

	function setDate($date) {
		$this->date = date(DATE_RSS, strtotime($date));
	}
	
	function setLanguage($language) {
		$this->language = $language;
	}
	
	function addItem(RssItem $Item) {
		$this->items[] = $Item;	
	}

	function get() {
		$feed  = '<?xml version="1.0" encoding="'.$this->encoding.'" ?'.'>';
		$feed .= '<rss version="2.0">';
		$feed .= '	<channel>';
		$feed .= '		<title>'.$this->title.'</title>';
		$feed .= '		<link>'.$this->link.'</link>';
		$feed .= '		<description>'.$this->description.'</description>';
		$feed .= '		<pubDate>'.$this->date.'</pubDate>';
		$feed .= '		<language>'.$this->language.'</language>';
		foreach($this->items as $Item) {
			$feed .= $Item->get();
		}
		$feed .= '	</channel>';
		$feed .= '</rss>';
		return $feed;
	}
	
	function spit() {
		//header('Content-Type: application/xml; charset='.$this->encoding); 
		echo $this->get();
	}
}

class RssItem {
	private $title;
	private $description;
	private $author;
	private $link;
	private $date;
	
	function __construct($title = '') {
		$this->setTitle($title);	
	}
	
	function setTitle($title) {
		$this->title = $title;
	}

	function setAuthor($author) {
		$this->author = $author;
	}

	function setLink($link) {
		$this->link = $link;
	}

	function setDescription($description) {
		$this->description = $description;
	}

	function setDate($date) {
		$this->date = date(DATE_RSS, strtotime($date));
	}

	function get() {
		$feed  = '<item>';
		$feed .= '	<title>'.$this->title.'</title>';
		$feed .= '	<link>'.$this->link.'</link>';
		$feed .= '	<description>'.$this->description.'</description>';
		$feed .= '	<pubDate>'.$this->date.'</pubDate>';
		$feed .= '	<author>'.$this->author.'</author>';
		$feed .= '</item>';
		return $feed;
	}
	
	function spit() {
		echo $this->get();
	}
}
?>