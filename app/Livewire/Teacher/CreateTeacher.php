<?php

namespace App\Livewire\Teacher;

use App\Models\User;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
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
                Wizard::make([
                    Step::make('User')->schema([
                        TextInput::make('name'),
                        TextInput::make('email')->required(),
                        TextInput::make('password')->required(),
                        TextInput::make('role')->default('Teacher'),
                    ]),
                    Step::make('Teacher')->schema([
                  Select::make('user_id')->options(User::query()->pluck('name', 'id'))->searchable()->required()->loadingMessage('please wait loding teacher'),
                  TextInput::make('lastName'),
              Select::make('degree_of_ducation')->options([
                "secondary school"=> "Secondery School Piplome",
                "Bachelor"=> "Bachelor Degree",
                "Master"=> "Master Degree",
                "PhD"=> "PHD",
              ]),
              TextInput::make('phone_number'),
              FileUpload::make('image_url')->directory('teacher_images')->visibility('public'),
              Textarea::make('bio'),
                    ]),
                ])
            ])
            ->statePath('data');
    }

    public function submit(): void
    {
        $data = $this->form->getState();

        //
    }

    public function render(): View
    {
        return view('livewire.teacher.create-teacher');
    }
}
