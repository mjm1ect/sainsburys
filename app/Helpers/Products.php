<?php

namespace App\Helpers;

class Products
{

	/**
     * Get the List of Available Products products.json
     *
     * @return array
     */
	private function getProducts(){

		$path = Config('sainsburys.product_list_json');
		$json = json_decode(file_get_contents($path), true); 

		return $json;
	}

	/**
     * Append the Products Selected with the Full Details.
     *
     * @param array $productsSelected
     * @return array
     */
	public function appendProductDetails($productsSelected){

		
		// Get the List of all available products.
		$productList = $this->getProducts(); 

		// Wrap the Product List as a collection so we can query by item key.
		$productsCollection = collect($productList['products']);

		$cleanProductSelected = [];
		foreach ($productsSelected as $key => $value){

			$productId = $value['product_id'];
			$quantity = $value['qty'];

			$singleItem['productId'] = $productId;

			$filteredItems = $productsCollection->where('id', $productId); // Query the Collection.

				foreach($filteredItems as $product){

					$singleItem['price'] = $product['price'];
					$singleItem['name'] = $product['name'];
					$singleItem['category'] = $product['category'];

				}

				// If More than 1 item quantity, split into single entities.
				for ($k = 0 ; $k < $quantity; $k++){
					$cleanProductSelected[] = $singleItem;
				}
			
		}

		return $cleanProductSelected;
	}

}