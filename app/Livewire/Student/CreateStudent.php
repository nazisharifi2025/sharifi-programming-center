<?php

namespace App\Livewire\Student;

use App\Models\User;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\FileUpload;
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
                
          Wizard::make([
            Step::make('User')->schema([
                TextInput::make('name'),
                TextInput::make('email')->required()->type('email'),
                TextInput::make('password')->required()->type('password'),
                TextInput::make('role')->default('Student'),
            ]),
            Step::make('Student')->schema([
                TextInput::make('lastName'),
                TextInput::make('phone_number'),
                TextInput::make('tazkira_no'),
                FileUpload::make('img_url')
            ]),
         ])->submitAction(new HtmlString('<button type="submit">Submit</button>'))
            ])
            ->statePath('data');
    }

    public function submit(): void
    {
        $data = $this->form->getState();
        DB::transaction(function() use ($data){
              $user = User::create([
                "name"=> $data['name'],
                "email"=> $data['email'],
                "password"=> $data['password'],
                "role"=> "Teacher"
            ]);
            $user->student()->create([
                "lastName"=> $data['lastName'],
                "phone_number"=> $data['phone_number'],
                "tazkira_no"=> $data['tazkira_no'],
                "img_url"=> $data['img_url'],
            ]);
            return redirect()->route('student.index');
        });
    }

    public function render(): View
    {
        return view('livewire.student.create-student');
    }
}
