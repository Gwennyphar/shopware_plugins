<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace GwenDetailPageExtension\Subscribers;
use Enlight\Event\SubscriberInterface;

class Frontend implements SubscriberInterface {
	
	public static function getSubscribedEvents() {
		return [
			'Enlight_Controller_Action_PostDispatch_Frontend_Detail' => 'onFrontendDetail'
		];
	} 
 
	public function onFrontendDetail(\Enlight_Event_EventArgs $arguments) {
		
		$view = $arguments->get('subject')->View();
		$container = Shopware()->Container();
		$articleId = 2;
		/** @var \Doctrine\DBAL\Connection $query */
		$query = $container->get('dbal_connection')->createQueryBuilder();
		$query->select('s_articles.name')
		   ->from('s_articles')
		   ->where('s_articles.id = :id')
		   ->setParameter('id', $articleId);
		$single = $query->execute()->fetchColumn();
		$view->assign('article_name', $single);
 
	}
}
