<?php
namespace Raef\ContactManager\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Raef\ContactManager\Model\ResourceModel\ContactReason\CollectionFactory as ContactReasonCollectionFactory;

class ContactForm extends Template
{
    protected $contactReasonCollectionFactory;

    public function __construct(
        Context $context,
        ContactReasonCollectionFactory $contactReasonCollectionFactory,
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
