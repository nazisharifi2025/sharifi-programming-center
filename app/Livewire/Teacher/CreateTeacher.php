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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\HtmlString;
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
                  TextInput::make('lastName'),
              Select::make('degree_of_ducation')->options([
                "secondary school"=> "Secondery School Piplome",
                "Bachelor"=> "Bachelor Degree",
                "Master"=> "Master Degree",
                "PhD"=> "PHD",
              ]),
              Select::make('fiald_of_education')->options([
                "Computer Science"=> "Computer Science",
                "Political Science"=> "Political Science",
                "English Literature"=> "English Literature",
                "Enviromental Science"=> "Enviromental Science",
              ]),
              TextInput::make('phone_number'),
              FileUpload::make('image_url')->directory('teacher_images')->visibility('public'),
              Textarea::make('bio'),
                    ]),
                ])->submitAction(new HtmlString('<button type="submit">Submit</button>'))
            ])
            ->statePath('data');
    }

    public function submit(): void
    {
        $data = $this->form->getState();

        DB::transaction(function () use ($data){
           $user = User::create([
                "name"=> $data['name'],
                "email"=> $data['email'],
                "password"=> $data['password'],
                "role"=> "Teacher"
            ]);
            $user->teacher()->create([
                "lastName"=> $data['lastName'],
                "degree_of_ducation"=> $data['degree_of_ducation'],
                "fiald_of_education"=> $data['fiald_of_education'],
                "phone_number"=> $data['phone_number'],
                "image_url"=> $data['image_url'],
                "bio"=> $data['bio'],
            ]);
            return redirect()->route('teacher.index');
        });
    }

    public function render(): View
    {
        return view('livewire.teacher.create-teacher');
    }
}