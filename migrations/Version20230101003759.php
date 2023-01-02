<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230101003759 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD categories_id INT DEFAULT NULL, ADD produits_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649CD11A2CF FOREIGN KEY (produits_id) REFERENCES produits (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649A21214B7 ON user (categories_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649CD11A2CF ON user (produits_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649A21214B7');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649CD11A2CF');
        $this->addSql('DROP INDEX IDX_8D93D649A21214B7 ON user');
        $this->addSql('DROP INDEX IDX_8D93D649CD11A2CF ON user');
        $this->addSql('ALTER TABLE user DROP categories_id, DROP produits_id');
    }
}
