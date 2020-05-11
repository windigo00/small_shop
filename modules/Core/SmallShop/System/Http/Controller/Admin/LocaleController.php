<?php
namespace Modules\Core\SmallShop\System\Http\Controller\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\LocaleRepository;
use App\Providers\Grid\Container as GridContainer;
use Modules\Core\SmallShop\System\Provider\Grid\Column\Model;
use App\Model\Locale;
use Illuminate\Contracts\Support\Renderable;

/**
 * Description of LocaleController
 *
 * @author windigo
 */
class LocaleController extends Controller
{
    /**
     *
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, LocaleRepository $repo, Model\Locale $columns): Renderable
    {
//        dump(app('config'));
        return view('system::admin.system.locale.index', [
            'locale_grid' => app(GridContainer::class, [
                'request'    => $request,
                'repository' => $repo,
                'columns'    => $columns
            ])
        ]);
    }
}
