namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BkashPaymentController extends Controller
{
    public function createPayment(Request $request)
    {
        $amount = $request->amount;

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer YOUR_ACCESS_TOKEN',
            'X-APP-Key' => 'YOUR_APP_KEY'
        ])->post('https://checkout.sandbox.bka.sh/v1.2.0-beta/payment/create', [
            'amount' => $amount,
            'currency' => 'BDT',
            'intent' => 'sale',
            'merchantInvoiceNumber' => 'Inv-' . uniqid(),
            'mode' => '0011'
        ]);

        return $response->json();
    }
}
