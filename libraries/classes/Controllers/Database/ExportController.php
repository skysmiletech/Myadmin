<?php

declare(strict_types=1);

namespace PhpMyAdmin\Controllers\Database;

use PhpMyAdmin\Config\PageSettings;
use PhpMyAdmin\Controllers\AbstractController;
use PhpMyAdmin\Export;
use PhpMyAdmin\Export\Options;
use PhpMyAdmin\Http\ServerRequest;
use PhpMyAdmin\Message;
use PhpMyAdmin\Plugins;
use PhpMyAdmin\ResponseRenderer;
use PhpMyAdmin\Template;
use PhpMyAdmin\Url;
use PhpMyAdmin\Util;

use function __;
use function array_merge;
use function is_array;

final class ExportController extends AbstractController
{
    /** @var Export */
    private $export;

    /** @var Options */
    private $exportOptions;

    public function __construct(
        ResponseRenderer $response,
        Template $template,
        Export $export,
        Options $exportOptions
    ) {
        parent::__construct($response, $template);
        $this->export = $export;
        $this->exportOptions = $exportOptions;
    }

    public function __invoke(ServerRequest $request): void
    {
        $GLOBALS['urlParams'] = $GLOBALS['urlParams'] ?? null;
        $GLOBALS['tables'] = $GLOBALS['tables'] ?? null;
        $GLOBALS['num_tables'] = $GLOBALS['num_tables'] ?? null;
        $GLOBALS['total_num_tables'] = $GLOBALS['total_num_tables'] ?? null;
        $GLOBALS['tooltip_truename'] = $GLOBALS['tooltip_truename'] ?? null;
        $GLOBALS['tooltip_aliasname'] = $GLOBALS['tooltip_aliasname'] ?? null;
        $GLOBALS['pos'] = $GLOBALS['pos'] ?? null;
        $GLOBALS['table_select'] = $GLOBALS['table_select'] ?? null;
        $GLOBALS['unlim_num_rows'] = $GLOBALS['unlim_num_rows'] ?? null;
        $GLOBALS['errorUrl'] = $GLOBALS['errorUrl'] ?? null;

        $pageSettings = new PageSettings('Export');
        $pageSettingsErrorHtml = $pageSettings->getErrorHTML();
        $pageSettingsHtml = $pageSettings->getHTML();

        $this->addScriptFiles(['export.js']);

        $this->checkParameters(['db']);

        $GLOBALS['errorUrl'] = Util::getScriptNameForOption($GLOBALS['cfg']['DefaultTabDatabase'], 'database');
        $GLOBALS['errorUrl'] .= Url::getCommon(['db' => $GLOBALS['db']], '&');

        if (! $this->hasDatabase()) {
            return;
        }

        $GLOBALS['urlParams']['goto'] = Url::getFromRoute('/database/export');

        [
            $GLOBALS['tables'],
            $GLOBALS['num_tables'],
            $GLOBALS['total_num_tables'],,,
            $GLOBALS['tooltip_truename'],
            $GLOBALS['tooltip_aliasname'],
            $GLOBALS['pos'],
        ] = Util::getDbInfo($request, $GLOBALS['db'], false);

        // exit if no tables in db found
        if ($GLOBALS['num_tables'] < 1) {
            $this->response->addHTML(
                Message::error(__('No tables found in database.'))->getDisplay()
            );

            return;
        }

        if ($request->hasBodyParam('selected_tbl') && empty($GLOBALS['table_select'])) {
            $GLOBALS['table_select'] = $request->getParsedBodyParam('selected_tbl');
        }

        $tablesForMultiValues = [];

        foreach ($GLOBALS['tables'] as $each_table) {
            if (is_array($request->getParsedBodyParam('table_select'))) {
                $is_checked = $this->export->getCheckedClause($each_table['Name'], $request->getParsedBodyParam('table_select'));
            } elseif (isset($GLOBALS['table_select'])) {
                $is_checked = $this->export->getCheckedClause($each_table['Name'], $GLOBALS['table_select']);
            } else {
                $is_checked = true;
            }

            if (is_array($request->getParsedBodyParam('table_structure'))) {
                $structure_checked = $this->export->getCheckedClause($each_table['Name'], $request->getParsedBodyParam('table_structure'));
            } else {
                $structure_checked = $is_checked;
            }

            if (is_array($request->getParsedBodyParam('table_data'))) {
                $data_checked = $this->export->getCheckedClause($each_table['Name'], $request->getParsedBodyParam('table_data'));
            } else {
                $data_checked = $is_checked;
            }

            $tablesForMultiValues[] = [
                'name' => $each_table['Name'],
                'is_checked_select' => $is_checked,
                'is_checked_structure' => $structure_checked,
                'is_checked_data' => $data_checked,
            ];
        }

        if (! isset($GLOBALS['sql_query'])) {
            $GLOBALS['sql_query'] = '';
        }

        if (! isset($GLOBALS['unlim_num_rows'])) {
            $GLOBALS['unlim_num_rows'] = 0;
        }

        $isReturnBackFromRawExport = $request->getParsedBodyParam('export_type') === 'raw';
        if ($request->hasBodyParam('raw_query') || $isReturnBackFromRawExport) {
            $export_type = 'raw';
        } else {
            $export_type = 'database';
        }

        $GLOBALS['single_table'] = $request->getParam('single_table') ?? $GLOBALS['single_table'] ?? null;

        $exportList = Plugins::getExport($export_type, isset($GLOBALS['single_table']));

        if (empty($exportList)) {
            $this->response->addHTML(Message::error(
                __('Could not load export plugins, please check your installation!')
            )->getDisplay());

            return;
        }

        $options = $this->exportOptions->getOptions(
            $export_type,
            $GLOBALS['db'],
            $GLOBALS['table'],
            $GLOBALS['sql_query'],
            $GLOBALS['num_tables'],
            $GLOBALS['unlim_num_rows'],
            $exportList
        );

        $this->render('database/export/index', array_merge($options, [
            'page_settings_error_html' => $pageSettingsErrorHtml,
            'page_settings_html' => $pageSettingsHtml,
            'structure_or_data_forced' => $request->getParsedBodyParam('structure_or_data_forced', 0),
            'tables' => $tablesForMultiValues,
        ]));
    }
}
