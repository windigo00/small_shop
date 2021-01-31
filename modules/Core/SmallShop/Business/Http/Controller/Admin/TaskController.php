<?php

namespace Modules\Core\SmallShop\Business\Http\Controller\Admin;

use Illuminate\Http\Request;
use Modules\Core\SmallShop\Business\Repository\TaskRepository;
//use App\Providers\Grid\Container as GridContainer;
//use Modules\Core\SmallShop\Business\Provider\Grid\Column\Model;
use Modules\Core\SmallShop\Business\Model\Task;
use Illuminate\Contracts\Support\Renderable;
use Modules\Core\SmallShop\Business\Services\TaskFacade;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Excel;
use Modules\Core\SmallShop\Business\Services\Export\ExportTS;
use Modules\Core\SmallShop\Business\Services\Export\ExportInvoice;
use Mpdf\Mpdf;

class TaskController extends \App\Http\Controllers\Controller
{
    /**
     *
     * @param Request $request
     * @param TaskRepository $repo
     * @return Renderable
     */
    public function index(Request $request, TaskRepository $repo): Renderable
    {
        return $this->show(null, $request, $repo);
    }

    public function show(?int $current, Request $request, TaskRepository $repo): Renderable
    {
        $date = $current !== null ? date_create() : date_create('now');
        $date->setTimezone(new \DateTimeZone(ini_get('date.timezone')));
        if ($current !== null) {
            $date->setTimestamp($current);
        }

        $params = [
            'time' => [
                'now'         => $date,
                'month_start' => (clone $date)->modify('first day of this month midnight'),
                'month_end'   => (clone $date)->modify('first day of next month midnight'),
                'start'       => (clone $date)->modify('first day of this month midnight')->modify('monday this week'),
                'end'         => (clone $date)->modify('last day of this month')->modify('monday next week'),
            ],
            'pages' => [
                'next' => (clone $date)->modify('previous month')->getTimestamp(),
                'prev' => (clone $date)->modify('previous month')->getTimestamp(),
            ],
            'routes' => [
                'list' => route('admin.business.tasks.list', '__'),
                'update' => route('admin.business.tasks.store'),
                'hints' => route('admin.business.tasks.hint'),
                'exports' => [
                    'timesheet' => route('admin.business.tasks.exportXls', '__'),
                    'invoice' => route('admin.business.tasks.exportPdf', '__'),
                ]
            ],
        ];
        $params['item_repo'] = $repo;

        return view('business::admin.task.index', $params);
    }

    public function list(?int $current, Request $request, TaskRepository $repo): \Illuminate\Http\JsonResponse
    {
        $date = $current !== null ? date_create($current) : date_create('now');
        $date->setTimezone(new \DateTimeZone(ini_get('date.timezone')));

        $tasks = $repo->getForMonth($date);
        $days = [];
        foreach ($tasks as $task) {
            /** @var Task $task */
            $day = str_replace('-', '', $task->date);
            if (!isset($days[$day])) {
                $days[$day] = [];
            }
            $days[$day][] = [
                "id" => $task->id,
                "name" => $task->name,
                "amount" => $task->amount
            ];
        }

        return response()->json(['data' => $days]);
    }

    public function store(Request $request, TaskFacade $facade): \Illuminate\Http\JsonResponse
    {
        $params = $request->request->all();
        $date = date_create($params['editDate']);
        $removed = $params['removedItems'];
        $items = [];
        $newItems = [];
        foreach ($params['items'] as $item) {
            if ($item['name'] === null || trim($item['name']) === '') {
                continue;
            }
            $item['date'] = $date;
            if ($item['id'] === null){
                if (count($removed) > 0) {
                    $item['id'] = array_pop($removed); // reuse old id
                } else {
                    $newItems[] = $item;
                    continue;
                }
            }
            $items[] = $item;
        }


        try {
            DB::beginTransaction();
            $facade->update($items);
            $facade->delete($removed);
            $facade->create($newItems);
            DB::commit();
            return response()->json(['ok']);
        } catch (\Exception $ex) {
            DB::rollBack();
            dump($items);
            dump($ex);
            $request->session()->flash('error', __('Tasks not updated!'));
            return response()->json(['fail', __('Tasks not updated!')]);
        }
    }

    public function exportXls(int $current, TaskFacade $facade, Excel $excel)
    {
        $date = date_create_from_format('Ymd', $current);
        return $excel->download(new ExportTS($date, $facade) , $current . '.xlsx');
    }

    public function exportPdf(int $current, Request $request, TaskFacade $facade, Mpdf $pdf)
    {
        $date = date_create_from_format('Ymd', $current);
        $view = new ExportInvoice($date, $facade->exportMonthData($date), $request->all());
        return $view->view();
    }

    public function hint(Request $request, TaskFacade $facade): \Illuminate\Http\JsonResponse
    {
        $names = $facade->getNamesLike($request->get('hint'));
        return response()->json($names);
    }
}
