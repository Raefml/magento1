<?php
namespace Raef\ContactManager\Block\Adminhtml\CustomerContact;

use Magento\Backend\Block\Widget\Form\Container;

class Edit extends Container
{
    protected $_coreRegistry = null;

    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }


    protected function _construct()
    {

        $this->_objectId = 'contact_id';
        $this->_blockGroup = 'Raef_ContactManager';
        $this->_controller = 'adminhtml_CustomerContact';

        parent::_construct();

        $this->buttonList->update('save', 'label', __('Save Department'));
        $this->buttonList->add(
            'saveandcontinue',
            [
                'label' => __('Save and Continue Edit'),
                'class' => 'save',
                'data_attribute' => [
                    'mage-init' => [
                        'button' => ['event' => 'saveAndContinueEdit', 'target' => '#edit_form'],
                    ],
                ]
            ],
            -100
        );
    }

    public function getHeaderText()
    {
        if ($this->_coreRegistry->registry('contactmanager_customercontact')->getId()) {
            return __("Edit contactmanager '%1'", $this->escapeHtml($this->_coreRegistry->registry('contactmanager_customercontact')->getName()));
        } else {
            return __('New contactmanager');
        }
    }


//    protected function _isAllowedAction($resourceId)
//    {
//        return $this->_authorization->isAllowed($resourceId);
//    }

    /**
     * Getter of url for "Save and Continue" button
     * tab_id will be replaced by desired by JS later
     *
     * @return string
     */
    protected function _getSaveAndContinueUrl()
    {
        return $this->getUrl('contactmanager/*/save', ['_current' => true, 'back' => 'edit', 'active_tab' => '']);

    }


}
