<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200328113907 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE education (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE education_additional (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE person (id INT AUTO_INCREMENT NOT NULL, education_id INT DEFAULT NULL, education_additional_id INT DEFAULT NULL, list_code SMALLINT NOT NULL, list_date DATE NOT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, patronymic VARCHAR(255) DEFAULT NULL, photos LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', birth_date VARCHAR(255) DEFAULT NULL, place_of_birth VARCHAR(255) DEFAULT NULL, marital_status VARCHAR(255) DEFAULT NULL, dwelling_place VARCHAR(255) DEFAULT NULL, nationality VARCHAR(255) DEFAULT NULL, social_status VARCHAR(255) DEFAULT NULL, partying VARCHAR(255) DEFAULT NULL, working_position VARCHAR(255) DEFAULT NULL, conviction VARCHAR(255) DEFAULT NULL, date_of_arrest DATE DEFAULT NULL, investigator VARCHAR(255) DEFAULT NULL, convict VARCHAR(255) DEFAULT NULL, session_date DATE DEFAULT NULL, presenter VARCHAR(255) DEFAULT NULL, session_participants LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', blame VARCHAR(512) DEFAULT NULL, clauses LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', verdict VARCHAR(512) DEFAULT NULL, verdict_date DATE DEFAULT NULL, rehabilitation VARCHAR(512) DEFAULT NULL, notes VARCHAR(512) DEFAULT NULL, rank_in_past VARCHAR(255) DEFAULT NULL, INDEX IDX_34DCD1762CA1BD71 (education_id), INDEX IDX_34DCD1768490B586 (education_additional_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD1762CA1BD71 FOREIGN KEY (education_id) REFERENCES education (id)');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD1768490B586 FOREIGN KEY (education_additional_id) REFERENCES education_additional (id)');

        // Sed data.
        $sqlEducation = file_get_contents(__DIR__.'/data/stalin-list-education.sql');
        $sqlEducationAdditional = file_get_contents(__DIR__.'/data/stalin-list-education-additional.sql');
        $sqlPerson = file_get_contents(__DIR__.'/data/stalin-list-person.sql');
        $this->addSql($sqlEducation);
        $this->addSql($sqlEducationAdditional);
        $this->addSql($sqlPerson);
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD1768490B586');
        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD1762CA1BD71');
        $this->addSql('DROP TABLE education');
        $this->addSql('DROP TABLE education_additional');
        $this->addSql('DROP TABLE person');
    }
}
