<?php

namespace Src\Database\Migrations;

use PDO;

class create_article_table
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function up()
    {
        $sql = "CREATE TABLE IF NOT EXISTS article (
            id int NOT NULL AUTO_INCREMENT,
            title varchar(100) NOT NULL,
            subtitle varchar(255) NOT NULL,
            PRIMARY KEY (id)
        )";

        $this->db->exec($sql);
    }

    public function down()
    {
        $this->db->exec("DROP TABLE article");
    }
}
