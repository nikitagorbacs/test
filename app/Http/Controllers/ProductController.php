<?php

namespace App\Http\Controllers;

use App\Models\Product;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    public function getAllProducts()
    {
        $products = Product::all();

        return $products;
    }

    public function getProductById(Product $product)
    {
        return $product;
    }

    public function addNewProduct(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'price' => 'required'
        ]);

        Product::create($request->all());

        // return 'Product was succesfully added!';
        return response('OK', 200);
    }

    public function deleteProduct(Product $product)
    {
        $product->delete();

        return 'Product was succesfully deleted!';
    }

    public function getRandomPhotos()
    {
        // retrieving random photos
        $client = new Client();

        $apiKey = 'sl6IRyXj9LopyYIPz7hBdpia1SOVKzSS2BGkdWVwTUs';
        $count = 3;
        $query = 'headphones';
        $orientation = 'portrait';

        $url = "https://api.unsplash.com/photos/random/?client_id=$apiKey&count=$count&query=$query&orientation=$orientation";

        $response = $client->get($url);

        if ($response->getStatusCode() == 200 && !empty($response->getBody())) {
            $data = json_decode($response->getBody(), true);
        } else {
            $data = 'No photos found';
        }

        // return $data;
        return view('test', [
            'data' => $data
        ]);
    }

    public function index()
    {
        $products = Product::all();

        $slides = $this->getRandomPhotos();

        return view('app', [
            'products' => $products,
            'slides' => $slides
        ]);
    }

    public function test(Request $request)
    {
        // test
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'quantity') !== false) {
                return 'hello';
            }
        }
    }
}
