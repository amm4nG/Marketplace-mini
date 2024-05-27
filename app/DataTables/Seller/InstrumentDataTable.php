<?php

namespace App\DataTables\Seller;

use App\Models\Instrument;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class InstrumentDataTable extends DataTable
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
            ->addColumn('action', function (Instrument $instrument) {
                return view('seller.instruments.action', ['instrument' => $instrument]);
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Instrument $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('instrument-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->setTableHeadClass(
                'text-muted
                fw-bold text-uppercase gs-0',
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
        return [Column::computed('DT_RowIndex')->title('No.')->addClass('text-center'), Column::computed('action')->addClass('text-center'), Column::make('name_instrument')->addClass('text-center'), Column::make('stock')->addClass('text-center')];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Instrument_' . date('YmdHis');
    }
}
