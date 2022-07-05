<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220705145542 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client ADD login VARCHAR(180) NOT NULL, ADD roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', ADD password VARCHAR(255) NOT NULL, ADD is_enable TINYINT(1) DEFAULT NULL, ADD token VARCHAR(255) DEFAULT NULL, ADD expire_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD nom VARCHAR(255) DEFAULT NULL, ADD prenom VARCHAR(255) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C7440455AA08CB10 ON client (login)');
        $this->addSql('ALTER TABLE gestionnaire ADD login VARCHAR(180) NOT NULL, ADD roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', ADD password VARCHAR(255) NOT NULL, ADD is_enable TINYINT(1) DEFAULT NULL, ADD token VARCHAR(255) DEFAULT NULL, ADD expire_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD nom VARCHAR(255) DEFAULT NULL, ADD prenom VARCHAR(255) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F4461B20AA08CB10 ON gestionnaire (login)');
        $this->addSql('ALTER TABLE livreur ADD login VARCHAR(180) NOT NULL, ADD roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', ADD password VARCHAR(255) NOT NULL, ADD is_enable TINYINT(1) DEFAULT NULL, ADD token VARCHAR(255) DEFAULT NULL, ADD expire_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD nom VARCHAR(255) DEFAULT NULL, ADD prenom VARCHAR(255) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EB7A4E6DAA08CB10 ON livreur (login)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_C7440455AA08CB10 ON client');
        $this->addSql('ALTER TABLE client DROP login, DROP roles, DROP password, DROP is_enable, DROP token, DROP expire_at, DROP nom, DROP prenom');
        $this->addSql('DROP INDEX UNIQ_F4461B20AA08CB10 ON gestionnaire');
        $this->addSql('ALTER TABLE gestionnaire DROP login, DROP roles, DROP password, DROP is_enable, DROP token, DROP expire_at, DROP nom, DROP prenom');
        $this->addSql('DROP INDEX UNIQ_EB7A4E6DAA08CB10 ON livreur');
        $this->addSql('ALTER TABLE livreur DROP login, DROP roles, DROP password, DROP is_enable, DROP token, DROP expire_at, DROP nom, DROP prenom');
    }
}
