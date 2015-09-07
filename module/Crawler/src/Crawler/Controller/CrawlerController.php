<?php
/**
 */

namespace Crawler\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Crawler\Form\CrawlForm;
use Crawler\Model\Crawl;

class CrawlerController extends AbstractActionController
{
    public function __construct()
    {

    }

    public function indexAction()
    {
        //for now here...
        if (!$this->zfcUserAuthentication()->hasIdentity())
        {
            return $this->redirect()->toRoute('zfcuser');
        }
        return new ViewModel(
            array(
                'crawls' => $this->_getCrawlTable()->fetchAll(),
            )
        );
    }

    public function createAction()
    {
        //for now here...
        if (!$this->zfcUserAuthentication()->hasIdentity())
        {
            return $this->redirect()->toRoute('zfcuser');
        }
        $form = new CrawlForm();
        $request = $this->getRequest();

        if($request->isPost())
        {
            $crawl = new Crawl();
            $form->setInputFilter($form->getInputFilter());
            $form->setData($request->getPost());

            if($form->isValid())
            {
                $crawl->exchangeArray($form->getData());
                if($crawl->crawlUrl())
                {
                    $this->_getCrawlTable($crawl)->saveCrawl();
                    return $this->redirect()->toRoute('index');
                }
            }
        }

        //return new ViewModel();
        return array('form' => $form);
    }
    public function deleteAction()
    {
        //for now here...
        if (!$this->zfcUserAuthentication()->hasIdentity())
        {
            return $this->redirect()->toRoute('zfcuser');
        }
        return $this->redirect()->toRoute('index');
    }
    //move to model ?
    private function _getCrawlTable()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('Crawler\Model\CrawlTable');
    }
}
