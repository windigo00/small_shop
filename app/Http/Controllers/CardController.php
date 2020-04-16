<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\Card;

/**
 * Description of CardController
 *
 * @author windigo
 */
class CardController extends Controller {

    public function check(Card $card = null) {
        return response(['checked' => $card == null ? false : true]);
    }

}
