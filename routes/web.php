<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InquiryController;


Route::get('/', [UserController::class, 'home'])->name('home');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');
Route::get('/agents', [UserController::class, 'agents'])->name('agents');
Route::get('/all/properties',[UserController::class, 'allProperties'])->name('allproperties');
Route::post('/inquiries/{property}', [InquiryController::class, 'store'])->name('inquiries.store'); 
Route::get('/property/{id}', [UserController::class, 'propertyShow'])->name('property.show');   

Route::get('/dashboard', [UserController::class, 'dashboard'])->middleware(['auth','verified'])->name('dashboard');

Route::middleware('auth','verified')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware('admin','verified')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/properties', [PropertyController::class, 'index'])->name('admin.properties.index');
    Route::get('/properties/add', [PropertyController::class, 'add'])->name('admin.properties.add');
    Route::post('/properties/store', [PropertyController::class, 'store'])->name('admin.properties.store');
    Route::get('/properties/show/{id}', [PropertyController::class, 'show'])->name('admin.properties.show');
    Route::get('/properties/edit/{id}', [PropertyController::class, 'edit'])->name('admin.properties.edit');
    Route::put('/properties/update/{id}', [PropertyController::class, 'update'])->name('admin.properties.update');
    Route::delete('/properties/delete/{id}', [PropertyController::class, 'destroy'])->name('admin.properties.delete');
    
    Route::get('/inquiries', [InquiryController::class, 'index'])->name('admin.inquiries.index');
    Route::get('/inquiries/{id}', [InquiryController::class, 'show'])->name('admin.inquiries.show');
    Route::put('/inquiries/{inquiry}/status', [InquiryController::class, 'updateStatus'])->name('inquiries.status');
    Route::put('/inquiries/{id}/update', [InquiryController::class, 'update'])->name('admin.inquiries.update');
    Route::delete('/inquiries/{inquiry}', [InquiryController::class, 'destroy'])->name('admin.inquiries.delete');


    Route::get('/users', [AdminController::class, 'allUsers'])->name('admin.users.index');
    Route::get('/users/{id}', [AdminController::class, 'showUser'])->name('admin.users.show');
    Route::get('/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/users/{id}/update', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/users/{id}/delete', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    
    
    Route::get('/agents', [AdminController::class, 'allAgents'])->name('admin.agents.index');
    Route::get('/agents/{id}', [AdminController::class, 'showAgent'])->name('admin.agents.show');
    Route::get('/agents/{id}/edit', [AdminController::class, 'editAgent'])->name('admin.agents.edit');
    Route::put('/agents/{id}/update', [AdminController::class, 'updateAgent'])->name('admin.agents.update');
    Route::delete('/agents/{id}/delete', [AdminController::class, 'deleteAgent'])->name('admin.agents.delete');

    
});

Route::middleware('agent','verified')->prefix('agent')->group(function(){
    Route::get('dashboard',[AgentController::class, 'dashboard'])->name('agent.dashboard');
    Route::get('/properties', [AgentController::class, 'indexProperty'])->name('agent.properties.index');
    Route::get('/properties/add', [AgentController::class, 'add'])->name('agent.properties.add');
    Route::post('/properties/store', [AgentController::class, 'store'])->name('agent.properties.store');
    Route::get('/properties/show/{id}', [AgentController::class, 'showProperty'])->name('agent.properties.show');
    Route::get('/properties/edit/{id}', [AgentController::class, 'editProperty'])->name('agent.properties.edit');
    Route::put('/properties/update/{id}', [AgentController::class, 'updateProperty'])->name('agent.properties.update');
    Route::delete('/properties/delete/{id}', [AgentController::class, 'destroy'])->name('agent.properties.delete');

    Route::get('/inquiries', [AgentController::class, 'index'])->name('agent.inquiries.index');
    Route::get('/inquiries/{id}', [AgentController::class, 'show'])->name('agent.inquiries.show');
    Route::put('/inquiries/{inquiry}/status', [AgentController::class, 'updateStatus'])->name('inquiries.status');
    Route::delete('/inquiries/{inquiry}', [AgentController::class, 'destroyInquiry'])->name('agent.inquiries.delete');
});




require __DIR__.'/auth.php';
