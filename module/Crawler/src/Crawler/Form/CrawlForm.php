<?php

namespace Crawler\Form;

use Zend\Form\Form;

class CrawlForm extends Form
{

    public function __construct($name = null)
    {

        parent::__construct('crawl');

        $this->add(array(
                'name' => 'url',
                'type' => 'Text',
            )
        );
        $this->add(array(
                'name' => 'submit',
                'type' => 'submit',
                'attributes' => array(
                        'value' => 'Send',
                        'id' => 'submit'
                )
            )
        );
    }

}
