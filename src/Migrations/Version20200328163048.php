<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200328163048 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE data_list (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE education (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE education_additional (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nationality (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE social_status (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marital_status (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clause (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE court_representative (id INT AUTO_INCREMENT NOT NULL, surname VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE convict_organization (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE person (id INT AUTO_INCREMENT NOT NULL, education_id INT DEFAULT NULL, education_additional_id INT DEFAULT NULL, list_id INT NOT NULL, social_status_id INT DEFAULT NULL, nationality_id INT NOT NULL, marital_status_id INT DEFAULT NULL, convict_id INT DEFAULT NULL, presenter_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, patronymic VARCHAR(255) DEFAULT NULL, photos LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', birth_date VARCHAR(255) DEFAULT NULL, place_of_birth VARCHAR(255) DEFAULT NULL, dwelling_place VARCHAR(255) DEFAULT NULL, partying VARCHAR(255) DEFAULT NULL, working_position VARCHAR(255) DEFAULT NULL, conviction VARCHAR(255) DEFAULT NULL, date_of_arrest DATE DEFAULT NULL, investigator VARCHAR(255) DEFAULT NULL, session_date DATE DEFAULT NULL, blame VARCHAR(512) DEFAULT NULL, verdict VARCHAR(512) DEFAULT NULL, verdict_date DATE DEFAULT NULL, rehabilitation VARCHAR(512) DEFAULT NULL, notes VARCHAR(512) DEFAULT NULL, rank_in_past VARCHAR(255) DEFAULT NULL, INDEX IDX_34DCD1762CA1BD71 (education_id), INDEX IDX_34DCD1768490B586 (education_additional_id), INDEX IDX_34DCD1763DAE168B (list_id), INDEX IDX_34DCD17659A15DCA (social_status_id), INDEX IDX_34DCD1761C9DA55 (nationality_id), INDEX IDX_34DCD176E559F9BF (marital_status_id), INDEX IDX_34DCD1769C6DB60E (convict_id), INDEX IDX_34DCD176DDE4C635 (presenter_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE person_court_representative (person_id INT NOT NULL, court_representative_id INT NOT NULL, INDEX IDX_FBCDB41F217BBB47 (person_id), INDEX IDX_FBCDB41FFBE454BE (court_representative_id), PRIMARY KEY(person_id, court_representative_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE person_clause (person_id INT NOT NULL, clause_id INT NOT NULL, INDEX IDX_17AFF392217BBB47 (person_id), INDEX IDX_17AFF39259074614 (clause_id), PRIMARY KEY(person_id, clause_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD1762CA1BD71 FOREIGN KEY (education_id) REFERENCES education (id)');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD1768490B586 FOREIGN KEY (education_additional_id) REFERENCES education_additional (id)');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD1763DAE168B FOREIGN KEY (list_id) REFERENCES data_list (id)');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD17659A15DCA FOREIGN KEY (social_status_id) REFERENCES social_status (id)');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD1761C9DA55 FOREIGN KEY (nationality_id) REFERENCES nationality (id)');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD176E559F9BF FOREIGN KEY (marital_status_id) REFERENCES marital_status (id)');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD1769C6DB60E FOREIGN KEY (convict_id) REFERENCES convict_organization (id)');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD176DDE4C635 FOREIGN KEY (presenter_id) REFERENCES court_representative (id)');
        $this->addSql('ALTER TABLE person_court_representative ADD CONSTRAINT FK_FBCDB41F217BBB47 FOREIGN KEY (person_id) REFERENCES person (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE person_court_representative ADD CONSTRAINT FK_FBCDB41FFBE454BE FOREIGN KEY (court_representative_id) REFERENCES court_representative (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE person_clause ADD CONSTRAINT FK_17AFF392217BBB47 FOREIGN KEY (person_id) REFERENCES person (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE person_clause ADD CONSTRAINT FK_17AFF39259074614 FOREIGN KEY (clause_id) REFERENCES clause (id) ON DELETE CASCADE');

        // Sed data.
        $this->addSql(file_get_contents(__DIR__.'/data/stalin-list-data-list.sql'));
        $this->addSql(file_get_contents(__DIR__.'/data/stalin-list-education.sql'));
        $this->addSql(file_get_contents(__DIR__.'/data/stalin-list-education-additional.sql'));
        $this->addSql(file_get_contents(__DIR__.'/data/stalin-list-nationality.sql'));
        $this->addSql(file_get_contents(__DIR__.'/data/stalin-list-social-status.sql'));
        $this->addSql(file_get_contents(__DIR__.'/data/stalin-list-marital-status.sql'));
        $this->addSql(file_get_contents(__DIR__.'/data/stalin-list-clause.sql'));
        $this->addSql(file_get_contents(__DIR__.'/data/stalin-list-court-representative.sql'));
        $this->addSql(file_get_contents(__DIR__.'/data/stalin-list-convict-organization.sql'));
        $this->addSql(file_get_contents(__DIR__.'/data/stalin-list-person.sql'));
        $this->addSql(file_get_contents(__DIR__.'/data/stalin-list-person-court-representative.sql'));
        $this->addSql(file_get_contents(__DIR__.'/data/stalin-list-person-clause.sql'));

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD1768490B586');
        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD1761C9DA55');
        $this->addSql('ALTER TABLE person_clause DROP FOREIGN KEY FK_17AFF39259074614');
        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD176DDE4C635');
        $this->addSql('ALTER TABLE person_court_representative DROP FOREIGN KEY FK_FBCDB41FFBE454BE');
        $this->addSql('ALTER TABLE person_court_representative DROP FOREIGN KEY FK_FBCDB41F217BBB47');
        $this->addSql('ALTER TABLE person_clause DROP FOREIGN KEY FK_17AFF392217BBB47');
        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD1762CA1BD71');
        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD1769C6DB60E');
        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD1763DAE168B');
        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD176E559F9BF');
        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD17659A15DCA');
        $this->addSql('DROP TABLE education_additional');
        $this->addSql('DROP TABLE nationality');
        $this->addSql('DROP TABLE clause');
        $this->addSql('DROP TABLE court_representative');
        $this->addSql('DROP TABLE person');
        $this->addSql('DROP TABLE person_court_representative');
        $this->addSql('DROP TABLE person_clause');
        $this->addSql('DROP TABLE education');
        $this->addSql('DROP TABLE convict_organization');
        $this->addSql('DROP TABLE data_list');
        $this->addSql('DROP TABLE marital_status');
        $this->addSql('DROP TABLE social_status');
    }
}
