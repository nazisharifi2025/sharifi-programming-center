<?php

namespace App\Livewire\Payment;

use App\Models\sinf;
use App\Models\User;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreatePayment extends Component implements HasActions, HasSchemas
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
                       Step::make('User')->icon(Heroicon::User)->completedIcon(Heroicon::CheckBadge)->description('Information about new user')->schema([
                TextInput::make('name'),
                TextInput::make('email')->required()->type('email'),
                TextInput::make('password')->required()->type('password'),
                TextInput::make('role')->default('Student'),
            ]),
            Step::make('Student')->description('Information about student')->icon(Heroicon::AcademicCap)->completedIcon(Heroicon::CheckBadge)->columns(2)->schema([
                TextInput::make('lastName'),
                TextInput::make('phone_number'),
                TextInput::make('tazkira_no'),
                FileUpload::make('img_url')
            ]),
                    Step::make('payment')->description('Information aboput new student')->icon(Heroicon::Banknotes)->completedIcon(Heroicon::CheckBadge)->columns(2)->schema([
                        TextInput::make('amount'),
                        Select::make('sinf_id')->label('Sinf')->options(sinf::query()->pluck('title' , 'id'))->searchable(),
                    ]),
                 ]),
            ])
            ->statePath('data');
    }

    public function submit(): void
    {
        $data = $this->form->getState();

        DB::transaction(function() use($data){
             $user = User::create([
                "name"=> $data['name'],
                "email"=> $data['email'],
                "password"=> $data['password'],
                "role"=> "Teacher"
            ]);
            $student = $user->student()->create([
                "lastName"=> $data['lastName'],
                "phone_number"=> $data['phone_number'],
                "tazkira_no"=> $data['tazkira_no'],
                "img_url"=> $data['img_url'],
            ]);
            $student->payment()->create([
                "amount"=> $data["amount"],
                "sinf_id"=> $data['sinf_id'],
            ]);
            return redirect()->route('student.index');
        });
    }

    public function render(): View
    {
        return view('livewire.payment.create-payment');
    }
}
