<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191126173032 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('sqlite' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('CREATE TABLE disjfa_translations (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, domain VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, text CLOB NOT NULL, locale VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE phpmob_settings (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, section VARCHAR(100) NOT NULL, key_name VARCHAR(100) NOT NULL, value CLOB DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, owner VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_SECTION ON phpmob_settings (section)');
        $this->addSql('CREATE INDEX IDX_KEY_NAME ON phpmob_settings (key_name)');
        $this->addSql('CREATE INDEX IDX_OWNER ON phpmob_settings (owner)');
        $this->addSql('CREATE UNIQUE INDEX UIDX_SETTING ON phpmob_settings (section, key_name, owner)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('sqlite' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE disjfa_translations');
        $this->addSql('DROP TABLE phpmob_settings');
    }
}
