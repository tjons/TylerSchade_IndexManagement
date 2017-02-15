<?php

namespace TylerSchade\IndexManagement\Controller\Adminhtml\Indices;

use Magento\Backend\App\Action;
use TylerSchade\IndexManagement\Indexer\Manager as IndexManager;
use TylerSchade\IndexManagement\Indexer\ManagerFactory as IndexManagerFactory;

class Refresh extends Action
{
    /**
     * @var IndexManager
     */
    private $indexManager;

    /**
     * @var IndexManagerFactory
     */
    private $indexManagerFactory;

    public function __construct(
        Action\Context $context,
        IndexManagerFactory $indexManagerFactory
    ) {
        $this->indexManagerFactory = $indexManagerFactory;

        parent::__construct($context);
    }

    public function execute()
    {
        try {
            $this->refreshIndex();
            $this->getMessageManager()->addSuccessMessage("The {$this->getRefreshedIndexTitle()} index was rebuilt.");

            $redirect = $this->resultRedirectFactory->create();

            return $redirect->setPath('indexer/indexer/list');
        } catch (\Exception $exception) {
            $this->messageManager->addErrorMessage("The index was not refreshed. Please try again.");
        }
    }

    public function _isAllowed()
    {
        return parent::_isAllowed();
    }

    private function refreshIndex()
    {
        $this->indexManager = $this->indexManagerFactory->create(['indexId' => $this->getIndexIdToRefresh()]);
        $this->indexManager->refreshIndex();
    }

    private function getRefreshedIndexTitle() : string
    {
        return $this->indexManager->getIndexerName();
    }

    private function getIndexIdToRefresh() : string
    {
        return (string) $this->getRequest()->getParam('indexer_id');
    }
}