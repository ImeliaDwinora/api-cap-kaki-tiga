<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller

{
    use ApiResponse;
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|confirmed',
        ]);
        $user = User::create([
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'email' => $request->email,
            'id_profil' => strval(mt_rand(0000000000, 9999999999)),

        ]);

        return $this->success(
            'Registrasi Berhasil!',
            ['token' => $user->createToken('apiToken')->plainTextToken],
        );
    }
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        if (!Auth::attempt($validated)) {
            return $this->fail('kredensial tidak tepat', null, 401);
        }
        return $this->success(
            'Login Berhasil!',
            ['token' => Auth::user()->createToken('apiToken')->plainTextToken],
        );
    }

    public function resetPassword(Request $request)
    {
        $email = $request->email;
        $checkEmail = User::where('email', '=', $email)->first();

        if($checkEmail) {
            $randomString = Str::random(8);
            $newPassword = bcrypt($randomString);
            $checkEmail->update(['password' => $newPassword]);
            return $this->success($randomString, null);
        }
        else {
            return ["status" => false, "message" => "Email belum terdaftar"];
        }
    }

    public function setPassword(Request $request)
    {
        $email = $request->email;
        $checkEmail = User::where('email', '=', $email)->first();
        $status = Hash::check($request->token, $checkEmail->password);
        if($status) {
            $newPassword = bcrypt($request->password);
            $checkEmail->update(['password' => $newPassword]);
            return $this->success("Berhasil ganti password, silahkan login", null);
        }
        else {
            return ['message' => 'tidak bisa ganti password', 'status' => $status];
        }
    }


    public function logout()
    {
        Auth::user()->tokens()->delete();
        return $this->success('Token Berhasil Dihapus',);
    }

    public function check(Request $request)
    {
        $emailToChecked = $request->email;
        $isEmailRegistered = User::where('email', $emailToChecked)->first();
        if ($isEmailRegistered) {
            return ['status' => true];
        } else {
            return ['status' => false];
        }
    }

    public function show()
    {
        return $this->success(
            null,
            Auth::user(),
        );
    }

    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'name' => 'string',
            'no_telp' => 'string',
            'alamat' => 'string',
            'tgl_lahir' => 'string',
            'kota' => 'string',
            'foto' => 'string',

        ]);
        $user = User::find($id);
        $user->update($validated);
        return $this->success(
                'Berhasil Mengupdate User',
                null,
            );
    }
}
