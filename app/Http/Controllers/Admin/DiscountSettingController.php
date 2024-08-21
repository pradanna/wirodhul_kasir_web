<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Category;
use App\Models\DiscountSetting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class DiscountSettingController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->request->ajax()) {
            $data = DiscountSetting::with([])
                ->orderBy('created_at', 'DESC')
                ->get();
            return $this->basicDataTables($data);
        }
        return view('admin.discount-setting.index');
    }

    public function add()
    {
        if ($this->request->method() === 'POST') {
            return $this->store();
        }
        return view('admin.discount-setting.add');
    }

    public function edit($id)
    {
        $data = DiscountSetting::with([])
            ->findOrFail($id);
        if ($this->request->method() === 'POST') {
            return $this->patch($data);
        }
        return view('admin.discount-setting.edit')->with(['data' => $data]);
    }

    public function delete($id)
    {
        try {
            DiscountSetting::destroy($id);
            return $this->jsonSuccessResponse('Berhasil menghapus data...');
        } catch (\Exception $e) {
            return $this->jsonErrorResponse();
        }
    }

    private $rule = [
        'nominal' => 'required',
        'discount' => 'required',
    ];

    private $message = [
        'nominal.required' => 'kolom minimal pembelian wajib diisi',
        'discount.required' => 'kolom diskon wajib diisi',
    ];


    private function store()
    {
        try {
            $validator = Validator::make($this->request->all(), $this->rule, $this->message);
            if ($validator->fails()) {
                return redirect()->back()->with('failed', 'Harap mengisi kolom dengan benar...')->withErrors($validator)->withInput();
            }
            $data_request = $this->getDataRequest();
            DiscountSetting::create($data_request);
            return redirect()->back()->with('success', 'Berhasil menyimpan data setting diskon...');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('failed', 'terjadi kesalahan server...');
        }
    }

    /**
     * @param $data Model
     * @return \Illuminate\Http\RedirectResponse
     */
    private function patch($data)
    {
        try {
            $validator = Validator::make($this->request->all(), $this->rule, $this->message);
            if ($validator->fails()) {
                return redirect()->back()->with('failed', 'Harap mengisi kolom dengan benar...')->withErrors($validator)->withInput();
            }
            $data_request = $this->getDataRequest();
            $data->update($data_request);
            return redirect()->back()->with('success', 'Berhasil merubah data setting diskon...');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('failed', 'terjadi kesalahan server...');
        }
    }

    private function getDataRequest()
    {
        return [
            'nominal' => $this->postField('nominal'),
            'discount' => $this->postField('discount'),
        ];
    }
}
