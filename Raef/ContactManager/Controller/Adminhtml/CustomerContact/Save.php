<?php
namespace Raef\ContactManager\Controller\Adminhtml\CustomerContact;

use Magento\Backend\App\Action;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Translate\Inline\StateInterface;
use Raef\ContactManager\Model\CustomerContactFactory;

class Save extends Action
{

    protected $_model;

    protected $resultPageFactory;
    protected $transportBuilder;
    protected $inlineTranslation;
    protected $_coreRegistry = null;

    public function __construct(
        \Raef\ContactManager\Model\CustomerContact $model,
        Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $registry,
        TransportBuilder $transportBuilder,
        StateInterface $inlineTranslation
    ) {
        parent::__construct($context);
        $this->_model = $model;
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
        $this->transportBuilder = $transportBuilder;
        $this->inlineTranslation = $inlineTranslation;
        parent::__construct($context);
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Raef_ContactManager::CustomerContact_save');
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            /** @var \Raef\ContactManager\Model\CustomerContact $model */
            $model = $this->_model;


            $id = $this->getRequest()->getParam('contact_id');

            if ($id) {
                $model->load($id);
                $this->sendEmail($model);


            }

            $model->setData($data);

            $this->_eventManager->dispatch(
                'ContactManager_prepare_save',
                ['CustomerContact' => $model, 'request' => $this->getRequest()]
            );

            try {

                $model->save();
                $this->messageManager->addSuccess(__('CustomerContact saved'));


                $this->_getSession()->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving CustomerContact'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['contact_id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }


    protected function sendEmail($model): void
    {
        try {
            $senderName = 'Raef';
            $senderEmail = 'raef.bouchahda@etudiant-enit.utm.tn';
            $customerName = $model->getCustomerName();
            $customerEmail = $model->getCustomerMail();
            $contactResponse = $model->getContactResponse();
            $contactRequestDate = $model->getContactCreationDate();

            if ($senderName && $senderEmail && $customerEmail && $contactResponse) {
                // Vérifiez chaque valeur d'e-mail individuellement
                if (!empty($senderName) && !empty($senderEmail) && !empty($customerEmail) && !empty($contactResponse)) {
                    $templateVars = [
                        'customer_name' => $customerName,
                        'customer_email' => $customerEmail,
                        'response' => $contactResponse,
                        'contact_request_date' => $contactRequestDate,
                    ];

                    $this->inlineTranslation->suspend();

                    $emailTemplateId = '2';

                    $transport = $this->transportBuilder
                        ->setTemplateIdentifier($emailTemplateId)
                        ->setTemplateOptions(['area' => \Magento\Framework\App\Area::AREA_FRONTEND, 'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID])
                        ->setTemplateVars($templateVars)
                        ->setFrom(['email' => $senderEmail, 'name' => $senderName])
                        ->addTo($customerEmail, $customerName)
                        ->getTransport();

                    // Envoyer l'e-mail
                    $transport->sendMessage();
                    $this->inlineTranslation->resume();
                } else {
                    throw new \InvalidArgumentException('One or more required email values are empty.');
                }
            } else {
                throw new \InvalidArgumentException('One or more required email values are missing.');
            }

        } catch (\Exception $e) {
            $this->messageManager->addError(__('An error occurred while sending the email: %1', $e->getMessage()));
        }
    }



}
