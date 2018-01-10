<?php

namespace LightweightModule;

use Shopware\Components\Plugin;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class LightweightModule extends Plugin  {
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->setParameter('lightweight_module.plugin_dir', $this->getPath());
    }
}
