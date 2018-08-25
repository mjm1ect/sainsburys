<?php

namespace App\Helpers;

class Totals
{

	/**
	 * Calculate the Total Cost Including Meal Deals.
	 *
     * @param array $items
     * @param int $mealDeals
     * @return int - Price
     */
	public function calculateTotalPrice($items = [], $mealDeals = 0){

		$totalCost = 0; // Default 0

		// Set Up meal Deals So we dont count these in the total, as meal deal prices totalled seperatly.
		$mealDealDrinks = $mealDeals;
		$mealDealSnacks = $mealDeals;
		$mealDealSandwiches = $mealDeals;

		// Calculate the total cost of meals dels.
		if($mealDeals > 0){

			$mealDealCost = Config('sainsburys.meal_deal_cost'); // Note: Price in config file so only need to update in 1 place.
			$totalCost = $mealDeals * $mealDealCost;

		}

		// Calculate Cost of all items, not counting meal deal stuff.
		foreach ($items as $key => $item){

			if($item['category'] == 'drink' && $mealDealDrinks > 0){
				$mealDealDrinks = $mealDealDrinks - 1;
				continue;
			}
			else if($item['category'] == 'snack' && $mealDealSnacks > 0){
				$mealDealSnacks = $mealDealSnacks - 1;
				continue;
			}
			else if($item['category'] == 'sandwich' && $mealDealSandwiches > 0){
				$mealDealSandwiches = $mealDealSandwiches - 1;
				continue;
			}

			$totalCost = $totalCost + $item['price'];

		}

		// Clean the total as per examples output expected. E.g. 3.00 should be £3, 6.5 should be £s6.50
		$totalCost = str_replace(".00", "", (string)number_format ($totalCost, 2, ".", "")); 

		return $totalCost;
	}

	/**
	 * Calculate the number of meal deals.
	 * Notes: Meal Deals consist of a snack, drink, sandwich and cost £3 quid.
	 *
     * @param array $items
     * @return int
     */
	public function calculateMealDeals($items = []) {

		$itemsCollection = collect($items); // Wrap in collection so can query.

		$countSnacks = $itemsCollection->where('category', 'snack')->count(); // Count how many snacks.
		$countDrinks = $itemsCollection->where('category', 'drink')->count(); // Count how many drinks.
		$countSandwich = $itemsCollection->where('category', 'sandwich')->count(); // Count how many sandwiches.

		// Check how many of each snack, drink and sandwich
		// the lowest value is how many meal deals there are. (Note: I'm sure there should be an easier way.)
		$mealDeals = 0; // Default 0 Meal Deals.

		// Check if any items qualify for a meal deal.
		if($countSnacks > 0 && $countDrinks > 0 && $countSandwich > 0){

			$mealDeals = $countSnacks; // Set meal deal count. (Assumtions: there can only be as many deals as snacks )

			// if there is less drinks than current count of deals. Assumption: then there can only be as many deals as drinks 
			if($countDrinks < $mealDeals){ 
				$mealDeals = $countDrinks; 
			}

			// if there is less sandwiches than current count of deals. Assumption: then there can only be as many deals as sandwiches 
			if($countSandwich < $mealDeals){
				$mealDeals = $countSandwich;
			}

		}

		//dd($items, "TEst", $countSnacks, $countDrinks, $countSandwich);

		return $mealDeals;

	}	

}