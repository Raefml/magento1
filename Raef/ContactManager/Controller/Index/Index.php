<?php
namespace Raef\ContactManager\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\MailException;
use Magento\Framework\View\Result\PageFactory;
use Raef\ContactManager\Model\CustomerContactFactory;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Store\Model\StoreManagerInterface;

use Raef\ContactManager\Model\ResourceModel\CustomerContact\CollectionFactory;
use Raef\ContactManager\Model\CustomerContact;

class Index extends Action
{
    protected $resultPageFactory;
    protected $customerContactFactory;
    protected $transportBuilder;
    protected $inlineTranslation;
    protected $storeManager;

    public function __construct(
        Context                $context,
        PageFactory            $resultPageFactory,
        CustomerContactFactory  $customerContactFactory,
        TransportBuilder       $transportBuilder,
        StateInterface         $inlineTranslation
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->customerContactFactory = $customerContactFactory;
        $this->transportBuilder = $transportBuilder;
        $this->inlineTranslation = $inlineTranslation;
    }
    public function execute()
    {
        $postData = $this->getRequest()->getPostValue();

        if ($postData) {
            try {
                $customerContactCollection = $this->customerContactFactory->create(); // Correction du nom de la variable
                $data = [
                    'customer_name' => $postData['name'],
                    'customer_mail' => $postData['email'],
                    'contact_request' => $postData['request'],
                    'customer_phone_number' => $postData['phone'],
                    'reason' => $postData['reason'],
                    'contact_creation_date' => date('Y-m-d H:i:s'),
                    'contact_modification_date' => date('Y-m-d H:i:s'),
                ];
                $customerContactCollection->saveContact($data);
               // $this->sendEmail($postData);
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('Error occurred while saving contact: %1', $e->getMessage()));
            }
        }

        // return $this->resultRedirectFactory->create()->setPath('*/*/'); // Rediriger vers la page précédente ou la page d'accueil
        return $this->resultPageFactory->create();
    }


    /**
     * @throws MailException
     * @throws LocalizedException
     */
    protected function sendEmail($postData): void
    {
        $sender = [
            'name' => $postData['name'] ?? '',
            'email' => "raef.bouchahda@etudiant-enit.utm.tn"
        ];

        $recipientEmail = $postData['email'] ?? '';
        $recipientName = 'raef';


        if ($sender['name'] && $sender['email'] && $recipientEmail) {
            $emailTemplateVariables = [
                'name' => $postData['name'] ?? '',
                'email' => $postData['email'] ?? '',
                'phone' => $postData['phone'] ?? '',
                'reason' => $postData['reason'] ?? '',
                'request' => $postData['request'] ?? ''
            ];

            $this->inlineTranslation->suspend();

            $emailTemplateId = '1';

            $transport = $this->transportBuilder
                ->setTemplateIdentifier($emailTemplateId)
                ->setTemplateOptions(['area' => \Magento\Framework\App\Area::AREA_FRONTEND, 'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID])
                ->setTemplateVars($emailTemplateVariables)
                ->setFrom($sender)
                ->addTo($recipientEmail, $recipientName)
                ->getTransport();




            // Envoyer l'e-mail
            $transport->sendMessage();
            $this->inlineTranslation->resume();
        } else {
            // Gérer le cas où une valeur est NULL
            throw new \InvalidArgumentException('One or more email values are NULL');
        }
    }

}
