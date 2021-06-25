<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all(); // lấy toàn bộ dữ liệu
        $listCategories = Category::latest()->paginate(15); // sắp sếp theo thứ tự mới nhất && phân trang
       
        return view('admin.category.index',[
            'data' => $listCategories,
            'categories' => $categories
        ]);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $categories = Category::all(); // lấy toàn bộ dữ liệu
       return view('admin.category.create',[
            'categories' => $categories,
            'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // bước 1 : nhận được data từ request
        //$name = $_POST['name'];
        $parent_id = $request->input('parent_id'); // lấy dữ liệu từ form
        $name = $request->input('name'); // tên
        $position = $request->input('position'); // vị trị
        $type = $request->input('type'); // loại danh mục
        $is_active = $request->input('is_active'); // hiển thị

        
        // bươc 2:
        $category = new Category(); // tên bảng =>  class
        $category->parent_id = $parent_id; // tên cột => thuộc tính của Class
        $category->name = $name;
        $category->slug = str_slug($name);
        $category->position = $position;
        $category->type = $type;
        $category->is_active = $is_active ? $is_active : 0;

        // xử lý lưu ảnh
        if ($request->hasFile('image')) { // dòng này Kiểm tra xem có image có được chọn
            // get file
            $file = $request->file('image');
            // tên file image
            $filename = $file->getClientOriginalName(); // tên ban đầu của image
            // Định nghĩa đường dẫn sẽ upload lên
            $path_upload = 'uploads/category/'; // uploads/brand ; uploads/vendor
            // Thực hiện upload file
            $file->move($path_upload,$filename);

            $category->image = $path_upload.$filename;
        }


      $category->save();

      return redirect()->route('admin.category.index');

    }
        


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        $categories = Category::all(); // lấy toàn bộ dữ liệu
        return view('admin.category.edit',[
            'category' => $category,
            'categories' => $categories]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          
    Banner::destroy($id); // DELETE FROM categories WHERE id = 56

        return response()->json(['status' => true],200);
    }
}
