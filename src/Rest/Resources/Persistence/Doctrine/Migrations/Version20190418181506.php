<?php

declare(strict_types=1);

namespace Rest\Resources\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190418181506 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE Permissions (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, route VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Roles (id INT AUTO_INCREMENT NOT NULL, role VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_77FF01C357698A6A (role), UNIQUE INDEX UNIQ_77FF01C35E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role_permission (role_id INT NOT NULL, permission_id INT NOT NULL, INDEX IDX_6F7DF886D60322AC (role_id), INDEX IDX_6F7DF886FED90CCA (permission_id), PRIMARY KEY(role_id, permission_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_settings (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, INDEX IDX_5C844C5A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_settings_item (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_settings_item_user_settings (user_settings_item_id INT NOT NULL, user_settings_id INT NOT NULL, INDEX IDX_6A9789E0D17EB8B3 (user_settings_item_id), INDEX IDX_6A9789E0F08F511D (user_settings_id), PRIMARY KEY(user_settings_item_id, user_settings_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE role_permission ADD CONSTRAINT FK_6F7DF886D60322AC FOREIGN KEY (role_id) REFERENCES Roles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE role_permission ADD CONSTRAINT FK_6F7DF886FED90CCA FOREIGN KEY (permission_id) REFERENCES Permissions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_settings ADD CONSTRAINT FK_5C844C5A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE user_settings_item_user_settings ADD CONSTRAINT FK_6A9789E0D17EB8B3 FOREIGN KEY (user_settings_item_id) REFERENCES user_settings_item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_settings_item_user_settings ADD CONSTRAINT FK_6A9789E0F08F511D FOREIGN KEY (user_settings_id) REFERENCES user_settings (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE role_permission DROP FOREIGN KEY FK_6F7DF886FED90CCA');
        $this->addSql('ALTER TABLE role_permission DROP FOREIGN KEY FK_6F7DF886D60322AC');
        $this->addSql('ALTER TABLE user_settings DROP FOREIGN KEY FK_5C844C5A76ED395');
        $this->addSql('ALTER TABLE user_settings_item_user_settings DROP FOREIGN KEY FK_6A9789E0F08F511D');
        $this->addSql('ALTER TABLE user_settings_item_user_settings DROP FOREIGN KEY FK_6A9789E0D17EB8B3');
        $this->addSql('DROP TABLE Permissions');
        $this->addSql('DROP TABLE Roles');
        $this->addSql('DROP TABLE role_permission');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE user_settings');
        $this->addSql('DROP TABLE user_settings_item');
        $this->addSql('DROP TABLE user_settings_item_user_settings');
    }
}
