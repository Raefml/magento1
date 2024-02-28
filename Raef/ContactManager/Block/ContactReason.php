<?php

// app/code/Raef/ContactManager/Block/ContactReason.php

namespace Raef\ContactManager\Block;

use Magento\Framework\View\Element\Template;
use Raef\ContactManager\Model\ResourceModel\ContactReason\CollectionFactory;

class ContactReason extends Template
{
    protected $contactReasonCollectionFactory;

    public function __construct(
        Template\Context $context,
        CollectionFactory $contactReasonCollectionFactory,
        array $data = []
    ) {
        $this->contactReasonCollectionFactory = $contactReasonCollectionFactory;
        parent::__construct($context, $data);
    }

    public function getContactReasons()
    {
        $collection = $this->contactReasonCollectionFactory->create();
        return $collection->getData();
    }
}

