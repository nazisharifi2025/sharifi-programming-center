<?php

namespace App\Livewire\Teacher;

use App\Models\Teacher;
use App\Models\User;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
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
              Section::make('Create new Teacher')->description('Add New Teacher')->schema([
                  Select::make('user_id')->options(User::query()->pluck('name', 'id'))->searchable()->required()->loadingMessage('please wait loding teacher'),
                  TextInput::make('lastName'),
              TextInput::make('degree_of_ducation'),
              TextInput::make('phone_number'),
              FileUpload::make('image_url')->directory('teacher_images')->visibility('public'),
              Textarea::make('bio'),
            ])
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
