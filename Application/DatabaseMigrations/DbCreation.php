<?php
class DbCreation implements IDatabaseMigration
{
    public function GetUniqueName()
    {
        return 'x76ysjvcn1av60lbqkaa';
    }

    public function GetSortOrder()
    {
        return 0;
    }

    public function Up($migrator)
    {
        $migrator->RunSql('
CREATE TABLE IF NOT EXISTS localuser(
  Id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  ShellUserId INT NOT NULL,
  KEY(ShellUserId)
);
        ');
    }

    public function Down($migrator)
    {

    }

    public function Seed($migrator)
    {

    }
}