<?php

namespace App\DataTables\Seller;

use App\Models\OrderInstrument;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class OrderDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('name', function (OrderInstrument $order) {
                return $order->user->profile->name;
            })
            ->addColumn('price', function (OrderInstrument $order) {
                return number_format($order->total_price);
            })
            ->addColumn('status', function (OrderInstrument $order) {
                return '<span class="badge text-bg-primary py-2 text-white">' .
                    ($order->payment
                        ? $order->payment->status
                        : 'No
            Payment') .
                    '</span>';
            })
            ->addColumn('paid_at', function (OrderInstrument $order) {
                return $order->payment->paid_at ?? '-';
            })
            ->addColumn('note', function (OrderInstrument $order) {
                return $order->payment->note ?? '-';
            })
            ->rawColumns(['status'])
            ->addColumn('action', function (OrderInstrument $order) {
                return view('seller.orders.action', ['order' => $order]);
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(OrderInstrument $model): QueryBuilder
    {
        $query = $model->newQuery();
        return $query->whereHas('payment', function ($query) {
            $query->where('status', '!=', 'paid')->whereOr('status', '!=', 'rejected');
        });
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()->setTableId('orderinstrument-table')->columns($this->getColumns())->minifiedAjax()->setTableHeadClass('text-muted fw-bold text-uppercase gs-0')->orderBy(1)->select(false)->buttons([]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('DT_RowIndex')->title('No')->addClass('text-center align-middle'),
            Column::computed('action')->addClass('text-center align-middle'),
            Column::computed('name')->addClass('text-center align-middle'),
            Column::make('price')
                ->title(
                    'total
                    price',
                )
                ->addClass('text-center align-middle'),
            Column::make('status')->addClass('text-center align-middle'),
            Column::make('paid_at')->addClass('text-center align-middle'),
            Column::make('note')->addClass('text-center
        align-middle'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'OrderInstrument_' . date('YmdHis');
    }
}
