<?php

namespace App\DataTables\Seller;

use App\Models\InstrumentImage;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class InstrumentImageDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */

    protected $id;

    public function setInstrument($id)
    {
        $this->id = $id;
    }

    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('image', function (InstrumentImage $image) {
                $imagePath = "/storage/$image->image";
                return '<img src="' . $imagePath . '" style="width:200px; heigth:auto" class="img-fluid" />';
            })
            ->addColumn('action', function (InstrumentImage $image) {
                return view('seller.instruments.images.action', ['images' => $image]);
            })
            ->rawColumns(['image', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(InstrumentImage $model): QueryBuilder
    {
        $query = $model->newQuery();
        $query->where('instrument_id', $this->id);
        return $query;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('instrumentimage-table')
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
        return [Column::computed('DT_RowIndex')->title('No.')->addClass('text-center align-middle'), Column::computed('action')->addClass('text-center align-middle'), Column::make('image')->addClass('text-center align-middle')];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'InstrumentImage_' . date('YmdHis');
    }
}
