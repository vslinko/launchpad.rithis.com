<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20120619161915 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $accounts = $schema->createTable('accounts');
        $accounts->addColumn('id', 'integer', array('autoincrement' => true));
        $accounts->addColumn('username', 'string', array('length' => 32));
        $accounts->addColumn('email', 'string', array('length' => 254));
        $accounts->addColumn('password', 'string', array('length' => 128));
        $accounts->addColumn('salt', 'string', array('length' => 128));
        $accounts->addColumn('account_expiration_date', 'datetime', array('notnull' => false));
        $accounts->addColumn('account_non_locked', 'boolean', array('default' => true));
        $accounts->addColumn('credentials_expiration_date', 'datetime', array('notnull' => false));
        $accounts->addColumn('enabled', 'boolean', array('default' => true));
        $accounts->setPrimaryKey(array('id'), 'accounts_pk');
        $accounts->addUniqueIndex(array('username'), 'accounts_username_unique');
        $accounts->addUniqueIndex(array('email'), 'accounts_email_unique');

        $roles = $schema->createTable('roles');
        $roles->addColumn('id', 'integer', array('autoincrement' => true));
        $roles->addColumn('role', 'string', array('length' => 32));
        $roles->setPrimaryKey(array('id'), 'roles_pk');

        $accountsRoles = $schema->createTable('accounts_roles');
        $accountsRoles->addColumn('account_id', 'integer');
        $accountsRoles->addColumn('role_id', 'integer');
        $accountsRoles->setPrimaryKey(array('account_id', 'role_id'), 'accounts_roles_pk');
        $accountsRoles->addForeignKeyConstraint($accounts, array('account_id'), array('id'), array(), 'accounts_fk');
        $accountsRoles->addForeignKeyConstraint($roles, array('role_id'), array('id'), array(), 'roles_fk');
    }

    public function down(Schema $schema)
    {
        $schema->dropTable('accounts_roles');
        $schema->dropTable('roles');
        $schema->dropTable('accounts');
    }
}
