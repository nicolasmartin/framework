<? if (isset($Pager)) : ?>
<ul class="pagination">
<? if ($Pager->haveToPaginate()): 
   $range   = $Pager->getRange('Sliding', array('chunk' => Config::get('pagination.chunk')));
   $pages   = $range->rangeAroundPage();
   
   $filter  = Config::get('pagination.filter');
   $path    = UrlComponent::whitelist(array_remove($filter, 'page'));
?>
<? if ($Pager->getPage() > 1) : ?>
    <li class="previous"><a href="<?= $path ?>/page/<?= $Pager->getPreviousPage() ?>">&laquo; Précédente</a></li>
<? else: ?>
    <li class="previous-off">&laquo; Précédente</li>
<? endif ?>
<? if ($pages[0] > 1) : ?>
   <li><a href="<?= $path ?>/page/1">1</a></li>
<? endif ?>
<? if ($pages[0] > 2) : ?>
	<li class="more">...</li>
<? endif ?>
<? foreach($pages as $page): ?>
<? if ($page == $Pager->getPage()): ?>
    <li class="active"><?= $page ?></li>
<? else: ?>
    <li><a href="<?= $path ?>/page/<?= $page ?>"><?= $page ?></a>
<? endif; ?>
<? endforeach; ?>
<? if ($pages[4] < $Pager->getLastPage()-1) : ?>
	<li class="more">...</li>
<? endif ?>
<? if ($pages[4] < $Pager->getLastPage()) : ?>
    <li><a href="<?= $path ?>/page/<?= $Pager->getLastPage() ?>"><?= $Pager->getLastPage() ?></a>
<? endif ?>
<? if ($Pager->getPage() < $Pager->getNextPage()) : ?>
    <li class="next"><a href="<?= $path ?>/page/<?= $Pager->getNextPage() ?>">Suivante &raquo;</a></li>
<? else: ?>
    <li class="next-off">Suivante &raquo;</li>
<? endif ?>
<? endif; ?>
</ul>

<? endif; ?>