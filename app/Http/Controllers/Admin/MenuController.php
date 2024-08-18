<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class MenuController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->request->ajax()) {
            $data = Menu::with(['category'])
                ->orderBy('created_at', 'DESC')
                ->get();
            return $this->basicDataTables($data);
        }
        return view('admin.kategori.index');
    }

    public function add()
    {
        if ($this->request->method() === 'POST') {
            return $this->store();
        }
        return view('admin.kategori.add');
    }

    public function edit($id)
    {
        $data = Menu::with(['category'])
            ->findOrFail($id);
        if ($this->request->method() === 'POST') {
            return $this->patch($data);
        }
        return view('admin.kategori.edit')->with(['data' => $data]);
    }

    public function delete($id)
    {
        try {
            Menu::destroy($id);
            return $this->jsonSuccessResponse('Berhasil menghapus data...');
        } catch (\Exception $e) {
            return $this->jsonErrorResponse();
        }
    }

    private $rule = [
        'category_id' => 'required',
        'name' => 'required',
    ];

    private $message = [
        'name.required' => 'kolom nama wajib diisi',
    ];


    private function store()
    {
        try {
            $validator = Validator::make($this->request->all(), $this->rule, $this->message);
            if ($validator->fails()) {
                return redirect()->back()->with('failed', 'Harap mengisi kolom dengan benar...')->withErrors($validator)->withInput();
            }
            $data_request = $this->getDataRequest();
            Menu::create($data_request);
            return redirect()->back()->with('success', 'Berhasil menyimpan data kategori...');
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
            return redirect()->back()->with('success', 'Berhasil merubah data menu...');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('failed', 'terjadi kesalahan server...');
        }
    }

    private function getDataRequest()
    {
        return [
            'category_id' => $this->postField('category'),
            'name' => $this->postField('name'),
        ];
    }
}
