<?php
//namespace Raef\ContactManager\Block\Adminhtml\CustomerContact\Edit;
//
//use Magento\Backend\Block\Widget\Form\Generic;
//use Magento\Backend\Block\Widget\Button;
//
//class Form extends Generic
//{
//    /**
//     * @var \Magento\Store\Model\System\Store
//     */
//    protected $_systemStore;
//
//    /**
//     * @param \Magento\Backend\Block\Template\Context $context
//     * @param \Magento\Framework\Registry $registry
//     * @param \Magento\Store\Model\System\Store $systemStore
//     * @param array $data
//     */
//    public function __construct(
//        \Magento\Backend\Block\Template\Context $context,
//        \Magento\Framework\Registry $registry,
//        \Magento\Framework\Data\FormFactory $formFactory,
//        \Magento\Store\Model\System\Store $systemStore,
//        array $data = []
//    ) {
//        $this->_systemStore = $systemStore;
//        parent::__construct($context, $registry, $formFactory, $data);
//    }
//
//    /**
//     * Init form
//     *
//     * @return void
//     */
//    protected function _construct()
//    {
//        parent::_construct();
//        $this->setId('customercontact_form');
//        $this->setTitle(__('CustomerContact Information'));
//    }
//
//    /**
//     * Prepare form
//     *
//     * @return $this
//     */
//
//    protected function _prepareLayout(): static
//    {
//        $this->addChild(
//            'edit_button',
//            Button::class,
//            [
//                'label' => __('Edit'),
//                'onclick' => 'setLocation(\'' . $this->getUrl('*/*/edit', ['id' => $this->getRequest()->getParam('id')]) . '\')',
//                'class' => 'edit'
//            ]
//        );
//
//        return parent::_prepareLayout();
//    }
//    protected function _prepareForm()
//
//
//    {
//
//        /** @var \Raef\ContactManager\Model\CustomerContact $model */
//        $model = $this->_coreRegistry->registry('contactmanager_customercontact');
//
//
//
//        /** @var \Magento\Framework\Data\Form $form */
//        $form = $this->_formFactory->create(
//            ['data' => ['id' => 'edit_form', 'action' => $this->getUrl('contactmanager/customercontact/save'), 'method' => 'post']]
//        );
//
//        $form->setHtmlIdPrefix('customercontact_');
//
//
//
//        $fieldset = $form->addFieldset(
//            'base_fieldset',
//            ['legend' => __('General Information'), 'class' => 'fieldset-wide']
//        );
//
//        if ($model && $model->getId()) {
//            $fieldset->addField('contact_id', 'hidden', ['name' => 'contact_id', 'value' => $model->getId()]);
//        }
//
//
//
//        $fieldset->addField(
//            'contact_response',
//            'textarea',
//            ['name' => 'contact_response', 'label' => __('Contact Response'), 'title' => __('Contact Response'), 'required' => true]
//        );
//
//        $fieldset->addField(
//            'save_button',
//            'submit',
//            [
//                'name' => 'save_button',
//                'value' => __('Save'),
//                'class' => 'primary',
//                'style' => 'margin-top: 20px; margin-left: 800px; width: 100px; font-size: 16px; background-color: orange; color: #fff;', // Ajout de marge en haut, largeur, taille de police et couleur de fond personnalisées
//                'tabindex' => 20, // Ordre de tabulation du champ
//                'after_element_html' => '<style>#save_button::after { content: "Click here to save"; }</style>', // Pseudo-élément pour ajouter le titre
//            ]
//        );
//
//        $form->setValues($model->getData());
//        $form->setUseContainer(true);
//        $this->setForm($form);
//
//        return parent::_prepareForm();
//    }
//}


namespace Raef\ContactManager\Block\Adminhtml\CustomerContact\Edit;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Button;

class Form extends Generic
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;


    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Init form
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('customercontact_form');
        $this->setTitle(__('CustomerContact Information'));



    }

    public function getHeaderText()
    {
        if ($this->_coreRegistry->registry('contactmanager_customercontact')->getId()) {
            return __("Edit contactmanager '%1'", $this->escapeHtml($this->_coreRegistry->registry('contactmanager_customercontact')->getName()));
        } else {
            return __('New contactmanager');
        }
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {

        $this->getHeaderText();
        /** @var \Raef\ContactManager\Model\CustomerContact $model */
        $model = $this->_coreRegistry->registry('contactmanager_customercontact');

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            ['data' => ['id' => 'edit_form', 'action' => $this->getUrl('contactmanager/customercontact/save'), 'method' => 'post']]
        );

        $form->setHtmlIdPrefix('customercontact_');

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('General Information'), 'class' => 'fieldset-wide']
        );

        if ($model && $model->getId()) {
            $fieldset->addField('contact_id', 'hidden', ['name' => 'contact_id', 'value' => $model->getId()]);
        }

        $fieldset->addField(
            'contact_response',
            'textarea',
            ['name' => 'contact_response', 'label' => __('Contact Response'), 'title' => __('Contact Response'), 'required' => true]
        );







        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
