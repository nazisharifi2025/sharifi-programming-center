<?php

namespace App\Livewire\Salarie;

use App\Models\salarie;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;


class ListSalaries extends Component implements HasActions, HasSchemas, HasTable
{
    use InteractsWithActions;
    use InteractsWithTable;
    use InteractsWithSchemas;

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => salarie::query())
            ->columns([
                TextColumn::make('teacher.user.name')->label('Teacher Name')->sortable()->searchable(),
                TextColumn::make('amount')->badge(),
                TextColumn::make('year'),
                TextColumn::make('month'),
                TextColumn::make('day'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
                   Action::make('delete')
    ->requiresConfirmation()
    ->action(fn (salarie $record) => $record->delete($record->id))
    ->failureNotificationTitle(function (int $successCount, int $totalCount): string {
        if ($successCount) {
            return "{$successCount} of {$totalCount} users deleted";
        }

        return 'Failed to delete any users';
    })
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.salarie.list-salaries');
    }
}
