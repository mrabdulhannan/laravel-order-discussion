<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Http\Controllers\ShopifyAPIController;
use App\Services\HelperServices;
use App\Mail\ExampleMail;
use Illuminate\Support\Facades\Mail;

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
        // dd($request->all());
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
        $order = $jsonData['orders'][0]??"";

        $orderNumber = $order['order_number']??"";
        $customerEmail = $order['customer']['email']??"";
        $customerName = $order['customer']['first_name']??"";

        // dd($orderNumber);
        $messages = $this->getAllMessagesByOrderId($orderId)??"";

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
        return view('admin.messenger', compact('orderNumber', 'messages', 'orderId', 'userName', 'userType', 'customerEmail', 'customerName'));
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
            'order_number' => 'nullable|string',
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

        $userType = $request['user_type'] ?? "";
        if ($userType == "admin") {
            $senderName = "Admin";
            $senderEmail = "admin@gmail.com";
            $recieverEmail = $request['customer_email'] ?? "";
            $recieverName = $request['customer_name'] ?? "";
        } elseif ($userType == "customer") {
            $senderName = $request['customer_name'] ?? "";
            $senderEmail = $request['customer_email'] ?? "";;
            $recieverEmail = "admin@gmail.com" ?? "";
            $recieverName = "Admin" ?? "";
        } else {
            $senderName = "Admin";
            $senderEmail = "admin@gmail.com";
            $recieverEmail = $request['customer_email'] ?? "";
            $recieverName = $request['customer_name'] ?? "";
        }

        $order_id = $request['order_id'] ?? "";
        $content =  $request['content'] ?? "";
        $images = $request['image_url'] ?? "";
        $orderNumber = $request['order_number'] ?? "";

        $this->sendEmailNotification($order_id, $orderNumber,  $content, $images, $senderName, $senderEmail, $recieverName, $recieverEmail);
        return redirect()->back()->with('success', 'Message created successfully.');
    }

    public function getOrderId($request)
    {

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

    public function getAllMessagesByOrderId($orderId)
    {

        $messages = Message::where('order_id', $orderId)->orderBy('created_at')->get();

        return $messages;
    }


    public function storeMessageFilesSingleFile(Request $request)
    {

        $request->validate([
            'file' => 'required|mimes:pdf,docx,xlsx,ppt,png,jpg,jpeg,gif|max:10240', // Adjust file types and size as needed
        ]);

        // $path = $profileImage->store('profile_images', 'public');
        $path = $request->file('file')->store('uploads', 'public'); // Change 'uploads' to your storage path

        $filePath = $path ?? "";
        $fileUrl = asset('storage/' . $filePath);

        $fileData = [
            'file_path' => $fileUrl ?? "",
        ];
        // auth()->user()->resources()->create($fileData);
        // Handle the request and return a response
        return response()->json(['message' => $fileData]);
    }

    public function storeMessageFiles(Request $request)
    {
        try {
            $request->validate([
                'files.*' => 'required|mimes:pdf,docx,xlsx,ppt,png,jpg,jpeg,gif|max:10240',
            ]);

            $filePaths = [];
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $path = $file->store('uploads', 'public');
                    $filePaths[] = asset('storage/' . $path);
                }
            }

            return response()->json(['message' => ['file_paths' => $filePaths]]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
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

    public function sendEmail()
    {
        $details = [
            'title' => 'Mail from Laravel Application',
            'body' => 'This is a test email sent from a Laravel application.'
        ];

        Mail::to('recipient@example.com')->send(new ExampleMail($details));

        return "Email sent successfully.";
    }

    public function sendEmailNotification($order_id, $orderNumber,  $content, $images, $senderName, $senderEmail, $recieverName, $recieverEmail)
    {
        $details = [
            'title' => 'Message about Order Number ' . $orderNumber,
            'body' =>   $content,
            'orderId' => $order_id,
            'senderEmail' => $senderEmail,
            'senderName' => $senderName,
            'recieverEmail' => $recieverEmail,
            'images' => $images,
            'userName' => $recieverName
        ];

        Mail::to($recieverEmail)->send(new ExampleMail($details));

        return "Email sent successfully.";
    }
}
