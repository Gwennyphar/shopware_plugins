<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace GwenDetailPageExtension\Subscriber;
 
use Enlight\Event\SubscriberInterface;
 
class TemplateRegistration implements SubscriberInterface {
	
	/**
	 * @var string
	 */
	private $pluginDirectory;
 
	/**
	 * @var \Enlight_Template_Manager
	 */
	private $templateManager;
 
	/**
	 * @param $pluginDirectory
	 * @param \Enlight_Template_Manager $templateManager
	 */
	public function __construct($pluginDirectory, \Enlight_Template_Manager $templateManager) {
		$this->pluginDirectory = $pluginDirectory;
		$this->templateManager = $templateManager;
	}
	/**
	 * {@inheritdoc}
	 */
	public static function getSubscribedEvents() {
		return [
			'Enlight_Controller_Action_PreDispatch' => 'onPreDispatch'
		];
	}
 
	public function onPreDispatch() {
		$this->templateManager->addTemplateDir($this->pluginDirectory . '/Views');
	}
}
