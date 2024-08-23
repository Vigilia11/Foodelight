<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\FetchDishesController;
use App\Http\Controllers\ReactController;
use App\Http\Controllers\DishRequestController;
use App\Http\Controllers\MealsController;
use App\Http\Controllers\BreadsController;
use App\Http\Controllers\CakesController;
use App\Http\Controllers\JuiceController;
use App\Http\Controllers\DishImageController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\MilkteaController;
use App\Http\Controllers\AvailableController;
use App\Http\Controllers\DrinkOrderController;
use App\Http\Controllers\DishOrderController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DishCartController;
use App\Http\Controllers\DrinkCartController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemsController;
use App\Http\Controllers\OrderItemsController;
use App\Http\Controllers\TodayOrdersController;
use App\Http\Controllers\AllOrdersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('dishes', DishController::class);
    Route::resource('reacts', ReactController::class);
    Route::resource('dishRequests', DishRequestController::class);

    Route::post('/addRequest', [DishRequestController::class, 'addRequest']);

    Route::post('/addReact', [ReactController::class, 'addReact']);

    Route::resource('meals', MealsController::class);
    Route::get('/editMeals/{id}', [MealsController::class, 'edit']);    
    Route::get('/fetchMeals', [MealsController::class, 'fetchMeals']);
    Route::get('/filterMeals/{filter}', [MealsController::class, 'filterMeals']);

    Route::get('/breads', [BreadsController::class, 'index']);
    Route::get('/fetchBreads', [BreadsController::class, 'fetchBreads']);
    Route::get('/filterBreads/{filter}', [BreadsController::class, 'filterBreads']);
    Route::get('/editBread/{id}', [BreadsController::class, 'edit']);

    Route::get('/cakes', [CakesController::class, 'index']);
    Route::get('/fetchCakes', [CakesController::class, 'fetchCakes']);
    Route::get('/filterCakes/{filter}', [CakesController::class, 'filterCakes']);
    Route::get('/editCake/{id}', [CakesController::class, 'edit']);

    Route::get('/juice', [JuiceController::class, 'index']);
    Route::get('/fetchJuice', [JuiceController::class, 'fetchJuice']);
    Route::get('/filterJuice/{filter}', [JuiceController::class, 'filterJuice']);

    Route::get('/milktea', [MilkteaController::class, 'index']);
    Route::get('/fetchMilktea', [MilkteaController::class, 'fetchMilktea']);
    Route::get('/filterMilktea/{filter}', [MilkteaController::class, 'filterMilktea']);

    Route::get('/fetchJuiceById/{id}', [JuiceController::class, 'fetchJuiceById']);
    Route::get('/fetchMilkteaById/{id}', [MilkTeaController::class, 'fetchMilkteaById']);

    Route::get('/fetchMostFavorites', [FetchDishesController::class, 'fetchMostFavorites']);
    Route::get('/fetchSelectedDish/{id}', [FetchDishesController::class, 'fetchSelectedDish']);
    Route::get('/fetchMostRequested', [FetchDishesController::class, 'fetchMostRequested']);

    Route::post('/drinkOrder', [DrinkOrderController::class, 'store']);
    Route::post('/dishOrder', [DishOrderController::class, 'store']);

    Route::post('dishCart', [DishCartController::class, 'store']);
    Route::post('/drinkCart', [DrinkCartController::class, 'store']);

    Route::get('/order', [OrderController::class, 'index']);
    Route::get('/fetchOrders', [OrderController::class, 'fetchOrders']);
    Route::post('/cartToOrder', [OrderController::class, 'cartToOrder']);
    Route::post('/deleteAllOrders', [OrderController::class, 'destroyAll']);
    Route::put('/cancelOrder/{id}', [OrderController::class, 'cancelOrder']);
    Route::delete('/deleteOrder/{id}', [OrderController::class, 'destroy']);

    Route::get('/orderItems/{id}', [OrderItemsController::class, 'orderItems']);
    Route::get('/fetchOrderItems/{id}', [OrderItemsController::class, 'fetchOrderItems']);
    Route::get('/fetchOrderItem/{id}', [OrderItemsController::class, 'fetchOrderItem']);
    Route::post('/updateDishOrder', [OrderItemsController::class, 'updateDishOrder']);
    Route::post('/updateDrinkOrder', [OrderItemsController::class, 'updateDrinkOrder']);
    Route::delete('/deleteOrderItem/{id}', [OrderItemsController::class, 'deleteOrderItem']);
    
    
    Route::get('/cart', [CartController::class, 'index']);
    Route::get('/fetchCarts', [CartController::class, 'fetchCarts']);
    Route::delete('/deleteCart/{date}', [CartController::class, 'destroy']);
    Route::delete('/deleteAllCart', [CartController::class, 'destroyAll']);

    Route::get('/cart/items/{date}', [CartItemsController::class, 'cartItems']);
    Route::get('/fetchCartItems/{date}', [CartItemsController::class, 'fetchCartItems']);
    Route::get('/fetchCartItem/{id}', [CartItemsController::class, 'fetchCartItem']);

    Route::post('/updateDishCart', [CartItemsController::class, 'updateDishCart']);
    Route::post('/updateDrinkCart', [CartItemsController::class, 'updateDrinkCart']);
    Route::delete('/deleteCartItem/{id}', [CartItemsController::class, 'deleteCartItem']);

    Route::get('/fetchDishPrice/{id}', [PriceController::class, 'fetchDishPrice']);
    Route::get('/fetchDrinkPrice/{id}', [PriceController::class, 'fetchDrinkPrice']);

    //availables
    Route::get('/fetchAvailableMeals', [MealsController::class, 'fetchAvailableMeals']);
    Route::get('/fetchAvailableBreads', [BreadsController::class, 'fetchAvailableBreads']);
    Route::get('/fetchAvailableCakes', [CakesController::class, 'fetchAvailableCakes']);
    Route::get('/fetchAvailableJuices', [JuiceController::class, 'fetchAvailableJuices']);
    Route::get('/fetchAvailableMilkteas', [MilkteaController::class, 'fetchAvailableMilkteas']);

    Route::put('/updateOrder/{id}', [OrderController::class, 'update']);

    //profile
    Route::get('/profile', [UserProfileController::class, 'index']);
    Route::post('/profile/store', [UserProfileController::class, 'store']);
    Route::get('/fetchProfile', [UserProfileController::class, 'fetchProfile']);
    Route::post('/updateProfilePhoto', [UserProfileController::class, 'updateProfilePhoto']);
    Route::post('/updateProfileInfo', [UserProfileController::class, 'updateProfileInfo']);

    //account
    Route::get('/account', [AccountController::class, 'index']);
    Route::post('/updatePassword', [AccountController::class, 'updatePassword']);
    Route::get('/fetchAccount', [AccountController::class, 'fetchAccount']);
    Route::post('/updateName', [AccountController::class, 'updateName']);

    //message
    Route::post('/sendMessage', [MessageController::class, 'store']);
    Route::get('/fetchMessages/{id}', [MessageController::class, 'fetchMessages']);
    Route::put('/updateMessage/{id}', [MessageController::class, 'update']);

    //users
    Route::get('/users', [UsersController::class, 'index']);
    Route::post('/deleteUser', [UsersController::class, 'destroy']);

    //user
    Route::get('/user/{id}', [UserController::class, 'index']);
    Route::get('/fetchUser/{id}', [UserController::class, 'fetchUser']);
    Route::get('/blockUser/{id}', [UserController::class, 'blockUser']);
    Route::get('/setUserActive/{id}', [UserController::class, 'setUserActive']);
});

Route::group(['middleware'=>['auth', 'role:admin']], function(){
       
    Route::PUT('/updateMeal/{id}', [MealsController::class, 'update']);
    
    Route::post('/bread/store', [BreadsController::class, 'store']);
    Route::PUT('/updateBread/{id}', [BreadsController::class, 'update']);

    
    Route::post('/cake/store', [CakesController::class, 'store']);
    Route::get('/editCakes/{id}', [CakesController::class, 'edit']);
    Route::PUT('/updateCake/{id}', [CakesController::class, 'update']);

    Route::post('/juice/store', [JuiceController::class, 'store']);
    Route::get('/editJuice/{id}', [JuiceController::class, 'edit']);
    Route::put('/updateJuice/{id}', [JuiceController::class, 'update']);

    Route::post('/milktea/store', [MilkteaController::class, 'store']);
    Route::get('/editMilktea/{id}', [MilkteaController::class, 'edit']);
    Route::put('/updateMilktea/{id}', [MilkteaController::class, 'update']);
    

    Route::resource('price', PriceController::class);
    Route::put('/updatePrice/{id}', [PriceController::class, 'update']);
    Route::delete('/deletePrice/{id}', [PriceController::class, 'destroy']);

    Route::post('/updateDishImage', [DishImageController::class, 'updateDishImage']);
    Route::delete('/deleteDish/{id}', [DishController::class, 'destroy']);

    Route::post('/addAvailable', [AvailableController::class, 'store']);
    Route::delete('/deleteAvailable/{id}', [AvailableController::class, 'destroy']);

    Route::get('/order/{id}', [OrderItemsController::class, 'OrderItems']);
    
    

    Route::get('/ordersToday', [TodayOrdersController::class, 'index']);
    Route::get('/fetchTodayUnnoticedOrders', [TodayOrdersController::class, 'fetchTodayUnnoticedOrders']);
    Route::get('/fetchTodayNoticedOrders', [TodayOrdersController::class, 'fetchTodayNoticedOrders']);
    Route::get('/fetchTodayReadyOrders', [TodayOrdersController::class, 'fetchTodayReadyOrders']);
    Route::get('/fetchTodayShippingOrders', [TodayOrdersController::class, 'fetchTodayShippingOrders']);
    Route::get('/fetchTodayRecievedOrders', [TodayOrdersController::class, 'fetchTodayRecievedOrders']);

    Route::get('/ordersAll', [AllOrdersController::class, 'index']);
    Route::get('/fetchAllUnnoticedOrders', [AllOrdersController::class, 'fetchAllUnnoticedOrders']);
    Route::get('/fetchAllNoticedOrders', [AllOrdersController::class, 'fetchAllNoticedOrders']);
    Route::get('/fetchAllReadyOrders', [AllOrdersController::class, 'fetchAllReadyOrders']);
    Route::get('/fetchAllShippingOrders', [AllOrdersController::class, 'fetchAllShippingOrders']);
    Route::get('/fetchAllRecievedOrders', [AllOrdersController::class, 'fetchAllRecievedOrders']);

    Route::get('/dashboard', [DashboardController::class, 'dashboard']);

});

require __DIR__.'/auth.php';
