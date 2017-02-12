<?php
/**
 * @by SwiftOtter, Inc., 2/9/17
 * @website https://swiftotter.com
 **/

namespace TylerSchade\IndexManagement\Controller\Adminhtml\Indices;

use Magento\Backend\App\Action;

class RefreshAll extends Action
{
    public function execute()
    {
        $indices = $this->indexCollection->getItems();

        try {
            array_walk($indices, function (Indexer $index) {
                $index->reindexAll();
            });

            $indexCount = count($indices);

            $this->getMessageManager()->addSuccessMessage("$indexCount indexes were refreshed.");
        } catch (\Exception $e) {
            $this->getMessageManager()->addErrorMessage('An error occurred. Please try again later.');
        }

        $redirect = $this->resultRedirectFactory->create();

        return $redirect->setPath('indexer/indexer/list');
    }
}