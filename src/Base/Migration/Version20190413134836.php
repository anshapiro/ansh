<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20190413134836 extends AbstractMigration
{
    private const PERMISSIONS = [
        [
            'id' => 'u_m_0',
            'category_name' => 'User Management',
            'permission_name' => 'Create Users'
        ],
        [
            'id' => 'u_m_1',
            'category_name' => 'User Management',
            'permission_name' => 'View Users'
        ],
        [
            'id' => 'u_m_2',
            'category_name' => 'User Management',
            'permission_name' => 'Edit Users'
        ],
    ];

    /**
     * @param Schema $schema
     *
     * @throws \Doctrine\DBAL\DBALException
     */
    public function up(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        foreach (self::PERMISSIONS as $permission) {
            $this->addSql('INSERT INTO PERMISSION (id, category_name, permission_name) VALUES (:permission_id, :category_name, :permission_name)', [
                'permission_id' => $permission['id'],
                'category_name' => $permission['category_name'],
                'permission_name' => $permission['permission_name'],
            ]);
        }
    }

    /**
     * @param Schema $schema
     *
     * @throws \Doctrine\DBAL\DBALException
     */
    public function down(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        foreach (self::PERMISSIONS as $permission) {
            $this->addSql('DELETE FROM PERMISSION WHERE id IN (:permiddion_id)', [
                'permission_id' => $permission['id'],
            ]);
        }
    }
}
