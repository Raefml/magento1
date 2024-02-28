<?php

namespace Raef\ContactManager\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class ContactReason extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('vendor_contact_reasons', 'id');
    }

    public function saveReason($reasonLabel)
    {
        $data = ['reason_label' => $reasonLabel];
        $this->getConnection()->insert($this->getMainTable(), $data);
        return $this;
    }

}
