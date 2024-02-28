<?php
namespace Raef\ContactManager\Model\ResourceModel\CustomerContact;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Raef\ContactManager\Model\CustomerContact as CustomerContactModel;
use Raef\ContactManager\Model\ResourceModel\CustomerContact as CustomerContactResourceModel;

/**
 * @method getCollection()
 */
class Collection extends AbstractCollection
{
    protected $_idFieldName = 'contact_id';

    protected function _construct()
    {
        $this->_init(CustomerContactModel::class, CustomerContactResourceModel::class);
    }

    public function saveContact(array $data)
    {
        $customerContactModel = $this->getNewEmptyItem(); // Créer une nouvelle instance de modèle
        $customerContactModel->setData($data); // Définir les données
        $customerContactModel->save(); // Enregistrer le modèle
    }
}
