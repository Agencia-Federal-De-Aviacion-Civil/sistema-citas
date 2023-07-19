<?php

namespace App\Http\Livewire\Medicine\Tables;

use App\Exports\UserExport;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Medicine\MedicineReserve;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use WireUi\Traits\Actions;

class UserRolesTable extends DataTableComponent
{
    use Actions;
    protected $model = MedicineReserve::class;
    protected function getListeners(): array
    {
        return array_merge(
            parent::getListeners(),
            [
                'privilegesUser' => '$refresh',
                'deleteUser' => '$refresh',
            ]
        );
    }
    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setBulkActions([
            'exportSelected' => 'EXPORTAR'
        ]);
        $this->setOfflineIndicatorEnabled();
        $this->setEagerLoadAllRelationsEnabled();
        $this->setDefaultSort('id', 'asc');
    }
    public function columns(): array
    {
        if (Auth::user()->can('super_admin.see.tabs.navigation')) {
            return [
                Column::make("Id", "id")
                    ->sortable(),
                Column::make('NOMBRE', 'name')
                    ->sortable()
                    ->searchable(),
                Column::make('APELLIDO PATERNO', 'UserPart.apParental')
                    ->sortable()
                    ->searchable(),

                Column::make('APELLIDO MATERNO', 'UserPart.apMaternal')
                    ->sortable()
                    ->searchable(),

                Column::make('CORREO', 'email')
                    ->sortable()
                    ->searchable(),

                Column::make('CURP', 'UserPart.curp')
                    ->sortable()
                    ->searchable(),

                Column::make('GENERO', 'UserPart.genre')
                    ->sortable()
                    ->searchable(),

                Column::make('FECHA NACIMIENTO', 'UserPart.birth')
                    ->sortable()
                    ->searchable()
                    ->format(fn ($value) => Carbon::parse($value)->format('d/m/Y')),

                Column::make('EDAD', 'UserPart.age')
                    ->sortable()
                    ->searchable(),

                Column::make('ESTADO', 'UserPart.participantState.name')
                    ->sortable()
                    ->searchable(),

                Column::make('MUNICIPIO', 'UserPart.participantMunicipal.name')
                    ->sortable()
                    ->searchable(),


                Column::make('CALLE', 'UserPart.street')
                    ->sortable()
                    ->searchable(),

                Column::make('N° INTERIOR', 'UserPart.nInterior')
                    ->sortable()
                    ->searchable(),

                Column::make('N° EXTEIROR', 'UserPart.nExterior')
                    ->sortable()
                    ->searchable(),

                Column::make('COLONIA', 'UserPart.suburb')
                    ->sortable()
                    ->searchable(),

                Column::make('C. POSTAL', 'UserPart.postalCode')
                    ->sortable()
                    ->searchable(),

                Column::make('ENTIDAD', 'UserPart.federalEntity')
                    ->sortable()
                    ->searchable(),

                Column::make('DELEGACIÓN', 'UserPart.delegation')
                    ->sortable()
                    ->searchable(),

                Column::make('CELULAR', 'UserPart.mobilePhone')
                    ->sortable()
                    ->searchable(),

                Column::make('OFICINA', 'UserPart.officePhone')
                    ->sortable()
                    ->searchable(),

                Column::make('EXTENSIÓN', 'UserPart.extension')
                    ->sortable()
                    ->searchable(),

                Column::make('ROL')
                    ->sortable()
                    ->label(fn ($row) => view(
                        'afac.tables.appointmentTable.actions.user-roles',
                        [
                            $rol = User::with(
                                'roles'
                            )->where('id', $row->id)->get(),
                            'rol' => $rol,
                        ]
                    )),

                Column::make('CREADO', 'UserPart.created_at')
                    ->sortable()
                    ->searchable()
                    ->format(fn ($value) => Carbon::parse($value)->format('d/m/Y H:i:s')),


                Column::make('ACTUALIZADO', 'UserPart.updated_at')
                    ->sortable()
                    ->searchable()
                    ->format(fn ($value) => Carbon::parse($value)->format('d/m/Y H:i:s')),

                Column::make("ACCIÓN",'id')
                    ->format(
                        fn ($value) => view(
                            'components.privileges-component',
                            [
                                'privilegesId' => $value,
                            ]
                        )
                    ),
            ];
        } else {
            return [
                Column::make("Id", "id")
                    ->sortable(),
                Column::make('NOMBRE', 'name')
                    ->sortable()
                    ->searchable(),
                Column::make('APELLIDO PATERNO', 'UserPart.apParental')
                    ->sortable()
                    ->searchable(),

                Column::make('APELLIDO MATERNO', 'UserPart.apMaternal')
                    ->sortable()
                    ->searchable(),

                Column::make('CORREO', 'email')
                    ->sortable()
                    ->searchable(),

                Column::make('CURP', 'UserPart.curp')
                    ->sortable()
                    ->searchable(),

                Column::make('GENERO', 'UserPart.genre')
                    ->sortable()
                    ->searchable(),

                Column::make('FECHA NACIMIENTO', 'UserPart.birth')
                    ->sortable()
                    ->searchable()
                    ->format(fn ($value) => Carbon::parse($value)->format('d/m/Y')),

                Column::make('EDAD', 'UserPart.age')
                    ->sortable()
                    ->searchable(),

                Column::make('ESTADO', 'UserPart.participantState.name')
                    ->sortable()
                    ->searchable(),

                Column::make('MUNICIPIO', 'UserPart.participantMunicipal.name')
                    ->sortable()
                    ->searchable(),


                Column::make('CALLE', 'UserPart.street')
                    ->sortable()
                    ->searchable(),

                Column::make('N° INTERIOR', 'UserPart.nInterior')
                    ->sortable()
                    ->searchable(),

                Column::make('N° EXTEIROR', 'UserPart.nExterior')
                    ->sortable()
                    ->searchable(),

                Column::make('COLONIA', 'UserPart.suburb')
                    ->sortable()
                    ->searchable(),

                Column::make('C. POSTAL', 'UserPart.postalCode')
                    ->sortable()
                    ->searchable(),

                Column::make('ENTIDAD', 'UserPart.federalEntity')
                    ->sortable()
                    ->searchable(),

                Column::make('DELEGACIÓN', 'UserPart.delegation')
                    ->sortable()
                    ->searchable(),

                Column::make('CELULAR', 'UserPart.mobilePhone')
                    ->sortable()
                    ->searchable(),

                Column::make('OFICINA', 'UserPart.officePhone')
                    ->sortable()
                    ->searchable(),

                Column::make('EXTENSIÓN', 'UserPart.extension')
                    ->sortable()
                    ->searchable(),
            ];
        }
    }
    public function builder(): Builder
    {
        return
            User::query()->with(['roles', 'UserPart'])
            ->where('status', 0)
            ->where('users.id', '<>', 1);
    }
    public function exportSelected()
    {

        if ($this->getSelected()) {

            $result = User::whereIn('id', $this->getSelected())->get();

            return Excel::download(new UserExport($result), 'useroles.xlsx');
        }
    }
}
