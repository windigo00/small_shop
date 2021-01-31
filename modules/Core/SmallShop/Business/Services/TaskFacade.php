<?php
namespace Modules\Core\SmallShop\Business\Services;

use Modules\Core\SmallShop\Business\Repository\TaskRepository;
use Modules\Core\SmallShop\Business\Model\Task;
use Maatwebsite\Excel\Excel;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Collection;

class TaskFacade
{
    const EXPORT_TYPE_XLS = 'xls';
    const EXPORT_TYPE_PDF = 'pdf';

    /**
     * @param {name: string, amount: int}[] $items
     */
    public function create(array $items): void
    {
        Task::query()->insert($items);
    }

    /**
     * @param {id: int, name: string, amount: int}[] $items
     */
    public function update(array $items)
    {
        foreach ($items as $item) {
            Task::query()->where('id', $item['id'])->update($item);
        }
    }

    /**
     * @param int[] $ids
     */
    public function delete(array $ids)
    {
        Task::destroy($ids);
    }

    public function exportMonthData(\DateTime $date): array
    {
        $dMonth = $date->format('n') * 1;
        $dYear = $date->format('Y');

        $days = [];
        $sum = 0;
        $date->modify('first day of this month');
        while ($date->format('n') * 1 === $dMonth) {
            $items = Task::query()->where('date', '=', $date->format('Y-m-d'))->get();
            $itemSum = 0;

            foreach ($items as $item) {
                $itemSum += $item->amount;
            }

            $days[] = [
                'date' => clone($date),
                'items' => $items,
                'sum' => $itemSum,
            ];
            $sum += $itemSum;
            $date->modify('next day');
        }

        // Get data
        $data = [
            'days' => $days,
            'sum' => $sum
        ];
        return $data;
    }

    public function getNamesLike(string $hint): Collection
    {
        return Task::query()->distinct()->where('name', 'like', "%{$hint}%")->pluck('name');
    }
}
