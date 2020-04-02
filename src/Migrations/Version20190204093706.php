<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190204093706 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE referentiel (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE claire_exercise_knowledge_knowledge_requirement');
        $this->addSql('ALTER TABLE claire_exercise_knowledge CHANGE author_id author_id INT DEFAULT NULL, CHANGE owner_id owner_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE claire_exercise_model CHANGE author_id author_id INT DEFAULT NULL, CHANGE owner_id owner_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE articles CHANGE categorie_id categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE claire_exercise_answer DROP FOREIGN KEY FK_D0B3344126F525E');
        $this->addSql('ALTER TABLE claire_exercise_answer DROP FOREIGN KEY FK_D0B3344B191BE6B');
        $this->addSql('ALTER TABLE claire_exercise_answer ADD CONSTRAINT FK_D0B3344126F525E FOREIGN KEY (item_id) REFERENCES claire_exercise_item (id)');
        $this->addSql('ALTER TABLE claire_exercise_answer ADD CONSTRAINT FK_D0B3344B191BE6B FOREIGN KEY (attempt_id) REFERENCES claire_exercise_attempt (id)');
        $this->addSql('ALTER TABLE claire_exercise_stored_exercise DROP FOREIGN KEY FK_7270807A7F19170F');
        $this->addSql('ALTER TABLE claire_exercise_stored_exercise ADD CONSTRAINT FK_7270807A7F19170F FOREIGN KEY (exercise_model_id) REFERENCES claire_exercise_model (id)');
        $this->addSql('ALTER TABLE claire_exercise_test_model_position DROP FOREIGN KEY FK_C31B436D7F19170F');
        $this->addSql('ALTER TABLE claire_exercise_test_model_position DROP FOREIGN KEY FK_C31B436DEC16BCB1');
        $this->addSql('ALTER TABLE claire_exercise_test_model_position DROP position');
        $this->addSql('ALTER TABLE claire_exercise_test_model_position ADD CONSTRAINT FK_C31B436D7F19170F FOREIGN KEY (exercise_model_id) REFERENCES claire_exercise_model (id)');
        $this->addSql('ALTER TABLE claire_exercise_test_model_position ADD CONSTRAINT FK_C31B436DEC16BCB1 FOREIGN KEY (test_model_id) REFERENCES claire_exercise_test_model (id)');
        $this->addSql('ALTER TABLE claire_exercise_test DROP FOREIGN KEY FK_C8394926EC16BCB1');
        $this->addSql('ALTER TABLE claire_exercise_test ADD CONSTRAINT FK_C8394926EC16BCB1 FOREIGN KEY (test_model_id) REFERENCES claire_exercise_test_model (id)');
        $this->addSql('ALTER TABLE claire_exercise_test_position DROP FOREIGN KEY FK_6F95FF221E5D0459');
        $this->addSql('ALTER TABLE claire_exercise_test_position DROP FOREIGN KEY FK_6F95FF22E934951A');
        $this->addSql('ALTER TABLE claire_exercise_test_position DROP position');
        $this->addSql('ALTER TABLE claire_exercise_test_position ADD CONSTRAINT FK_6F95FF221E5D0459 FOREIGN KEY (test_id) REFERENCES claire_exercise_test (id)');
        $this->addSql('ALTER TABLE claire_exercise_test_position ADD CONSTRAINT FK_6F95FF22E934951A FOREIGN KEY (exercise_id) REFERENCES claire_exercise_stored_exercise (id)');
        $this->addSql('ALTER TABLE log CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE claire_exercise_test_attempt DROP FOREIGN KEY FK_783E4D1FA76ED395');
        $this->addSql('ALTER TABLE claire_exercise_test_attempt ADD CONSTRAINT FK_783E4D1FA76ED395 FOREIGN KEY (user_id) REFERENCES asker_user (id)');
        $this->addSql('ALTER TABLE claire_exercise_item DROP FOREIGN KEY FK_F5D1234E934951A');
        $this->addSql('ALTER TABLE claire_exercise_item ADD CONSTRAINT FK_F5D1234E934951A FOREIGN KEY (exercise_id) REFERENCES claire_exercise_stored_exercise (id)');
        $this->addSql('ALTER TABLE claire_exercise_resource CHANGE author_id author_id INT DEFAULT NULL, CHANGE owner_id owner_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE claire_exercise_attempt DROP FOREIGN KEY FK_228E85D1A76ED395');
        $this->addSql('ALTER TABLE claire_exercise_attempt DROP FOREIGN KEY FK_228E85D1CAA20852');
        $this->addSql('ALTER TABLE claire_exercise_attempt DROP FOREIGN KEY FK_228E85D1E934951A');
        $this->addSql('ALTER TABLE claire_exercise_attempt ADD CONSTRAINT FK_228E85D1A76ED395 FOREIGN KEY (user_id) REFERENCES asker_user (id)');
        $this->addSql('ALTER TABLE claire_exercise_attempt ADD CONSTRAINT FK_228E85D1CAA20852 FOREIGN KEY (test_attempt_id) REFERENCES claire_exercise_test_attempt (id)');
        $this->addSql('ALTER TABLE claire_exercise_attempt ADD CONSTRAINT FK_228E85D1E934951A FOREIGN KEY (exercise_id) REFERENCES claire_exercise_stored_exercise (id)');
        $this->addSql('ALTER TABLE asker_user_role DROP FOREIGN KEY FK_C663916DA3AFCEC7');
        $this->addSql('ALTER TABLE asker_user_role DROP FOREIGN KEY FK_C663916DD60322AC');
        $this->addSql('ALTER TABLE asker_user_role ADD CONSTRAINT FK_C663916DA3AFCEC7 FOREIGN KEY (asker_user_id) REFERENCES asker_user (id)');
        $this->addSql('ALTER TABLE asker_user_role ADD CONSTRAINT FK_C663916DD60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE claire_exercise_knowledge_knowledge_requirement (knowledge_id INT NOT NULL, required_id INT NOT NULL, INDEX IDX_67A0678CDD3DFC3F (required_id), INDEX IDX_67A0678CE7DC6902 (knowledge_id), PRIMARY KEY(knowledge_id, required_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE claire_exercise_knowledge_knowledge_requirement ADD CONSTRAINT FK_67A0678CDD3DFC3F FOREIGN KEY (required_id) REFERENCES claire_exercise_knowledge (id)');
        $this->addSql('ALTER TABLE claire_exercise_knowledge_knowledge_requirement ADD CONSTRAINT FK_67A0678CE7DC6902 FOREIGN KEY (knowledge_id) REFERENCES claire_exercise_knowledge (id)');
        $this->addSql('DROP TABLE referentiel');
        $this->addSql('ALTER TABLE articles CHANGE categorie_id categorie_id INT NOT NULL');
        $this->addSql('ALTER TABLE asker_user_role DROP FOREIGN KEY FK_C663916DA3AFCEC7');
        $this->addSql('ALTER TABLE asker_user_role DROP FOREIGN KEY FK_C663916DD60322AC');
        $this->addSql('ALTER TABLE asker_user_role ADD CONSTRAINT FK_C663916DA3AFCEC7 FOREIGN KEY (asker_user_id) REFERENCES asker_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE asker_user_role ADD CONSTRAINT FK_C663916DD60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE claire_exercise_answer DROP FOREIGN KEY FK_D0B3344126F525E');
        $this->addSql('ALTER TABLE claire_exercise_answer DROP FOREIGN KEY FK_D0B3344B191BE6B');
        $this->addSql('ALTER TABLE claire_exercise_answer ADD CONSTRAINT FK_D0B3344126F525E FOREIGN KEY (item_id) REFERENCES claire_exercise_item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE claire_exercise_answer ADD CONSTRAINT FK_D0B3344B191BE6B FOREIGN KEY (attempt_id) REFERENCES claire_exercise_attempt (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE claire_exercise_attempt DROP FOREIGN KEY FK_228E85D1A76ED395');
        $this->addSql('ALTER TABLE claire_exercise_attempt DROP FOREIGN KEY FK_228E85D1CAA20852');
        $this->addSql('ALTER TABLE claire_exercise_attempt DROP FOREIGN KEY FK_228E85D1E934951A');
        $this->addSql('ALTER TABLE claire_exercise_attempt ADD CONSTRAINT FK_228E85D1A76ED395 FOREIGN KEY (user_id) REFERENCES asker_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE claire_exercise_attempt ADD CONSTRAINT FK_228E85D1CAA20852 FOREIGN KEY (test_attempt_id) REFERENCES claire_exercise_test_attempt (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE claire_exercise_attempt ADD CONSTRAINT FK_228E85D1E934951A FOREIGN KEY (exercise_id) REFERENCES claire_exercise_stored_exercise (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE claire_exercise_item DROP FOREIGN KEY FK_F5D1234E934951A');
        $this->addSql('ALTER TABLE claire_exercise_item ADD CONSTRAINT FK_F5D1234E934951A FOREIGN KEY (exercise_id) REFERENCES claire_exercise_stored_exercise (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE claire_exercise_knowledge CHANGE owner_id owner_id INT NOT NULL, CHANGE author_id author_id INT NOT NULL');
        $this->addSql('ALTER TABLE claire_exercise_model CHANGE owner_id owner_id INT NOT NULL, CHANGE author_id author_id INT NOT NULL');
        $this->addSql('ALTER TABLE claire_exercise_resource CHANGE owner_id owner_id INT NOT NULL, CHANGE author_id author_id INT NOT NULL');
        $this->addSql('ALTER TABLE claire_exercise_stored_exercise DROP FOREIGN KEY FK_7270807A7F19170F');
        $this->addSql('ALTER TABLE claire_exercise_stored_exercise ADD CONSTRAINT FK_7270807A7F19170F FOREIGN KEY (exercise_model_id) REFERENCES claire_exercise_model (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE claire_exercise_test DROP FOREIGN KEY FK_C8394926EC16BCB1');
        $this->addSql('ALTER TABLE claire_exercise_test ADD CONSTRAINT FK_C8394926EC16BCB1 FOREIGN KEY (test_model_id) REFERENCES claire_exercise_test_model (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE claire_exercise_test_attempt DROP FOREIGN KEY FK_783E4D1FA76ED395');
        $this->addSql('ALTER TABLE claire_exercise_test_attempt ADD CONSTRAINT FK_783E4D1FA76ED395 FOREIGN KEY (user_id) REFERENCES asker_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE claire_exercise_test_model_position DROP FOREIGN KEY FK_C31B436DEC16BCB1');
        $this->addSql('ALTER TABLE claire_exercise_test_model_position DROP FOREIGN KEY FK_C31B436D7F19170F');
        $this->addSql('ALTER TABLE claire_exercise_test_model_position ADD position INT NOT NULL');
        $this->addSql('ALTER TABLE claire_exercise_test_model_position ADD CONSTRAINT FK_C31B436DEC16BCB1 FOREIGN KEY (test_model_id) REFERENCES claire_exercise_test_model (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE claire_exercise_test_model_position ADD CONSTRAINT FK_C31B436D7F19170F FOREIGN KEY (exercise_model_id) REFERENCES claire_exercise_model (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE claire_exercise_test_position DROP FOREIGN KEY FK_6F95FF221E5D0459');
        $this->addSql('ALTER TABLE claire_exercise_test_position DROP FOREIGN KEY FK_6F95FF22E934951A');
        $this->addSql('ALTER TABLE claire_exercise_test_position ADD position INT NOT NULL');
        $this->addSql('ALTER TABLE claire_exercise_test_position ADD CONSTRAINT FK_6F95FF221E5D0459 FOREIGN KEY (test_id) REFERENCES claire_exercise_test (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE claire_exercise_test_position ADD CONSTRAINT FK_6F95FF22E934951A FOREIGN KEY (exercise_id) REFERENCES claire_exercise_stored_exercise (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE log CHANGE user_id user_id INT NOT NULL');
    }
}
