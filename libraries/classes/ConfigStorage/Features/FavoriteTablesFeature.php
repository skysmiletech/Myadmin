<?php

declare(strict_types=1);

namespace PhpMyAdmin\ConfigStorage\Features;

use PhpMyAdmin\Dbal\DatabaseName;
use PhpMyAdmin\Dbal\TableName;

/** @psalm-immutable */
final class FavoriteTablesFeature
{
    public DatabaseName $database;

    public TableName $favorite;

    public function __construct(DatabaseName $database, TableName $favorite)
    {
        $this->database = $database;
        $this->favorite = $favorite;
    }
}
