<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190311202219 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comps_claire_exercise_model DROP FOREIGN KEY FK_2DBF07FEEB8AAB26');
        $this->addSql('CREATE TABLE competence_claire_exercise_model (competence_id INT NOT NULL, claire_exercise_model_id INT NOT NULL, INDEX IDX_BB4E343115761DAB (competence_id), INDEX IDX_BB4E34312C4AF34F (claire_exercise_model_id), PRIMARY KEY(competence_id, claire_exercise_model_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE competence_claire_exercise_model ADD CONSTRAINT FK_BB4E343115761DAB FOREIGN KEY (competence_id) REFERENCES competence (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE competence_claire_exercise_model ADD CONSTRAINT FK_BB4E34312C4AF34F FOREIGN KEY (claire_exercise_model_id) REFERENCES claire_exercise_model (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE comps');
        $this->addSql('DROP TABLE comps_claire_exercise_model');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE comps (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE comps_claire_exercise_model (comps_id INT NOT NULL, claire_exercise_model_id INT NOT NULL, INDEX IDX_2DBF07FE2C4AF34F (claire_exercise_model_id), INDEX IDX_2DBF07FEEB8AAB26 (comps_id), PRIMARY KEY(comps_id, claire_exercise_model_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE comps_claire_exercise_model ADD CONSTRAINT FK_2DBF07FE2C4AF34F FOREIGN KEY (claire_exercise_model_id) REFERENCES claire_exercise_model (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comps_claire_exercise_model ADD CONSTRAINT FK_2DBF07FEEB8AAB26 FOREIGN KEY (comps_id) REFERENCES comps (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE competence_claire_exercise_model');
    }
}
