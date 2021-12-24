<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Exception;
use SplObjectStorage;
use App\Models\Messages;
use App\Models\User;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

/**
 * @author Rohit Dhiman | @aimflaiims
 */
class WebSocketController implements MessageComponentInterface
{
    private $clients;

    public function __construct()
    {
        $this->clients = new SplObjectStorage;
    }

    public function index(){
      $my_id = Auth::id();
      
      $messages_to_me = DB::table('messages')
                  ->leftJoin('users','sent_from','users.id')
                  ->select('users.username', 'users.profile_picture', 'users.id')
                  ->where('messages.sent_to',$my_id)
                  ->orderBy('messages.id','DESC')
                  ->groupBy('messages.sent_from')
                  ->get();
      $messages_from_me = DB::table('messages')
                  ->leftJoin('users','sent_to','users.id')
                  ->select('users.username', 'users.profile_picture', 'users.id')
                  ->where('messages.sent_from',$my_id)
                  ->orderBy('messages.id','DESC')
                  ->groupBy('messages.sent_to')
                  ->get();
      $user_list = $messages_to_me->merge($messages_from_me);
      $user_list = $user_list->unique();

      return view('frontend.pages.messages',[
        'user_list' => $user_list
      ]);
    }

    public function get_by_user(Request $request){
        $my_id = Auth::id();
        $message_with = (int)$request->message_with;

        $messages = DB::table('messages')
            ->where('sent_from', '=', $my_id)
            ->where('sent_to', '=', $message_with)
            ->orWhere(function ($query) use ($my_id, $message_with){
              $query->where('sent_to', '=', $my_id)
                    ->where('sent_from', '=', $message_with);
            })
            ->get();
        
        return response()->json([
            'messages' => $messages
        ]);
    }

    public function get_users(Request $request){
        $me = Auth::user();
        $users = User::where([
          ['username', 'like', '%'.$request->keyword.'%'], 
          ['username', 'not like', '%'.$me->username.'%']
        ])->get();
        
        return response()->json([
            'users' => $users
        ]);
    }

    /**
     * Store the connected client in SplObjectStorage
     * Notify all clients about total connection
     *
     * @param ConnectionInterface $conn
     */
    public function onOpen(ConnectionInterface $conn)
    {
        echo "Client connected " . $conn->resourceId . " \n";
        $this->clients->attach($conn);
        foreach ($this->clients as $client) {
            $client->send(json_encode([
                "type" => "socket",
                "msg" => "Total Connected: " . count($this->clients)
            ]));
        }
    }

    /**
     * Remove disconnected client from SplObjectStorage
     * Notify all clients about total connection
     *
     * @param ConnectionInterface $conn
     */
    public function onClose(ConnectionInterface $conn)
    {
        echo "Client left onClose " . $conn->resourceId . " \n";
        $this->clients->detach($conn);
        foreach ($this->clients as $client) {
            $client->send(json_encode([
                "type" => "socket",
                "msg" => "Total Connected: " . count($this->clients)
            ]));
        }
    }

    /**
     * Receive message from connected client
     * Broadcast message to other clients
     *
     * @param ConnectionInterface $from
     * @param string $data
     */
    public function onMessage(ConnectionInterface $from, $data)
    {
        $resource_id = $from->resourceId;
        $data = json_decode($data);
        $type = $data->type;
        switch ($type) {
            case 'chat':
                $message_content = $data->message_content;
                $response_from = "<span class='d-flex flex-column-reverse' style='text-align:right; background: #dbf1ff;'> $message_content <span style='color: grey;'>" . date('Y-m-d h:i a') . "</span></span><br><br>";
                $response_to = "<span class='d-flex flex-column-reverse' style='background: #f2f6f9;'> $message_content <span style='color: grey;'>" . date('Y-m-d h:i a') . "</span></span><br><br>";
                // Output
                $from->send(json_encode([
                    "type" => $type,
                    "msg" => $message_content,
                    "from" => "me"
                ]));

                foreach ($this->clients as $client) {
                    if ($from != $client) {
                        $client->send(json_encode([
                            "type" => $type,
                            "msg" => $message_content,
                            "from" => "other"
                        ]));
                    }
                }

                // Save to database
                $message = new Messages();
                $message->sent_from = $data->from;
                $message->sent_to = $data->to;
                $message->message_content = $message_content;
                $message->save();

                echo "Resource id $resource_id sent $message_content \n";
                break;
        }
    }

    /**
     * Throw error and close connection
     *
     * @param ConnectionInterface $conn
     * @param Exception $e
     */
    public function onError(ConnectionInterface $conn, Exception $e)
    {
        echo "Client left onError " . $conn->resourceId . " \n";
        $conn->close();
    }
}
