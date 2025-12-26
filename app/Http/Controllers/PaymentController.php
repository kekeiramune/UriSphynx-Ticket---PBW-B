namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

use App\Models\ConcertPrice;

public function create($concertId)
{
    $prices = ConcertPrice::with('seating')
        ->where('id_concert', $concertId)
        ->where('status_seating', 'available')
        ->get();

    return view('payment.form', compact('prices'));
}
