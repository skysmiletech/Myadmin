<?php

declare(strict_types=1);

namespace PhpMyAdmin\ConfigStorage\Features;

use PhpMyAdmin\Dbal\DatabaseName;
use PhpMyAdmin\Dbal\TableName;

/** @psalm-immutable */
final class ExportTemplatesFeature
{
    public DatabaseName $database;

    public TableName $exportTemplates;

    public function __construct(DatabaseName $database, TableName $exportTemplates)
    {
        $this->database = $database;
        $this->exportTemplates = $exportTemplates;
    }
}
