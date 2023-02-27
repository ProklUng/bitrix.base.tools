<?php

namespace Prokl\Commands\Migrations;

use Arrilot\BitrixMigrations\TemplatesCollection;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableSeparator;

class TemplatesCommand extends AbstractCommand
{
    /**
     * TemplatesCollection instance.
     *
     * @var TemplatesCollection
     */
    protected $collection;

    protected static $defaultName = 'templates';

    /**
     * Constructor.
     *
     * @param TemplatesCollection $collection
     * @param string|null         $name
     */
    public function __construct(TemplatesCollection $collection, $name = null)
    {
        $this->collection = $collection;

        parent::__construct($name);
    }

    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $this->setDescription('Show the list of available migration templates');
    }

    /**
     * Execute the console command.
     *
     * @return null|int
     */
    protected function fire()
    {
        $table = new Table($this->output);
        $table->setHeaders(['Name', 'Path', 'Description'])->setRows($this->collectRows());
        $table->setStyle('borderless');
        $table->render();

        return 0;
    }

    /**
     * Collect and return templates from a Migrator.
     *
     * @return array
     */
    protected function collectRows()
    {
        $rows = collect($this->collection->all())
            ->filter(function ($template) {
                return $template['is_alias'] == false;
            })
            ->sortBy('name')
            ->map(function ($template) {
                $row = [];

                $names = array_merge([$template['name']], $template['aliases']);
                $row[] = implode("\n/ ", $names);
                $row[] = wordwrap($template['path'], 65, "\n", true);
                $row[] = wordwrap($template['description'], 25, "\n", true);

                return $row;
            });

        return $this->separateRows($rows);
    }

    /**
     * Separate rows with a separator.
     *
     * @param $templates
     *
     * @return array
     */
    protected function separateRows($templates)
    {
        $rows = [];
        foreach ($templates as $template) {
            $rows[] = $template;
            $rows[] = new TableSeparator();
        }
        unset($rows[count($rows) - 1]);

        return $rows;
    }
}
