<?
	class RssController extends Controller {

		public function index() {
			$this->View->setAutorender(false);

			$site 	= Config::get('project.url');
			$author = Config::get('project.owner');
			
			$Rss = new RssFeed();
			$Rss->setTitle(__('default.title'));
			$Rss->setDescription(__('default.description'));
			$Rss->setDate(date('Y-m-d H:i:s'));
			$Rss->setLink($site);

			$data = array();
			foreach($data as $row) {
				$Item = new RssItem();
				$Item->setTitle('title');
				$Item->setDescription('description');
				$Item->setDate(date('Y-m-d H:i:s'));
				$Item->setAuthor('no@email.com (author)');
				$Item->setLink('http://domain.com/'); 
				
				$Rss->addItem($Item);
			}
			
			echo $Rss->spit();
		}
	}