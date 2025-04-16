<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

route::get("/admin", [AdminController::class, 'index'])->name('index.index');
route::get("/admin/index", [AdminController::class, 'index'])->name('admin.index');
route::get("/admin/add", [AdminController::class, 'create'])->name('admin.create');
route::post("/admin/store", [AdminController::class, 'store'])->name('admin.store');
route::get("/admin/edit/{id}", [AdminController::class, 'edit'])->name('admin.edit');
route::put("/admin/update/{id}", [AdminController::class, 'update'])->name('admin.update');
route::delete("/admin/delete/{id}", [AdminController::class, 'delete'])->name('admin.delete');
