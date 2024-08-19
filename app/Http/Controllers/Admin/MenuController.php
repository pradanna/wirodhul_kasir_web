<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

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
        return view('admin.menu.index');
    }

    public function add()
    {
        if ($this->request->method() === 'POST' && $this->request->ajax()) {
            return $this->store();
        }
        $categories = Category::all();
        return view('admin.menu.add')->with([
            'categories' => $categories
        ]);
    }

    public function edit($id)
    {
        $data = Menu::with(['category'])
            ->findOrFail($id);
        if ($this->request->method() === 'POST' && $this->request->ajax()) {
            return $this->patch($data);
        }
        $categories = Category::all();
        return view('admin.menu.edit')->with([
            'categories' => $categories,
            'data' => $data
        ]);
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
        'category' => 'required',
        'name' => 'required',
    ];

    private $message = [
        'category.required' => 'kolom kategori wajib diisi',
        'name.required' => 'kolom nama wajib diisi',
    ];


    private function store()
    {
        try {
            $validator = Validator::make($this->request->all(), $this->rule, $this->message);
            if ($validator->fails()) {
                $errors = $validator->errors()->getMessages();
                return response()->json([
                    'status' => 400,
                    'message' => 'Harap Mengisi Kolom Dengan Benar...',
                    'data' => $errors
                ], 400);
            }
            $data_request = $this->getDataRequest();
            Menu::create($data_request);
            return $this->jsonSuccessResponse('success', 'Berhasil menyimpan data menu...');
        } catch (\Exception $e) {
            return $this->jsonErrorResponse();
        }
    }

    /**
     * @param Model $data
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    private function patch($data)
    {
        try {
            $validator = Validator::make($this->request->all(), $this->rule, $this->message);
            if ($validator->fails()) {
                $errors = $validator->errors()->getMessages();
                return response()->json([
                    'status' => 400,
                    'message' => 'Harap Mengisi Kolom Dengan Benar...',
                    'data' => $errors
                ], 400);
            }
            $data_request = $this->getDataRequest();
            $data->update($data_request);
            return $this->jsonSuccessResponse('success', 'Berhasil menyimpan data menu...');
        } catch (\Exception $e) {
            return $this->jsonErrorResponse();
        }
    }

    private function getDataRequest()
    {
        $data_request = [
            'category_id' => $this->postField('category'),
            'name' => $this->postField('name'),
            'price' => $this->postField('price'),
            'description' => $this->postField('description'),
        ];

        if ($this->request->hasFile('file')) {
            $file = $this->request->file('file');
            $extension = $file->getClientOriginalExtension();
            $document = Uuid::uuid4()->toString() . '.' . $extension;
            $storage_path = public_path('assets/menu');
            $documentName = $storage_path . '/' . $document;
            $data_request['image'] = '/assets/menu/' . $document;
            $file->move($storage_path, $documentName);
        }
        return $data_request;
    }
}
