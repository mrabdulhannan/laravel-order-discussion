<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Http\Controllers\ShopifyAPIController;
use App\Services\HelperServices;
class ChatController extends Controller
{
    protected $helperService;

    public function __construct(HelperServices $helperService)
    {
        $this->helperService = $helperService;
    }

    public function getMessages($order_id)
    {
        // Retrieve messages based on the order ID
        $messages = Message::where('order_id', $order_id)->get();

        return response()->json(['messages' => $messages], 200);
    }

    public function sendMessage(Request $request, $order_id)
    {
        dd($request->all());
        // Validate incoming message
        $validatedData = $request->validate([
            'user_type' => 'required|string',
            'content' => 'required|string',
        ]);

        // Create and store the message
        $message = new Message();
        $message->order_id = $order_id;
        $message->sender = $validatedData['sender'];
        $message->content = $validatedData['content'];
        $message->save();

        return response()->json(['message' => 'Message sent successfully'], 201);
    }

    public function openMessenger(Request $request)
    {
      
        $orderData = $this->getOrderId($request);

        
        $orderId = $orderData[0];
        $shop = $orderData[1];
        $userName = $orderData[2];
        $userType = $orderData[3];

        $orderData = $this->helperService->getOrderAndCustomerDetails($orderId);
        $jsonData = json_decode($orderData, true);

        // Extract order number and customer email
        $order = $jsonData['orders'][0];
        
        $orderNumber = $order['order_number'];
        $customerEmail = $order['customer']['email'];

        // dd($orderNumber);
        $messages = $this->getAllMessagesByOrderId($orderId);

        // $customerDetails = $order['customer'];
        // <p>First Name: {{ $customerDetails['first_name'] }}</p>
        // <p>Last Name: {{ $customerDetails['last_name'] }}</p>
        // <p>Email: {{ $customerDetails['email'] }}</p>
        // <p>Phone: {{ $customerDetails['phone'] ?? 'N/A' }}</p>
        // <p>Address: {{ $customerDetails['default_address']['address1'] }}, {{ $customerDetails['default_address']['city'] }}, {{ $customerDetails['default_address']['province'] }}, {{ $customerDetails['default_address']['country'] }}, {{ $customerDetails['default_address']['zip'] }}</p>
        // <p>State: {{ $customerDetails['state'] }}</p>
        // <p>Created At: {{ $customerDetails['created_at'] }}</p>
        // <p>Updated At: {{ $customerDetails['updated_at'] }}</p>
        // dd($orderNumber,$customerEmail);
        // Return or use the extracted parameters
        // return response()->json([
        //     'id' => $id,
        //     'shop' => $shop
        // ]);
        return view('admin.messenger', compact('orderNumber','messages','orderId','userName','userType','customerEmail'));
    }

    public function create()
    {
        return view('messages.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'order_id' => 'required|string',
            'user_type' => 'required|string',
            'image_url' => 'nullable|string',
            'user_name' => 'nullable|string',
            'user_email' => 'nullable|email',
            'order_number'=>'nullable|string',
            'content' => 'required|string',
        ]);

        Message::create($request->only([
            'order_id',
            'user_type',
            'image_url',
            'user_name',
            'user_email',
            'order_number',
            'content',
        ]));

        return redirect()->back()->with('success', 'Message created successfully.');
    }

    public function getOrderId($request){

        $fullUrl = $request->fullUrl();

        // Parse the URL
        $parsedUrl = parse_url($fullUrl);

        // Parse the query string into an array
        $queryParams = [];
        if (isset($parsedUrl['query'])) {
            parse_str($parsedUrl['query'], $queryParams);
        }

        // Extract the specific parameters
        $id = $queryParams['id'] ?? "";
        $shop = $queryParams['shop'] ?? "";
        $userName = $queryParams['user_name'] ?? "";
        $userType = $queryParams['user_type'] ?? "";

        
        return [$id, $shop, $userName, $userType];
    }

    public function getAllMessagesByOrderId($orderId){

        $messages = Message::where('order_id', $orderId)->orderBy('created_at')->get();

        return $messages;
    }


    public function storeMessageFiles(Request $request)
    {
        
        $request->validate([
            'file' => 'required|mimes:pdf,docx,xlsx,ppt,png,jpg,jpeg,gif|max:10240', // Adjust file types and size as needed
        ]);

        // $path = $profileImage->store('profile_images', 'public');
        $path = $request->file('file')->store('uploads', 'public'); // Change 'uploads' to your storage path

        $filePath = $path??"";
        $fileUrl = asset('storage/' . $filePath);

        $fileData = [
            'file_path' => $fileUrl ?? "",
        ];
        // auth()->user()->resources()->create($fileData);
        // Handle the request and return a response
        return response()->json(['message' => $fileData]);
    }

    public function index()
    {
        $messages = Message::all();
        return view('messages.index', compact('messages'));
    }

    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();
        return redirect()->route('messages.index')->with('success', 'Message deleted successfully.');
    }

    public function edit($id)
    {
        $message = Message::findOrFail($id);
        return view('messages.edit', compact('message'));
    }

    public function update(Request $request, $id)
    {
        $message = Message::findOrFail($id);
        $message->update($request->all());
        return redirect()->route('messages.index')->with('success', 'Message updated successfully.');
    }
}
