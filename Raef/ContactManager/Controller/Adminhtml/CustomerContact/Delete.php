<?php
namespace Raef\ContactManager\Controller\Adminhtml\CustomerContact;
use Raef\ContactManager\Model\CustomerContact;
use Magento\Backend\App\Action;

class Delete extends Action
{
    protected $_model;


    public function __construct(
        Action\Context $context,
       CustomerContact $model
    ) {
        parent::__construct($context);
        $this->_model = $model;
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Raef_ContactManager::CustomerContact_delete');
    }

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()



    {



        $id = $this->getRequest()->getParam('id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $model = $this->_model;
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccess(__('Contact delete'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }
        $this->messageManager->addError(__('Contact does not exist'));
        return $resultRedirect->setPath('*/*/');
    }
}

