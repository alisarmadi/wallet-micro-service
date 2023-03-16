<?php

namespace App\Http\Controllers;

use App\Services\FinancialService;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(protected UserService $userService, protected FinancialService $financialService)
    {
        //
    }

    /**
     * @param $userId
     * @return JsonResponse
     */
    public function getBalance($userId): JsonResponse
    {
        if (!$this->userService->isUserExist($userId)) {
            abort(Response::HTTP_NOT_FOUND, 'User does not exist');
        }
        $balance = $this->financialService->getUserBalance($userId);
        return response()->json(['balance' => $balance], Response::HTTP_OK);
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function addMoney(Request $request, $userId)
    {
        if (!$this->userService->isUserExist($userId)) {
            abort(Response::HTTP_NOT_FOUND, 'User does not exist');
        }
        $this->validate($request, [
            'amount' => 'required|integer',
        ]);
        $amount = (int)$request->get('amount');
        $referenceId = $this->financialService->addAmountForUser($userId, $amount);
        return response()->json(['reference_id' => $referenceId], Response::HTTP_OK);
    }
}
