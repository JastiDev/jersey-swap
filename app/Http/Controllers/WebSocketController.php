<?php

namespace App\Http\Controllers;

use App\Models\Messages;
use App\Models\Rooms;
use App\Models\RoomUsers;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use SplObjectStorage;

/**
 * @author Rohit Dhiman | @aimflaiims
 */
class WebSocketController implements MessageComponentInterface
{
    private $clients;
    private $users;
    private $userresources;

    public function __construct()
    {
        $this->clients = new SplObjectStorage;
        $this->users = [];
        $this->userresources = [];
    }

    public function index()
    {
        $my_id = Auth::id();
        $my_room_ids = DB::table('room_users')->where('user_id', $my_id)->pluck('room_id')->all();
        $user_list = DB::table('room_users')
            ->leftJoin('users', 'user_id', 'users.id')
            ->select('users.username', 'users.profile_picture', 'users.id', 'room_id')
            ->whereIn('room_id', $my_room_ids)
            ->where('user_id', '!=', $my_id)
            ->get();

        return view('frontend.pages.messages', [
            'user_list' => $user_list
        ]);
    }

    public function get_by_user(Request $request)
    {
        $my_id = Auth::id();
        $message_with = (int)$request->message_with;
        $my_room_ids = DB::table('room_users')->where('user_id', $my_id)->pluck('room_id')->all();
        $room_user = DB::table('room_users')->where('user_id', $message_with)->whereIn('room_id', $my_room_ids)->first();

        if ($room_user == NULL) {
            $room = new Rooms();
            $room->name = $my_id . '-' . $message_with;
            $room->save();

            $room_user_me = new RoomUsers();
            $room_user_me->room_id = $room->id;
            $room_user_me->user_id = $my_id;
            $room_user_me->save();

            $room_user_other = new RoomUsers();
            $room_user_other->room_id = $room->id;
            $room_user_other->user_id = $message_with;
            $room_user_other->save();

            return response()->json([
                'messages' => [],
                'room_id' => $room->id
            ]);

        } else {
            $messages = Messages::where('room_id', '=', $room_user->room_id)->get();
            $list = [];
            foreach ($messages as $message) {
                /** @var Messages $message */
                $message->read_at = time();
                $message->save();

                $message = $message->toArray();
                $date = new \DateTime($message['created_at']);
                $message['created_at'] = $date->format(DATE_ISO8601);
                $date = new \DateTime($message['updated_at']);
                $message['updated_at'] = $date->format(DATE_ISO8601);
                $list[] = $message;
            }

            unset($message, $date, $messages);

            return response()->json([
                'messages' => $list,
                'room_id' => $room_user->room_id
            ]);
        }
    }

    public function get_users(Request $request)
    {
        $me = Auth::user();
        $users = User::where([
            ['username', 'like', '%' . $request->keyword . '%'],
            ['username', 'not like', '%' . $me->username . '%']
        ])->get();

        return response()->json([
            'users' => $users
        ]);
    }

    public function count_new(Request $request)
    {
        $my_id = Auth::id();
        $my_room_ids = DB::table('room_users')->where('user_id', $my_id)->pluck('room_id')->all();

        $new_messages = [];
        foreach ($my_room_ids as $room_id) {
            $new_messages[] = [
                'room_id' => $room_id,
                'messages' => DB::table('messages')
                    ->where('room_id', '=', $room_id)
                    ->where('sent_from', '!=', $my_id)
                    ->whereNull('read_at')
                    ->count()
            ];
        }

        return response()->json([
            'count_messages' => $new_messages
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
        $this->users[$conn->resourceId] = $conn;
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
                $images_str = $data->images_str;

                if (strlen($images_str) > 0) { //if image is attached.
                    $images_arr = explode(':::', $images_str);
                    $temp = array_pop($images_arr);

                    foreach ($temp as $image) {
                        $base64_image = $image; // your base64 encoded
                        @list(, $file_data) = explode(';', $base64_image);
                        @list(, $img_data) = explode(',', $file_data);

                        $imageName = uniqid() . '.png';
                        $img = Image::make($file_data);
                        $img->resize(300, 300, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save(storage_path('app/public/messages') . '/' . $imageName);

                        $from->send(json_encode([
                            "type" => "img",
                            "msg" => $imageName,
                            "from" => "me"
                        ]));

                        if (isset($this->userresources[$data->to])) {
                            foreach ($this->userresources[$data->to] as $key => $resourceId) {
                                if (isset($this->users[$resourceId])) {
                                    $this->users[$resourceId]->send(json_encode([
                                        "type" => "img",
                                        "msg" => $imageName,
                                        "from" => $data->from
                                    ]));;
                                }
                            }
                        }
                        Messages::create([
                            'message_content' => $imageName,
                            'sent_from' => $data->from,
                            'room_id' => $data->room_id
                        ]);
                    }
                    if (strlen($message_content) > 0) { //if content is sent too.
                        $from->send(json_encode([
                            "type" => $type,
                            "msg" => $message_content,
                            "from" => "me"
                        ]));

                        if (isset($this->userresources[$data->to])) {
                            foreach ($this->userresources[$data->to] as $key => $resourceId) {
                                if (isset($this->users[$resourceId])) {
                                    $this->users[$resourceId]->send(json_encode([
                                        "type" => $type,
                                        "msg" => $message_content,
                                        "from" => $data->from
                                    ]));;
                                }
                            }
                        }

                        // Save to database
                        $message = new Messages();
                        $message->sent_from = $data->from;
                        $message->room_id = $data->room_id;
                        $message->message_content = $message_content;
                        $message->save();
                    }

                } else { //if image is NOT attached.
                    // Output
                    $from->send(json_encode([
                        "type" => $type,
                        "msg" => $message_content,
                        "from" => "me"
                    ]));

                    if (isset($this->userresources[$data->to])) {
                        foreach ($this->userresources[$data->to] as $key => $resourceId) {
                            if (isset($this->users[$resourceId])) {
                                $this->users[$resourceId]->send(json_encode([
                                    "type" => $type,
                                    "msg" => $message_content,
                                    "from" => $data->from
                                ]));;
                            }
                        }
                    }

                    // Save to database
                    $message = new Messages();
                    $message->sent_from = $data->from;
                    $message->room_id = $data->room_id;
                    $message->message_content = $message_content;
                    $message->save();
                }
                echo "Resource id $resource_id sent $message_content \n";
                break;
            case 'socket':
                if (isset($data->user_id)) {
                    if (isset($this->userresources[$data->user_id])) {
                        if (!in_array($from->resourceId, $this->userresources[$data->user_id])) {
                            $this->userresources[$data->user_id][] = $from->resourceId;
                        }
                    } else {
                        $this->userresources[$data->user_id] = [];
                        $this->userresources[$data->user_id][] = $from->resourceId;
                    }
                }
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
        // $conn->close();
        echo 'Error' . $e->getMessage() . PHP_EOL;

        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} has disconnected\n";
        unset($this->users[$conn->resourceId]);

        foreach ($this->userresources as &$userId) {
            foreach ($userId as $key => $resourceId) {
                if ($resourceId == $conn->resourceId) {
                    unset($userId[$key]);
                }
            }
        }
    }
}
