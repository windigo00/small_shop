<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\Card;
use App\Model\Customer\Card as CCard;
use App\Repositories\CustomerCardRepository;

/**
 * Description of CardController
 *
 * @author windigo
 */
class CardController extends Controller {

    /**
     *
     * @var CustomerCardRepository
     */
    protected $cardRepo;
    /**
     *
     * @param CustomerCardRepository $repo
     */
    public function __construct(CustomerCardRepository $repo)
    {
        $this->cardRepo = $repo;
    }
    /**
     * Check card status for registration by number
     *
     * @param Card $card_number
     * @return \Illuminate\Http\Response
     */
    public function check(string $card_number = ''): \Illuminate\Http\Response {
        $response = ['checked' => false];
        if (empty($card_number)) {
            return response($response);
        }

        if (!$this->cardRepo->isCardByNumberAssigned($card_number)) {
            $response['checked'] = true;
            $response['card_id'] = $this->cardRepo->getCardByNumber($card_number)->id;
        }
        return response($response);
    }

}
