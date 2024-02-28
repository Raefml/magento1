<?php
namespace Raef\ContactManager\Controller\Adminhtml\CustomerContact;

use Magento\Backend\App\Action;

class Edit extends Action
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_resultPageFactory;


    protected $_model;


    public function __construct(
        Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $registry,
        \Raef\ContactManager\Model\CustomerContact $model
    ) {
        $this->_resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
        $this->_model = $model;
        parent::__construct($context);
    }

    /**
     * {@inheritdoc}
     */
//    protected function _isAllowed()
//    {
//        return $this->_authorization->isAllowed('Raef_ContactManager::CustomerContact_save');
//    }

    /**
     * Init actions
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    protected function _initAction()
    {

        // load layout, set active menu and breadcrumbs

        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('Raef_ContactManager::CustomerContact')
            ->addBreadcrumb(__('CustomerContact'), __('CustomerContact'))
            ->addBreadcrumb(__('Manage CustomerContact'), __('Manage CustomerContact'));
        return $resultPage;
    }

    /**
     * Edit Department
     *
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Backend\Model\View\Result\Redirect
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $model = $this->_model;

        // If you have got an id, it's edition
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This CustomerContact not exists.'));
                /** \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();

                return $resultRedirect->setPath('*/*/');
            }
        }

        $data = $this->_getSession()->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);

        }

        $this->_coreRegistry->register('contactmanager_customercontact', $model);

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_initAction();
        $resultPage->addBreadcrumb(
            $id ? __('Edit CustomerContact') : __('New CustomerContact'),
            $id ? __('Edit CustomerContact') : __('New CustomerContact')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('contactmanager_customercontact'));
        $resultPage->getConfig()->getTitle()
            ->prepend($model->getId() ? $model->getName() : __('New CustomerContact'));

        return $resultPage;
    }
}
