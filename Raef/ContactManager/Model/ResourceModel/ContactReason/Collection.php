<?php
namespace Raef\ContactManager\Model\ResourceModel\ContactReason;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Raef\ContactManager\Model\ContactReason as ContactReasonModel;
use Raef\ContactManager\Model\ResourceModel\ContactReason as ContactReasonResourceModel;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'id';

    protected function _construct()
    {
        $this->_init(
            ContactReasonModel::class,
            ContactReasonResourceModel::class
        );
    }
}
