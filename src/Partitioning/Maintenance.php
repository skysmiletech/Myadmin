<?php

declare(strict_types=1);

namespace PhpMyAdmin\Partitioning;

use PhpMyAdmin\DatabaseInterface;
use PhpMyAdmin\Identifiers\DatabaseName;
use PhpMyAdmin\Identifiers\TableName;
use PhpMyAdmin\Util;

use function sprintf;

final class Maintenance
{
    public function __construct(private DatabaseInterface $dbi)
    {
    }

    /** @return mixed[] */
    public function analyze(DatabaseName $db, TableName $table, string $partition): array
    {
        $query = sprintf(
            'ALTER TABLE %s ANALYZE PARTITION %s;',
            Util::backquote($table->getName()),
            Util::backquote($partition),
        );

        $this->dbi->selectDb($db);
        $result = $this->dbi->fetchResult($query);

        $rows = [];
        foreach ($result as $row) {
            $rows[$row['Table']][] = $row;
        }

        return [$rows, $query];
    }

    /** @return mixed[] */
    public function check(DatabaseName $db, TableName $table, string $partition): array
    {
        $query = sprintf(
            'ALTER TABLE %s CHECK PARTITION %s;',
            Util::backquote($table->getName()),
            Util::backquote($partition),
        );

        $this->dbi->selectDb($db);
        $result = $this->dbi->fetchResult($query);

        $rows = [];
        foreach ($result as $row) {
            $rows[$row['Table']][] = $row;
        }

        return [$rows, $query];
    }

    /** @return mixed[] */
    public function drop(DatabaseName $db, TableName $table, string $partition): array
    {
        $query = sprintf(
            'ALTER TABLE %s DROP PARTITION %s;',
            Util::backquote($table->getName()),
            Util::backquote($partition),
        );

        $this->dbi->selectDb($db);
        $result = $this->dbi->tryQuery($query);

        return [(bool) $result, $query];
    }

    /** @return mixed[] */
    public function optimize(DatabaseName $db, TableName $table, string $partition): array
    {
        $query = sprintf(
            'ALTER TABLE %s OPTIMIZE PARTITION %s;',
            Util::backquote($table->getName()),
            Util::backquote($partition),
        );

        $this->dbi->selectDb($db);
        $result = $this->dbi->fetchResult($query);

        $rows = [];
        foreach ($result as $row) {
            $rows[$row['Table']][] = $row;
        }

        return [$rows, $query];
    }

    /**
     * @return array<int, bool|string>
     * @psalm-return array{bool, string}
     */
    public function rebuild(DatabaseName $db, TableName $table, string $partition): array
    {
        $query = sprintf(
            'ALTER TABLE %s REBUILD PARTITION %s;',
            Util::backquote($table->getName()),
            Util::backquote($partition),
        );

        $this->dbi->selectDb($db);
        $result = $this->dbi->tryQuery($query);

        return [(bool) $result, $query];
    }

    /** @return mixed[] */
    public function repair(DatabaseName $db, TableName $table, string $partition): array
    {
        $query = sprintf(
            'ALTER TABLE %s REPAIR PARTITION %s;',
            Util::backquote($table->getName()),
            Util::backquote($partition),
        );

        $this->dbi->selectDb($db);
        $result = $this->dbi->fetchResult($query);

        $rows = [];
        foreach ($result as $row) {
            $rows[$row['Table']][] = $row;
        }

        return [$rows, $query];
    }

    /**
     * @return array<int, bool|string>
     * @psalm-return array{bool, string}
     */
    public function isView(DatabaseName $db, TableName $table): bool
    {
        $query = sprintf(
            'SELECT TABLE_NAME FROM INFORMATION_SCHEMA.VIEWS WHERE TABLE_SCHEMA = %s AND TABLE_NAME = %s;',
            $this->dbi->$db->getName(),
            $this->dbi->$table->getName()
        );

        $result = $this->dbi->fetchResult($query);
        return !empty($result);
    }
    
    public function truncate(DatabaseName $db, TableName $table, string $partition): array
    {
        if ($this->isView($db, $table)) {
            return [false, 'Cannot TRUNCATE a view'];
        }
        else{
            $query = sprintf(
                'ALTER TABLE %s TRUNCATE PARTITION %s;',
                Util::backquote($table->getName()),
                Util::backquote($partition),
            );
    
            $this->dbi->selectDb($db);
            $result = $this->dbi->tryQuery($query);
    
            return [(bool) $result, $query];
        }
    }
}
