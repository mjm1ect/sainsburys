<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use App\Helpers\Totals; // use Totals Helper
use App\Helpers\Products; // use Products Helper

use App\Http\Resources\Total as TotalResource;


class TotalsController extends Controller
{
    /**
     * Receive a list of products and return the total price to be paid for the goods.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $productsSelected = $request->input('products'); // Customers selected items.

        // Nothing Selected return error response.
        if (empty($productsSelected))
            return response()->api(null, Response::HTTP_NOT_FOUND);


        $productsHelper = new Products(); // Product Helper
        $totalsHelper = new Totals(); // Totals Calculations Helper

        // Append the product details to the customers items and split out into single records.
        $appendedProductSelection = $productsHelper->appendProductDetails($productsSelected); 
        
        $mealDeals = $totalsHelper->calculateMealDeals($appendedProductSelection); // Calculate number of any Meal Deals.

        $totalCost = $totalsHelper->calculateTotalPrice($appendedProductSelection, $mealDeals); // Calculate the Total Cost payable.;

        return response()->json([ 'total' => $totalCost ]);

        //return response()->api([ 'total' => $totalCost ]); // Don't want all gubbings for api response e.g. load time, status messages etc.
        
    }

    /**
     * Return a clean error for get requests.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request)
    {
        return response()->api(null, Response::HTTP_NOT_IMPLEMENTED);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response()->api(null, Response::HTTP_NOT_IMPLEMENTED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->api(null, Response::HTTP_NOT_IMPLEMENTED);
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
        return response()->api(null, Response::HTTP_NOT_IMPLEMENTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response()->api(null, Response::HTTP_NOT_IMPLEMENTED);
    }
}
