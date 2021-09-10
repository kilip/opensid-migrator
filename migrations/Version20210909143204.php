<?php

/*
 * This file is part of the OpenSID project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210909143204 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->upPertanyaan();

        $this->addSql('alter table analisis_respon add constraint pk_analisis_respon primary key (id_indikator, id_parameter, id_subjek, id_periode)');

        $this->createUUID('analisis_respon_bukti');
        $this->createUUID('analisis_respon_hasil');
        $this->createUUID('detail_log_penduduk');
        $this->createUUID('pertanyaan');
        $this->createUUID('setting_sms');
        $this->createUUID('tweb_penduduk_map');

        $this->addSql('rename table "user" rename to passport_user');
        $this->addSql('rename table "user_grup" rename to passport_group');
    }

    public function down(Schema $schema): void
    {
        $this->downPertanyaan();
        $this->dropPrimaryKey('analisis_respon');
        $this->dropPrimaryKey('analisis_respon_bukti');
        $this->dropPrimaryKey('analisis_respon_hasil');

        $this->dropUuid('analisis_respon_bukti');
        $this->dropUuid('analisis_respon_hasil');
        $this->dropUuid('detail_log_penduduk');
        $this->dropUUID('pertanyaan');
        $this->dropUuid('setting_sms');
        $this->dropUuid('tweb_penduduk_map');

        if($schema->hasTable('user')){
            $this->addSql('rename table passport_user rename to "user"');
        }
        if($schema->hasTable('user_grup')){
            $this->addSql('rename table passport_group rename to "user_grup"');
        }
    }

    private function createUUID(string $tableName): void
    {
        $this->addSql('alter table '.$tableName.' add column uuid varchar(36)');
        $this->addSql('update '.$tableName.' set uuid=uuid_generate_v4()');
        $this->addSql('alter table '.$tableName.' alter column uuid TYPE varchar(36)');
        $this->addSql('alter table '.$tableName.' add primary key (uuid)');
    }

    private function dropPrimaryKey(string $tableName): void
    {
        $pk = $tableName.'_pkey';
        if($tableName === 'analisis_respon'){
            $pk = 'pk_analisis_respon';
        }

        $this->addSql('alter table '.$tableName.' drop constraint '.$pk);
    }

    private function dropUuid(string $tableName)
    {
        $this->addSql('alter table '.$tableName.' drop column uuid');
    }

    private function upPertanyaan()
    {
        $this->addSql('alter table pertanyaan rename column "1" to q1');
        $this->addSql('alter table pertanyaan rename column "Pendapatan perkapita perbulan" to "pendapatan_perbulan"');
        $this->addSql('alter table pertanyaan rename column "36" to q36');
        $this->addSql('alter table pertanyaan rename column "15" to q15');
        $this->addSql('alter table pertanyaan rename column "24" to q24');
        $this->addSql('alter table pertanyaan rename column "23" to q23');
        $this->addSql('alter table pertanyaan rename column "26" to q26');
        $this->addSql('alter table pertanyaan rename column "28" to q28');
    }

    private function downPertanyaan()
    {
        $this->addSql('alter table pertanyaan rename column q1  to "1"');
        $this->addSql('alter table pertanyaan rename column "pendapatan_perbulan" to "Pendapatan perkapita perbulan"');
        $this->addSql('alter table pertanyaan rename column q36 to "36"');
        $this->addSql('alter table pertanyaan rename column q15 to "15"');
        $this->addSql('alter table pertanyaan rename column q24 to "24"');
        $this->addSql('alter table pertanyaan rename column q23 to "23"');
        $this->addSql('alter table pertanyaan rename column q26 to "26"');
        $this->addSql('alter table pertanyaan rename column q28 to "28"');
    }
}
