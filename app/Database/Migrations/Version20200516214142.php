<?php

namespace App\Database\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20200516214142 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE mail_chimp_lists (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', campaign_defaults LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', contact LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', email_type_option TINYINT(1) NOT NULL, mail_chimp_id VARCHAR(255) DEFAULT NULL, name VARCHAR(255) NOT NULL, notify_on_subscribe VARCHAR(255) DEFAULT NULL, notify_on_unsubscribe VARCHAR(255) DEFAULT NULL, permission_reminder VARCHAR(255) NOT NULL, use_archive_bar TINYINT(1) DEFAULT NULL, visibility VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mail_chimp_members (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', mailchimp_id VARCHAR(255) DEFAULT NULL, email_address VARCHAR(255) NOT NULL, email_type VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, merge_fields LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', interests LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', language VARCHAR(255) NOT NULL, vip VARCHAR(255) NOT NULL, location LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', marketing_permissions LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', ip_signup VARCHAR(255) DEFAULT NULL, timestamp_signup VARCHAR(255) DEFAULT NULL, ip_opt VARCHAR(255) DEFAULT NULL, timestamp_opt VARCHAR(255) DEFAULT NULL, tags LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', unique_email_id VARCHAR(255) DEFAULT NULL, web_id VARCHAR(255) DEFAULT NULL, unsubscribe_reason VARCHAR(255) DEFAULT NULL, stats LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', member_rating VARCHAR(255) DEFAULT NULL, last_changed VARCHAR(255) DEFAULT NULL, last_note LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', source VARCHAR(255) DEFAULT NULL, tags_count VARCHAR(255) DEFAULT NULL, list_id VARCHAR(255) DEFAULT NULL, links LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (user_id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_groups (group_id INT AUTO_INCREMENT NOT NULL, users INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_953F224D1483A5E9 (users), PRIMARY KEY(group_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_groups ADD CONSTRAINT FK_953F224D1483A5E9 FOREIGN KEY (users) REFERENCES users (user_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_groups DROP FOREIGN KEY FK_953F224D1483A5E9');
        $this->addSql('DROP TABLE mail_chimp_lists');
        $this->addSql('DROP TABLE mail_chimp_members');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE user_groups');
    }
}
