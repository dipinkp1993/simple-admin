<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Customer;
new #[Layout('layouts.app')] class extends Component {
     public Customer $customer;
     public $customerName, $customerMobile, $customerEmail,$customerAddress;
     public function mount(Customer $customer)
     {
        $this->fill($customer);
        $this->customerName=@$customer->customer_name;
        $this->customerMobile=@$customer->customer_phone;
        $this->customerEmail=@$customer->customer_email;
        $this->customerAddress=@$customer->customer_address;
     }
     public function updateCustomer()
     {
        $validated = $this->validate([
            'customerName' => ['required', 'string', 'min:5'],
            //'customerMobile' => ['string'],
            //'customerEmail' => ['email'],
            //'customerAddress' => ['string'],
        ]);
        $formArray=['customer_name'=>$this->customerName,'customer_phone'=>$this->customerMobile,'customer_email'=>$this->customerEmail,'customer_address'=>$this->customerAddress];
        $this->customer->update($formArray);
        session()->flash('status', 'Customer successfully updated.');
        $this->redirect(route('customers.index', absolute: false), navigate: true);

     }
    
}; ?>
<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Edit Customer') }}
    </h2>
</x-slot>
  <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
               <form  class="space-y-4">
                    <x-input wire:model="customerName" label="Customer Name" placeholder="Enter Name" />
                    <x-input wire:model="customerMobile" label="Customer Mobile" placeholder="Enter Mobile" />
                    <x-input wire:model="customerEmail" label="Customer Email" placeholder="Enter Email" type="email"  />
                    <x-textarea wire:model="customerAddress" label="Customer Address" placeholder="Enter Address." />
                
                    <div class="pt-4">
                        <x-button  rose right-icon="calendar" wire:click='updateCustomer' wire:confirm="Are you sure you want to update this customer?" spinner>Update Now</x-button>
                    </div>
                    <x-errors />
                </form>
                </div>
            </div>
        </div>
    </div>
