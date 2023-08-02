<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Domains\Auth\Domain\Exceptions\UserNotFoundException;
use App\Domains\Auth\Domain\Exceptions\UserUnauthorizedException;
use App\Domains\Auth\UseCase\DTOs\MentorLoginInput;
use App\Domains\Auth\UseCase\MentorLoginUseCase;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class MentorLoginController extends Controller
{
    /**
     * @var MentorLoginUseCase
     */
    private MentorLoginUseCase $mentorLoginUseCase;

    /**
     * @param MentorLoginUseCase $mentorLoginUseCase
     */
    public function __construct(MentorLoginUseCase $mentorLoginUseCase)
    {
        $this->mentorLoginUseCase = $mentorLoginUseCase;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        // Requestのバリデーション
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email:filter,dns,spoof,strict', 'regex:/.*'. config('constants.emails.EMAIL.MENTOR'). '/'],
            'password' => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => [
                    'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
                    'message' => '422 Unprocessable Entity',
                    'details' => $validator->messages(),
                ],
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // 実際の処理
        try {
            $mentorLoginInput = new MentorLoginInput(
                $request->email,
                $request->password
            );
            $mentorLoginOutput = $this->mentorLoginUseCase->execute($mentorLoginInput);
        } catch (UserNotFoundException $error) {
            return response()->json([
                'errors' => [
                    'code' => $error->getCode(),
                    'message' => $error->getMessage(),
                ],
            ], $error->getCode());
        } catch (UserUnauthorizedException $error) {
            return response()->json([
                'errors' => [
                    'code' => $error->getCode(),
                    'message' => $error->getMessage(),
                ],
            ], $error->getCode());
        } catch (Throwable $error) { // それ以外の全ての例外
            return response()->json([
                'errors' => [
                    'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'message' => '500 Internal Server Error',
                    'details' => $error->getMessage(),
                ],
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        // Response
        return response()->json([
            'data' => [
                'type' => 'mentors',
                'id' => $mentorLoginOutput->getId(),
                'attributes' => [
                    'code' => $mentorLoginOutput->getCode(),
                    'email' => $mentorLoginOutput->getEmail(),
                    'name' => $mentorLoginOutput->getName(),
                ],
            ],
        ], Response::HTTP_OK);
    }
}
