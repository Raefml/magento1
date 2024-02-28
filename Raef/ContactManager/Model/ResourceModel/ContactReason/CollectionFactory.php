<?php
namespace Raef\ContactManager\Model\ResourceModel\ContactReason;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class CollectionFactory
{
    protected $_objectManager;
    protected $_instanceName;

    public function __construct(
        \Magento\Framework\ObjectManagerInterface $objectManager,
                                                  $instanceName = '\\Raef\\ContactManager\\Model\\ResourceModel\\ContactReason\\Collection'
    ) {
        $this->_objectManager = $objectManager;
        $this->_instanceName = $instanceName;
    }

    public function create(array $data = [])
    {
        return $this->_objectManager->create($this->_instanceName, $data);
    }
}
