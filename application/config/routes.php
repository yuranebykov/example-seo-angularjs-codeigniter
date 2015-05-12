<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Можна користуватись $route['(:any)/(:any)'] = 'main'
 * В controllers/main.php зразок метод:
 * public function index($page, $id)
 * {
 *    if($this->isAgent) $this->createDataPost($page, $id);
 *    $this->_controlData();
 * }
 *
 * Але це не рекомендує в складний роутер
 * Приклад, url /games/xbox360. xbox360 - це не Id, а список ігри для XBox360
 * Якщо /games/rayman-raving-rabbids, rayman-raving-rabbids - це Id.
 *
 * Потрібно зробити окреми роутери, приклад:
 * $route['games/xbox360'] = 'main/gamesForXbox360';
 * $route['games/(:any)'] = 'main/games/$1';
 */

$route['books'] = 'main/books';
$route['comics'] = 'main/comics';
$route['movies'] = 'main/movies';

$route['books/(:any)'] = 'main/books/$1';
$route['comics/(:any)'] = 'main/comics/$1';
$route['movies/(:any)'] = 'main/movies/$1';

$route['default_controller'] = 'main';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
