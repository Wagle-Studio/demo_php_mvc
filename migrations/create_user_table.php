<?php

namespace Src\Database\Migrations;

use PDO;

class create_user_table
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function up()
    {
        $sql = "CREATE TABLE IF NOT EXISTS user (
            id int NOT NULL AUTO_INCREMENT,
            email varchar(255) NOT NULL,
            PRIMARY KEY (id),
            UNIQUE KEY email (email)
        )";

        $this->db->exec($sql);
    }

    public function down()
    {
        $this->db->exec("DROP TABLE user");
    }
}
