<?php

namespace TylerSchade\IndexManagement\Controller\Adminhtml\Indices;

use Magento\Backend\App\Action;
use Magento\Indexer\Model\Indexer;
use Magento\Indexer\Model\Indexer\Collection;
use TylerSchade\IndexManagement\Indexer\ManagerFactory as IndexManagerFactory;

class RefreshAll extends Action
{
    /**
     * @var IndexManagerFactory
     */
    protected $indexManagerFactory;

    /**
     * @var Collection
     */
    protected $indexCollection;

    public function __construct(
        Action\Context $context,
        IndexManagerFactory $indexManagerFactory,
        Collection $indexCollection
    ) {
        $this->indexManagerFactory = $indexManagerFactory;
        $this->indexCollection = $indexCollection;

        parent::__construct($context);
    }

    public function execute()
    {
        $indices = $this->indexCollection->getItems();

        try {
            array_walk($indices, function (Indexer $index) {
                $this->refreshIndex($index->getId());
            });

            $this->getMessageManager()->addSuccessMessage(count($indices) . " indexes were refreshed.");
        } catch (\Exception $e) {
            $this->getMessageManager()->addErrorMessage('An error occurred. Please try again later.');
        }

        $redirect = $this->resultRedirectFactory->create();

        return $redirect->setPath('indexer/indexer/list');
    }

    protected function refreshIndex(string $id)
    {
        $indexManager = $this->indexManagerFactory->create(['indexId' => $id]);
        $indexManager->refreshIndex();
    }
}