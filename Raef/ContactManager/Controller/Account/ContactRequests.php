<?php
namespace Raef\ContactManager\Controller\Account;

use Magento\Customer\Controller\AbstractAccount;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Raef\ContactManager\Model\ResourceModel\CustomerContact\Collection;
use Raef\ContactManager\Model\ResourceModel\CustomerContact\CollectionFactory as ContactCollectionFactory;

class ContactRequests extends AbstractAccount
{
    protected $resultPageFactory;
    protected $customerContactFactory;

    public function __construct(
        Context     $context,
        PageFactory $resultPageFactory,
        ContactCollectionFactory $customerContactFactory,

    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
       $this->customerContactFactory = $customerContactFactory; // I
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->set(__('Demandes de contact'));



        return $resultPage;
    }
}
