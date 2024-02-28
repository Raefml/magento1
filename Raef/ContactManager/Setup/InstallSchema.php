<?php
namespace Raef\ContactManager\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        $table = $installer->getConnection()->newTable(
            $installer->getTable('customer_contact')
        )->addColumn(
            'contact_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
            'Contact ID'
        )->addColumn(
            'customer_name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Customer Name'
        )->addColumn(
            'customer_mail',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Customer Email'
        )->addColumn(
            'customer_phone_number',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            20,
            ['nullable' => false],
            'Customer Phone Number'
        )->addColumn(
            'reason',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Reason'
        )->addColumn(
            'contact_request',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            '2M',
            [],
            'Contact Request'
        )->addColumn(
            'contact_response',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            '2M',
            [],
            'Contact Response'
        )->addColumn(
            'contact_creation_date',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
            'Contact Creation Date'
        )->addColumn(
            'contact_modification_date',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
            'Contact Modification Date'
        );
        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }
}
