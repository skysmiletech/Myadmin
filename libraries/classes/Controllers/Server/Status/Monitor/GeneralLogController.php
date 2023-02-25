<?php

declare(strict_types=1);

namespace PhpMyAdmin\Controllers\Server\Status\Monitor;

use PhpMyAdmin\Controllers\Server\Status\AbstractController;
use PhpMyAdmin\DatabaseInterface;
use PhpMyAdmin\Http\ServerRequest;
use PhpMyAdmin\ResponseRenderer;
use PhpMyAdmin\Server\Status\Data;
use PhpMyAdmin\Server\Status\Monitor;
use PhpMyAdmin\Template;
use PhpMyAdmin\Url;

final class GeneralLogController extends AbstractController
{
    public function __construct(
        ResponseRenderer $response,
        Template $template,
        Data $data,
        private Monitor $monitor,
        private DatabaseInterface $dbi,
    ) {
        parent::__construct($response, $template, $data);
    }

    public function __invoke(ServerRequest $request): void
    {
        $GLOBALS['errorUrl'] ??= null;

        $GLOBALS['errorUrl'] = Url::getFromRoute('/');

        if ($this->dbi->isSuperUser()) {
            $this->dbi->selectDb('mysql');
        }

        if (! $this->response->isAjax()) {
            return;
        }

        $data = $this->monitor->getJsonForLogDataTypeGeneral(
            (int) $request->getParsedBodyParam('time_start'),
            (int) $request->getParsedBodyParam('time_end'),
            (bool) $request->getParsedBodyParam('limitTypes'),
            (bool) $request->getParsedBodyParam('removeVariables'),
        );
        if ($data === null) {
            $this->response->setRequestStatus(false);

            return;
        }

        $this->response->addJSON(['message' => $data]);
    }
}
