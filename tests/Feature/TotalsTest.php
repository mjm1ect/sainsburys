<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TotalsTest extends TestCase
{

	
	public function testApiPostRequest()
    {

		// test with 1 Item Chicken, Should cost 3.50.
	   	$products = [
			    		'product_id' => 1,
			    		'qty' => 1 
			    	];

    	$data = [ 'products' => [ $products	] ];
    	//dd($data, json_encode($data));
		
		$response = $this->json('POST', '/api/totals', $data);

		$response
            ->assertStatus(200)
            ->assertJson([
                'total' => '3.50',
            ]);

	}

	public function testSainsburysPartOne()
    {

		// Sainsurys part one example should total 6.50
	   	$products = [
	   					[
				    		'product_id' => 1,
				    		'qty' => 1 
			    		],
			    		[
				    		'product_id' => 2,
				    		'qty' => 1 
			    		],
			    		[
				    		'product_id' => 3,
				    		'qty' => 1 
			    		]
			    	];

    	$data = [ 'products' => $products ];
    	//dd($data, json_encode($data));
		
		$response = $this->json('POST', '/api/totals', $data);

		$response
            ->assertStatus(200)
            ->assertJson([
                'total' => '6.50',
            ]);

	}

	public function testSainsburysPartTwoMealDeal()
    {

		// Sainsurys part two, one meal deal should be 3 quid
	   	$products = [
	   					[
				    		'product_id' => 2,
				    		'qty' => 1 
			    		],
			    		[
				    		'product_id' => 3,
				    		'qty' => 1 
			    		],
			    		[
				    		'product_id' => 4,
				    		'qty' => 1 
			    		]
			    	];

    	$data = [ 'products' => $products ];
    	//dd($data, json_encode($data));
		
		$response = $this->json('POST', '/api/totals', $data);

		$response
            ->assertStatus(200)
            ->assertJson([
                'total' => '3.00',
            ]);

	}

	public function testSainsburysPartTwoMultipeMealDeals()
    {

		// Sainsurys part two, multiple meal deals should be 10.25
	   	$products = [
	   					[
				    		'product_id' => 1,
				    		'qty' => 1 
			    		],
	   					[
				    		'product_id' => 2,
				    		'qty' => 2 
			    		],
			    		[
				    		'product_id' => 3,
				    		'qty' => 2
			    		],
			    		[
				    		'product_id' => 4,
				    		'qty' => 2
			    		],
			    		[
				    		'product_id' => 7,
				    		'qty' => 1
			    		]
			    	];

    	$data = [ 'products' => $products ];
    	//dd($data, json_encode($data));
		
		$response = $this->json('POST', '/api/totals', $data);

		$response
            ->assertStatus(200)
            ->assertJson([
                'total' => '10.25',
            ]);

	}

}
