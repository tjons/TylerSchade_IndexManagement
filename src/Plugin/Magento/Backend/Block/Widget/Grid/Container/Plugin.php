<?php

namespace TylerSchade\IndexManagement\Plugin\Magento\Backend\Block\Widget\Grid\Container;

use Magento\Backend\Block\Widget\Container;
use Magento\Backend\Model\UrlInterface;
use Magento\Indexer\Block\Backend\Container as GridContainer;

class Plugin
{
    private $urlModel;

    public function __construct(
        UrlInterface $urlModel
    ) {
        $this->urlModel = $urlModel;
    }

    public function beforeSetLayout($container)
    {
        if ($container->getNameInLayout() == 'adminhtml.indexer.grid.container') {
            /** @var Container $container */
            $container->addButton('refresh_indices', [
                'label' => __('Refresh All Indexes'),
                'onclick' => "setLocation('{$this->urlModel->getUrl('indices/indices/refreshAll')}')",
                'class' => 'primary'
            ]);
        }
    }
}