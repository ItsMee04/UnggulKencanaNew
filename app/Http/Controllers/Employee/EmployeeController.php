<?php

namespace App\Http\Controllers\Employee;

use App\Models\User;
use App\Models\Employees;
use App\Models\Professions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class EmployeeController extends Controller
{
    public function index()
    {
        $data = Employees::paginate(4);
        $professsion = Professions::where('professions', '!=', 'Admin')->get();
        return view('employee.index', ['data' => $data, 'professions' => $professsion]);
    }

    public function store(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib di isi !!!',
            'mimes'    => ':attribute format wajib menggunakan PNG/JPG'
        ];

        $credentials = $request->validate([
            'nip'           =>  'required',
            'name'          => 'required',
            'phone'         => 'required',
            'profession'    => 'required',
            'address'       => 'required',
            'status'        => 'required',
            'signature'     => 'mimes:png,jpg,jpeg',
            'avatar'        => 'mimes:png,jpg,jpeg',
        ], $messages);

        $newAvatar = '';

        if ($request->file('avatar')) {
            $extension = $request->file('avatar')->getClientOriginalExtension();
            $newAvatar = $request->name . 'avatar' . '-' . now()->timestamp . '.' . $extension;
            $request->file('avatar')->storeAs('Avatar', $newAvatar);
            $request['avatar'] = $newAvatar;
        }

        Employees::create([
            'nip'           => $request->nip,
            'name'          => $request->name,
            'address'       => $request->address,
            'phone'         => $request->phone,
            'professions_id' => $request->profession,
            'status'        => $request->status,
            'avatar'        => $newAvatar,
        ]);
        return redirect('employee')->with('success-message', 'Data Success Di Simpan !');
    }

    public function update(Request $request, $id)
    {
        $employee = Employees::where('id', $id)->first();

        $messages = [
            'required' => ':attribute wajib di isi !!!',
            'mimes'    => ':attribute format wajib menggunakan PNG/JPG'
        ];

        $credentials = $request->validate([
            'nip'           =>  'required',
            'name'          => 'required',
            'phone'         => 'required',
            'profession'    => 'required',
            'address'       => 'required',
            'status'        => 'required',
            'signature'     => 'mimes:png,jpg,jpeg',
            'avatar'        => 'mimes:png,jpg,jpeg',
        ], $messages);

        if ($request->file('avatar')) {
            $pathavatar     = 'storage/Avatar/' . $employee->avatar;

            if (File::exists($pathavatar)) {
                File::delete($pathavatar);
            }

            $extension = $request->file('avatar')->getClientOriginalExtension();
            $newAvatar = $request->employeename . 'avatar' . '-' . now()->timestamp . '.' . $extension;
            $request->file('avatar')->storeAs('Avatar', $newAvatar);
            $request['avatar'] = $newAvatar;

            Employees::where('id', $id)
                ->update([
                    'nip'               => $request->nip,
                    'name'              => $request->name,
                    'address'           => $request->address,
                    'phone'             => $request->phone,
                    'professions_id'    => $request->profession,
                    'status'            => $request->status,
                    'avatar'            => $newAvatar,
                ]);
        } else {
            Employees::where('id', $id)
                ->update([
                    'nip'               => $request->nip,
                    'name'              => $request->name,
                    'address'           => $request->address,
                    'phone'             => $request->phone,
                    'professions_id'    => $request->profession,
                    'status'            => $request->status
                ]);
        }
        return redirect('employee')->with('success-message', 'Data Success Di Update !');
    }

    public function delete($id)
    {
        $employee = Employees::where('id', $id)->first();
        $user    = User::where('employees_id', $id)->first();

        $path1 = 'storage/avatar/' . $employee->avatar;
        $path2 = 'storage/signature/' . $employee->signature;

        if (File::exists($path1, $path2)) {
            File::delete($path1, $path2);
        }

        $deleteemployee = Employees::where('id', $id)->delete();

        if ($user != null) {
            if ($deleteemployee) {
                User::where('user_id', $id)->delete();
            }
        }

        return redirect('employee')->with('success-message', 'Data Success Dihapus !');
    }
}
