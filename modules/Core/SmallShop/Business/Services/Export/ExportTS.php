<?php

namespace Modules\Core\SmallShop\Business\Services\Export;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Modules\Core\SmallShop\Business\Services\TaskFacade;

class ExportTS implements WithMultipleSheets
{
    protected \DateTime $date;
    protected TaskFacade $taskFacade;

    public function __construct(\DateTime $date, TaskFacade $facade)
    {
        $this->date = $date;
        $this->taskFacade = $facade;
    }

    public function sheets(): array
    {
        $data = $this->taskFacade->exportMonthData(clone($this->date));
        return [
            new Timesheet($this->date, $data),
            new TimesheetDetail($this->date, $data),
        ];
    }
}
