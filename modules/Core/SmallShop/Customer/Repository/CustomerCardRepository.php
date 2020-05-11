<?php
namespace Modules\Core\SmallShop\Customer\Repository;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\SmallShop\Customer\Model\Card;
use Modules\Core\SmallShop\Customer\Model\Customer\Card as CCard;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Providers\Grid\Columns;
use Illuminate\Http\Request;
use App\Repositories\AbstractRepository;

/**
 * Description of CustomerCardRepository
 *
 * @author windigo
 */
class CustomerCardRepository extends AbstractRepository
{
    public function __construct(CCard $model)
    {
        parent::__construct($model);
    }

    public function create(array $modelData = array()): Model
    {
    }

    public function delete(int $id): void
    {
    }

    public function update(array $modelData = array()): Model
    {
    }

    public function isCardAssigned(int $card_id): bool
    {
        return $this->model_class->query()->where('card_id', $card_id)->count() !== 0;
    }

    public function isCardByNumberAssigned(string $card_number): bool
    {
        try {
            return $this->model_class->query()
                ->join('cards', 'card_id', '=', 'cards.id')
                ->where('cards.number', '=', $card_number)->count() !== 0;
        } catch (ModelNotFoundException $ex) {
            return false;
        }
    }
    /**
     *
     * @param string $card_number
     * @return Card|null
     */
    public function getCardByNumber(string $card_number): ?Card
    {
        try {
            return Card::query()
                ->where('number', '=', $card_number)
                ->firstOrFail();
        } catch (ModelNotFoundException $ex) {
            return null;
        }
    }
    /**
     *
     * @param Request $request
     * @param string[] $with
     * @param Columns|null $columns
     * @return LengthAwarePaginator
     */
    public function getPage(Request $request, array $with = [], Columns $columns = null): LengthAwarePaginator
    {
        return parent::getPage($request, $with, $columns);
    }
}
