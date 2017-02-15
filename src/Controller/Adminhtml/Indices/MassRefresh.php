<?php

namespace TylerSchade\IndexManagement\Controller\Adminhtml\Indices;

use Magento\Indexer\Model\Indexer;

class MassRefresh extends RefreshAll
{
    public function execute()
    {
        try {
            $indexerIds = $this->getIdsToRefresh();

            array_walk($indexerIds, function (string $indexId) {
                $this->refreshIndex($indexId);
            });

            $this->getMessageManager()->addSuccessMessage(count($indexerIds) . " indexes were refreshed.");
        } catch (\Exception $e) {
            $this->getMessageManager()->addErrorMessage('An error occurred. Please try again later.');
        }

        $redirect = $this->resultRedirectFactory->create();

        return $redirect->setPath('indexer/indexer/list');
    }

    protected function getIdsToRefresh() : array
    {
        return $this->getRequest()->getParam('indexer_ids');
    }
}