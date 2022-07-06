<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220706150926 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE menu_burger (id INT AUTO_INCREMENT NOT NULL, burger_id INT DEFAULT NULL, menu_id INT DEFAULT NULL, quantite INT DEFAULT NULL, INDEX IDX_3CA402D517CE5090 (burger_id), INDEX IDX_3CA402D5CCD7E912 (menu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu_portion (id INT AUTO_INCREMENT NOT NULL, portionfrite_id INT DEFAULT NULL, menu_id INT DEFAULT NULL, quantite INT DEFAULT NULL, INDEX IDX_685BE098B2D45716 (portionfrite_id), INDEX IDX_685BE098CCD7E912 (menu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE menu_burger ADD CONSTRAINT FK_3CA402D517CE5090 FOREIGN KEY (burger_id) REFERENCES burger (id)');
        $this->addSql('ALTER TABLE menu_burger ADD CONSTRAINT FK_3CA402D5CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('ALTER TABLE menu_portion ADD CONSTRAINT FK_685BE098B2D45716 FOREIGN KEY (portionfrite_id) REFERENCES portion_frite (id)');
        $this->addSql('ALTER TABLE menu_portion ADD CONSTRAINT FK_685BE098CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('DROP TABLE menu_portion_frite');
        $this->addSql('DROP TABLE taille_boisson');
        $this->addSql('ALTER TABLE menu_taille DROP FOREIGN KEY FK_A517D3E0CCD7E912');
        $this->addSql('ALTER TABLE menu_taille DROP FOREIGN KEY FK_A517D3E0FF25611A');
        $this->addSql('ALTER TABLE menu_taille ADD id INT AUTO_INCREMENT NOT NULL, ADD quantite INT DEFAULT NULL, CHANGE menu_id menu_id INT DEFAULT NULL, CHANGE taille_id taille_id INT DEFAULT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE menu_taille ADD CONSTRAINT FK_A517D3E0CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('ALTER TABLE menu_taille ADD CONSTRAINT FK_A517D3E0FF25611A FOREIGN KEY (taille_id) REFERENCES taille (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE menu_portion_frite (menu_id INT NOT NULL, portion_frite_id INT NOT NULL, INDEX IDX_29FA693BCCD7E912 (menu_id), INDEX IDX_29FA693B9B17FA7B (portion_frite_id), PRIMARY KEY(menu_id, portion_frite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE taille_boisson (taille_id INT NOT NULL, boisson_id INT NOT NULL, INDEX IDX_59FAC268FF25611A (taille_id), INDEX IDX_59FAC268734B8089 (boisson_id), PRIMARY KEY(taille_id, boisson_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE menu_portion_frite ADD CONSTRAINT FK_29FA693B9B17FA7B FOREIGN KEY (portion_frite_id) REFERENCES portion_frite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_portion_frite ADD CONSTRAINT FK_29FA693BCCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE taille_boisson ADD CONSTRAINT FK_59FAC268734B8089 FOREIGN KEY (boisson_id) REFERENCES boisson (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE taille_boisson ADD CONSTRAINT FK_59FAC268FF25611A FOREIGN KEY (taille_id) REFERENCES taille (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE menu_burger');
        $this->addSql('DROP TABLE menu_portion');
        $this->addSql('ALTER TABLE menu_taille MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE menu_taille DROP FOREIGN KEY FK_A517D3E0FF25611A');
        $this->addSql('ALTER TABLE menu_taille DROP FOREIGN KEY FK_A517D3E0CCD7E912');
        $this->addSql('ALTER TABLE menu_taille DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE menu_taille DROP id, DROP quantite, CHANGE taille_id taille_id INT NOT NULL, CHANGE menu_id menu_id INT NOT NULL');
        $this->addSql('ALTER TABLE menu_taille ADD CONSTRAINT FK_A517D3E0FF25611A FOREIGN KEY (taille_id) REFERENCES taille (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_taille ADD CONSTRAINT FK_A517D3E0CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_taille ADD PRIMARY KEY (menu_id, taille_id)');
    }
}
