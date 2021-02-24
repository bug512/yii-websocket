<?php

class m210222_222245_create_comment_table extends CDbMigration
{
    public $seeds = [
        [
            ':author_name' => 'Andrew Coffey',
            ':content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
        ],
        [
            'author_name' => 'Annaliese Sparks',
            'content' => 'Sapien diam ligula egestas aptent et ridiculus magnis velit tincidunt dolor. Dignissim nisi auctor sociis vivamus etiam dignissim at. Turpis netus placerat commodo primis parturient adipiscing non blandit velit Ultrices ullamcorper.',
        ],
        [
            'author_name' => 'Laith Owens',
            'content' => 'Nunc vestibulum elementum. Magna tincidunt dictumst morbi elementum amet commodo euismod congue senectus id, sociis Luctus non elit habitant per proin urna felis ornare curabitur ad per volutpat malesuada erat nunc torquent ornare quam consectetuer venenatis class ad parturient. Praesent nulla imperdiet blandit arcu mauris placerat est interdum elit dolor torquent. Parturient duis adipiscing eros neque, malesuada tellus fringilla proin.',
        ],
    ];

    public function up()
    {
        $this->execute('drop type if exists moderate_status_t');
        $this->execute('create type moderate_status_t as enum(\'check\', \'approved\', \'declined\')');

        $this->createTable('{{comment}}', [
            'id' => 'pk',
            'author_name' => 'string not null',
            'content' => 'text not null',
            'state' => 'moderate_status_t not null default \'check\'',
            'create_time' => 'timestamp',
            'update_time' => 'timestamp',
        ]);

        $insert = 'insert into {{comment}} (author_name, create_time, content) values (:author_name, CURRENT_TIMESTAMP(0), :content)';

        foreach ($this->seeds as $seed) {
            Yii::app()->db->createCommand($insert)->execute($seed);
        }
    }

    public function down()
    {
        $this->dropTable('{{comment}}');
        $this->execute('drop type if exists moderate_status_t');
    }
}