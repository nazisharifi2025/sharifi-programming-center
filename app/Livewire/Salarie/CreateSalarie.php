<?php

namespace App\Livewire\Salarie;

use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use salarie;

class CreateSalarie extends Component implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithSchemas;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
              TextInput::make('year'),
              TextInput::make('month'),
              TextInput::make('day'),
            ])
            ->statePath('data')
            ->model(salarie::class);
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $record = salarie::create($data);

        $this->form->model($record)->saveRelationships();
    }

    public function render(): View
    {
        return view('livewire.salarie.create-salarie');
    }
}
