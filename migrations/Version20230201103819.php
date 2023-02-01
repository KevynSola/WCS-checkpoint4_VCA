<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230201103819 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE target ADD killer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE target ADD CONSTRAINT FK_466F2FFCCD5FD5FF FOREIGN KEY (killer_id) REFERENCES killer (id)');
        $this->addSql('CREATE INDEX IDX_466F2FFCCD5FD5FF ON target (killer_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE target DROP FOREIGN KEY FK_466F2FFCCD5FD5FF');
        $this->addSql('DROP INDEX IDX_466F2FFCCD5FD5FF ON target');
        $this->addSql('ALTER TABLE target DROP killer_id');
    }
}
