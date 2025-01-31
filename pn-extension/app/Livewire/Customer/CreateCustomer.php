<?php

namespace App\Livewire\Customer;

use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class CreateCustomer extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public Customer $record;

    public function mount(): void
    {
        $this->form->fill($this->record->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('splynx_id')
                    ->required(),
                Forms\Components\TextInput::make('easypay_number')
                    ->required(),
                Forms\Components\TextInput::make('username')
                    ->required(),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\TextInput::make('surname')
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required(),
                Forms\Components\TextInput::make('phone_number')
                    ->tel()
                    ->required(),
                Forms\Components\TextInput::make('street')
                    ->required(),
                Forms\Components\TextInput::make('city')
                    ->required(),
                Forms\Components\TextInput::make('zip_code')
                    ->required(),
                Forms\Components\TextInput::make('tarrif')
                    ->required(),
                Forms\Components\TextInput::make('agreed-terms')
                    ->required(),
            ])
            ->statePath('data')
            ->model($this->record);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $this->record->update($data);
    }

    public function render(): View
    {
        return view('livewire.customer.create-customer');
    }
}
