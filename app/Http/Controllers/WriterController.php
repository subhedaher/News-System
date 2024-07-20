<?php

namespace App\Http\Controllers;

use App\Models\Writer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class WriterController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Writer::class, 'writer');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $writers = Writer::with('roles')->paginate(5);
        return view('cms.writers.index', ['writers' => $writers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::where('guard_name', '=', 'writer')->get();
        return view('cms.writers.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'role_id' => 'required|numeric|exists:roles,id',
            'full_name' => 'required|string|min:3|max:45',
            'email' => 'required|email|unique:writers',
            'bio' => 'required|string',
            'address' => 'required|string|min:3|max:45',
            'phone_number' => 'required|string|unique:writers|min:12|max:15',
            'password' => [
                'required',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(), 'string', 'confirmed'
            ]
        ]);


        if (!$validator->fails()) {
            $writer = new Writer();
            $writer->full_name = $request->input('full_name');
            $writer->email = $request->input('email');
            $writer->address = $request->input('address');
            $writer->phone_number = $request->input('phone_number');
            $writer->bio = $request->input('bio');
            $writer->password = Hash::make($request->input('password'));
            $writer->admin_id = $request->user()->id;
            $saved = $writer->save();
            if ($saved) {
                $writer->assignRole((int)$request->input('role_id'));
            }
            return response()->json([
                'status' => $saved,
                'message' => $saved ? "Writer Added Successfully" : "Writer Added Failed!"
            ], $saved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json([
                'status' => false,
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Writer $writer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Writer $writer)
    {
        $roles = Role::where('guard_name', '=', 'writer')->get();
        $currentRole = $writer->roles()->first();
        return view('cms.writers.edit', ['roles' => $roles, 'currentRole' => $currentRole, 'writer' => $writer]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Writer $writer)
    {
        $validator = Validator($request->all(), [
            'role_id' => 'required|numeric|exists:roles,id',
        ]);

        if (!$validator->fails()) {
            $writer->syncRoles((int)$request->input('role_id'));
            return response()->json([
                'status' => true,
                'message' => "Writer updated Successfully"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Writer $writer)
    {
        $deleted = Writer::destroy($writer->id);
        return response()->json([
            'status' => $deleted,
            'message' => $deleted ? "Writer Deleted Successfully" : "Writer Deleted Failed!"
        ], $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
