<?php

namespace Modules\Core\SmallShop\Business\Services\Export;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Illuminate\Contracts\View\View;

class TimesheetDetail implements FromView, WithTitle
{
    protected \DateTime $date;
    protected array $data;

    public function __construct(\DateTime $date, array $data)
    {
        $this->date = $date;
        $this->data = $data;
    }
    
    public function view(): View
    {
        return view('business::admin.task.export.timesheet_detail', [
            'data' => $this->data
        ]);
    }

    public function title(): string
    {
        return 'Detail ' . $this->date->format('Y_m');
    }

}
