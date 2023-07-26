<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Symfony\Component\HttpFoundation\Response;

class MentorController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        // バリデーション
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            // emailは *.mentor@gmail.com のみ許可
            'email' => ['required', 'string', 'email:filter,dns,spoof,strict', 'unique:mentors,email', 'regex:/.*'. config('consts.emails.EMAIL.MENTOR'). '/'],
            'password' => ['required', Password::defaults()],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // codeを一意に定める
        while(true){
            $code = 'm'. (string) str_pad(random_int(0, 999999), 6,0, STR_PAD_LEFT);
            if(!Mentor::where('code', $code)->exists()) break;
        }
        
        $mentor = Mentor::create([
            'code' => $code,
            'name' => $request->name,
            'is_admin' => true,
            'is_remote' => false,
            'work_day' => 0,
            'state' => 0,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'code' => $mentor->code,
            'name' => $mentor->name,
            'email' => $mentor->email
        ], Response::HTTP_CREATED);
    }
}
