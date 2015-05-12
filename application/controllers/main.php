<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends Main_Controller {

    /* Головна сторінка */
	public function index()
	{
        if($this->isAgent) $this->createDataPost("home");
        $this->_controlData();
	}

    public function books($id = false)
    {
        if($this->isAgent) $this->createDataPost("books", $id);
        $this->_controlData();
    }

    public function movies($id = false)
    {
        if($this->isAgent) $this->createDataPost("movies", $id);
        $this->_controlData();
    }

    public function comics($id = false)
    {
        if($this->isAgent) $this->createDataPost("comics", $id);
        $this->_controlData();
    }

    private function _controlData()
    {
        /* Це стартова сторінка для користувачів */
        if(empty($this->dPost))
        {
            $this->mainData();
            $this->load->view('main_view', $this->data['common']);
        }
        else
        {
            /* Отримання дані для вибрану веб-сторінку */
            switch($this->dPost->page)
            {
                case "home":
                    $this->_setActiveTitle('Home', '');
                    break;

                case "books":
                    if(isset($this->dPost->id))
                    {
                        $this->data['context']['data'] = $this->getJsonData($this->dPost->page, $this->dPost->id);
                        $this->_setActiveTitle($this->data['context']['data']->name);
                    }
                    else
                    {
                        $this->data['context']['data'] = $this->getJsonData($this->dPost->page);
                        $this->_setActiveTitle('Books', 'books');
                    }
                    break;

                case "movies":
                    if(isset($this->dPost->id))
                    {
                        $this->data['context']['data'] = $this->getJsonData($this->dPost->page, $this->dPost->id);
                        $this->_setActiveTitle($this->data['context']['data']->name);
                    }
                    else
                    {
                        $this->data['context']['data'] = $this->getJsonData($this->dPost->page);
                        $this->_setActiveTitle('Movies', 'movies');
                    }
                    break;

                case "comics":
                    if(isset($this->dPost->id))
                    {
                        $this->data['context']['data'] = $this->getJsonData($this->dPost->page, $this->dPost->id);
                        $this->_setActiveTitle($this->data['context']['data']->name);
                    }
                    else
                    {
                        $this->data['context']['data'] = $this->getJsonData($this->dPost->page);
                        $this->_setActiveTitle('Comics', 'comics');
                    }
                    break;
            }

            /* Рендерінг повний документ без JS для SEO бот */
            if($this->isAgent)
            {
                $this->mainData();
                $this->data['context']['page'] = $this->dPost->page;
                if($this->dPost->page != 'home')
                    $this->data['common']['content'] = $this->load->view('seo_content/'.(isset($this->dPost->id) ? 'seo_item_view' : 'seo_list_view'), $this->data['context'], true);
                $this->load->view('seo_view', $this->data['common']);
            }
            /* Відображати текст дані в написані JSON, для AJAX отримати дані */
            else
            {
                echo json_encode($this->data['context']);
            }
        }
    }

    private function _setActiveTitle($name, $url = false)
    {
        $this->data[$this->isAgent ? 'common' : 'context']['title'] = array('name' => $name,  /* Відображення CSS клас .active в навігацію */ 'activeUrl' => $url);
    }

}
