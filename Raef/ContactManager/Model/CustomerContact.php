<?php
namespace Raef\ContactManager\Model;

use Magento\Framework\Model\AbstractModel;

class CustomerContact extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(\Raef\ContactManager\Model\ResourceModel\CustomerContact::class);
    }

    /**
     * Save contact data
     *
     * @param array $data
     * @return $this
     */
    public function saveContact(array $data)
    {
        // Ajoutez votre logique de sauvegarde ici
        $this->setData($data);
        $this->save();
        return $this;
    }

    /**
     * Get customer email
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->getData('customer_mail');
    }

    /**
     * Get contact response
     *
     * @return string|null
     */
    public function getYourResponse()
    {
        return $this->getData('contact_response'); // Assuming 'contact_response' is the column name where you store the response
    }
}
