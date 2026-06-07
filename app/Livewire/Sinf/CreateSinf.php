<?php

namespace App\Livewire\Sinf;

use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use App\Models\sinf;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;

class CreateSinf extends Component implements HasActions, HasSchemas
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
                TextInput::make('title'),
                DateTimePicker::make('start_date'),
                DateTimePicker::make('end_date'),
                TextInput::make('description'),
                FileUpload::make('banner_url')->directory('sinf_images')->visibility('public'),
                TextInput::make('teacher_id'),
            ])
            ->statePath('data')
            ->model(sinf::class);
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $record = sinf::create($data);

        $this->form->model($record)->saveRelationships();
    }

    public function render(): View
    {
        return view('livewire.sinf.create-sinf');
    }
}
