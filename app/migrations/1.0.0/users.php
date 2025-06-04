<?php

use Phalcon\Db\Column;
use Phalcon\Db\Exception;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Migrations\Mvc\Model\Migration;

/**
 * Class UsersMigration_100
 */
class UsersMigration_100 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     * @throws Exception
     */
    public function morph(): void
    {
        $this->morphTable('users', [
            'columns' => [
                new Column(
                    'id',
                    [
                        'type' => Column::TYPE_BIGINTEGER,
                        'primary' => true,
                        'notNull' => true,
                        'autoIncrement' => true,
                        'first' => true
                    ]
                ),
                new Column(
                    'email',
                    [
                        'type' => Column::TYPE_TEXT,
                        'notNull' => true,
                        'after' => 'id'
                    ]
                ),
                new Column(
                    'username',
                    [
                        'type' => Column::TYPE_TEXT,
                        'notNull' => false,
                        'after' => 'email'
                    ]
                ),
                new Column(
                    'password_hash',
                    [
                        'type' => Column::TYPE_TEXT,
                        'notNull' => true,
                        'after' => 'username'
                    ]
                ),
                new Column(
                    'full_name',
                    [
                        'type' => Column::TYPE_TEXT,
                        'notNull' => false,
                        'after' => 'password_hash'
                    ]
                ),
                new Column(
                    'phone',
                    [
                        'type' => Column::TYPE_TEXT,
                        'notNull' => false,
                        'after' => 'full_name'
                    ]
                ),
                new Column(
                    'address',
                    [
                        'type' => Column::TYPE_TEXT,
                        'notNull' => false,
                        'after' => 'phone'
                    ]
                ),
                new Column(
                    'is_active',
                    [
                        'type' => Column::TYPE_BOOLEAN,
                        'default' => "true",
                        'notNull' => false,
                        'after' => 'address'
                    ]
                ),
                new Column(
                    'is_admin',
                    [
                        'type' => Column::TYPE_BOOLEAN,
                        'default' => "false",
                        'notNull' => false,
                        'after' => 'is_active'
                    ]
                ),
                new Column(
                    'created_at',
                    [
                        'type' => Column::TYPE_TIMESTAMP,
                        'default' => "CURRENT_TIMESTAMP",
                        'notNull' => false,
                        'after' => 'is_admin'
                    ]
                ),
                new Column(
                    'updated_at',
                    [
                        'type' => Column::TYPE_TIMESTAMP,
                        'default' => "CURRENT_TIMESTAMP",
                        'notNull' => false,
                        'after' => 'created_at'
                    ]
                ),
            ],
            'indexes' => [
                new Index('users_email_key', ['email'], 'UNIQUE'),
                new Index('users_username_key', ['username'], 'UNIQUE'),
            ],
        ]);
    }

    /**
     * Run the migrations
     *
     * @return void
     */
    public function up(): void
    {
    }

    /**
     * Reverse the migrations
     *
     * @return void
     */
    public function down(): void
    {
    }
}
