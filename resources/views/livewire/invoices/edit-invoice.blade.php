<?php

use Livewire\Volt\Component;
use App\Models\Invoice;
use App\Models\Customer;
use Livewire\Attributes\Layout;

new #[Layout('layouts.app')] class extends Component {
    public Invoice $invoice;
    public $invoiceDate, $invoiceCustomer,$invoiceCustomerName,$invoiceAmount,$invoiceStatus;
    public $customers=[];
    public function mount(Invoice $invoice)
    {
        $this->fill($invoice);
        //$this->invoice = $invoice->load('customer');
        $this->invoiceCustomer=$invoice->customer_id;
        $this->invoiceCustomerName=$invoice->customer->customer_name;
        $this->invoiceDate=$invoice->invoice_date;
        $this->invoiceAmount=$invoice->amount;
        $this->invoiceStatus=$invoice->status;
       // $this->customers = Customer::pluck('customer_name', 'id'); // Fetch customer list for dropdown

    }
    public function updateInvoice()
    {
        $validated = $this->validate([
            'invoiceCustomer'=>['required','string'],
            'invoiceDate' => ['required', 'date'],
            'invoiceAmount' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'invoiceStatus' => ['required'],
    
        ]);
        $formArray=['customer_id'=>$this->invoiceCustomer,'invoice_date'=>$this->invoiceDate,'amount'=>$this->invoiceAmount,'status'=>$this->invoiceStatus];
        $this->invoice->update($formArray);
        session()->flash('status', 'Invoice successfully updated.');
        $this->redirect(route('invoices.index', absolute: false), navigate: true);
    }
    
    

    


}; ?>

<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Edit Invoice') }}
    </h2>
</x-slot>
  <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">


    <form  class="space-y-4">
        <x-select 

        wire:model.defer="invoiceCustomer"

        placeholder="Select customer"

        :async-data="[

        'api' => route('api-list'),

        'method' => 'GET', // default is GET

        'params' => ['entity_type' => 'customer','paginate'=>0,'default_selected' => $invoiceCustomer ? [$invoiceCustomer] : null], // default is []

        'credentials' => 'include' // default is undefined

    ]"

        option-label="customer_name"

        option-value="id"   />

      
        <x-input wire:model="invoiceDate" type="date" label="Enter Invoice Date"/>
        <x-input wire:model="invoiceAmount" label="Amount" placeholder="Enter Amount" type="number" />
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
                <x-button  rose right-icon="calendar" wire:click='updateInvoice' spinner>Update Now</x-button>
            </div>
            
    </form>
    </div>
  </div>
  </div>
</div>

