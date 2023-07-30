<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Domains\Auth\UseCase\DTOs\MentorRegisterInput;
use App\Domains\Auth\UseCase\MentorRegisterUseCase;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class MentorRegisterController extends Controller
{
    /**
     * @var MentorRegisterUseCase
     */
    private MentorRegisterUseCase $mentorRegisterUseCase;

    /**
     * @param MentorRegisterUseCase $mentorRegisterUseCase
     */
    public function __construct(MentorRegisterUseCase $mentorRegisterUseCase)
    {
        $this->mentorRegisterUseCase = $mentorRegisterUseCase;
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
            // emailは *.mentor@gmail.com のみ許可、mentorsテーブル内で重複を許さない
            'email' => ['required', 'string', 'email:filter,dns,spoof,strict', 'unique:mentors,email', 'regex:/.*'. config('constants.emails.EMAIL.MENTOR'). '/'],
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
            $mentorRegisterInput = new MentorRegisterInput(
                $request->email,
                $request->name,
                $request->password
            );
            $mentorRegisterOutput = $this->mentorRegisterUseCase->execute($mentorRegisterInput);
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
                'type' => 'mentors',
                'id' => $mentorRegisterOutput->getId(),
                'attributes' => [
                    'code' => $mentorRegisterOutput->getCode(),
                    'email' => $mentorRegisterOutput->getEmail(),
                    'name' => $mentorRegisterOutput->getName()
                ]
            ]
        ], Response::HTTP_CREATED);
    }
}
