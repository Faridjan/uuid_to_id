<?php

declare(strict_types=1);

namespace App\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201210122401 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE goods_transform_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_transformer_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE goods_transformer (id INT NOT NULL, uuid UUID NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EAEC497FD17F50A6 ON goods_transformer (uuid)');
        $this->addSql('COMMENT ON COLUMN goods_transformer.id IS \'(DC2Type:id_type)\'');
        $this->addSql('COMMENT ON COLUMN goods_transformer.uuid IS \'(DC2Type:uuid_type)\'');
        $this->addSql('COMMENT ON COLUMN goods_transformer.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE user_transformer (id INT NOT NULL, uuid UUID NOT NULL, created_at DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CF555238D17F50A6 ON user_transformer (uuid)');
        $this->addSql('COMMENT ON COLUMN user_transformer.id IS \'(DC2Type:id_type)\'');
        $this->addSql('COMMENT ON COLUMN user_transformer.uuid IS \'(DC2Type:uuid_type)\'');
        $this->addSql('COMMENT ON COLUMN user_transformer.created_at IS \'(DC2Type:date_immutable)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP SEQUENCE goods_transform_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_transformer_id_seq CASCADE');
        $this->addSql('DROP TABLE goods_transformer');
        $this->addSql('DROP TABLE user_transformer');
    }
}
