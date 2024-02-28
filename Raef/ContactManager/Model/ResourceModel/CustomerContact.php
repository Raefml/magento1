<?php
namespace Raef\ContactManager\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class CustomerContact extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('customer_contact', 'contact_id');
    }

    public function saveContact($data)
    {
        $connection = $this->getConnection();
        $tableName = $this->getMainTable();

        $connection->insert($tableName, $data);
    }
}
