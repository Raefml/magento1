<?php
namespace Raef\ContactManager\Model;

use Raef\ContactManager\Model\ResourceModel\CustomerContact\CollectionFactory;

class CustomerContactFactory
{
    protected $collectionFactory;

    public function __construct(CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }

    public function create(array $data = [])
    {
        return $this->collectionFactory->create($data);
    }
}
