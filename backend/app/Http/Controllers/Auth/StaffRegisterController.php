<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Domains\Auth\UseCase\DTOs\StaffRegisterInput;
use App\Domains\Auth\UseCase\StaffRegisterUseCase;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class StaffRegisterController extends Controller
{
    /**
     * @var StaffRegisterUseCase
     */
    private StaffRegisterUseCase $staffRegisterUseCase;

    /**
     * @param StaffRegisterUseCase $staffRegisterUseCase
     */
    public function __construct(StaffRegisterUseCase $staffRegisterUseCase)
    {
        $this->staffRegisterUseCase = $staffRegisterUseCase;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        // Requestのバリデーション
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            // emailは *.staff@gmail.com のみ許可、staffテーブル内で重複を許さない
            'email' => ['required', 'string', 'email:filter,dns,spoof,strict', 'unique:staff,email', 'regex:/.*'. config('constants.emails.EMAIL.STAFF'). '/'],
            'password' => ['required', 'string', Password::defaults()],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => [
                    'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
                    'message' => '422 Unprocessable Entity',
                    'details' => $validator->messages()
                ]
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // 実際の処理
        try {
            $staffRegisterInput = new StaffRegisterInput(
                $request->email,
                $request->name,
                $request->password
            );
            $staffRegisterOutput = $this->staffRegisterUseCase->execute($staffRegisterInput);
        } catch (Throwable $error) { // それ以外の全ての例外
            return response()->json([
                'errors' => [
                    'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'message' => '500 Internal Server Error',
                    'details' => $error->getMessage()
                ]
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        // Response
        return response()->json([
            'data' => [
                'type' => 'staff',
                'id' => $staffRegisterOutput->getId(),
                'attributes' => [
                    'code' => $staffRegisterOutput->getCode(),
                    'email' => $staffRegisterOutput->getEmail(),
                    'name' => $staffRegisterOutput->getName()
                ]
            ]
        ], Response::HTTP_CREATED);
    }
}
