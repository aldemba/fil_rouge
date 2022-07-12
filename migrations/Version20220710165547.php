<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220710165547 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menu_complements DROP FOREIGN KEY FK_52BE81ECD1322E03');
        $this->addSql('ALTER TABLE portion_frite DROP FOREIGN KEY FK_8F393CADD1322E03');
        $this->addSql('ALTER TABLE taille DROP FOREIGN KEY FK_76508B38D1322E03');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, is_enable TINYINT(1) DEFAULT NULL, token VARCHAR(255) DEFAULT NULL, expire_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_C7440455AA08CB10 (login), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, num_commande VARCHAR(255) DEFAULT NULL, date DATETIME DEFAULT NULL, etat TINYINT(1) DEFAULT NULL, montant DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gestionnaire (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, is_enable TINYINT(1) DEFAULT NULL, token VARCHAR(255) DEFAULT NULL, expire_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_F4461B20AA08CB10 (login), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livraison (id INT AUTO_INCREMENT NOT NULL, montant_total DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livreur (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, is_enable TINYINT(1) DEFAULT NULL, token VARCHAR(255) DEFAULT NULL, expire_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) DEFAULT NULL, matricule_moto VARCHAR(255) DEFAULT NULL, etat TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_EB7A4E6DAA08CB10 (login), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu_burger (id INT AUTO_INCREMENT NOT NULL, burger_id INT DEFAULT NULL, menu_id INT DEFAULT NULL, quantite INT DEFAULT NULL, INDEX IDX_3CA402D517CE5090 (burger_id), INDEX IDX_3CA402D5CCD7E912 (menu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu_portion (id INT AUTO_INCREMENT NOT NULL, portionfrite_id INT DEFAULT NULL, menu_id INT DEFAULT NULL, quantite INT DEFAULT NULL, INDEX IDX_685BE098B2D45716 (portionfrite_id), INDEX IDX_685BE098CCD7E912 (menu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu_taille (id INT AUTO_INCREMENT NOT NULL, taille_id INT DEFAULT NULL, menu_id INT DEFAULT NULL, quantite INT DEFAULT NULL, INDEX IDX_A517D3E0FF25611A (taille_id), INDEX IDX_A517D3E0CCD7E912 (menu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quartiers (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE zone (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, prix DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE menu_burger ADD CONSTRAINT FK_3CA402D517CE5090 FOREIGN KEY (burger_id) REFERENCES burger (id)');
        $this->addSql('ALTER TABLE menu_burger ADD CONSTRAINT FK_3CA402D5CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('ALTER TABLE menu_portion ADD CONSTRAINT FK_685BE098B2D45716 FOREIGN KEY (portionfrite_id) REFERENCES portion_frite (id)');
        $this->addSql('ALTER TABLE menu_portion ADD CONSTRAINT FK_685BE098CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('ALTER TABLE menu_taille ADD CONSTRAINT FK_A517D3E0FF25611A FOREIGN KEY (taille_id) REFERENCES taille (id)');
        $this->addSql('ALTER TABLE menu_taille ADD CONSTRAINT FK_A517D3E0CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('DROP TABLE catalogue');
        $this->addSql('DROP TABLE complements');
        $this->addSql('DROP TABLE menu_complements');
        $this->addSql('DROP TABLE taille_boisson');
        $this->addSql('ALTER TABLE burger DROP FOREIGN KEY FK_EFE35A0DA76ED395');
        $this->addSql('DROP INDEX IDX_EFE35A0DA76ED395 ON burger');
        $this->addSql('ALTER TABLE burger DROP user_id');
        $this->addSql('DROP INDEX IDX_8F393CADD1322E03 ON portion_frite');
        $this->addSql('ALTER TABLE portion_frite DROP complements_id');
        $this->addSql('ALTER TABLE produit ADD user_id INT DEFAULT NULL, CHANGE image image LONGBLOB DEFAULT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC27A76ED395 ON produit (user_id)');
        $this->addSql('DROP INDEX IDX_76508B38D1322E03 ON taille');
        $this->addSql('ALTER TABLE taille DROP complements_id');
        $this->addSql('ALTER TABLE user ADD is_enable TINYINT(1) DEFAULT NULL, ADD token VARCHAR(255) DEFAULT NULL, ADD expire_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD nom VARCHAR(255) DEFAULT NULL, ADD prenom VARCHAR(255) DEFAULT NULL, ADD telephone VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE catalogue (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE complements (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE menu_complements (menu_id INT NOT NULL, complements_id INT NOT NULL, INDEX IDX_52BE81ECCCD7E912 (menu_id), INDEX IDX_52BE81ECD1322E03 (complements_id), PRIMARY KEY(menu_id, complements_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE taille_boisson (taille_id INT NOT NULL, boisson_id INT NOT NULL, INDEX IDX_59FAC268FF25611A (taille_id), INDEX IDX_59FAC268734B8089 (boisson_id), PRIMARY KEY(taille_id, boisson_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE menu_complements ADD CONSTRAINT FK_52BE81ECCCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_complements ADD CONSTRAINT FK_52BE81ECD1322E03 FOREIGN KEY (complements_id) REFERENCES complements (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE taille_boisson ADD CONSTRAINT FK_59FAC268734B8089 FOREIGN KEY (boisson_id) REFERENCES boisson (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE taille_boisson ADD CONSTRAINT FK_59FAC268FF25611A FOREIGN KEY (taille_id) REFERENCES taille (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE gestionnaire');
        $this->addSql('DROP TABLE livraison');
        $this->addSql('DROP TABLE livreur');
        $this->addSql('DROP TABLE menu_burger');
        $this->addSql('DROP TABLE menu_portion');
        $this->addSql('DROP TABLE menu_taille');
        $this->addSql('DROP TABLE quartiers');
        $this->addSql('DROP TABLE zone');
        $this->addSql('ALTER TABLE burger ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE burger ADD CONSTRAINT FK_EFE35A0DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_EFE35A0DA76ED395 ON burger (user_id)');
        $this->addSql('ALTER TABLE portion_frite ADD complements_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE portion_frite ADD CONSTRAINT FK_8F393CADD1322E03 FOREIGN KEY (complements_id) REFERENCES complements (id)');
        $this->addSql('CREATE INDEX IDX_8F393CADD1322E03 ON portion_frite (complements_id)');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27A76ED395');
        $this->addSql('DROP INDEX IDX_29A5EC27A76ED395 ON produit');
        $this->addSql('ALTER TABLE produit DROP user_id, CHANGE image image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE taille ADD complements_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE taille ADD CONSTRAINT FK_76508B38D1322E03 FOREIGN KEY (complements_id) REFERENCES complements (id)');
        $this->addSql('CREATE INDEX IDX_76508B38D1322E03 ON taille (complements_id)');
        $this->addSql('ALTER TABLE user DROP is_enable, DROP token, DROP expire_at, DROP nom, DROP prenom, DROP telephone');
    }
}
