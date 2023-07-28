<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Domains\Auth\UseCase\DTOs\RegisterMentorInput;
use App\Domains\Auth\UseCase\RegisterMentorUseCase;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Symfony\Component\HttpFoundation\Response;

class RegisterMentorController extends Controller
{
    /**
     * @var RegisterMentorUseCase
     */
    private RegisterMentorUseCase $registerMentorUsecase;

    /**
     * @param RegisterMentorUseCase $registerMentorUsecase
     */
    public function __construct(RegisterMentorUseCase $registerMentorUseCase)
    {
        $this->registerMentorUseCase = $registerMentorUseCase;
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
            // emailは *.mentor@gmail.com のみ許可
            'email' => ['required', 'string', 'email:filter,dns,spoof,strict', 'unique:mentors,email', 'regex:/.*'. config('consts.emails.EMAIL.MENTOR'). '/'],
            'password' => ['required', Password::defaults()],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation Failed',
                'errors' => $validator->messages(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try{
            $registerMentorInput = new RegisterMentorInput(
                $request->email,
                $request->name,
                $request->password
            );
            $registerMentorOutput = $this->registerMentorUseCase->execute($registerMentorInput);
        }
        // catch (MentorConflictException $error) { // アカウントの重複例外
        //     return response()->json([
        //         'message' => $error->getMessage()
        //     ], Response::HTTP_CONFLICT);
        // }
        catch (Throwable $error) { // それ以外の全ての例外
            return response()->json([
                'error' => '500 Server Error.',
                'detail' => $error->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'code' => $registerMentorOutput->getCode(),
            'email' => $registerMentorOutput->getEmail(),
            'name' => $registerMentorOutput->getName()
        ], Response::HTTP_CREATED);
    }
}
