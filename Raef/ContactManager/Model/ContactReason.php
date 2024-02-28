<?php
namespace Raef\ContactManager\Model;

use Magento\Framework\Model\AbstractModel;
use Raef\ContactManager\Model\ResourceModel\ContactReason as ContactReasonResourceModel;

class ContactReason extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(ContactReasonResourceModel::class);
    }


    public function saveReason($reasonLabel)
    {
        $this->setData('reason_label', $reasonLabel)->save();
        return $this;
    }
}
