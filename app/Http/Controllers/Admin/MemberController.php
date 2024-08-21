<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Member;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class MemberController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->request->ajax()) {
            $data = Member::with([])
                ->orderBy('created_at','DESC')
                ->get();
            return $this->basicDataTables($data);
        }
        return view('cashier.member.index');
    }

    public function add()
    {
        if ($this->request->method() === 'POST') {
            return $this->store();
        }
        return view('cashier.member.add');
    }

    public function edit($id)
    {
        $data = Member::with([])
            ->findOrFail($id);
        if ($this->request->method() === 'POST') {
            return $this->patch($data);
        }
        return view('cashier.member.edit')->with(['data' => $data]);
    }

    public function delete($id)
    {
        try {
            Member::destroy($id);
            return $this->jsonSuccessResponse('Berhasil menghapus data...');
        } catch (\Exception $e) {
            return $this->jsonErrorResponse();
        }
    }

    private $rule = [
        'username' => 'required',
    ];

    private $message = [
        'username.required' => 'kolom username wajib diisi',
    ];

    private function store()
    {
        try {
            $validator = Validator::make($this->request->all(), $this->rule, $this->message);
            if ($validator->fails()) {
                return redirect()->back()->with('failed', 'Harap mengisi kolom dengan benar...')->withErrors($validator)->withInput();
            }
            $data_user = [
                'username' => $this->postField('username'),
                'phone' => $this->postField('phone'),
            ];

            Member::create($data_user);
            return redirect()->back()->with('success', 'Berhasil menyimpan data member...');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('failed', 'terjadi kesalahan server...');
        }
    }

    /**
     * @param Model $data
     * @return \Illuminate\Http\RedirectResponse
     */
    private function patch($data)
    {
        try {
            $validator = Validator::make($this->request->all(), $this->rule, $this->message);
            if ($validator->fails()) {
                return redirect()->back()->with('failed', 'Harap mengisi kolom dengan benar...')->withErrors($validator)->withInput();
            }
            $data_user = [
                'username' => $this->postField('username'),
                'phone' => $this->postField('phone'),
            ];

            $data->update($data_user);
            return redirect()->back()->with('success', 'Berhasil merubah data member...');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('failed', 'terjadi kesalahan server...');
        }
    }
}
