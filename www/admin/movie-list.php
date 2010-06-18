<?php

require_once("config.php");
require_once(WWW_DIR."/lib/adminpage.php");
require_once(WWW_DIR."/lib/movie.php");
define("ITEMS_PER_PAGE", "25");

$page = new AdminPage();

$movie = new Movie();

$page->title = "Movie List";

$movcount = $movie->getCount();

$offset = isset($_REQUEST["offset"]) ? $_REQUEST["offset"] : 0;
$page->smarty->assign('pagertotalitems',$movcount);
$page->smarty->assign('pageroffset',$offset);
$page->smarty->assign('pageritemsperpage',ITEMS_PER_PAGE);
$page->smarty->assign('pagerquerybase', WWW_TOP."/movie-list.php?offset=");
$pager = $page->smarty->fetch("pager.tpl");
$page->smarty->assign('pager', $pager);

$movielist = $movie->getRange($offset, ITEMS_PER_PAGE);
$page->smarty->assign('movielist',$movielist);	

$page->content = $page->smarty->fetch('admin/movie-list.tpl');
$page->render();

?>