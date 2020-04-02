<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190311201054 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A1EADB5CE');
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD3168BCF5E72D');
        $this->addSql('CREATE TABLE comps (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comps_claire_exercise_model (comps_id INT NOT NULL, claire_exercise_model_id INT NOT NULL, INDEX IDX_2DBF07FEEB8AAB26 (comps_id), INDEX IDX_2DBF07FE2C4AF34F (claire_exercise_model_id), PRIMARY KEY(comps_id, claire_exercise_model_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comps_claire_exercise_model ADD CONSTRAINT FK_2DBF07FEEB8AAB26 FOREIGN KEY (comps_id) REFERENCES comps (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comps_claire_exercise_model ADD CONSTRAINT FK_2DBF07FE2C4AF34F FOREIGN KEY (claire_exercise_model_id) REFERENCES claire_exercise_model (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE articles');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE comments');
        $this->addSql('DROP INDEX search_idex_askeruser_username ON asker_user');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comps_claire_exercise_model DROP FOREIGN KEY FK_2DBF07FEEB8AAB26');
        $this->addSql('CREATE TABLE articles (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, description LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, image VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, createdt_at DATETIME NOT NULL, INDEX IDX_BFDD3168BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, description LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE comments (id INT AUTO_INCREMENT NOT NULL, hasarticle_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, commentaire LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, created_at DATETIME NOT NULL, INDEX IDX_5F9E962A1EADB5CE (hasarticle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD3168BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A1EADB5CE FOREIGN KEY (hasarticle_id) REFERENCES articles (id)');
        $this->addSql('DROP TABLE comps');
        $this->addSql('DROP TABLE comps_claire_exercise_model');
        $this->addSql('CREATE UNIQUE INDEX search_idex_askeruser_username ON asker_user (username)');
    }
}
