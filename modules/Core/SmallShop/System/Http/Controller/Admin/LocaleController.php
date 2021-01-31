<?php
namespace Modules\Core\SmallShop\System\Http\Controller\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Core\SmallShop\System\Repository\LocaleRepository;
use App\Providers\Grid\Container as GridContainer;
use Modules\Core\SmallShop\System\Provider\Grid\Column\Model;
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
        $translator  = app('translator');
//        $c  = array_combine(config('app.enabled_locale'), config('app.locale_codes'));
//        dump($c);
//        $columns->setLanguages();
        return view('system::admin.locale.index', [
            'locale_grid' => app(GridContainer::class, [
                'request'    => $request,
                'repository' => $repo,
                'columns'    => $columns
            ])
        ]);
    }
}
