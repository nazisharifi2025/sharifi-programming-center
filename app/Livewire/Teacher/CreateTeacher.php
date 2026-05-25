<?php

namespace App\Livewire\Teacher;

use App\Models\Teacher;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\Contracts\View\View;
use Livewire\Component;


class CreateTeacher extends Component implements HasActions, HasSchemas
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
              TextInput::make('last_name'),
              TextInput::make('degree_of_ducation'),
              TextInput::make('phone_number'),
            ])
            ->statePath('data')
            ->model(Teacher::class);
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $record = Teacher::create($data);

        $this->form->model($record)->saveRelationships();
    }

    public function render(): View
    {
        return view('livewire.teacher.create-teacher');
    }
}
