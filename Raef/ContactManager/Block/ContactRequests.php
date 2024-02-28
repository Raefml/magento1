<?php
namespace Raef\ContactManager\Block;

use Magento\Framework\View\Element\Template;
use Raef\ContactManager\Model\CustomerContactFactory;
class ContactRequests extends Template
{
    protected $customerSession;
    protected $contactCollectionFactory;

    public function __construct(
        Template\Context $context,
        \Magento\Customer\Model\SessionFactory $customerSession,
        CustomerContactFactory $contactCollectionFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->customerSession = $customerSession;
        $this->contactCollectionFactory = $contactCollectionFactory;
    }

    public function getContactRequests()
    {

        $collection = $this->contactCollectionFactory->create();

        $customerEmail = $this->customerSession->create()->getCustomer()->getEmail();


        $customerEmail = $this->customerSession->create()->getCustomer()->getEmail();


        $collection->addFieldToFilter('customer_mail', $customerEmail);


        $collection->load();

       // dd($collection);
        return $collection;


    }
}
