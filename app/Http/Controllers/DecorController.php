<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Exception;
use Illuminate\Http\Request;

class DecorController extends Controller
{
    public function index()
    {
        return view('admin.decor.index', [
            'products' => Product::where('category', '=', Product::DECOR)->get()
        ]);
    }

    public function create()
    {
        return view('admin.decor.create');
    }

    public function store(Request $request)
    {
        try {
            $decor = new Product();
            $decor->setData($request);
            $decor->save();

            $image = new ProductImage();
            $image->setData($decor->id, $request);
            $image->save();

            $this->message(true, "Data successfully added", "");
        } catch (Exception $e)
        {
            $this->message(false, "", "Failed to store data." . $e->getMessage());
        }

        return redirect()->route('decor.manage.index');
    }

    public function edit($id)
    {
        return view('admin.decor.edit', [
            'product' => Product::find($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $decor = Product::find($id);
            $decor->setData($request);
            $decor->save();

            $this->message(true, "Data successfully updated", "");
        } catch (Exception $e)
        {
            $this->message(false, "", "Failed to store data");
        }

        return redirect()->route('decor.manage.index');
    }

    public function destroy($id)
    {
        try {
            $product = Product::find($id);
            $productImages = ProductImage::where('product_id', '=', $product->id)->get();

            foreach($productImages as $productImage) {
                $productImage->removeImage($productImage->image);
                $productImage->delete();
            }
            $product->delete();

            $this->message(true, "Data successfully removed", "");
        } catch(Exception $e) {
            $this->message(false, "", "Failed to remove product. " . $e->getMessage());
        }

        return redirect()->route('decor.manage.index');
    }

    public function indexImage($id)
    {
        return view('admin.product_image.index',[
            'product' => Product::find($id),
            'images' => ProductImage::where('product_id', '=', $id)->get()
        ]);
    }

    public function createImage($id)
    {
        return view('admin.product_image.create', [
            'product' => Product::find($id)
        ]);
    }

    public function storeImage(Request $request, $id)
    {
        try {
            $image = new ProductImage();
            $image->setData($id, $request);
            $image->save();

            $this->message(true, "Image successfully added", "");
        } catch (Exception $e) {
            $this->message(false, "", "Failed to add image. " . $e->getMessage());
        }

        return redirect()->route('decor.manage.detail.index', [$id]);
    }

    public function destroyImage($id, $imageId)
    {
        try {
            $image = ProductImage::find($imageId);
            $image->removeImage($image->image);
            $image->delete();

            $this->message(true, "Image successfully remove", "");
        } catch (Exception $e) {
            $this->message(false, "", "Failed to remove image. " . $e->getMessage());
        }

        return redirect()->route('decor.manage.detail.index', [$id]);
    }
}
