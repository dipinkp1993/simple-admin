<?php

use Livewire\Volt\Component;
use App\Models\Customer;

new class extends Component {
    public $customerName, $customerMobile, $customerEmail,$customerAddress;
   

    public function saveCustomer()
    {
        $validated = $this->validate([
            'customerName' => ['required', 'string', 'min:5'],
            'customerMobile' => ['string'],
            'customerEmail' => ['email'],
            'customerAddress' => ['string'],
        ]);
        $formArray=['customer_name'=>$this->customerName,'customer_phone'=>$this->customerMobile,'customer_email'=>$this->customerEmail,'customer_address'=>$this->customerAddress];
        Customer::create($formArray);
        session()->flash('status', 'Customer successfully created.');
        $this->redirect(route('customers.index', absolute: false), navigate: true);
    }


}; ?>

<div class="w-full mt-12">


    <form  class="space-y-4">
        <x-input wire:model="customerName" label="Customer Name" placeholder="Enter Name" />
        <x-input wire:model="customerMobile" label="Customer Mobile" placeholder="Enter Mobile" />
        <x-input wire:model="customerEmail" label="Customer Email" placeholder="Enter Email" type="email"  />
        <x-textarea wire:model="customerAddress" label="Customer Address" placeholder="Enter Address." />
       
        <div class="pt-4">
            <x-button  rose right-icon="calendar" wire:click='saveCustomer' spinner>Save Now</x-button>
        </div>
      
    </form>
</div>

