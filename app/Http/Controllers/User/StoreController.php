<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request)
    {
        DB::beginTransaction();
        $data = $request->validated();
        try {
            User::create($data);
            Log::channel('custom')->info('[email] ' . request()->input('email') . ' [message] Користувач успішно доданий');
            DB::commit();
            return response()->json(['message' => 'Користувач зареєстрованний успішно!']);
        }catch (\Exception $e){
            DB::rollBack();
            return response()->json(['message' => 'Невідома помилка']);
        }
    }
}
