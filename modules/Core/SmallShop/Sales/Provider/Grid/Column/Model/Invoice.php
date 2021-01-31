<?php
namespace Modules\Core\SmallShop\Sales\Provider\Grid\Column\Model;

use App\Providers\Grid\Columns;
use Modules\Core\SmallShop\Customer\Model\Customer;
use Modules\Core\SmallShop\Sales\Model\Invoice as InvoiceModel;
use App\Providers\Grid\Column\Type;
use Illuminate\Database\Eloquent;

/**
 * Description of InvoiceGridColumns
 *
 * @author windigo
 */
class Invoice extends Columns
{
    protected $model = InvoiceModel::class;

    public function initColumns(): void
    {
        $this->items = [
            app(Type\ID::class, ['name' => 'id','label' => '#']),
            app(Type\Text::class, [
                'name' => 'order_nr',
                'label' => __('Number'),
                'render' => function ($value, OrderModel $row) {
                    return __('link', ['route' => route('admin.sales.orders.show', ['order' => $row]), 'label' => $value]);
                }
            ]),
            app(Type\Price::class, [
                'name' => 'amount',
                'label' => __('Amount')
            ]),
            app(Type\Date::class, ['name' => 'created_at',  'label' => __('Created')]),
            app(Type\Date::class, ['name' => 'updated_at',  'label' => __('Updated')]),
            app(Type\Action::class, [
                'name' => 'action',
                'label' => '',
                'actions' => [
                    'edit'  => [
                        'color' => 'primary',
                        'icon' => 'pen',
                        'route' => function (Eloquent\Model $item) {
                            return route('admin.sales.invoices.edit', ['invoice' => $item]);
                        },
                    ],
                    'print'  => [
                        'color' => 'primary',
                        'icon' => 'print',
                        'route' => function (Eloquent\Model $item) {
                            return route('admin.sales.invoices.print', ['invoice' => $item]);
                        },
                    ],
                ]
            ]),
        ];

    }
}
