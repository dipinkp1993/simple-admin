<?php

use Livewire\Volt\Component;
use App\Models\Invoice;

new class extends Component {
    public $invoiceDate, $invoiceCustomer, $invoiceAmount,$invoiceStatus;
    public function saveInvoice()
    {
        $validated = $this->validate([
            'invoiceCustomer'=>['required','string'],
            'invoiceDate' => ['required', 'date'],
            'invoiceAmount' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'invoiceStatus' => ['required'],
    
        ]);
        $formArray=['customer_id'=>$this->invoiceCustomer,'invoice_date'=>$this->invoiceDate,'amount'=>$this->invoiceAmount,'status'=>$this->invoiceStatus];
        Invoice::create($formArray);
        session()->flash('status', 'Invoice successfully created.');
        $this->redirect(route('invoices.index', absolute: false), navigate: true);
    }
    
    

    


}; ?>

<div class="w-full mt-12">


    <form  class="space-y-4">
        <x-select abel="Search a User"

        wire:model.defer="invoiceCustomer"

        placeholder="Select customer"

        :async-data="[

        'api' => route('api-list'),

        'method' => 'GET', // default is GET

        'params' => ['entity_type' => 'customer','paginate'=>0], // default is []

        'credentials' => 'include' // default is undefined

    ]"

        option-label="customer_name"

        option-value="id" />

        <x-input wire:model="invoiceDate" type="date" label="Enter Invoice Date"/>
        <x-input wire:model="invoiceAmount" label="Amount" placeholder="Enter Amount" />
        <x-select

        label="Select Status"

        placeholder="Select one status"

        wire:model.defer="invoiceStatus"

    >

        <x-select.option label="Unpaid" value="unpaid" />

        <x-select.option label="Paid" value="paid" />

        <x-select.option label="Cancelled" value="cancelled" />

        <

    </x-select>
            <div class="pt-4">
                <x-button  rose right-icon="calendar" wire:click='saveInvoice' spinner>Save Now</x-button>
            </div>
            
    </form>
</div>

