<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20190414144022 extends AbstractMigration
{
    /**
     * @param Schema $schema
     *
     * @throws \Doctrine\DBAL\DBALException
     */
    public function up(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE status (id VARCHAR(255) NOT NULL, status_name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_7B00651C6625D392 (status_name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE patient ADD status_id VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EB6BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('CREATE INDEX IDX_1ADAD7EB6BF700BD ON patient (status_id)');

        $this->addSql('INSERT INTO status (id, status_name) VALUES (:status_id, :status_name)', [
            'status_id' => '98463301-e79e-4162-a28d-edc0c6334aef',
            'status_name' => 'New',
        ]);
    }

    /**
     * @param Schema $schema
     *
     * @throws \Doctrine\DBAL\DBALException
     */
    public function down(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE patient DROP FOREIGN KEY FK_1ADAD7EB6BF700BD');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP INDEX IDX_1ADAD7EB6BF700BD ON patient');
        $this->addSql('ALTER TABLE patient DROP status_id');

        $this->addSql('DELETE FROM status WHERE id = :status_id', [
            'status_id' => '98463301-e79e-4162-a28d-edc0c6334aef',
        ]);
    }
}
