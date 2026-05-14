<?php

namespace App\Livewire\Sinf;

use App\Models\sinf;
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


class ListSinfs extends Component implements HasActions, HasSchemas, HasTable
{
    use InteractsWithActions;
    use InteractsWithTable;
    use InteractsWithSchemas;

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => sinf::query())
            ->columns([
                TextColumn::make('title')->label('Cource Name'),
                TextColumn::make('teacher.user.name')->label('Name')->sortable()->searchable(),
                TextColumn::make('start_date'),
                TextColumn::make('end_date'),
                TextColumn::make('description')->limit(25),
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
    ->action(fn (sinf $record) => $record->delete($record->id))
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
        return view('livewire.sinf.list-sinfs');
    }
}
