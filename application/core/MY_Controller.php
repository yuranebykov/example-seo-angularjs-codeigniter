<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_Controller extends CI_Controller {

    protected $dPost; //Дані від запит із метод POST
    protected $isAgent = false; //Якщо true, то ботів читає сайт

    protected $data = array(
        'common' => array(), //Головні дані, це отримати для стартову сторінку, якщо користує MVC JS
        'context' => array() //Дані для одну сторінку, POST буде просити, що отримати
    );

    public function __construct()
    {
        parent::__construct();

        $this->load->helper('file');

        $http_users_agents = "baiduspider|twitterbot|facebookexternalhit|rogerbot|linkedinbot|embedly|quora link preview|showyoubot|outbrain|pinterest|slackbot|vkShare|W3C_Validator";

        /* Перевірка, чи ботів користують сайт */
        if(preg_match("/($http_users_agents)/i", $_SERVER['HTTP_USER_AGENT']) || isset($_REQUEST["_escaped_fragment_"])) $this->isAgent = true;

        /* Отримання запит від метод POST */
        $this->dPost = json_decode(file_get_contents("php://input"));
    }

    /* Це отримання дані через JSON, це просто зразок */
    protected function getJsonData($page, $id = false)
    {
        switch($page) {
            case 'pages':
                $result = read_file($this->_urlJson($page));
                break;

            case 'books':
            case 'movies':
            case 'comics':
                $result = $id ? read_file($this->_urlJson($page.'/'.$id)) : read_file($this->_urlJson($page.'/all'));
                break;
        }

        return json_decode($result);
    }

    /* Це створення $dPost об'єкт, для отримання дані для ботів */
    protected function createDataPost($page, $id = false)
    {
        $this->dPost = (object) array(
            'page' => $page
        );

        if($id) $this->dPost->id = $id;
    }

    /* Отримання головні дані */
    protected function mainData()
    {
        $this->data['common']['pages'] = $this->getJsonData('pages');
    }

    private function _urlJson($page)
    {
        return './data/'.$page.'.json';
    }
}
