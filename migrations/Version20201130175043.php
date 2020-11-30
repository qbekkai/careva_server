<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201130175043 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE sites (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_BC00AA635E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE colors (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_C2BEC39F5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projects (id INT AUTO_INCREMENT NOT NULL, site_id INT NOT NULL, client_id INT NOT NULL, project_type_id INT DEFAULT NULL, event_type_id INT DEFAULT NULL, event_id INT DEFAULT NULL, color_id INT DEFAULT NULL, id_project INT DEFAULT NULL, publish_date DATETIME NOT NULL, visibility TINYINT(1) NOT NULL, year INT NOT NULL, medias JSON NOT NULL, UNIQUE INDEX UNIQ_5C93B3A4F12E799E (id_project), INDEX IDX_5C93B3A4F6BD1646 (site_id), INDEX IDX_5C93B3A419EB6921 (client_id), INDEX IDX_5C93B3A4535280F6 (project_type_id), INDEX IDX_5C93B3A4401B253C (event_type_id), INDEX IDX_5C93B3A471F7E88B (event_id), INDEX IDX_5C93B3A47ADA1FB5 (color_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_types (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_182B381C5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE events (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(200) NOT NULL, UNIQUE INDEX UNIQ_5387574A5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_types (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, UNIQUE INDEX UNIQ_4A6580AE5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) DEFAULT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, username VARCHAR(50) NOT NULL, fistname VARCHAR(100) DEFAULT NULL, lastname VARCHAR(100) DEFAULT NULL, registration_at DATETIME NOT NULL, last_login DATETIME NOT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clients (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(200) NOT NULL, thumb VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_C82E745E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE projects ADD CONSTRAINT FK_5C93B3A4F6BD1646 FOREIGN KEY (site_id) REFERENCES sites (id)');
        $this->addSql('ALTER TABLE projects ADD CONSTRAINT FK_5C93B3A419EB6921 FOREIGN KEY (client_id) REFERENCES clients (id)');
        $this->addSql('ALTER TABLE projects ADD CONSTRAINT FK_5C93B3A4535280F6 FOREIGN KEY (project_type_id) REFERENCES project_types (id)');
        $this->addSql('ALTER TABLE projects ADD CONSTRAINT FK_5C93B3A4401B253C FOREIGN KEY (event_type_id) REFERENCES event_types (id)');
        $this->addSql('ALTER TABLE projects ADD CONSTRAINT FK_5C93B3A471F7E88B FOREIGN KEY (event_id) REFERENCES events (id)');
        $this->addSql('ALTER TABLE projects ADD CONSTRAINT FK_5C93B3A47ADA1FB5 FOREIGN KEY (color_id) REFERENCES colors (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE projects DROP FOREIGN KEY FK_5C93B3A4F6BD1646');
        $this->addSql('ALTER TABLE projects DROP FOREIGN KEY FK_5C93B3A47ADA1FB5');
        $this->addSql('ALTER TABLE projects DROP FOREIGN KEY FK_5C93B3A4401B253C');
        $this->addSql('ALTER TABLE projects DROP FOREIGN KEY FK_5C93B3A471F7E88B');
        $this->addSql('ALTER TABLE projects DROP FOREIGN KEY FK_5C93B3A4535280F6');
        $this->addSql('ALTER TABLE projects DROP FOREIGN KEY FK_5C93B3A419EB6921');
        $this->addSql('DROP TABLE sites');
        $this->addSql('DROP TABLE colors');
        $this->addSql('DROP TABLE projects');
        $this->addSql('DROP TABLE event_types');
        $this->addSql('DROP TABLE events');
        $this->addSql('DROP TABLE project_types');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE clients');
    }
}
