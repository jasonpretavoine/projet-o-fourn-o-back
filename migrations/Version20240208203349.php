<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240208203349 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ustensil_recipe (ustensil_id INT NOT NULL, recipe_id INT NOT NULL, INDEX IDX_68357430E62544B2 (ustensil_id), INDEX IDX_6835743059D8A214 (recipe_id), PRIMARY KEY(ustensil_id, recipe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ustensil_recipe ADD CONSTRAINT FK_68357430E62544B2 FOREIGN KEY (ustensil_id) REFERENCES ustensil (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ustensil_recipe ADD CONSTRAINT FK_6835743059D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ustensil_recipe DROP FOREIGN KEY FK_68357430E62544B2');
        $this->addSql('ALTER TABLE ustensil_recipe DROP FOREIGN KEY FK_6835743059D8A214');
        $this->addSql('DROP TABLE ustensil_recipe');
    }
}
