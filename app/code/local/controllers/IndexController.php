<?php

class IndexController extends Controller
{
    public function indexAction()
    {
        parent::indexAction();
        // $model = $this->getModel('index');
        // var_dump($model->testMethod());

        // $model = Mage::getModel('index');
        // var_dump($model->testMethod());

        // $helper = Mage::getHelper('index');
        // var_dump($helper->testMethod());
    }

    public function getExampleMethod()
    {
        $controllerName = Mage::getControllerName();
        echo $controllerName.' view works perfectly';
    }
}
