<?php

namespace Crawler\Model;


use Zend\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Http\Client;

class Crawl
{
    public $user;
    public $url;
    public $finding;
    public $date;

    private $_minLength = 5;
    private $_maxTimeout = 30;
    private $_maxRedirects = 5;

    public function exchangeArray($data)
    {
        foreach ($data as $key => $value)
        {
            $this->$key = $value;
        }
        /*
        $this->user = $data['user'];
        $this->url = $data['url'];
        $this->finding = $data['finding'];
        $this->date = $data['date'];
        */
    }

    public function getInputFilter()
    {

        $inputFilter = new InputFilter();

        $inputFilter->add(array(
                'name' => 'crawl',
                'required' => 'true',
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 5,
                            'max' => 255,
                         )
                    )
                )
            )
        );

        return $inputFilter;
    }

    public function crawlUrl()
    {
        $url = $this->validateUrl($this->url);
        if(!$url)
        {
            return false;
        }
        $client = new Client($url, array(
                'maxredirects' => $this->_maxRedirects,
                'timeout' => $this->_maxTimeout,
            )
        );
        $response = $client->send();
        echo $response->getContent();
    }

    public function validateUrl($url)
    {
        if (strlen($url) < $this->_minLength)
        {
            return false;
        }
        if (!preg_match('/http/' , $url))
        {
            return 'http://' . $url;
        }
        return $url;
    }

}