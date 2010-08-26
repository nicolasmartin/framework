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

			$Pictures = Doctrine::getTable('Picture')->getLastest(10);

			foreach($Pictures as $Picture) {
				$Item = new RssItem();
				$Item->setTitle('Photo: '.$Picture['name'].', Album: '.$Picture->Album['name']);
				$Item->setDescription('<img src="'.$site.'/photos/'.$Picture['path'].'" alt="'.$Picture['name'].'" /><br />'); // 
				$Item->setDate(date('Y-m-d H:i:s'));
				$Item->setAuthor('no@email.com ('.$author.')');
				$Item->setLink($site.UrlComponent::path('/gallery/album/'.$Picture->Album['slug'])); 
				
				$Rss->addItem($Item);
			}
			
			echo $Rss->spit();
		}
	}