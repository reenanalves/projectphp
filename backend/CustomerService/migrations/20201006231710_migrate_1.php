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
        $this->execute("CREATE TABLE `address` (
            `id` int(11) NOT NULL,
            `customer_id` int(11) NOT NULL,
            `street` varchar(100) NOT NULL,
            `district` varchar(100) NOT NULL,
            `number` varchar(20) NOT NULL,
            `complement` varchar(30) NOT NULL,
            `city` varchar(20) NOT NULL,
            `state` varchar(2) NOT NULL,
            `status` int(11) NOT NULL
          ) ENGINE=MyISAM DEFAULT CHARSET=latin1");

        $this->execute("CREATE TABLE `customer` (
            `id` int(11) NOT NULL,
            `name` varchar(30) NOT NULL,
            `birthday` date NOT NULL,
            `document_cpf` varchar(20) NOT NULL,
            `document_rg` varchar(20) NOT NULL,
            `phone` varchar(20) NOT NULL,
            `status` int(11) NOT NULL
          ) ENGINE=MyISAM DEFAULT CHARSET=latin1");
    }

    public function down(): void
    {
        $this->execute("DROP TABLE `address`");

        $this->execute("DROP TABLE `customer`");
    }
}
