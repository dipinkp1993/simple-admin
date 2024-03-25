<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
   
}; ?>

<aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
        
        <nav class="text-white text-base font-semibold pt-3">
            <a :href="route('dashboard')" wire:navigate  class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Dashboard
            </a>
            <a :href="route('customers.index')" :active="request()->routeIs('customers.index')" wire:navigate class="flex items-center active-nav-link text-white py-4 pl-6 nav-item">
                <i class="fas fa-sticky-note mr-3"></i>
                Customers
            </a>
            <a :href="route('invoices.index')" :active="request()->routeIs('invoices.index')" wire:navigate class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-table mr-3"></i>
                Invoices
            </a>
           
        </nav>
        
    </aside>

