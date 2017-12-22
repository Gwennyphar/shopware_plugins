<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace GwenDetailPageExtension;

use Shopware\Components\Plugin\Context\ActivateContext;
use Shopware\Components\Plugin\Context\DeactivateContext;
use Shopware\Components\Plugin\Context\InstallContext;
use Shopware\Components\Plugin\Context\UninstallContext;
 
class GwenDetailPageExtension extends \Shopware\Components\Plugin {

	 public function install(InstallContext $context) {
		 $context->scheduleClearCache($this->getCacheArray());
		 parent::install($context);
	}
 
	public function uninstall(UninstallContext $context) {
		$context->scheduleClearCache($this->getCacheArray());
		parent::uninstall($context);
	}
 
	public function activate(ActivateContext $context) {
		$context->scheduleClearCache($this->getCacheArray());
		parent::install($context);
	}
 
	public function deactivate(DeactivateContext $context) {
		$context->scheduleClearCache($this->getCacheArray());
		parent::install($context);
	}
	
	/**
	 * Get caches to clear
	 *
	 * @return array
	 */
	private function getCacheArray() {
		return [
			InstallContext::CACHE_TAG_CONFIG,
			InstallContext::CACHE_TAG_HTTP
		];
	}

	/**
	 * register event
	 */
	 public static function getSubscribedEvents() {
		return [
			'Enlight_Controller_Action_PostDispatch_Frontend_Detail' => 'onFrontendDetail'
		];
	}

	/**
	 * => onFrontendDetail
	 * get article name from db
	 */
	 public function onFrontendDetail(\Enlight_Event_EventArgs $arguments) {
		 $article_Id = 2;		 
		 $view = $arguments->get('subject')->View();
		 $query = $this->container->get('dbal_connection')->createQueryBuilder();
		 $query->select('s_articles.name')
			->from('s_articles')
			->where('s_articles.id = :id')
			->setParameter('id', $article_Id);
		$single = $query->execute()->fetchColumn();
		$view->assign('article_name', $single);
	}
}//end class
