<?php

namespace App\DataTables\Seller;

use App\Models\Slide;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SlideDataTable extends DataTable
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
            ->addColumn('action', function (Slide $slide) {
                return view('seller.slides.action', ['slide' => $slide]);
            })
            ->addColumn('image', function (Slide $image) {
                $imagePath = "/storage/$image->url_image";
                return '<img src="' . $imagePath . '" style="width:200px; heigth:auto" class="img-fluid" />';
            })
            ->rawColumns(['image', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Slide $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()->setTableId('slide-table')->columns($this->getColumns())->minifiedAjax()->setTableHeadClass('text-muted fw-bold text-uppercase gs-0')->orderBy(1)->select(false)->buttons([]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [Column::computed('DT_RowIndex')->title('No.')->addClass('text-center align-middle'),
        Column::computed('action')->addClass('text-center align-middle'),
        Column::make('order')->addClass('text-center align-middle'), Column::make('image')->addClass('text-center
        align-middle')];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Slide_' . date('YmdHis');
    }
}
