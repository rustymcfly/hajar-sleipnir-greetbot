<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220220163223 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE application_command (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE guild (id INT AUTO_INCREMENT NOT NULL, guild_id VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_75407DAB5F2131EF (guild_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, guild_member_id VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE guilds_members (user_id INT NOT NULL, guild_id INT NOT NULL, INDEX IDX_35AD762EA76ED395 (user_id), INDEX IDX_35AD762E5F2131EF (guild_id), PRIMARY KEY(user_id, guild_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE guild ADD CONSTRAINT FK_75407DAB5F2131EF FOREIGN KEY (guild_id) REFERENCES application_command (id)');
        $this->addSql('ALTER TABLE guilds_members ADD CONSTRAINT FK_35AD762EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE guilds_members ADD CONSTRAINT FK_35AD762E5F2131EF FOREIGN KEY (guild_id) REFERENCES guild (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE guild DROP FOREIGN KEY FK_75407DAB5F2131EF');
        $this->addSql('ALTER TABLE guilds_members DROP FOREIGN KEY FK_35AD762E5F2131EF');
        $this->addSql('ALTER TABLE guilds_members DROP FOREIGN KEY FK_35AD762EA76ED395');
        $this->addSql('DROP TABLE application_command');
        $this->addSql('DROP TABLE guild');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE guilds_members');
    }
}
