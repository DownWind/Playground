<?php

namespace Crawler\Model;

class Crawl
{
    public $user;
    public $url;
    public $finding;
    public $date;

    public function exchangeArray($data)
    {
        $this->user = $data['user'];
        $this->url = $data['url'];
        $this->finding = $data['finding'];
        $this->date = $data['date'];

    }

}