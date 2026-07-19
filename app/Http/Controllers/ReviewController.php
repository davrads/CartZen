<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Delivered order भएको product को लागि नयाँ review लेख्ने।
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id'     => ['required', 'exists:products,id'],
            'order_item_id'  => ['nullable', 'exists:order_items,id'],
            'rating'         => ['required', 'integer', 'min:1', 'max:5'],
            'comment'        => ['nullable', 'string', 'max:1000'],
        ]);

        $customerId = Auth::guard('customer')->id();
        $data['user_id'] = $customerId;

        // एउटै order item को लागि दोहोरो review नबनोस्
        if (!empty($data['order_item_id'])) {
            $alreadyReviewed = Review::where('user_id', $customerId)
                ->where('order_item_id', $data['order_item_id'])
                ->exists();

            if ($alreadyReviewed) {
                return back()->with('review_error', 'तपाईंले यो सामानको लागि पहिल्यै Review लेख्नुभएको छ।');
            }
        }

        Review::create($data);

        return back()->with('review_status', 'तपाईंको Review सफलतापूर्वक थपियो।');
    }

    /**
     * आफ्नो review अपडेट गर्ने।
     */
    public function update(Request $request, Review $review)
    {
        abort_unless($review->user_id === Auth::guard('customer')->id(), 403);

        $data = $request->validate([
            'rating'  => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string', 'max:1000'],
        ]);

        $review->update($data);

        return back()->with('review_status', 'Review अपडेट भयो।');
    }

    /**
     * आफ्नो review मेटाउने।
     */
    public function destroy(Review $review)
    {
        abort_unless($review->user_id === Auth::guard('customer')->id(), 403);

        $review->delete();

        return back()->with('review_status', 'Review हटाइयो।');
    }
}
