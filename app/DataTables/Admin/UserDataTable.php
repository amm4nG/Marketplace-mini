<?php

namespace App\DataTables\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    public $filterRole = null;
    
    public function __construct($role = null)
    {
        $this->filterRole = $role;
    }
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('action', function (User $user) {
                return view('admin.users.action', ['user' => $user]);
            })
            ->addColumn('role', function (User $user) {
                return '<span class="badge text-bg-info p-2">' . $user->role . '</span>';
            })
            ->rawColumns(['role', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        if ($this->filterRole != null) {
            return $model ->newQuery()->where('role', $this->filterRole);
        }
        $query = $model->newQuery();
        return $query->where('role', 'seller')->orWhere('role', 'buyer');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('user-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->setTableHeadClass(
                'text-muted
                fw-bold text-uppercase gs-0',
            )
            ->orderBy(1)
            ->select(false)
            ->parameters([
                // 'searching' => false,
                // 'lengthChange' => false,
            ])
            ->buttons([]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [Column::computed('DT_RowIndex')->title('No.')->addClass('text-center'), Column::computed('action')->addClass('text-center'), Column::make('username')->addClass('text-center'), Column::make('role')->addClass('text-center'), Column::make('email')->addClass('text-center')];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'User_' . date('YmdHis');
    }
}
