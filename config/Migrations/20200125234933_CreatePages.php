<?php
use Migrations\AbstractMigration;

class CreatePages extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        /**
         * Comand Cake: BIN\CAKE MIGRATIONS CREATE CreatePages
         */
        $table = $this->table('pages');

        $table->addColumn('title', 'string');
        $table->addColumn('url', 'string');
        $table->addColumn('body', 'text');
        $table->addColumn('created', 'timestamp', [
            'default' => 'CURRENT_TIMESTAMP'
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null'    => true
        ]);

        $table->create();
        /**
         * Para rodar a migration: BIN\CAKE MIGRATIONS MIGRATE
         * Para ver tabelas criadas: BIN\CAKE BAKE ALL
         */
    }
}
