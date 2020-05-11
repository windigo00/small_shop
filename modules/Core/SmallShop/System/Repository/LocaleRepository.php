<?php

namespace Modules\Core\SmallShop\System\Repository;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\SmallShop\System\Model\Locale;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Providers\Grid\Columns;
use Illuminate\Http\Request;
use Modules\Core\SmallShop\System\Model\Locale\Factory as LocaleFactory;
use App\Repositories\AbstractRepository;

class LocaleRepository extends AbstractRepository
{
    public function __construct(Locale $model)
    {
        parent::__construct($model);
    }

    public function create(array $modelData = []): Locale
    {
    }

    public function delete(int $id): void
    {
    }

    public function update(array $modelData = []): Locale
    {
    }

    public function save(string $key, string $translation, string $locale, string $group = 'default'): ?Locale
    {
        if (empty($key) || empty($translation)) {
            return null;
        }
        if (empty($group)) {
            $group = 'default';
        }

        $model = LocaleFactory::get($locale);
        $locale = Locale::firstOrCreate(['key' => $key]);
        $model->fill([
            'key_id'   => $locale->id,
            'group_id' => Locale\Group::firstOrCreate(['name' => $group])->id,
            'value'    => $translation,
        ])->save();
        return $locale;
    }

    /**
     *
     * @param Request $request
     * @param string[] $with
     * @param Columns|null $columns
     * @return LengthAwarePaginator
     */
    public function getPage(Request $request, array $with = [], ?Columns $columns = null): LengthAwarePaginator
    {
        return parent::getPage($request, $with, $columns);
    }
}
