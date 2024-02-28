<?php


 namespace Raef\ContactManager\Controller\Adminhtml\Config;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Raef\ContactManager\Model\ContactReasonFactory;

class Save extends Action
{
    protected $contactReasonFactory;

    public function __construct(
        Context $context,
        ContactReasonFactory $contactReasonFactory
    ) {
        parent::__construct($context);
        $this->contactReasonFactory = $contactReasonFactory;
    }

    public function execute()
    {


        $data = $this->getRequest()->getPostValue();


        // Récupérer la valeur du champ 'reason_label'
        if (!empty($data['groups']['reasons']['fields']['reason_label'])) {
            $reasonLabel = $data['groups']['reasons']['fields']['reason_label'];

            // Sauvegarder la valeur dans votre table
            $this->saveReasonToDatabase($reasonLabel);
        }


        $this->_redirect('adminhtml/system_config/edit/section/contact');
    }

    protected function saveReasonToDatabase($reasonLabel)
    {

        $contactReason = $this->contactReasonFactory->create();


        $contactReason->setData('reason_label', $reasonLabel);


        $contactReason->save();
    }
}
