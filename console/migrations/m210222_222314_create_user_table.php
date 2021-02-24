<?php

class m210222_222314_create_user_table extends CDbMigration
{
    public function up()
    {
        $this->createTable('{{user}}', [
            'id' => 'pk',
            'username' => 'string not null',
            'password' => 'varchar(128) not null',
            'email' => 'string not null',
            'create_time' => 'timestamp',
            'update_time' => 'timestamp',
        ]);

        $this->insert('{{user}}', [
            'username' => 'admin',
            'password' => \CPasswordHelper::hashPassword('admin'),
            'email' => 'admin@example.com',
        ]);
    }

    public function down()
    {
        $this->dropTable('{{user}}');
    }
}