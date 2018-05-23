<?php

class Controller
{
    private $_template = '';

    public function __construct()
    {
        if ( Mage::getActionName() == "indexAction" ) {
            $tmplPath = Mage::VIEWS_URL.'_templates/header.phtml';
            if ( file_exists( $tmplPath ) ) {
                require_once $tmplPath;
            }
        }
    }

    public function indexAction()
    {
        $this->setTemplate();
        require_once $this->_template;
    }

    public function setTemplate($tmpl = null)
    {
        $baseFile = '/index.phtml';

        if ( isset($tmpl) ) {
            $tmplPath = Mage::VIEWS_URL.$tmpl.$baseFile;

            if ( file_exists( $tmplPath ) ) {
                $this->_template = $tmplPath;
                return true;
            }

            return false;
        }

        $tmplPath = Mage::VIEWS_URL.Mage::getControllerName().$baseFile;

        if ( file_exists( $tmplPath ) ) {
            $this->_template = $tmplPath;
            return true;
        }

        return false;
    }

    public function getTemlate()
    {
        return $this->_template;
    }

    public function getHelper($helperName)
    {
        return Mage::getHelper($helperName);
    }

    public function getModel($modelName)
    {
        return Mage::getModel($modelName);
    }

    public function getSkinUrl($path)
    {
        return Mage::getSkinUrl($path);
    }

    public function __destruct()
    {
        if ( Mage::getActionName() == "indexAction" ) {
            $tmplPath = Mage::VIEWS_URL.'_templates/footer.phtml';

            if ( file_exists( $tmplPath ) ) {
                require_once $tmplPath;
            }
        }
    }
}