<?php

namespace Raef\ContactManager\Block\Adminhtml\System\Config\Form\Field;

use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Raef\ContactManager\Model\ResourceModel\ContactReason;

class SaveButton extends Field
{
    protected $contactReasonResource;
    protected $scopeConfig;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        ContactReason $contactReasonResource,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->contactReasonResource = $contactReasonResource;
        $this->scopeConfig = $scopeConfig;
    }
    protected function _getElementHtml(AbstractElement $element)
    {
        $button = $this->getLayout()->createBlock('Magento\Backend\Block\Widget\Button')
            ->setData([
                'id' => 'save_reason_button',
                'label' => __('Save Reason'),
                'onclick' => 'javascript:saveReason(); return false;'
            ]);

        $reasonLabel = $this->scopeConfig->getValue('section/group/field', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);



        $this->contactReasonResource->saveReason($reasonLabel);

        return parent::_getElementHtml($element);
    }
}

