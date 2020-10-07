<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Migrate1 extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function up(): void
    {
        $this->execute("CREATE TABLE `user` (
            `id` int(11) NOT NULL,
            `user` varchar(30) NOT NULL,
            `pass` varchar(33) NOT NULL,
            `status` int(11) NOT NULL,
            `name` varchar(30) NOT NULL
          ) ENGINE=MyISAM DEFAULT CHARSET=latin1");

        $this->execute("INSERT INTO `user` (`id`, `user`, `pass`, `status`, `name`) VALUES
        (1, 'user', 'cc75e1c85b040aed61f8dbd87f4a8eb2', 1, 'Renan Alves da Silva')");
    }

    public function down(): void
    {
        $this->execute("DROP TABLE `user`");
    }
}
