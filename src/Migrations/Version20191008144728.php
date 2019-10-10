<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191008144728 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('ALTER TABLE user ADD COLUMN email VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD COLUMN picture VARCHAR(255) DEFAULT NULL');
        $this->addSql('DROP INDEX IDX_33C9F81B59D8A214');
        $this->addSql('DROP INDEX IDX_33C9F81BBAD26311');
        $this->addSql('CREATE TEMPORARY TABLE __temp__tag_recipe AS SELECT tag_id, recipe_id FROM tag_recipe');
        $this->addSql('DROP TABLE tag_recipe');
        $this->addSql('CREATE TABLE tag_recipe (tag_id INTEGER NOT NULL, recipe_id INTEGER NOT NULL, PRIMARY KEY(tag_id, recipe_id), CONSTRAINT FK_33C9F81BBAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_33C9F81B59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO tag_recipe (tag_id, recipe_id) SELECT tag_id, recipe_id FROM __temp__tag_recipe');
        $this->addSql('DROP TABLE __temp__tag_recipe');
        $this->addSql('CREATE INDEX IDX_33C9F81B59D8A214 ON tag_recipe (recipe_id)');
        $this->addSql('CREATE INDEX IDX_33C9F81BBAD26311 ON tag_recipe (tag_id)');
        $this->addSql('DROP INDEX IDX_34220A7259D8A214');
        $this->addSql('CREATE TEMPORARY TABLE __temp__steps AS SELECT id, recipe_id, spot, description FROM steps');
        $this->addSql('DROP TABLE steps');
        $this->addSql('CREATE TABLE steps (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, recipe_id INTEGER DEFAULT NULL, spot INTEGER NOT NULL, description CLOB NOT NULL COLLATE BINARY, CONSTRAINT FK_34220A7259D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO steps (id, recipe_id, spot, description) SELECT id, recipe_id, spot, description FROM __temp__steps');
        $this->addSql('DROP TABLE __temp__steps');
        $this->addSql('CREATE INDEX IDX_34220A7259D8A214 ON steps (recipe_id)');
        $this->addSql('DROP INDEX IDX_4B60114F99387CE8');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ingredients AS SELECT id, units_id, name, quantity FROM ingredients');
        $this->addSql('DROP TABLE ingredients');
        $this->addSql('CREATE TABLE ingredients (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, units_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, quantity DOUBLE PRECISION NOT NULL, CONSTRAINT FK_4B60114F99387CE8 FOREIGN KEY (units_id) REFERENCES units (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO ingredients (id, units_id, name, quantity) SELECT id, units_id, name, quantity FROM __temp__ingredients');
        $this->addSql('DROP TABLE __temp__ingredients');
        $this->addSql('CREATE INDEX IDX_4B60114F99387CE8 ON ingredients (units_id)');
        $this->addSql('DROP INDEX IDX_8C552A6B59D8A214');
        $this->addSql('DROP INDEX IDX_8C552A6B3EC4DCE');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ingredients_recipe AS SELECT ingredients_id, recipe_id FROM ingredients_recipe');
        $this->addSql('DROP TABLE ingredients_recipe');
        $this->addSql('CREATE TABLE ingredients_recipe (ingredients_id INTEGER NOT NULL, recipe_id INTEGER NOT NULL, PRIMARY KEY(ingredients_id, recipe_id), CONSTRAINT FK_8C552A6B3EC4DCE FOREIGN KEY (ingredients_id) REFERENCES ingredients (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_8C552A6B59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO ingredients_recipe (ingredients_id, recipe_id) SELECT ingredients_id, recipe_id FROM __temp__ingredients_recipe');
        $this->addSql('DROP TABLE __temp__ingredients_recipe');
        $this->addSql('CREATE INDEX IDX_8C552A6B59D8A214 ON ingredients_recipe (recipe_id)');
        $this->addSql('CREATE INDEX IDX_8C552A6B3EC4DCE ON ingredients_recipe (ingredients_id)');
        $this->addSql('DROP INDEX IDX_F557830159D8A214');
        $this->addSql('DROP INDEX IDX_F557830186813830');
        $this->addSql('CREATE TEMPORARY TABLE __temp__kitchen_tools_recipe AS SELECT kitchen_tools_id, recipe_id FROM kitchen_tools_recipe');
        $this->addSql('DROP TABLE kitchen_tools_recipe');
        $this->addSql('CREATE TABLE kitchen_tools_recipe (kitchen_tools_id INTEGER NOT NULL, recipe_id INTEGER NOT NULL, PRIMARY KEY(kitchen_tools_id, recipe_id), CONSTRAINT FK_F557830186813830 FOREIGN KEY (kitchen_tools_id) REFERENCES kitchen_tools (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_F557830159D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO kitchen_tools_recipe (kitchen_tools_id, recipe_id) SELECT kitchen_tools_id, recipe_id FROM __temp__kitchen_tools_recipe');
        $this->addSql('DROP TABLE __temp__kitchen_tools_recipe');
        $this->addSql('CREATE INDEX IDX_F557830159D8A214 ON kitchen_tools_recipe (recipe_id)');
        $this->addSql('CREATE INDEX IDX_F557830186813830 ON kitchen_tools_recipe (kitchen_tools_id)');
        $this->addSql('DROP INDEX IDX_6970EB0F59D8A214');
        $this->addSql('CREATE TEMPORARY TABLE __temp__reviews AS SELECT id, recipe_id, author, commentary, picture FROM reviews');
        $this->addSql('DROP TABLE reviews');
        $this->addSql('CREATE TABLE reviews (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, recipe_id INTEGER DEFAULT NULL, author VARCHAR(255) NOT NULL COLLATE BINARY, commentary CLOB NOT NULL COLLATE BINARY, picture VARCHAR(255) DEFAULT NULL COLLATE BINARY, CONSTRAINT FK_6970EB0F59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO reviews (id, recipe_id, author, commentary, picture) SELECT id, recipe_id, author, commentary, picture FROM __temp__reviews');
        $this->addSql('DROP TABLE __temp__reviews');
        $this->addSql('CREATE INDEX IDX_6970EB0F59D8A214 ON reviews (recipe_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_4B60114F99387CE8');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ingredients AS SELECT id, units_id, name, quantity FROM ingredients');
        $this->addSql('DROP TABLE ingredients');
        $this->addSql('CREATE TABLE ingredients (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, units_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, quantity DOUBLE PRECISION NOT NULL)');
        $this->addSql('INSERT INTO ingredients (id, units_id, name, quantity) SELECT id, units_id, name, quantity FROM __temp__ingredients');
        $this->addSql('DROP TABLE __temp__ingredients');
        $this->addSql('CREATE INDEX IDX_4B60114F99387CE8 ON ingredients (units_id)');
        $this->addSql('DROP INDEX IDX_8C552A6B3EC4DCE');
        $this->addSql('DROP INDEX IDX_8C552A6B59D8A214');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ingredients_recipe AS SELECT ingredients_id, recipe_id FROM ingredients_recipe');
        $this->addSql('DROP TABLE ingredients_recipe');
        $this->addSql('CREATE TABLE ingredients_recipe (ingredients_id INTEGER NOT NULL, recipe_id INTEGER NOT NULL, PRIMARY KEY(ingredients_id, recipe_id))');
        $this->addSql('INSERT INTO ingredients_recipe (ingredients_id, recipe_id) SELECT ingredients_id, recipe_id FROM __temp__ingredients_recipe');
        $this->addSql('DROP TABLE __temp__ingredients_recipe');
        $this->addSql('CREATE INDEX IDX_8C552A6B3EC4DCE ON ingredients_recipe (ingredients_id)');
        $this->addSql('CREATE INDEX IDX_8C552A6B59D8A214 ON ingredients_recipe (recipe_id)');
        $this->addSql('DROP INDEX IDX_F557830186813830');
        $this->addSql('DROP INDEX IDX_F557830159D8A214');
        $this->addSql('CREATE TEMPORARY TABLE __temp__kitchen_tools_recipe AS SELECT kitchen_tools_id, recipe_id FROM kitchen_tools_recipe');
        $this->addSql('DROP TABLE kitchen_tools_recipe');
        $this->addSql('CREATE TABLE kitchen_tools_recipe (kitchen_tools_id INTEGER NOT NULL, recipe_id INTEGER NOT NULL, PRIMARY KEY(kitchen_tools_id, recipe_id))');
        $this->addSql('INSERT INTO kitchen_tools_recipe (kitchen_tools_id, recipe_id) SELECT kitchen_tools_id, recipe_id FROM __temp__kitchen_tools_recipe');
        $this->addSql('DROP TABLE __temp__kitchen_tools_recipe');
        $this->addSql('CREATE INDEX IDX_F557830186813830 ON kitchen_tools_recipe (kitchen_tools_id)');
        $this->addSql('CREATE INDEX IDX_F557830159D8A214 ON kitchen_tools_recipe (recipe_id)');
        $this->addSql('DROP INDEX IDX_6970EB0F59D8A214');
        $this->addSql('CREATE TEMPORARY TABLE __temp__reviews AS SELECT id, recipe_id, author, commentary, picture FROM reviews');
        $this->addSql('DROP TABLE reviews');
        $this->addSql('CREATE TABLE reviews (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, recipe_id INTEGER DEFAULT NULL, author VARCHAR(255) NOT NULL, commentary CLOB NOT NULL, picture VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO reviews (id, recipe_id, author, commentary, picture) SELECT id, recipe_id, author, commentary, picture FROM __temp__reviews');
        $this->addSql('DROP TABLE __temp__reviews');
        $this->addSql('CREATE INDEX IDX_6970EB0F59D8A214 ON reviews (recipe_id)');
        $this->addSql('DROP INDEX IDX_34220A7259D8A214');
        $this->addSql('CREATE TEMPORARY TABLE __temp__steps AS SELECT id, recipe_id, spot, description FROM steps');
        $this->addSql('DROP TABLE steps');
        $this->addSql('CREATE TABLE steps (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, recipe_id INTEGER DEFAULT NULL, spot INTEGER NOT NULL, description CLOB NOT NULL)');
        $this->addSql('INSERT INTO steps (id, recipe_id, spot, description) SELECT id, recipe_id, spot, description FROM __temp__steps');
        $this->addSql('DROP TABLE __temp__steps');
        $this->addSql('CREATE INDEX IDX_34220A7259D8A214 ON steps (recipe_id)');
        $this->addSql('DROP INDEX IDX_33C9F81BBAD26311');
        $this->addSql('DROP INDEX IDX_33C9F81B59D8A214');
        $this->addSql('CREATE TEMPORARY TABLE __temp__tag_recipe AS SELECT tag_id, recipe_id FROM tag_recipe');
        $this->addSql('DROP TABLE tag_recipe');
        $this->addSql('CREATE TABLE tag_recipe (tag_id INTEGER NOT NULL, recipe_id INTEGER NOT NULL, PRIMARY KEY(tag_id, recipe_id))');
        $this->addSql('INSERT INTO tag_recipe (tag_id, recipe_id) SELECT tag_id, recipe_id FROM __temp__tag_recipe');
        $this->addSql('DROP TABLE __temp__tag_recipe');
        $this->addSql('CREATE INDEX IDX_33C9F81BBAD26311 ON tag_recipe (tag_id)');
        $this->addSql('CREATE INDEX IDX_33C9F81B59D8A214 ON tag_recipe (recipe_id)');
        $this->addSql('DROP INDEX UNIQ_8D93D649F85E0677');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, username, roles, password FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO user (id, username, roles, password) SELECT id, username, roles, password FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
    }
}
