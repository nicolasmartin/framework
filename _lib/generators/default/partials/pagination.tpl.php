[? if (isset($Pager)) : ?]
De [?= $Pager->getFirstIndice() ?] à [?= $Pager->getLastIndice() ?] sur [?= $Pager->getNumResults() ?]
[? if ($Pager->haveToPaginate()): 
   $range   = $Pager->getRange('Sliding', array('chunk' => 5));
   $pages   = $range->rangeAroundPage();
   $path    = UrlComponent::path($this->getController()->name.'/index');
?]
, pages 
[? if ($Pager->getPage() > 1) : ?]
    <a href="[?= $path ?]page/[?= $Pager->getPreviousPage() ?]">&laquo;</a> 
[? endif ?]

[? if ($pages[0] > 1) : ?]
    <a href="[?= $path ?]page/1">1</a>
[? endif ?]

[? if ($pages[0] > 2) : ?]...[? endif ?]

[? foreach($pages as $page): ?]
[? if ($page == $Pager->getPage()): ?]
    <b>[?= $page ?]</b>
[? else: ?]
    <a href="[?= $path ?]page/[?= $page ?]">[?= $page ?]</a>
[? endif; ?]
[? endforeach; ?]

[? if ($pages[4] < $Pager->getLastPage()-1) : ?]...[? endif ?]

[? if ($pages[4] < $Pager->getLastPage()) : ?]
    <a href="[?= $path ?]page/[?= $Pager->getLastPage() ?]">[?= $Pager->getLastPage() ?]</a>
[? endif ?]

[? if ($Pager->getPage() < $Pager->getNextPage()) : ?]
    <a href="[?= $path ?]page/[?= $Pager->getNextPage() ?]">&raquo;</a>
[? endif; ?]
[? endif; ?]
[? endif; ?]
