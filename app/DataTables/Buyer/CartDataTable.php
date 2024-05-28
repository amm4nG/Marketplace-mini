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
        return (new EloquentDataTable($query))->addIndexColumn()->addColumn('action', 'cart.action')->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Cart $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('cart-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->setTableHeadClass(
                'text-primary
                fw-bold text-uppercase',
            )
            ->orderBy(1)
            ->select(false)
            ->buttons([]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [Column::computed('DT_RowIndex')->title('No.')->addClass('text-center'), Column::computed('action')->addClass('text-center'), Column::make('name_instrument'), Column::make('quantity')->addClass('text-center')];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Cart_' . date('YmdHis');
    }
}
