<?php

namespace App\Livewire\Student;

use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use App\Models\Student;
use App\Models\User;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;

class CreateStudent extends Component implements HasActions, HasSchemas
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
              Section::make('Create new Student')->description('Add New Student')->schema([
                Select::make('user_id')->options(User::query()->pluck('name', 'id'))->searchable()->required()->loadingMessage('please wait loding student'),
                TextInput::make('lastName'),
               FileUpload::make('img_url')->directory('images')->visibility('public'),
               TextInput::make('phone_number'),
               TextInput::make('tazkira_no'),
               ])
            ])
            ->statePath('data')
            ->model(Student::class);
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $record = Student::create($data);

        $this->form->model($record)->saveRelationships();
    }

    public function render(): View
    {
        return view('livewire.student.create-student');
    }
}
