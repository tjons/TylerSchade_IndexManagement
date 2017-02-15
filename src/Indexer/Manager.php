<?php

namespace TylerSchade\IndexManagement\Indexer;

use Magento\Framework\Stdlib\DateTime\DateTime;
use Magento\Indexer\Model\IndexerFactory;

class Manager
{
    /**
     * @var Indexer
     */
    private $indexer;

    /**
     * @var DateTime
     */
    private $dateTime;

    public function __construct(
        IndexerFactory $indexerFactory,
        DateTime $dateTime,
        string $indexId
    ) {
        $indexer = $indexerFactory->create();
        $this->indexer = $indexer->load($indexId);
        $this->dateTime = $dateTime;
    }

    public function refreshIndex()
    {
        $this->indexer->reindexAll();

        $this->updateIndexState();
    }

    public function getIndexerName() : string
    {
        return (string) $this->indexer->getTitle();
    }

    private function updateIndexState()
    {
        /** @var \Magento\Indexer\Model\Indexer\State $state */
        $state = $this->indexer->getState();

        $state->setUpdated($this->dateTime->date());
        $state->save();
    }
}