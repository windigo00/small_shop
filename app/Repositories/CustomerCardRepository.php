<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Model\Card;
use App\Model\Customer\Card as CCard;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Description of CustomerCardRepository
 *
 * @author windigo
 */
class CustomerCardRepository implements RepositoryInterface
{
    public function create(array $modelData = array()): Model {

    }

    public function delete(int $id): void {

    }

    public function update(array $modelData = array()): Model {

    }

    public function isCardAssigned(int $card_id): bool {
        return CCard::query()->where('card_id', $card_id)->count() !== 0;
    }

    public function isCardByNumberAssigned(string $card_number): bool {
        try {
            return CCard::query()
                ->join('cards', 'card_id', '=', 'cards.id')
                ->where('cards.number', '=', $card_number )->count() !== 0;
        } catch(ModelNotFoundException $ex) {
            return false;
        }
    }

    public function getCardByNumber(string $card_number): ?Card {
        try {
            return Card::query()
                ->where('number', '=', $card_number )
                ->firstOrFail();

        } catch(ModelNotFoundException $ex) {
            return null;
        }
    }
}
