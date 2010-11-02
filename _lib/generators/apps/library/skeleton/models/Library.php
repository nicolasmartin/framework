<?php
class Library extends BaseLibrary
{
	function delete() {
		@unlink(ROOT.'/www'.$this['path']);
		parent::delete();	
	}
}