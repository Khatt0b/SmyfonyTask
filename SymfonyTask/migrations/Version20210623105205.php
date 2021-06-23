<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210623105205 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE article_table_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE category_table_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE comment_table_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE role_table_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tag_table_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_table_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE article_table (id INT NOT NULL, category_id INT DEFAULT NULL, added_by_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, views VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_819EFD5712469DE2 ON article_table (category_id)');
        $this->addSql('CREATE INDEX IDX_819EFD5755B127A4 ON article_table (added_by_id)');
        $this->addSql('COMMENT ON COLUMN article_table.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE article_table_tag_table (article_table_id INT NOT NULL, tag_table_id INT NOT NULL, PRIMARY KEY(article_table_id, tag_table_id))');
        $this->addSql('CREATE INDEX IDX_B143C924B917DC37 ON article_table_tag_table (article_table_id)');
        $this->addSql('CREATE INDEX IDX_B143C924DACE5387 ON article_table_tag_table (tag_table_id)');
        $this->addSql('CREATE TABLE category_table (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE comment_table (id INT NOT NULL, article_id INT DEFAULT NULL, comment VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5FB317B77294869C ON comment_table (article_id)');
        $this->addSql('CREATE TABLE role_table (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE tag_table (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE user_table (id INT NOT NULL, role_table_id INT NOT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, pwd VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_14EB741EC62CCE6D ON user_table (role_table_id)');
        $this->addSql('ALTER TABLE article_table ADD CONSTRAINT FK_819EFD5712469DE2 FOREIGN KEY (category_id) REFERENCES category_table (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE article_table ADD CONSTRAINT FK_819EFD5755B127A4 FOREIGN KEY (added_by_id) REFERENCES user_table (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE article_table_tag_table ADD CONSTRAINT FK_B143C924B917DC37 FOREIGN KEY (article_table_id) REFERENCES article_table (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE article_table_tag_table ADD CONSTRAINT FK_B143C924DACE5387 FOREIGN KEY (tag_table_id) REFERENCES tag_table (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comment_table ADD CONSTRAINT FK_5FB317B77294869C FOREIGN KEY (article_id) REFERENCES article_table (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_table ADD CONSTRAINT FK_14EB741EC62CCE6D FOREIGN KEY (role_table_id) REFERENCES role_table (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE article_table_tag_table DROP CONSTRAINT FK_B143C924B917DC37');
        $this->addSql('ALTER TABLE comment_table DROP CONSTRAINT FK_5FB317B77294869C');
        $this->addSql('ALTER TABLE article_table DROP CONSTRAINT FK_819EFD5712469DE2');
        $this->addSql('ALTER TABLE user_table DROP CONSTRAINT FK_14EB741EC62CCE6D');
        $this->addSql('ALTER TABLE article_table_tag_table DROP CONSTRAINT FK_B143C924DACE5387');
        $this->addSql('ALTER TABLE article_table DROP CONSTRAINT FK_819EFD5755B127A4');
        $this->addSql('DROP SEQUENCE article_table_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE category_table_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE comment_table_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE role_table_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tag_table_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_table_id_seq CASCADE');
        $this->addSql('DROP TABLE article_table');
        $this->addSql('DROP TABLE article_table_tag_table');
        $this->addSql('DROP TABLE category_table');
        $this->addSql('DROP TABLE comment_table');
        $this->addSql('DROP TABLE role_table');
        $this->addSql('DROP TABLE tag_table');
        $this->addSql('DROP TABLE user_table');
    }
}
