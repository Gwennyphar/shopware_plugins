<?php

class Shopware_Controllers_Backend_Lightweight extends Enlight_Controller_Action implements \Shopware\Components\CSRFWhitelistAware
{
    public function preDispatch()
    {
        $this->View()->addTemplateDir($this->container->getParameter('lightweight_module.plugin_dir') . '/Resources/views');
    }

    public function indexAction()
    {
    }

    /**
     * Returns a list with actions which should not be validated for CSRF protection
     *
     * @return string[]
     */
    public function getWhitelistedCSRFActions()
    {
        return [
            'index'
        ];
    }
}
