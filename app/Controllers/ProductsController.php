<?php

namespace App\Controllers;
use App\SessionGuard as Guard;
use App\Controllers\Controller;
use App\Models\Product;

class ProductsController extends Controller
{
	public function updateProduct()
    {
		Product::find($_POST['id'])->update($_POST);
		redirect("/");
	}

	public static function findById($id)
	{
		return Product::find($id);
	}

	public function findByName()
	{
		$products = Product::where('name', 'LIKE', '%'. $_POST['key_word'] .'%')->get();


		$this->sendPage('search', ['products' => $products]);
	}

	public function findProdById($id)
	{
		echo Product::find($id);
	}

	public function removeProduct() {
		try {
			Product::find($_POST['product_id'])->carts()->delete();
		} finally {
			Product::find($_POST['product_id'])->delete();
			redirect("/");
		}
	}

	public function addProduct()
    {
		$target_dir = ROOTDIR . "public\uploads\\";
		$target_file = $target_dir . basename($_FILES["image"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["image"]["tmp_name"]);
			if($check !== false) {
				echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				echo "File is not an image.";
				$uploadOk = 0;
			}
		}

		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
		  } else {
			if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
			  echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
			} else {
			  echo "Sorry, there was an error uploading your file.";
			}
		}
		echo '<pre>'; print_r($_POST); echo '</pre>';
		$data = $this->filterProductData($_POST);
		$data["image"] = '/uploads/' . basename($_FILES["image"]["name"]);
		$prod = new Product();
		$prod->fill($data);
		$prod->save();
		redirect("/");
    }

	public function index()
	{
		$products = Product::all();
		$this->sendPage('home', ['products' => $products]);
	}

	protected function filterProductData(array $data)
    {
        return [
			'name' => $data['name'],
			'unit_price' => $data['unit_price'],
            'amount' => $data['amount'],
			'description' => $data['description'],
			'remaining' => $data['amount'],
			'sold' => 0
        ];
    }
}
