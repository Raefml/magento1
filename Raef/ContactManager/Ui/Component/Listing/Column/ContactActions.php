<?php
///**
// * Copyright © 2015 Magento. All rights reserved.
// * See COPYING.txt for license details.
// */
//namespace Raef\ContactManager\Ui\Component\Listing\Column;
//
//use Magento\Framework\View\Element\UiComponent\ContextInterface;
//use Magento\Framework\View\Element\UiComponentFactory;
//use Magento\Ui\Component\Listing\Columns\Column;
//use Magento\Framework\UrlInterface;
//
///**
// * Class DepartmentActions
// */
//class ContactActions extends Column
//{
//    /**
//     * @var UrlInterface
//     */
//    protected $urlBuilder;
//
//    /**
//     * @param ContextInterface $context
//     * @param UiComponentFactory $uiComponentFactory
//     * @param UrlInterface $urlBuilder
//     * @param array $components
//     * @param array $data
//     */
//    public function __construct(
//        ContextInterface $context,
//        UiComponentFactory $uiComponentFactory,
//        UrlInterface $urlBuilder,
//        array $components = [],
//        array $data = []
//    ) {
//        $this->urlBuilder = $urlBuilder;
//        parent::__construct($context, $uiComponentFactory, $components, $data);
//    }
//
//    /**
//     * Prepare Data Source
//     *
//     * @param array $dataSource
//     * @return array
//     */
//    public function prepareDataSource(array $dataSource)
//    {
//        if (isset($dataSource['data']['items'])) {
//            foreach ($dataSource['data']['items'] as &$item) {
//                $item[$this->getData('name')]['edit'] = [
//                    'href' => $this->urlBuilder->getUrl(
//                        'contactmanager/customercontact/Edit',
//                        ['id' => $item['contact_id']]
//                    ),
//                    'label' => __('Edit'),
//                    'hidden' => false,
//                ];
//                $item[$this->getData('name')]['delete'] = [
//                    'href' => $this->urlBuilder->getUrl(
//                        'contactmanager/customercontact/delete',
//                        ['id' => $item['contact_id']]
//                    ),
//                    'label' => __('delete'),
//                    'hidden' => false,
//                ];
//            }
//        }
//
//        return $dataSource;
//    }
//}

/**
 * Raef ContactManager
 */

namespace Raef\ContactManager\Ui\Component\Listing\Column;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

/**
 * Class ContactActions
 */
class ContactActions extends Column
{
    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface   $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface       $urlBuilder,
        array              $components = [],
        array              $data = []
    )
    {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $id = $item['contact_id'];
                $item[$this->getData('name')]['edit'] = [
                    'href' => $this->urlBuilder->getUrl(
                        'contactmanager/customercontact/edit',
                        ['id' => $id]
                    ),
                    'label' => __('Edit'),
                    'hidden' => false,
                ];
                $item[$this->getData('name')]['delete'] = [
                    'href' => $this->urlBuilder->getUrl(
                        'contactmanager/customercontact/delete',
                        ['id' => $id]
                    ),
                    'label' => __('Delete'),
                    'confirm' => [
                        'title' => __('Delete Contact'),
                        'message' => __('Are you sure you want to delete this contact?')
                    ],
                    'hidden' => false,
                ];
            }
        }

        return $dataSource;
    }
}
