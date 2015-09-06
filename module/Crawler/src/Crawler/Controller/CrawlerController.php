<?php
/**
 */

namespace Crawler\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CrawlerController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel(
            array(
                'crawls' => $this->_getCrawlTable()->fetchAll(),
            )
        );
    }

    public function crawlAction()
    {
        return new ViewModel();
    }

    private function _getCrawlTable()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('Crawler\Model\CrawlTable');
    }
}
