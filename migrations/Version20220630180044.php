<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220630180044 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE catalogue (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE menu_complements');
        $this->addSql('ALTER TABLE portion_frite DROP FOREIGN KEY FK_8F393CADD1322E03');
        $this->addSql('DROP INDEX IDX_8F393CADD1322E03 ON portion_frite');
        $this->addSql('ALTER TABLE portion_frite DROP complements_id');
        $this->addSql('ALTER TABLE taille DROP FOREIGN KEY FK_76508B38D1322E03');
        $this->addSql('DROP INDEX IDX_76508B38D1322E03 ON taille');
        $this->addSql('ALTER TABLE taille DROP complements_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE menu_complements (menu_id INT NOT NULL, complements_id INT NOT NULL, INDEX IDX_52BE81ECCCD7E912 (menu_id), INDEX IDX_52BE81ECD1322E03 (complements_id), PRIMARY KEY(menu_id, complements_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE menu_complements ADD CONSTRAINT FK_52BE81ECD1322E03 FOREIGN KEY (complements_id) REFERENCES complements (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_complements ADD CONSTRAINT FK_52BE81ECCCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE catalogue');
        $this->addSql('ALTER TABLE portion_frite ADD complements_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE portion_frite ADD CONSTRAINT FK_8F393CADD1322E03 FOREIGN KEY (complements_id) REFERENCES complements (id)');
        $this->addSql('CREATE INDEX IDX_8F393CADD1322E03 ON portion_frite (complements_id)');
        $this->addSql('ALTER TABLE taille ADD complements_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE taille ADD CONSTRAINT FK_76508B38D1322E03 FOREIGN KEY (complements_id) REFERENCES complements (id)');
        $this->addSql('CREATE INDEX IDX_76508B38D1322E03 ON taille (complements_id)');
    }
}
