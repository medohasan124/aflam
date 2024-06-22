<?php

namespace App\DataTables;


use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RolesDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))

            ->addColumn('action', 'admin.role.dataTable.action')
             ->addColumn('checkbox', 'admin.role.dataTable.checkbox')
             ->addColumn('used', function($role){
                $role_user = DB::table('role_user')->where('role_id',$role->id)->count();
                return $role_user ;
             })
            ->editColumn('created_at',function($role){
                return $role->created_at->format('d-m-y');
            })
            ->editColumn('updated_at',function($role){
                return $role->created_at->format('d-m-y');
            })

            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Role $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('roles-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [

            Column::computed('checkbox')
            ->exportable(false)
            ->printable(false)
            ->width(10)
            ->addClass('text-center')
            ->title('<input type="checkbox" class="allCheckbox">'),

            Column::make('id'),
            Column::make('name'),
            Column::computed('used')
            ->exportable(false)
            ->printable(false)
            ->width(10)
            ->addClass('text-center'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::computed('action'),


        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Roles_' . date('YmdHis');
    }
}
