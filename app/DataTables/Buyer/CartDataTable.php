<?php

namespace App\DataTables\Buyer;

use App\Models\Cart;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CartDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('checkbox', function (Cart $cart) {
                return '<input type="checkbox" class="row-checkbox"
                value="' .
                    $cart->instrument_id .
                    ',' .
                    $cart->quantity .
                    '">';
            })
            ->addColumn('action', function (Cart $cart) {
                return view('buyer.carts.action', ['cart' => $cart]);
            })
            ->addColumn('name_instrument', function (Cart $cart) {
                return $cart->instrument->name_instrument;
            })
            ->rawColumns(['checkbox', 'action']) // Ensure raw HTML is rendered
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Cart $model): QueryBuilder
    {
        return $model->newQuery()->with('instrument');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()->setTableId('cart-table')->columns($this->getColumns())->minifiedAjax()->setTableHeadClass('text-primary fw-bold text-uppercase')->orderBy(1)->select(false)->buttons([]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [Column::computed('checkbox')->title('<input type="checkbox" id="select-all" />'), Column::computed('action')->addClass('text-center'), Column::computed('name_instrument')->addClass('text-center'), Column::make('quantity')->addClass('text-center')];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Cart_' . date('YmdHis');
    }
}