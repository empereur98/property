<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230604084959 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE property ADD image_name VARCHAR(255) DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('DROP INDEX `primary` ON property_options');
        $this->addSql('ALTER TABLE property_options DROP FOREIGN KEY FK_21C8AA603ADB05F1');
        $this->addSql('ALTER TABLE property_options DROP FOREIGN KEY FK_21C8AA60549213EC');
        $this->addSql('ALTER TABLE property_options ADD PRIMARY KEY (property_id, options_id)');
        $this->addSql('DROP INDEX idx_21c8aa60549213ec ON property_options');
        $this->addSql('CREATE INDEX IDX_89F8B0FF549213EC ON property_options (property_id)');
        $this->addSql('DROP INDEX idx_21c8aa603adb05f1 ON property_options');
        $this->addSql('CREATE INDEX IDX_89F8B0FF3ADB05F1 ON property_options (options_id)');
        $this->addSql('ALTER TABLE property_options ADD CONSTRAINT FK_21C8AA603ADB05F1 FOREIGN KEY (options_id) REFERENCES options (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE property_options ADD CONSTRAINT FK_21C8AA60549213EC FOREIGN KEY (property_id) REFERENCES property (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE property DROP image_name, DROP updated_at');
        $this->addSql('DROP INDEX `PRIMARY` ON property_options');
        $this->addSql('ALTER TABLE property_options DROP FOREIGN KEY FK_89F8B0FF549213EC');
        $this->addSql('ALTER TABLE property_options DROP FOREIGN KEY FK_89F8B0FF3ADB05F1');
        $this->addSql('ALTER TABLE property_options ADD PRIMARY KEY (options_id, property_id)');
        $this->addSql('DROP INDEX idx_89f8b0ff3adb05f1 ON property_options');
        $this->addSql('CREATE INDEX IDX_21C8AA603ADB05F1 ON property_options (options_id)');
        $this->addSql('DROP INDEX idx_89f8b0ff549213ec ON property_options');
        $this->addSql('CREATE INDEX IDX_21C8AA60549213EC ON property_options (property_id)');
        $this->addSql('ALTER TABLE property_options ADD CONSTRAINT FK_89F8B0FF549213EC FOREIGN KEY (property_id) REFERENCES property (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE property_options ADD CONSTRAINT FK_89F8B0FF3ADB05F1 FOREIGN KEY (options_id) REFERENCES options (id) ON DELETE CASCADE');
    }
}
