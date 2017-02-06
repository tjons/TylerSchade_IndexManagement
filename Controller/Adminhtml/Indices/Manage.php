<?php

/**
 * @by SwiftOtter, Inc., 2/9/17
 * @website https://swiftotter.com
 **/

namespace TylerSchade\IndexManagement\Controller\Adminhtml\Indices;

use Magento\Backend\App\Action;
use Magento\Indexer\Model\Indexer;

class Manage extends Action
{
    private $indexCollection;

    public function __construct(
        \Magento\Indexer\Model\Indexer\CollectionFactory $collectionFactory,
        Action\Context $context
    ) {
        $this->indexCollection = $collectionFactory->create();

        parent::__construct($context);
    }

    public function execute()
    {
        $indices = $this->indexCollection->getItems();

        array_walk($indices, function (Indexer $index) {
            $index->reindexAll();
        });
    }

    protected function _isAllowed()
    {
        return true;
    }
}